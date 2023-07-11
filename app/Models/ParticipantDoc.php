<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantDoc extends Model
{
    use HasFactory;

    protected $table = 'participants_docs';

    protected $guarded = [];
}
