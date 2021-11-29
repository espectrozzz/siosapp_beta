<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class c_concepto extends Model
{
    protected $fillable = ['folio_id','concepto_id','cantidad','estado_id'];
    use HasFactory;
}
