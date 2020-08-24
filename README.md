## tmaic-sku

> 适用于Laravel的商品属性，SKU模块实现

### #名词介绍

- 选项     
商品属性值的键名，如`颜色`,`尺寸` 等
- 属性值   
商品某选项对应的值，同一商品同一选项下可有多个属性值
- SKU   
库存控制的最小可用单位，可通过不同的属性值组合来搭配不同金额，不同库存的SKU

### #安装

**引入**

```bash
composer require tmaic/tmaic-sku
```

**发布迁移文件**

```bash
php artisan vendor:publish --tag=tmaic-sku-migrations
```

**运行迁移**

```bash
php artisan migrate
```

**如果需要发布配置文件，请运行以下命令:**

```bash
php artisan vendor:publish --tag=tmaic-sku-config
```

### #使用

**在商品模型中引入`Tmaic\TmaicSku\Traits\HasSku`Trait**

```php
use Illuminate\Database\Eloquent\Model;
use Tmaic\TmaicSku\Traits\HasSku;

class Product extends Model
{
    use HasSku;
}
```

---

**注意事项**
如果报以下错误

SQLSTATE[42000]: Syntax error or access violation: 1463 Non-grouping field 'attrs_count' is used in HAVING clause (SQL: select `skus`.*, (select count(*) from `attrs` inner join `attr_sku` on `attrs`.`id` = `attr_sku`.`attr_id` where `skus`.`id` = `attr_sku`.`sku_id`) as `attrs_count` from `skus` where `id` in (select `sku_id` from `attr_sku` where `sku_id` in (select `sku_id` from `attr_sku` where `attr_id` in (79, 84))) having `attrs_count` = 2 limit 1)

需要在 config/database.php 下的配置：如下

'strict' => false,

将 strict 改为 false

**选项新增**

```php
use Tmaic\TmaicSku\Models\Option;
Option::create(['name' => '尺寸']);
```

**选项删除**

```php
$option->delete();
```

---

**获取商品属性值**

```php
$poduct->attrs()->get();
$poduct->attrs;
```

**新增商品属性值**

```php
$product->addAttrValues($option, ['S', 'M', 'L']);
$product->addAttrValues('套餐', ['套餐一', '套餐二', '套餐三']);
```

**同步商品属性值**

```php
$product->syncAttrValues($option, ['红色', '白色']);
```

**移除某选项下的所有属性值**

```php
$product->removeAttrValues($option);
```

参数说明:
```php
addAttrValues($option, ...$value)
syncAttrValues($option, ...$value)
removeAttrValues($option)
```
> 1. `$option` 属性实例/属性ID/属性名称
> 2. `$value` 属性值数组 每一项将会创建或同步属性值

---

**创建(同步)SKU**

> 如果属性值存在，则更新SKU，否则创建SKU     
> sku的属性组合是建立在产品基础属性值之上的，分配sku属性值组合前请添加产品属性值

```php
$product->syncSkuWithAttrs([$attr1, $attr2, $attr3], ['amount' => 5000, 'stock' => 100]);
```
`syncSkuWithAttrs`参数说明:
> 1. `$position` 属性值组合数组,每项类型为:`属性值实例`/`属性值ID`
> 2. `$payload` SKU数据，如`金额`,`库存`等

**获取SKU**

```php
use Tmaic\TmaicSku\Models\Sku;
// 通过属性值组合获取sku
$sku = Sku::findByPosition($attr1, $attr2);
// 获取产品sku实例
$product->skus()->get();
```

**删除SKU**

```php
$sku->delete();
$product->skus()->delete();
```

**通过属性值组合获取SKU**

```php
use Tmaic\TmaicSku\Models\Sku;
Sku::findByPosition([$attr1, $attr2, $attr3])
```

**调整SKU的属性值组合**

```php
// 增加属性值组合
$sku->assignAttrs([$attr1, $attr2])
// 同步属性值组合
$sku->syncAttrs([$attr1, $attr2])
// 移除属性值组合
$sku->removeAttrs([$attr1, $attr2])
```

---

**完整示例**
```php
// 创建产品
$product = Goods::create(['GoodsName' => 'phone 11 Pro Max']);

// 准备作为sku属性
$colorAttrs = $product->addAttrValues('选择外观', ['深空灰', '银色']);
$capacity  = $product->addAttrValues('存储容量', ['128GB', '256GB']);

// 获取属性值实例
$black = $colorAttrs->firstWhere('value', '黑色');
$white = $colorAttrs->firstWhere('value', '白色');
$siz128GB = $capacity->firstWhere('value', '128GB');
$siz256GB = $capacity->firstWhere('value', '256GB');

// 组合属性值，建立sku
$product->syncSkuWithAttrs([$black, $siz128GB], ['amount' => 12699, 'stock' => 100]);
$product->syncSkuWithAttrs([$black, $siz256GB], ['amount' => 12699, 'stock' => 100]);
$product->syncSkuWithAttrs([$white, $siz128GB], ['amount' => 12699, 'stock' => 100]);
$product->syncSkuWithAttrs([$white, $siz256GB], ['amount' => 12699, 'stock' => 100]);

// 获取商品及商品SKU数据
$product = $product->load('skus.attrs.option');
```
