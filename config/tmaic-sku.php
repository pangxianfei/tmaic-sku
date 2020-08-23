<?php

return [
    /*
     * 表名映射
     */
    'table_names' => [
        /*
         * sku表,金额，库存等信息
         */
        'skus' => 'skus',

        /*
         * 选项表，单独存放sku属性选项值，如"颜色","尺寸"
         */
        'options' => 'options',

        /*
         * 商品的属性值表，商品同选项下不同值为多个属性值
         */
        'attrs' => 'attrs',

        /*
         * sku与产品属性值之前的多对多关联表，用于确认sku所对应的属性值搭配
         */
        'attr_sku' => 'attr_sku',
    ],

    /*
     * 模型映射
     */
    'models' => [
        /*
         * sku模型，需实现 Tmaic\TmaicSku\Contracts\SkuContract
         */
        'Sku' => \Tmaic\TmaicSku\Models\Sku::class,

        /*
         * 选项模型，需实现 Tmaic\TmaicSku\Contracts\OptionContract
         */
        'Option' => \Tmaic\TmaicSku\Models\Option::class,

        /*
         * 属性值模型,需实现 Tmaic\TmaicSku\Contracts\AttrContract
         */
        'Attr' => \Tmaic\TmaicSku\Models\Attr::class,

        /*
         * 属性与SKU多对多中间模型
         */
        'AttrSku' => \Tmaic\TmaicSku\Models\AttrSku::class,
    ],

    /*
     * 商品多态关联名称
     */
    'tmaic_name' => 'producible'
];
