<?php

namespace App\Models;

use App\Traits\UuidForPrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use UuidForPrimaryKeyTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'order',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sectionable()
    {
        return $this->morphTo();
    }

    public function prompts()
    {
        return $this->morphMany(Prompt::class, 'promptable');
    }
}
