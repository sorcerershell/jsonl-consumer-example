<?php

namespace App\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Report\OrderSummary\Model\OrderSummary;

class OrderSummaryPipeline
{
    /**
     * @var OrderSummaryProcessor[]
     */
    private array $processors;

    /**
     * @param OrderSummaryProcessor ...$processors
     */
    public function __construct(OrderSummaryProcessor ...$processors)
    {
        $this->processors = $processors;
    }


    public function run(Order $order) : OrderSummary{
        $summary = new OrderSummary();
        foreach ($this->processors as $processor) {
            $processor->process($summary, $order);
        }

        return $summary;
    }

}