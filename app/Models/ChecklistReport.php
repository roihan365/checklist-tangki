<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistReport extends Model
{
    protected $fillable = [
        'report_name',
        'report_format',
        'parameters',
        // 'file_path',
        'user_id',
        'status',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
