<?php

namespace helper;

class XmlHelper
{

    /**
     * Generate xml
     * @param $users
     * @return string
     */
    public static function makeXml($users)
    {
        $string = '<?xml version="1.0"  encoding="utf-8"?><users>';

        foreach ($users as $user) {
            $string .= '<user>';
            foreach ($user as $node => $value) {
                $string .= sprintf('<%s>%s</%s>', $node, $value, $node);
            }
            $string .= '</user>';
        }
        $string .= '</users>';
        return $string;
    }


    /**
     * Create xml file
     * @param $outputFile
     * @param $xml
     * @return bool
     */

    public static function createXmlFile($outputFile, $xml)
    {
        if (!empty($xml)) {
            file_put_contents($outputFile, XmlHelper::makeXml($xml));
            return true;
        }
        return false;
    }

}


