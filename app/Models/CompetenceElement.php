<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceElement extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function competence_unit()
    {
        return $this->belongsTo(CompetenceUnit::class);
    }

    public function competence_criterias()
    {
        return $this->hasMany(CompetenceCriteria::class);
    }
}
