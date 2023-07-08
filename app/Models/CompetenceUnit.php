<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceUnit extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function competence_elements()
    {
        return $this->hasMany(CompetenceElement::class);
    }
}
