<?php

namespace App\Report\OrderSummary\Mapper;

use App\Model\Address;
use App\Model\Customer;

class CustomerMapper
{
    public static function mapFromArray(array $source) : Customer {
        $customer = new Customer();
        self::mapCustomerDetails($customer, $source);
        self::mapAddress($customer, $source["shipping_address"]);
        return $customer;
    }

    /**
     * @param Customer $customer
     * @param array $source
     */
    private static function mapCustomerDetails(Customer $customer, array $source): void
    {
        $customer->setCustomerId($source["customer_id"]);
        $customer->setFirstName($source["first_name"]);
        $customer->setLastName($source["last_name"]);
        $customer->setEmail($source["email"]);
        $customer->setPhone($source["phone"]);
    }

    /**
     * @param Customer $customer
     * @param $shipping_address
     */
    private static function mapAddress(Customer $customer, $shipping_address): void
    {
        $address = new Address();
        if ($shipping_address !== null && count($shipping_address) > 0) {
            AddressMapper::mapFromArray($address, $shipping_address);
        }
        $customer->setShippingAddress($address);
    }
}