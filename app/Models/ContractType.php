<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category',
        'classification'
    ];
    
    public function academical_work_experience():BelongsTo{
        return $this->belogsTo(AcademicalWorkExperience::class);
    }
}
