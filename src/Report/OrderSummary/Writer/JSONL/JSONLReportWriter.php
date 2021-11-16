<?php

namespace App\Report\OrderSummary\Writer\JSONL;

use App\Report\OrderSummary\Model\OrderSummary;
use App\Report\OrderSummary\Writer\ReportOutputType;
use App\Report\OrderSummary\Writer\ReportWriterContract;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Filesystem\Filesystem;

class JSONLReportWriter implements ReportWriterContract
{
    private Filesystem $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->serializer = SerializerBuilder::create()->build();
    }


    public function write(OrderSummary $summary, string $outputPath)
    {
       $this->filesystem->appendToFile($outputPath, $this->serializer->serialize($summary,'json') . PHP_EOL);
    }

    public function getSupportedType(): ReportOutputType
    {
        return ReportOutputType::jsonl();
    }
}