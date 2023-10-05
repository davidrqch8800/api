<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'category',
        'classification'
    ];
    
    public function academical_work_experience(){
        return $this->belogsTo(AcademicalWorkExperience::class);
    }
}
