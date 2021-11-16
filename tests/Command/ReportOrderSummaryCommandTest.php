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
        $destinationPath = $kernel->getCacheDir() . "/output.csv";

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
        $destinationPath = $kernel->getCacheDir() . "/output.csv";

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
        $destinationPath = $kernel->getCacheDir() . "output.csv";

        $commandTester->execute([
            'source' => $source,
            'result' => $destinationPath,
            'type' => 'txt'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("not supported", $output);
    }

    public function testExecuteWithEmptyItems()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('report:order-summary');
        $commandTester = new CommandTester($command);

        $source = $kernel->getProjectDir() . '/tests/Fixtures/dummy2.jsonl';
        $destinationPath = $kernel->getCacheDir() . "/output2.csv";

        $commandTester->execute([
            'source' => $source,
            'result' => $destinationPath,
            'type' => 'csv'
        ]);
        $content = file_get_contents($destinationPath);
        $this->assertStringNotContainsString("1001", $content);
        $this->assertStringNotContainsString("1002", $content);
        $this->assertStringContainsString("1003", $content);
    }

    public function testExecuteWithOutputTypeJSONL()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('report:order-summary');
        $commandTester = new CommandTester($command);

        $source = $kernel->getProjectDir() . '/tests/Fixtures/dummy.jsonl';
        $destinationPath = $kernel->getCacheDir() . "/output.jsonl";

        $commandTester->execute([
            'source' => $source,
            'result' => $destinationPath,
            'type' => 'jsonl'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("generating order summary...", $output);
        $this->assertFileExists($destinationPath);
        $content = file_get_contents($destinationPath);
        $this->assertStringContainsString("1001", $content);
    }
}
