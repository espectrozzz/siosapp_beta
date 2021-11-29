<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class d_imagene extends Model
{
    protected $fillable = ['folio_id','url','uuid','estado_id','timagen_id'];
    use HasFactory;
}
