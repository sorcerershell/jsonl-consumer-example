<?php

namespace App\Report\OrderSummary\Writer;

use App\Report\OrderSummary\Model\OrderSummary;

interface ReportWriterContract
{
    public function write(OrderSummary $summary, string $outputPath);
    public function getSupportedType() : ReportOutputType;

}