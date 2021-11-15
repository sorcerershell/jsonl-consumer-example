<?php

namespace App\Tests\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Model\OrderLineItem;
use App\Model\Product;
use App\Report\OrderSummary\Processor\ItemProcessor;
use App\Report\OrderSummary\Processor\OrderDetailsProcessor;
use App\Report\OrderSummary\Processor\OrderSummaryPipeline;
use PHPUnit\Framework\TestCase;

class OrderSummaryPipelineTest extends TestCase
{

    public function testRun()
    {
        $order = new Order();
        $order->setItems([
            OrderLineItem::create(4, 10.25, new Product()),
            OrderLineItem::create(2, 20.75, new Product()),
        ]);
        $order->setOrderDate(new \DateTime());
        $order->setOrderId(1234);
        $stateName = "VICTORIA";
        $order->getCustomer()->getShippingAddress()->setState($stateName);


        $processors = [
            new OrderDetailsProcessor(),
            new ItemProcessor(),
        ];

        $sut = new OrderSummaryPipeline(...$processors);
        $summary = $sut->run($order);

        $this->assertEquals($order->getOrderId(), $summary->getOrderId());
        $this->assertEquals($order->getOrderDate(), $summary->getOrderDatetime());
        $this->assertEquals($stateName, $summary->getCustomerState());

        $this->assertEquals(82.5, $summary->getTotalOrderValue());
        $this->assertEquals(13.75, $summary->getAverageUnitPrice());
        $this->assertEquals(6, $summary->getTotalUnitsCount());
        $this->assertEquals(2, $summary->getDistinctUnitCount());

    }
}
