<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AcademicalWorkExperience extends Model
{
    use HasFactory;
    use HasUuids;

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

    public function professor():BelongsTo{
        return $this->belogsTo(Professor::class);
    }

    public function contract_type():BelongsTo{
        return $this->belogsTo(ContratType::class);
    }
}
