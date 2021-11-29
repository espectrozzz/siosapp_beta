<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class d_coo_daño extends Model
{
    protected $fillable = ['folio_id','coordenadas'];
    use HasFactory;
    
}
