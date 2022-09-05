<?php declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Service\DirectoryService;

final class DirectoryServiceTest extends TestCase
{
    /** @test */
    public function FolderCanBeParsed(): void
    {
        $path = getcwd()."/tests/files-test/20131004";
        $directory = new DirectoryService();
        $directory->getDirFiles($path);
        $this->assertTrue( in_array( str_replace("/","\\" ,getcwd()."/tests/files-test/20131004/"."device-tokens-for-sfx-collection-1.log"),  str_replace("/","\\" ,$directory->dirFiles)) );
    }

}