<?php

function _print($msg)
{
    if(php_sapi_name() === 'cli')
    {
        echo $msg . PHP_EOL;
    }else{
        echo "<pre>$msg</pre>" . PHP_EOL;
    }
}

function _exec($cmd)
{
    $tmp = array();
    $res = shell_exec(escapeshellcmd($cmd));
    if(strtolower(php_sapi_name()) === 'cli')
    {
        return $res;
    }else{
        $res = preg_split("/\n/", $res);
        $res = array_unique(array_diff($res, array('')));
        foreach($res as $r)
        {
            $tmp[] = "<pre>$r</pre>";
        }
        return implode("", $tmp);
    }
}

function printLine($message){
	echo($message . PHP_EOL);
}