<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_user_id');
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_user_id');
    }

    public function agreement() {
        return $this->hasOne(TestAgreement::class);
    }
}
