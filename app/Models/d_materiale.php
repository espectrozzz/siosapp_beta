<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class d_materiale extends Model
{
    protected $fillable = ['folio_id','material_id','cantidad','estado_id'];
    use HasFactory;
}
