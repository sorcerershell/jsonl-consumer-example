<?php

namespace App\Report\OrderSummary\Mapper;

use App\Model\Address;

class AddressMapper
{
    public static function mapFromArray(Address $address, array $source) {
        $address->setStreet($source["street"]);
        $address->setSuburb($source["suburb"]);
        $address->setState($source["state"]);
        $address->setPostcode($source["postcode"]);
    }
}