<?php

namespace App\Tests\Command;

use App\Command\ReportOrderSummaryCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ReportOrderSummaryCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('report:order-summary');
        $commandTester = new CommandTester($command);

        $source = $kernel->getProjectDir() . '/tests/Fixtures/dummy.jsonl';
        $destinationPath = "output.csv";

        $commandTester->execute([
            'source' => $source,
            'result' => $destinationPath,
            'type' => 'csv'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("generating order summary...", $output);
        $this->assertFileExists($destinationPath);
    }

    public function testExecuteSourceFileNotExists()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('report:order-summary');
        $commandTester = new CommandTester($command);

        $source = $kernel->getProjectDir() . '/tests/Fixtures/dummy.json';
        $destinationPath = "output.csv";

        $commandTester->execute([
            'source' => $source,
            'result' => $destinationPath,
            'type' => 'csv'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("not found", $output);
    }

    public function testExecuteTypeNotSupported()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('report:order-summary');
        $commandTester = new CommandTester($command);

        $source = $kernel->getProjectDir() . '/tests/Fixtures/dummy.jsonl';
        $destinationPath = "output.csv";

        $commandTester->execute([
            'source' => $source,
            'result' => $destinationPath,
            'type' => 'txt'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("not supported", $output);
    }
}
