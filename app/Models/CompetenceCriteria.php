<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceCriteria extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function competence_element()
    {
        return $this->belongsTo(CompetenceElement::class);
    }
}
