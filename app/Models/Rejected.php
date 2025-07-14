<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rejected extends Model
{
    //

    use SoftDeletes;

    protected $table = 'rejected';
    protected $primaryKey = 'rejected_id';

    protected $fillable = [
        'entity_terkait_id',
        'tanggal_rejected',
        'alasan_rejected',
        'status_rejected',
        'catatan'.
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
