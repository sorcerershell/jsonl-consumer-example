<?php

namespace App\Tests\Report\OrderSummary\Mapper;

use App\Report\OrderSummary\Mapper\OrderSummaryMapper;
use App\Report\OrderSummary\Model\OrderSummary;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class OrderSummaryMapperTest extends TestCase
{

    public function testMapToCSVArray()
    {
        $summary = $this->getOrderSummary();
        $csvArray = OrderSummaryMapper::mapToCSVArray($summary);
        $this->assertEquals($summary->getOrderId(), $csvArray[0]);
        $this->assertEquals($summary->getOrderDatetime()->format(\DateTimeInterface::ISO8601), $csvArray[1]);
        $this->assertEquals($summary->getTotalOrderValue(), $csvArray[2]);
        $this->assertEquals($summary->getAverageUnitPrice(), $csvArray[3]);
        $this->assertEquals($summary->getDistinctUnitCount(), $csvArray[4]);
        $this->assertEquals($summary->getTotalUnitsCount(), $csvArray[5]);
        $this->assertEquals($summary->getCustomerState(), $csvArray[6]);
    }

    public function getOrderSummary() : OrderSummary
    {
        $json = '{"order_id":1001,"order_datetime":"2019-03-08T12:13:29+00:00","total_order_value":359.78,"average_unit_price":59.96333333333333,"distinct_unit_count":2,"total_units_count":6,"customer_state":"VICTORIA"}
';
        $serializer = SerializerBuilder::create()->build();
        return $serializer->deserialize($json, OrderSummary::class, 'json');
    }
}
