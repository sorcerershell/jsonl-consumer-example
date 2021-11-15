<?php

namespace App\Report\OrderSummary\Reader\JSON;

use App\Model\Order;
use App\Report\OrderSummary\Mapper\OrderMapper;
use App\Report\OrderSummary\Processor;
use App\Report\OrderSummary\Processor\OrderSummaryPipeline;
use JsonCollectionParser\Parser;

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
        $this->jsonParser->parse($input, $callback);
    }
}