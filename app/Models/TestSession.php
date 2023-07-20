<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected function startedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i')
        );
    }

    protected function endedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i')
        );
    }
}
