<?php

namespace App\Report\OrderSummary\Reader\JSON;

use App\Model\Order;
use App\Report\OrderSummary\Mapper\OrderMapper;
use App\Report\OrderSummary\Processor;
use App\Report\OrderSummary\Processor\ReportPipeline;
use JsonCollectionParser\Parser;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class OrderStreamReader
{
    private Parser $jsonParser;

    public function __construct()
    {
        $this->jsonParser = new Parser();
    }

    /**
     * @throws \Exception
     */
    public function parse($input, callable $callback) {
        @$stream = fopen($input, "r");
        if (!$stream) {
            throw new ResourceNotFoundException();
        }
        $this->jsonParser->parse($stream, $callback);
    }
}