<?php

namespace App\Models;

use App\Traits\UuidForPrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use UuidForPrimaryKeyTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'company_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function coverLetters()
    {
        return $this->hasMany(CoverLetter::class);
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    public function prompts()
    {
        return $this->hasMany(Prompt::class);
    }
}
