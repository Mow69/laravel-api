<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'image',
        'status',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
       // return $this->image ? Storage::disk('public')->url($this->image) : null;
       return $this->image ? asset('storage/images/profils/' . $this->image) : null;

    }
}
