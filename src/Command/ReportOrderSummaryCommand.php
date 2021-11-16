<?php

namespace App\Command;

use App\Report\OrderSummary\OrderSummaryService;
use App\Report\OrderSummary\Processor\ReportPipeline;
use App\Report\OrderSummary\Reader\JSON\OrderStreamReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

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
        $this->addArgument("result", InputArgument::REQUIRED, "path where order summary will be generated");
        $this->addArgument("type", InputArgument::REQUIRED, "output file type");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sourcePath = $input->getArgument("source");
        $resultPath = $input->getArgument("result");

        $type = $input->getArgument("type");

        try {
            $output->writeln("generating order summary...");
            $this->summaryService->generate($sourcePath, $resultPath, $type);
        } catch (ResourceNotFoundException $e) {
            $output->writeln("resource or file not found");
        } catch (\Exception $e) {
            $output->writeln("error:" . $e->getMessage());
        }

        return Command::SUCCESS;
    }

}