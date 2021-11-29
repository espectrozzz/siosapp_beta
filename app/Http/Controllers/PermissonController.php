<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\permiso;
use Illuminate\Support\Facades\Hash;

class PermissonController extends Controller
{
	public function selectRoles(){
		$datos = Role::all();
        return json_encode($datos);
	}
    
    public function tablaRoles(Request $request){
    	$permisos = DB::table('permissions')
           ->join('role_has_permissions', 'permissions.id','=', 'role_has_permissions.permission_id')
           ->select('permissions.name', 'permissions.id')
           ->where('role_has_permissions.role_id', '=', $request->rol)
           ->get();
    	// return $request->rol;
    	return json_encode($permisos);
    }

    public function eliminarPermiso(Request $request){
    	DB::table('role_has_permissions')
    		->where('permission_id', '=', $request->permiso)
    		->where('role_id', '=', $request->rol)
    		->delete();
    	return $request->permiso;
    }

    public function cargarCheckboxPermiso(Request $request){

    	// return $request;

    	$permisos_actuales = permiso::
           select('permissions.name', 'permissions.id')
           ->FiltrarPermisos($request->permisos)
           ->get();

    	return json_encode($permisos_actuales);
    }

    public function agregarPermisos(Request $request){

    	for ($i=0; $i < count($request->permisos); $i++) { 

    		$permiso = $request->permisos[$i];

	    	DB::table('role_has_permissions')
	    		->insert([
					    'permission_id' => $permiso,
					    'role_id' => $request->rol
					]);
    	}


    	// foreach ($request->permisos as $key => $value) {
    	// }

    	return 200;
    	// return $request;
    }

    public function tablaUsuarios(Request $request){
          $rol = $request->rol;
          $nombre = $request->nombre;
          if ($rol == "0" && $nombre == "") { //Traer  todos los usuarios 
            $usuarios_roles = DB::table('users')
                                ->select('users.name', 'users.email', 'users.id', 'roles.id as id_rol', 'roles.name as name_rol')
                                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                                ->get();
          }elseif ($rol != "0" && $nombre == "") {  //Filtrar usuarios por rol
            $usuarios_roles = DB::table('users')
                                ->select('users.name', 'users.email', 'users.id', 'roles.id as id_rol', 'roles.name as name_rol')
                                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                                ->where('model_has_roles.role_id', '=', $rol)
                                ->get();
          }elseif ($rol == "0" && $nombre != "") { //Filtrar usuarios por input
            $usuarios_roles = DB::table('users')
                                ->select('users.name', 'users.email', 'users.id', 'roles.id as id_rol', 'roles.name as name_rol')
                                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                                ->where('users.name', 'like', '%' . $nombre . '%')
                                ->get();
          }else { //Filtrar usuarios por input y rol 
            $usuarios_roles = DB::table('users')
                                ->select('users.name', 'users.email', 'users.id', 'roles.id as id_rol', 'roles.name as name_rol')
                                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                                ->where('model_has_roles.role_id', '=', $rol)
                                ->where('users.name', 'like', '%' . $nombre . '%')
                                ->get(); 
          }

      return $usuarios_roles;
    }

    // public function editarUsuario(Request $request){
    //   return $request;
    // }

    // public function editarPassword(Request $request){
    //   return $request;
    // }

    // public function editarRol(Request $request){
    //   return $request;
    // }

    public function editarUsuario(Request $request){
      $query = User::find($request->id);
      $query->name = $request->usuario;
      $query->email = $request->correo;
      $query->save();
      $filas_afectadas = $query->wasChanged();
      if ($filas_afectadas) {
        return 200;
      }else{
        return 500;
      }
    }

    public function editarPassword(Request $request){
      // $password_encriptada = Hash::make($request->password_nueva);
      // $query = User::find($request->id);
      // $password_base = $query->password;


      // if (Hash::check($request->password_nueva, $password_base)) {
      //   return "Ls contraseñas coinciden";
      // }
      // else{
      //   return "Las contraseñas no coinciden :)";
      // }

      $query = User::find($request->id);
      $query->fill([  
                      'password' => Hash::make($request->password_nueva)  
                  ])->save(); 
      // $query->password = $password_encriptada;
      // $query->password = $request->password_nueva;
      // $query->save();
      $filas_afectadas = $query->wasChanged();

      if ($filas_afectadas) {
        return 200;
      }else{
        return 500;
      }
      // return $password_encriptada;
    }

    public function editarRol(Request $request){
      // $query = Role::find($request->id);
      $query = DB::table('model_has_roles')
        ->where('model_id', '=', $request->id)
        ->update(['role_id' => $request->rol]);      

      if ($query) {
        return 200;
      }else{
        DB::table('model_has_roles')->insert([
              'model_id' => $request->id,
              'model_type' => 'App\Models\User',
              'role_id' => $request->rol
          ]);
        return 400;
      }
      // return $request;
    }
}
