<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as Permisos;

class permiso extends Permisos
{
    use HasFactory;

	// public function __get($name)
 //    {
 //        $value = $this->get($name);
        // if array return another collection instance.
    //     if (is_array($value)) {
    //         return $this->make($value);
    //     }
    //     return $value;
    // }

    public function scopeFiltrarPermisos($query,$permisos){
        if($permisos){
            foreach ($permisos as $permiso) {
                    $query->Where('permissions.id','<>', $permiso);
            }
            return $query;
        }
    }

}
