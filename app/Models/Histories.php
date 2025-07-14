<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Histories extends Model
{
    //

    use SoftDeletes;

    protected $table = 'histories';
    protected $primaryKey = 'histories_id';
    protected $fillable = [
        'jenis_aksi',
        'waktu_aksi',
        'keterangan',
        'user_id',
        'dokument_id',

    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function documents()
    {
        return $this->belongsTo(Documents::class);
    }

}
