<?php

namespace App\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Model\OrderLineItem;
use App\Report\OrderSummary\Model\OrderSummary;

class ItemProcessor implements OrderSummaryProcessor
{
    /**
     * @param OrderSummary $summary
     * @param Order $order
     */
    public function process(OrderSummary $summary, Order $order): void
    {
        if ($this->isEmptyItems($order)) {
            return;
        }

        $lineItemSummary = array_reduce($order->getItems(), function ($carry, OrderLineItem $item) {
            if (is_null($carry)) {
                $carry = $this->initializeCarry();
            }
            $totalUnitCount = $this->sumTotalUnitCount($carry['totalUnitCount'], $item);
            $totalOrderValue = $carry['totalOrderValue'] + ($item->getQuantity() * $item->getUnitPrice());
            $averageUnitPrice = $totalOrderValue / $totalUnitCount;

            return [
                'totalUnitCount' => $totalUnitCount,
                'totalOrderValue' => $totalOrderValue,
                'averageUnitPrice' => $averageUnitPrice,
            ];
        });

        $summary->setTotalOrderValue($lineItemSummary['totalOrderValue']);
        $summary->setAverageUnitPrice($lineItemSummary['averageUnitPrice']);
        $summary->setTotalUnitsCount($lineItemSummary['totalUnitCount']);
        $summary->setDistinctUnitCount(count($order->getItems()));
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function isEmptyItems(Order $order): bool
    {
        return $order->getItems() == null || count($order->getItems()) == 0;
    }

    /**
     * @return int[]
     */
    public function initializeCarry(): array
    {
        $carry = [
            'totalUnitCount' => 0,
            'totalOrderValue' => 0,
            'averageUnitPrice' => 0,
        ];
        return $carry;
    }

    /**
     * @param $totalUnitCount1
     * @param OrderLineItem $item
     * @return int
     */
    public function sumTotalUnitCount($totalUnitCount1, OrderLineItem $item): int
    {
        return $totalUnitCount1 + $item->getQuantity();
    }
}