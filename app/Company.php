<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'img_path',
        'website',
    ];

    public function getImgPathAttribute($value)
    {
        return Storage::disk('public')->url("companies_logo/$value");
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
