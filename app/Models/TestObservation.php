<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestObservation extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function test_schedule()
    {
        return $this->belongsTo(TestSchedule::class);
    }

    public function competence_criteria()
    {
        return $this->belongsTo(CompetenceCriteria::class);
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_user_id');
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_user_id');
    }
}
