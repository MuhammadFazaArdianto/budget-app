<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutcomeModel extends Model
{
    protected $table = 'outcomes';

    protected $fillable = [
        'user_id',
        'kategori',
        'jumlah',
        'tgl_pengeluaran',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
