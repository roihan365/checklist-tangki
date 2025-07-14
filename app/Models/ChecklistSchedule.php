<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tanggal',
        'waktu',
        'lokasi',
        'distributor_id',
        'vehicle_id',
        'jenis_layanan',
        'status',
        'catatan',
        'created_by'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(TankTruck::class, 'vehicle_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function checklistDocuments()
    {
        return $this->hasMany(ChecklistDocument::class);
    }
}