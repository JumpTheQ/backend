<?php

namespace App\Models;

use App\Actions\HandleApplicationSavedAction;
use App\Traits\UuidForPrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use UuidForPrimaryKeyTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'keywords',
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

    public static function booted(): void
    {
        static::saved(function ($model) {
            $handleApplicationSavedAction = new HandleApplicationSavedAction();
            $handleApplicationSavedAction($model);
        });
    }
}
