<?php

namespace Tmaic\TmaicSku\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttrSku extends Pivot
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('tmaic-sku.table_names.attr_sku'));
    }
}