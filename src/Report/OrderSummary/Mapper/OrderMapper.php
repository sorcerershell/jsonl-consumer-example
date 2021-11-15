<?php

namespace App\Report\OrderSummary\Mapper;

use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderLineItem;

class OrderMapper
{
    public static function mapFromArray(array $source) : Order {
        $order = new Order();
        self::mapOrderBasicDetails($order, $source);
        self::mapCustomer($source["customer"], $order);

        if ($source["items"] != null && count($source["items"]) > 0) {
            $items = [];
            foreach($source["items"] as $item) {
                $lineItem = new OrderLineItem();
                ItemMapper::mapFromArray($lineItem, $item);
                $items[] = $lineItem;
            }

            $order->setItems($items);
        }
        return $order;
    }

    /**
     * @param Order $order
     * @param array $source
     */
    private static function mapOrderBasicDetails(Order $order, array $source): void
    {
        $order->setOrderId($source['order_id']);
        $order->setOrderDate(\DateTime::createFromFormat("D, d M Y H:i:s O", $source["order_date"]));
        $order->setDiscounts($source['discounts']);
        $order->setShippingPrice($source['shipping_price']);
    }

    /**
     * @param $source
     * @param Order $order
     */
    private static function mapCustomer($source, Order $order): void
    {
        $customer = new Customer();
        if (count($source) > 0) {
            $customer = CustomerMapper::mapFromArray($source);
        }

        $order->setCustomer($customer);
    }
}