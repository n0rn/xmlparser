<?php

require_once 'source' . DIRECTORY_SEPARATOR . 'FilterDump.php';
require_once 'helper' . DIRECTORY_SEPARATOR . 'XmlHelper.php';

use source\FilterDump;
use helper\XmlHelper;


$class = new FilterDump('users' . DIRECTORY_SEPARATOR . 'users.xml');
$users = $class->filterDump();
$filePath = 'result' . DIRECTORY_SEPARATOR . 'result.xml';

    if (XmlHelper::createXmlFile($filePath, $users)) {
        echo 'Created xml document';
    } else {
        throw new Exception('We have some problems with creating xml');
    }





