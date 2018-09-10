<?php
                
    require_once('../../lib/PrintIPP.php');
    //echo $_GET['file'];


    $host = $_GET['host'];
    $uri_print = $_GET['uri_print'];

    $file = $_GET['file'];
    $username = 'root';
    $password =false;
    $port=631;
    $printer=$uri_print;
    $paths = array ("root" => "/P1", "admin" => "/P1", "printers" => "/P1", "jobs" => "/P1");

    $logfile="/tmp/phpprintipp";
    $handle_http_exceptions=false;
    $handle_http_exceptions=false;
    $handle_ipp_exceptions=false;
    $handle_ipp_exceptions=false;
    $mediatype="application/octet-stream";
    $mediatype="text/plain";

    $data = $file;

    $ipp = new PrintIPP();
    $ipp->with_exceptions = $handle_ipp_exceptions;
    $ipp->handle_http_exceptions = $handle_http_exceptions;

    $ipp->setHost($host);
    $ipp->paths = $paths;
    $ipp->setPort($port);

    $ipp->setPrinterURI($printer);

    $ipp->setData($file);//String or path to file.
    /*echo "Create-Job: ".$ipp->createJob(). "<br />";
    printf("Job is: %s<br />",$job = $ipp->last_job);

    echo "Sending URI: " . $ipp->sendURI('/public/'.$file, $job,$last=true) . "<br />\n";*/

    $ipp->printJob();




	//printf (_("Get Printer Attributes: %s\n"), $ipp->getPrinterAttributes());




?>