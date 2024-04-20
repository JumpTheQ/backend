<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UuidForPrimaryKeyTrait
{
    /**
     * Boot the Uuid trait for the model.
     *
     * @return void
     */
    public static function bootUuidForPrimaryKeyTrait()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
