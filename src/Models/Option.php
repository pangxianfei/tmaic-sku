<?php

namespace Tmaic\TmaicSku\Models;

use Tmaic\TmaicSku\Contracts\OptionContract;
use Illuminate\Database\Eloquent\Model;

class Option extends Model implements OptionContract
{
    protected $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('tmaic-sku.table_names.options'));
    }

    public static function findByName(string $name)
    {
        return static::whereName($name)->first();
    }
}