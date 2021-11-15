<?php

namespace App\Report\OrderSummary\Mapper;

use App\Report\OrderSummary\Model\OrderSummary;

class OrderSummaryMapper
{
    public static function mapToCSVArray(OrderSummary $summary) : array
    {
        return [
            $summary->getOrderId(),
            $summary->getOrderDatetime()->format(\DateTimeInterface::ISO8601),
            $summary->getTotalOrderValue(),
            $summary->getAverageUnitPrice(),
            $summary->getDistinctUnitCount(),
            $summary->getTotalUnitsCount(),
            $summary->getCustomerState(),
        ];
    }

}