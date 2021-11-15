<?php

namespace App\Tests\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Report\OrderSummary\Model\OrderSummary;
use App\Report\OrderSummary\Processor\OrderDetailsProcessor;
use PHPUnit\Framework\TestCase;

final class OrderDetailsProcessorTest extends TestCase
{
    public function testOrderSummaryDetails() {
        $order = new Order();
        $order->setOrderDate(new \DateTime());
        $order->setOrderId(1234);
        $stateName = "VICTORIA";
        $order->getCustomer()->getShippingAddress()->setState($stateName);

        $summary = new OrderSummary();
        $sut = new OrderDetailsProcessor();
        $sut->process($summary, $order);
        $this->assertEquals($order->getOrderId(), $summary->getOrderId());
        $this->assertEquals($order->getOrderDate(), $summary->getOrderDatetime());
        $this->assertEquals($stateName, $summary->getCustomerState());
    }
}
