<?php
/**
 * tmiac商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2020-2025 tmaic 保留所有权利。
 * ----------------------------------------------
 * 官方网址: http://www.tmaic.com.

 * =========================================================
 * @author : pangxianfei 421339244@qq.com
 */
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