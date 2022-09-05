<?php

namespace App\Service;

class CsvWriterService {
    public $appCodes;
    public $header = ['id','appCode','deviceId','contactable','subscription_status','has_downloaded_free_product_status','has_downloaded_iap_product_status'];
    public $tag1Values = array('active_subscriber','expired_subscriber','never_subscribed');
    public $tag2Values = array('has_downloaded_free_product','not_downloaded_free_product','downloaded_free_product_unknown');
    public $tag3Values = array('has_downloaded_iap_product','not_downloaded_free_product');

    public function __construct($appCodes)
    {
        $this->appCodes = $appCodes;
    }


    function createFile($path) {
        //header of csv file
        $csvData = array();
        array_push($csvData,$this->header);
    
        // Open your file in read mode
        $input = fopen($path, "r");
        $lineNumber = 1;
        // Parse a line of the file until the end 
        while(!feof($input)) {
            if(substr(fgets($input),0,3) != 'app'){
                // Parse each line
                $dataParsed = explode(',',fgets($input));
                if(count($dataParsed)>2){
                    $id = $lineNumber;
                    $appCode = array_search($dataParsed[0],$this->appCodes,true);
                    $deviceId = $dataParsed[1];
                    $contactable = $dataParsed[2] == 1 ? 1 : 0;
                    // a finir
                    $parsedTag = explode('|',$dataParsed[3]);
    
                    $tag1 = 'subscription_unknown';
                    $tag2 = 'downloaded_free_product_unknown';
                    $tag3 = 'downloaded_iap_product_unknown';
                    if(count($parsedTag)>0){
                        $tag1 = in_array($parsedTag[0],$this->tag1Values) ? $parsedTag[0] : 'subscription_unknown';
                    }
                    if(count($parsedTag)>1){
                        $tag2 = in_array($parsedTag[1],$this->tag2Values) ? $parsedTag[1] : 'downloaded_free_product_unknown';
                    }
                    if(count($parsedTag)>2){
                        $tag3 = in_array($parsedTag[2],$this->tag3Values) ? $parsedTag[2] : 'downloaded_iap_product_unknown';
                    }
    
                    $csvLine = [$id,$appCode,$deviceId,$contactable,$tag1,$tag2,$tag3];
                    array_push($csvData,$csvLine);
                    $lineNumber++;
                }
            }
        }
        fclose($input);
    
        $filename = substr($path,0,-3).'csv';
    
        // open csv file for writing
        $f = fopen($filename, 'w');
        
        if ($f === false) {
            die('Error opening the file ' . $filename);
        }
        
        // write each row at a time to a file
        foreach ($csvData as $row) {
            fputcsv($f, $row);
        }
        
        // close the file
        fclose($f);
    }
}