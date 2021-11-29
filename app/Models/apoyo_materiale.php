<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apoyo_materiale extends Model
{
	protected $fillable = ['id', 'ots', 'fechacierre', 'cluster', 'coordenadas', 'M25', 'M26', 'M27', 'M28', 'M29', 'M30', 'M31', 'M32', 'M33', 'M34', 'M35', 'M36', 'M37', 'M38', 'M39', 'M40'];
    use HasFactory;
}
