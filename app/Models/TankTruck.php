<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TankTruck extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'plat_nomor',
        'nomor_lambung',
        'jenis_kendaraan',
        'merk',
        'tipe',
        'tahun_pembuatan',
        'warna',
        'kapasitas',
        'nomor_rangka',
        'nomor_mesin',
        'distributor_id',
        'status',
        'tanggal_aktif',
        'tanggal_nonaktif',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_aktif' => 'date',
        'tanggal_nonaktif' => 'date',
        'kapasitas' => 'decimal:2'
    ];

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }

    public function documents()
    {
        return $this->hasMany(TankTruckDocument::class);
    }

    public function histories()
    {
        return $this->hasMany(TankTruckHistory::class)->latest();
    }

    public function checklistSchedules()
    {
        return $this->hasMany(ChecklistSchedule::class, 'vehicle_id');
    }

    public function pendingDocuments()
    {
        return $this->documents()->where('status', 'pending');
    }

    public function approvedDocuments()
    {
        return $this->documents()->where('status', 'approved');
    }

    public function rejectedDocuments()
    {
        return $this->documents()->where('status', 'rejected');
    }

    public function checklistDocuments()
    {
        return $this->hasMany(ChecklistDocument::class, 'vehicle_id');
    }
}
