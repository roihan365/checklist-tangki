<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TankTruckHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'tank_truck_id',
        'aktivitas',
        'deskripsi',
        'user_id',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function tankTruck()
    {
        return $this->belongsTo(TankTruck::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
