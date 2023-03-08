<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $table='equipements';
    protected $primaryKey='id';
    protected $fillable=
    [
        'name',
        'description',
        'ip_adress',
        'type'
    ];
}
