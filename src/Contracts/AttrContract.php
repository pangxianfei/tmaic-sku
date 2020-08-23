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
namespace Tmaic\TmaicSku\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

interface AttrContract
{
    /**
     * 获取所属选项
     *
     * @return BelongsTo
     */
    public function option(): BelongsTo;

    /**
     * 获取所属产品
     *
     * @return MorphTo
     */
    public function producible(): MorphTo;

    /**
     * 获取使用此键值的sku
     *
     * @return BelongsToMany
     */
    public function skus(): BelongsToMany;
}