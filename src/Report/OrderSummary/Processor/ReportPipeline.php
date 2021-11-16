<?php

namespace App\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Report\OrderSummary\Model\OrderSummary;

class ReportPipeline
{
    /**
     * @var ReportProcessorContract[]
     */
    private array $processors;

    /**
     * @param ReportProcessorContract ...$processors
     */
    public function __construct(ReportProcessorContract ...$processors)
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