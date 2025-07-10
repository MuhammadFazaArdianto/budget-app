<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeModel extends Model
{
    protected $table = 'incomes';

    protected $fillable = [
        'user_id',
        'kategori',
        'jumlah',
        'tgl_pemasukan',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
