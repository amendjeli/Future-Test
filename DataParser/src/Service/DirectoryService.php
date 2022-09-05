<?php
namespace App\Service;

use App\Service\DirectoryService;

class DirectoryService {
    public $dir;
    public function __construct($dir = "/files//")
    {
        $this->dir = getcwd()."/files/".$dir;
        $this->dirFiles = array();
    }

    function getDirContents($dir) {
        $files = scandir($dir);
        $appCodes = parse_ini_file(getcwd().'\files\appCodes.ini');
        $csvWriter = new CsvWriterService($appCodes);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $fileName = basename($value);
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    
                if($extension == 'log'){
                    $csvWriter->createFile($path);
                }
    
            }
            else if ($value != "." && $value != "..") {
                $this->getDirContents($path);
            }
        }
    }

    function getDirFiles($dir) {
        $files = scandir($dir);
        $appCodes = parse_ini_file(getcwd().'\tests\files-test\appCodes.ini');
        $csvWriter = new CsvWriterService($appCodes);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $fileName = basename($value);
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    
                if($extension == 'log'){
                    array_push($this->dirFiles,$path);
                }
    
            }
            else if ($value != "." && $value != "..") {
                $this->getDirContents($path);
            }
        }
    }
}