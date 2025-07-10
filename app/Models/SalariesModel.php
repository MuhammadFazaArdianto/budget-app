<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalariesModel extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'user_id',
        'total_gaji',
        'tgl_gajian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
