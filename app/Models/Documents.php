<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documents extends Model
{
    //

    use SoftDeletes;

    protected $table = 'dokuments';
    protected $primaryKey = 'dokumen_id';
    protected $fillable = [
        'judul_dokumen',
        'tanggal_upload',
        'tipe_dokumen',
        'ukuran_dokumen',
        'path_file',
        'deskripsi',
        'status_dokumen',
        'user_id'
    ];

    public function histories()
    {
        return $this->belongsTo(Histories::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Cetak::class);
    }

}
