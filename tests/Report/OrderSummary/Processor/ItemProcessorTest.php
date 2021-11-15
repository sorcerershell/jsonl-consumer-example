<?php declare(strict_types=1);
namespace App\Tests\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Model\OrderLineItem;
use App\Model\Product;
use App\Report\OrderSummary\Model\OrderSummary;
use App\Report\OrderSummary\Processor\ItemProcessor;
use PHPUnit\Framework\TestCase;


final class ItemProcessorTest extends TestCase {

    public function testOrderSummaryWith1LineItem() {
        $summary = new OrderSummary();
        $order = new Order();
        $order->setItems([
            OrderLineItem::create(4, 10.25, new Product()),
        ]);

        $sut = new ItemProcessor();
        $sut->process($summary, $order);

        $this->assertEquals(41, $summary->getTotalOrderValue());
        $this->assertEquals(10.25, $summary->getAverageUnitPrice());
        $this->assertEquals(4, $summary->getTotalUnitsCount());
        $this->assertEquals(1, $summary->getDistinctUnitCount());
    }
    public function testOrderSummaryWith2LineItems() {
        $summary = new OrderSummary();
        $order = new Order();
        $order->setItems([
            OrderLineItem::create(4, 10.25, new Product()),
            OrderLineItem::create(2, 20.75, new Product()),
        ]);

        $sut = new ItemProcessor();
        $sut->process($summary, $order);

        $this->assertEquals(82.5, $summary->getTotalOrderValue());
        $this->assertEquals(13.75, $summary->getAverageUnitPrice());
        $this->assertEquals(6, $summary->getTotalUnitsCount());
        $this->assertEquals(2, $summary->getDistinctUnitCount());
    }


    public function testOrderSummaryWithNoLineItem() {
        $summary = new OrderSummary();
        $order = new Order();
        $order->setItems([
        ]);


        $sut = new ItemProcessor();
        $sut->process($summary, $order);

        $this->assertEquals(0, $summary->getTotalOrderValue());
        $this->assertEquals(0, $summary->getAverageUnitPrice());
        $this->assertEquals(0, $summary->getTotalUnitsCount());
        $this->assertEquals(0, $summary->getDistinctUnitCount());
    }

    public function testOrderSummaryNullItemsHandling() {
        $summary = new OrderSummary();
        $order = new Order();
        $order->setItems(null);

        $sut = new ItemProcessor();
        $sut->process($summary, $order);

        $this->assertEquals(0, $summary->getTotalOrderValue());
        $this->assertEquals(0, $summary->getAverageUnitPrice());
        $this->assertEquals(0, $summary->getTotalUnitsCount());
        $this->assertEquals(0, $summary->getDistinctUnitCount());
    }
}