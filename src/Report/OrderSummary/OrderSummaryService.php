<?php

namespace App\Report\OrderSummary;

use App\Report\OrderSummary\Mapper\OrderMapper;
use App\Report\OrderSummary\Mapper\OrderSummaryMapper;
use App\Report\OrderSummary\Processor\OrderSummaryPipeline;
use App\Report\OrderSummary\Reader\JSON\OrderStreamReader;
use League\Csv\Writer;

class OrderSummaryService
{
    private OrderSummaryPipeline $orderSummaryPipeline;
    private OrderStreamReader $jsonReader;

    /**
     * @param OrderSummaryPipeline $orderSummaryPipeline
     * @param OrderStreamReader $jsonReader
     */
    public function __construct(OrderSummaryPipeline $orderSummaryPipeline, OrderStreamReader $jsonReader)
    {
        $this->orderSummaryPipeline = $orderSummaryPipeline;
        $this->jsonReader = $jsonReader;
    }


    /**
     * @throws \Exception
     */
    public function generate(string $uri, string $outputPath)
    {
        $writer = Writer::createFromPath($outputPath, "w+");
        $this->jsonReader->parse($uri, function (array $item) use (&$items, $writer) {
            $order = OrderMapper::mapFromArray($item);
            $summary = $this->orderSummaryPipeline->run($order);
            $csvRow = OrderSummaryMapper::mapToCSVArray($summary);
            $writer->insertOne($csvRow);
        });
    }


}