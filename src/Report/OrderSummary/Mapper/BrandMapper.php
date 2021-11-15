<?php

namespace App\Report\OrderSummary\Mapper;

use App\Model\Brand;

class BrandMapper
{
    public static function mapFromArray(Brand $brand, array $source) {
        $brand->setId($source["id"]);
        $brand->setName($source["name"]);
    }

}