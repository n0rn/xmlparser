<?php

namespace source;

use Exception;
use XMLReader;

class FilterDump
{
    private $sourceFile;


    public function __construct($sourceFile)
    {
        if ($this->isBadFile($sourceFile)) {
            throw new Exception("Bad file");

        }

        $this->sourceFile = $sourceFile;
    }

    /**
     * @return array
     * @throws Exception
     */

    public function filterDump()
    {
        if (!$this->isValidXml($this->sourceFile)) {

            throw new Exception('Malformed xml');
        }

            $reader = new XMLReader();
            $reader->open($this->sourceFile);
                $user = [];
            while($reader->read()) {
                //find <user>
                if($this->nodeIsUser($reader)) {
                    $tmp = simplexml_load_string($reader->readOuterXml());
                    $age = (string)$tmp->age;
                    //filter out all users of age 20 to 30 years
                    if ($this->isValidAge($age)) {
                        $user[] = (array)$tmp;
                    }
                }

            }
            $reader->close();
            return  $user;

    }


    /**
     * Checking file
     * @param $sourceFile
     * @return bool
     */

    private function isBadFile($sourceFile)
    {
        if (!file_exists($sourceFile) || !is_file($sourceFile) || !is_readable($sourceFile)) {
            return true;
        }

        return false;
    }

    /**
     * Validation user age
     * @param $age
     * @return bool
     */
    private function isValidAge($age)
    {
        return ($age >= 20 && $age <= 30);
    }

    /**
     * Take user from xml
     * @param $user
     * @return bool
     */
    private function nodeIsUser($user)
    {
        if($user->nodeType == XMLREADER::ELEMENT && $user->localName == 'user') {
            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @return bool
     */
    private function isValidXml($file)
    {
        $xml = XMLReader::open($file);
        $xml->setParserProperty(XMLReader::VALIDATE, true);

        if ($xml->isValid()) return true;
        return false;
    }


}


