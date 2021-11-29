<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class d_seguimiento extends Model
{
    protected $fillable = ['folio_id','observacion','estado_id'];
    use HasFactory;
}
