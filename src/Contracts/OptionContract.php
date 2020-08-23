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

interface OptionContract
{
    /**
     * 通过名称查询选项
     *
     * @param string $name
     * @return mixed
     */
    public static function findByName(string $name);
}