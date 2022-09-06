<?php declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Service\CsvWriterService;

final class CsvWriterServiceTest extends TestCase
{
    /** @test */
    public function FileWritten(): void
    {
        $appCodes = parse_ini_file(getcwd().'/tests/files-test/appCodes.ini');
        $csvWriter = new CsvWriterService($appCodes);
        $csvWriter->createFile(getcwd().'/tests/files-test/20131004/device-tokens-for-sfx-collection-1.log');
        $this->assertTrue(file_exists(getcwd().'/tests/files-test/20131004/device-tokens-for-sfx-collection-1.csv'));
    }
}