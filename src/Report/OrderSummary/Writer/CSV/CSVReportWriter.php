<?php

namespace App\Report\OrderSummary\Writer\CSV;

use App\Report\OrderSummary\Mapper\OrderSummaryMapper;
use App\Report\OrderSummary\Model;
use App\Report\OrderSummary\OrderSummaryService;
use App\Report\OrderSummary\Writer\ReportOutputType;
use App\Report\OrderSummary\Writer\ReportWriterContract;
use League\Csv\AbstractCsv;
use League\Csv\Writer;

class CSVReportWriter implements ReportWriterContract
{
    private static $writer;

    /**
     * @param Model\OrderSummary $summary
     * @param string $outputPath
     * @throws \League\Csv\CannotInsertRecord
     */
    public function write(Model\OrderSummary $summary, string $outputPath): void
    {
        $writer = self::getWriter($outputPath);
        $csvRow = OrderSummaryMapper::mapToCSVArray($summary);
        $writer->insertOne($csvRow);
    }

    /**
     * @param string $outputPath
     * @return Writer
     */
    private function getWriter(string $outputPath)
    {
        if (!self::$writer instanceof AbstractCsv){
            self::$writer = Writer::createFromPath($outputPath, "w+");
        }
        return self::$writer;
    }


    public function getSupportedType(): ReportOutputType
    {
        return ReportOutputType::csv();
    }
}