<?php

namespace App\Models;

use App\Traits\UuidForPrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use UuidForPrimaryKeyTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'level',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
