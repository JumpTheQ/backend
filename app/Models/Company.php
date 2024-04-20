<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'website'
    ];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
