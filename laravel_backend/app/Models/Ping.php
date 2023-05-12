<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    use HasFactory;
    protected $table='pings';
    protected $primaryKey='id';
    protected $fillable=
    [   'ip_adress',
        'result',
        'time',
        //'color',
         
    ];
}
