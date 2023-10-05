<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni',
        'lastName',
        'motherLastName',
        'firstName',
        // 'birthDate',
        'gender', 
        'nationality', 
        'ubigeoCode',
        // 'mediaContactId'
    ];

    public function academical_work_experiences(){
        return $this->hasMany(AcademicalWorkExperience::class);
    }

    public function media_contact(){
        return $this->belogsTo(MediaContact::class);
    }
}
