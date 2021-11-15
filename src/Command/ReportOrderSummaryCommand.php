<?php

namespace App\Command;

use App\Report\OrderSummary\OrderSummaryService;
use App\Report\OrderSummary\Processor\OrderSummaryPipeline;
use App\Report\OrderSummary\Reader\JSON\OrderStreamReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReportOrderSummaryCommand extends Command
{
    protected static $defaultName = "report:order-summary";

    private OrderSummaryService $summaryService;

    public function __construct(OrderSummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument("source", InputArgument::REQUIRED, "path or url to dumped order json-line file");
        $this->addArgument("result", InputArgument::REQUIRED, "path where csv will be generated");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sourcePath = $input->getArgument("source");
        $resultPath = $input->getArgument("result");
        if (!is_file($sourcePath)) {
            $output->writeln("source file in ${sourcePath} not exists");
            return Command::FAILURE;
        }

        $this->summaryService->generate($sourcePath, $resultPath);

        return Command::SUCCESS;
    }

}