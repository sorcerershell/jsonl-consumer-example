<?php

namespace App\Report\OrderSummary\Mapper;

use App\Model\Brand;
use App\Model\Product;

class ProductMapper
{
    public static function mapFromArray(Product $product, array $source) {
        self::mapProductDetails($product, $source);
        self::mapProductBrand($source["brand"], $product);
    }

    /**
     * @param Product $product
     * @param array $source
     */
    private static function mapProductDetails(Product $product, array $source): void
    {
        $product->setProductId($source["product_id"]);
        $product->setTitle($source["title"]);
        $product->setSubtitle($source["subtitle"]);
        $product->setThumbnail($source["thumbnail"]);
        $product->setUpc($source["upc"]);
        $product->setUrl($source["url"]);
        $product->setGtin14($source["gtin14"]);
        $product->setImage($source["image"]);
        $product->setCreatedAt(\DateTime::createFromFormat("Y-m-d H:i:s",$source["created_at"]));
    }

    /**
     * @param $brand1
     * @param Product $product
     */
    private static function mapProductBrand($brand1, Product $product): void
    {
        $brand = new Brand();
        if ($brand1 != null && count($brand1) > 0) {
            BrandMapper::mapFromArray($brand, $brand1);
            $product->setBrand($brand);
        }
        $product->setBrand($brand);
    }
}