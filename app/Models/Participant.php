<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['payment_receipt_file'];

    public function docs()
    {
        return $this->hasOne(ParticipantDoc::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
