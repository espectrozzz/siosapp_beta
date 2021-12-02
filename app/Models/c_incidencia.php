<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class c_incidencia extends Model
{
    use HasFactory;

    public function tFolios(){
        return $this->belongsToMany(c_tipo_folio::class, 'incidencia_has_tfolios', 'incidencia_id', 'tfolio_id');
    }
}
