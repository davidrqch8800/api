<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



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
    
    public function professor(): BelongsTo{
        return $this->belogsTo(Professor::class);
    }
}
