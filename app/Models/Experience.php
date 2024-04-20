<?php

namespace App\Models;

use App\Traits\UuidForPrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use UuidForPrimaryKeyTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'company',
        'description',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
