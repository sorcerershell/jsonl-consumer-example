<?php

namespace App\Report\OrderSummary;

use App\Report\OrderSummary\Mapper\OrderMapper;
use App\Report\OrderSummary\Mapper\OrderSummaryMapper;
use App\Report\OrderSummary\Processor\ReportPipeline;
use App\Report\OrderSummary\Reader\JSON\OrderStreamReader;
use App\Report\OrderSummary\Writer\CSV\CSVReportWriter;
use App\Report\OrderSummary\Writer\ReportWriter;
use League\Csv\Writer;

class OrderSummaryService
{
    private ReportPipeline $orderSummaryPipeline;
    private OrderStreamReader $jsonReader;
    private ReportWriter $reportWriter;

    /**
     * @param ReportPipeline $orderSummaryPipeline
     * @param OrderStreamReader $jsonReader
     */
    public function __construct(ReportPipeline $orderSummaryPipeline, OrderStreamReader $jsonReader, ReportWriter $writer)
    {
        $this->orderSummaryPipeline = $orderSummaryPipeline;
        $this->jsonReader = $jsonReader;
        $this->reportWriter = $writer;
    }


    /**
     * @throws \Exception
     */
    public function generate(string $uri, string $outputPath, string $type)
    {
        $this->jsonReader->parse($uri, function (array $item) use (&$items, $outputPath, $type) {
            $summary = $this->processLine($item);
            if ($summary->getTotalOrderValue() == 0) {
                return;
            }
            $this->reportWriter->write($summary, $outputPath, $type);
        });
    }

    /**
     * @param array $item
     * @return Model\OrderSummary
     */
    private function processLine(array $item): Model\OrderSummary
    {
        $order = OrderMapper::mapFromArray($item);
        return $this->orderSummaryPipeline->run($order);
    }


}