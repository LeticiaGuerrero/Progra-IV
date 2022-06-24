<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    protected $table = 'tbl_vehiculos';
    
    protected $primaryKey = 'idVehiculo';

    protected $fillable = [
        'marca',
        'modelo',
        'year',
        'num_motor',
        'Num_chasis',
    ];

    public $timestamps = false;


}