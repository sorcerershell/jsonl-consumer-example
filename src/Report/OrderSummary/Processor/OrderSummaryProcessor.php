<?php

namespace App\Report\OrderSummary\Processor;

use App\Model\Order;
use App\Report\OrderSummary\Model\OrderSummary;

interface OrderSummaryProcessor
{
    public function process(OrderSummary $summary, Order $order);
}