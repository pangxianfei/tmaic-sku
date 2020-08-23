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

use Tmaic\TmaicSku\Contracts\AttrContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attr extends Model implements AttrContract
{
    protected $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('tmaic-sku.table_names.attrs'));
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(config('tmaic-sku.models.Option'));
    }

    public function producible(): MorphTo
    {
        return $this->morphTo(config('tmaic-sku.tmaic_name'));
    }

    public function skus(): BelongsToMany
    {
        return $this->belongsToMany(
            config('tmaic-sku.models.Sku'),
            config('tmaic-sku.table_names.attr_sku')
        )->using(config('tmaic-sku.models.AttrSku'));
    }
}
