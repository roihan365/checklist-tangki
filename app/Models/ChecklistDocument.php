<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistDocument extends Model
{
    protected $fillable = [
        'checklist_schedule_id',
        'petugas_id',
        'vehicle_id',
        'status',
        'file_path',
        'catatan',
    ];

    public function tankTruck()
    {
        return $this->belongsTo(TankTruck::class, 'vehicle_id');
    }

    public function checklistSchedule()
    {
        return $this->belongsTo(ChecklistSchedule::class, 'checklist_schedule_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
