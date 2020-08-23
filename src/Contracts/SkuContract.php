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

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

interface SkuContract
{
    /**
     * 获取所属产品
     *
     * @return MorphTo
     */
    public function producible(): MorphTo;

    /**
     * 获取属性键值
     *
     * @return BelongsToMany
     */
    public function attrs(): BelongsToMany;

    /**
     * 同步属性键值
     *
     * @param mixed ...$attrs
     * @return mixed
     */
    public function syncAttrs(...$attrs);

    /**
     * 分配属性键值
     *
     * @param mixed ...$attrs
     * @return mixed
     */
    public function assignAttrs(...$attrs);

    /**
     * 移除属性键值
     *
     * @param mixed ...$attrs
     * @return mixed
     */
    public function removeAttrs(...$attrs);

    /**
     * 通过属性值组合查询sku实例
     *
     * @param array $position
     * @return mixed
     */
    public static function findByPosition(...$position);
}