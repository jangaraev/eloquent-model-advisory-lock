<?php

namespace Jangaraev\EloquentModelAdvisoryLock;

use Illuminate\Support\Facades\DB;

trait AppliesAdvisoryLock
{
    /*public static function lockedFirstOrCreate(array $attributes, array $values = [])
    {
        return static::advisoryLock(fn () => (new static)->newQuery()->firstOrCreate($attributes, $values));
    }*/

    protected static function advisoryLock(callable $callback)
    {
        $lockName = substr(static::class . ' *OrCreate lock', -64);

        DB::statement("SELECT GET_LOCK('{$lockName}', 3)");

        $output = $callback();

        DB::statement("SELECT RELEASE_LOCK('{$lockName}')");

        return $output;
    }
}
