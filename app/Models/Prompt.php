<?php

namespace App\Models;

use App\Traits\UuidForPrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use App\Actions\HandlePromptAction;

class Prompt extends Model
{
    use UuidForPrimaryKeyTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'application_id',
        'user_id',
        'promptable_id',
        'promptable_type'
    ];

    public function promptable()
    {
        return $this->morphTo();
    }

    public static function booted(): void
    {
        // TODO: Remove me once frontend is integrated
        static::saving(function ($model) {
            $handlePromptSavingAction = new HandlePromptAction();
            $handlePromptSavingAction($model);
        });
    }
}
