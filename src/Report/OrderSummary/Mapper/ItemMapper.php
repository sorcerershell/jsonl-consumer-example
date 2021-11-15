<?php

namespace App\Report\OrderSummary\Mapper;

use App\Model\OrderLineItem;
use App\Model\Product;

class ItemMapper
{
    public static function mapFromArray(OrderLineItem $item, array $source) {
        $item->setQuantity($source["quantity"]);
        $item->setUnitPrice($source["unit_price"]);
        self::mapProduct($source["product"], $item);
    }

    /**
     * @param $product1
     * @param OrderLineItem $item
     */
    private static function mapProduct($product1, OrderLineItem $item): void
    {
        $product = new Product();
        if ($product1 != null && count($product1) > 0) {
            ProductMapper::mapFromArray($product, $product1);
        }
        $item->setProduct($product);
    }
}