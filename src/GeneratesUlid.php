<?php

namespace Vanthao03596\LaravelUlid;

use Illuminate\Support\Str;
use Ulid\Ulid;

trait GeneratesUlid
{
    public static function bootGeneratesUlid(): void
    {
        static::creating(function ($model) {
            foreach ($model->ulidColumns() as $item) {
                /* @var \Illuminate\Database\Eloquent\Model|static $model */
                $ulid = Str::ulid();

                if (isset($model->attributes[$item]) && ! is_null($model->attributes[$item])) {
                    /* @var \Ulid\Ulid $ulid */
                    $ulid = Ulid::fromString($model->attributes[$item]);
                }

                $model->{$item} = (string) $ulid;
            }
        });
    }

    /**
     * The name of the column that should be used for the ULID.
     *
     * @return string
     */
    public function ulidColumn(): string
    {
        return 'ulid';
    }

    /**
     * The names of the columns that should be used for the ULID.
     *
     * @return array
     */
    public function ulidColumns(): array
    {
        return [$this->ulidColumn()];
    }
}
