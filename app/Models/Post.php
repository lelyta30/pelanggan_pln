<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'id_pelanggan',
        'name',
        'address',
        'tariff',
        'daya',
        'no_meter',
        'merk_meter',
        'type_meter',
        'no_comm_device',
        'merk_comm_device',
        'type_comm_device',
        'port',
        'phone',
        'provider',
        'ip_address',
    ];
}