<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicalWorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution',
        'typeInstitution',
        'position',
        'typePosition',
        'startedAt',
        'endedAt',
        'contractTypeId',
        'professorId'
    ];

    public function professor(){
        return $this->belogsTo(Professor::class);
    }

    public function contract_type(){
        return $this->belogsTo(ContratType::class);
    }
}
