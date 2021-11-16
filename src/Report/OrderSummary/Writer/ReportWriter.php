<?php

namespace App\Report\OrderSummary\Writer;

use App\Report\OrderSummary\Model\OrderSummary;
use App\Report\OrderSummary\Exception\OutputTypeNotSupportedException;

class ReportWriter
{
    /**
     * @var iterable<string, ReportWriterContract> $writers
     */
    private $writers;


    /**
     * @param ReportWriterContract[] $writers
     */
    public function __construct(ReportWriterContract ...$writers)
    {
        foreach ($writers as $writer) {
            $this->writers[$writer->getSupportedType()->value] = $writer;
        }
    }

    public function write(OrderSummary $summary, string $outputPath, string $type)
    {
        if (!array_key_exists($type, $this->writers)) {
            throw new OutputTypeNotSupportedException();
        }

        $this->writers[$type]->write($summary, $outputPath);
    }

}