<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'email',
        'phone',
        'socialMedia',
        'linkSocialNetwork'
    ];
    
    public function professor(){
        return $this->belogsTo(Professor::class);
    }
}
