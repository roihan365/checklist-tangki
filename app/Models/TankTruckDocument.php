<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TankTruckDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'tank_truck_id',
        'jenis_dokumen',
        'nomor_dokumen',
        'tanggal_terbit',
        'tanggal_kadaluarsa',
        'file_path',
        'status',
        'catatan',
        'reviewed_by',
        'reviewed_at'
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_kadaluarsa' => 'date',
        'reviewed_at' => 'datetime'
    ];

    public function tankTruck()
    {
        return $this->belongsTo(TankTruck::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getDocumentStatusAttribute()
    {
        return [
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ][$this->status] ?? $this->status;
    }
}
