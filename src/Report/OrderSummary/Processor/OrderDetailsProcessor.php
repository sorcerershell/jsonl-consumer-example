<?php

namespace App\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Model\OrderLineItem;
use App\Report\OrderSummary\Model\OrderSummary;

class OrderDetailsProcessor implements ReportProcessorContract
{
    public function process(OrderSummary $summary, Order $order)
    {
        $summary->setOrderId($order->getOrderId());
        $summary->setOrderDatetime($order->getOrderDate());
        $summary->setCustomerState($order->getCustomer()->getShippingAddress()->getState());
    }


}
