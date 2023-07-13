<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantCompetency extends Model
{
    use HasFactory;

    protected $table = 'participants_competencies';

    protected $guarded = [];
}
