<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function participant_user()
    {
        return $this->belongsTo(User::class);
    }

    public function assessor_user()
    {
        return $this->belongsTo(User::class);
    }
}
