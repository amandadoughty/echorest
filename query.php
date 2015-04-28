#! /usr/bin/php
<?php

/*****************************************************************************
 *
 *                       _          _____  __    ___  
 *              ___  ___| |__   ___|___ / / /_  / _ \ 
 *             / _ \/ __| '_ \ / _ \ |_ \| '_ \| | | |
 *            (  __/ (__| | | | (_) |__) | (_) | |_| |
 *             \___|\___|_| |_|\___/____/ \___/ \___/.com
 *
 *****************************************************************************
 *  C O P Y R I G H T   A N D   C O N F I D E N T I A L I T Y   N O T I C E
 *****************************************************************************
 *
 *      Copyright 2008 Echo360, Inc.  All rights reserved.
 *      This software contains valuable confidential and proprietary
 *      information of Echo360, Inc. and is subject to applicable
 *      licensing agreements.  Unauthorized reproduction, transmission or
 *      distribution of this file and its contents is a violation of
 *      applicable laws.
 ****************************************************************************/

require_once('ess-rest.php');	// Need to configure echo-params.php for your EchoSystem 

date_default_timezone_set("Australia/Perth");
$startTime = date('U');

echo "\nDate/Time = " . date("r") . "\n";

if(sizeof($argv) == 3 || sizeof($argv) == 4) {
  $operation = $argv[1];
  $url = $argv[2];
  $xml = "";

  if($operation == "create") {

    // Basic test to check if an XML file is supplied
    if(sizeof($argv) == 4) {
      echo "Reading XML file = '" . $argv[3] . "'...\n";
      $xml = file_get_contents($argv[3]);

      if($xml == "") {
        echo "Error - no content supplied in XML file\n\n";
        return;
      }
    } else if(sizeof($argv) == 3) {
      $xml = "";
    } else {
      displayUsage();
      return;
    }

    createEntity($url, $xml);
  } else if($operation == "read") {
    readEntity($url);
  } else if($operation == "update") {
    if(sizeof($argv) == 3) {
      $xml = "";
    } else if(sizeof($argv) == 4) {
      // Basic test to check if an XML file is supplied
      echo "Reading XML file = '" . $argv[3] . "'...\n";
      $xml = file_get_contents($argv[3]);

      if($xml == "") {
        echo "Error - no content supplied in XML file\n\n";
        return;
      }
    } else {
      displayUsage();
      return;
    }

    updateEntity($url, $xml); 
  } else if($operation == "delete") {
    deleteEntity($url);
  } else {
    displayUsage();
    return;
  }
} else {
  displayUsage();
  return;
}

$endTime = date('U');

$totalTime = $endTime - $startTime;

echo "Total Time: $totalTime seconds\n";

/**
 * Makes POST REST call to update Entities in the ESS
 *
 * e.g. $url = people, people/{person GUID}
 *      $url = terms, terms/{term GUID}
 *      $url = courses, courses/{course GUID}, courses/{course GUID}/sections
 */
function createEntity($url, $xml) {

  $method = "POST";
  $params = array();

  $result = callRestService("$url", "$xml", "$method", $params);

  $doc = new DOMDocument('1.0');
  $doc->preserveWhiteSpace = false;
  $doc->formatOutput = true;
  $doc->loadXML($result);

  echo "\n-----------\n";
  echo $doc->saveXML();
  echo "-----------\n";
}// end of createEntity function


/**
 * Makes GET REST call to read Entities from the ESS
 *
 * e.g. $url = people, people/{person GUID}
 *      $url = terms, terms/{term GUID}
 *      $url = courses, courses/{course GUID}, courses/{course GUID}/sections
 */
function readEntity($url) {

  $xml = "";			// Not needed in this example
  $method = "GET";
  $params = array();

  $result = callRestService("$url", "$xml", "$method", $params);

  if($result != "") {
    $doc = new DOMDocument('1.0');
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;
    $doc->loadXML($result);

    echo "\n-----------\n";
    echo $doc->saveXML();
    echo "-----------\n";
  }
}// end of readEntity function


/**
 * Makes PUT REST call to update Entities in the ESS
 *
 * e.g. $url = people, people/{person GUID}
 *      $url = terms, terms/{term GUID}
 *      $url = courses, courses/{course GUID}, courses/{course GUID}/sections
 */
function updateEntity($url, $xml) {

  $method = "PUT";
  $params = array();

  $result = callRestService("$url", "$xml", "$method", $params);

  if($result != "") {
    $doc = new DOMDocument('1.0');
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;
    $doc->loadXML($result);

    echo "\n-----------\n";
    echo $doc->saveXML();
    echo "-----------\n";
  }
}// end of updateEntity function


/**
 * Makes DELETE REST call to delete Entities in the ESS
 *
 * e.g. $url = people, people/{person GUID}
 *      $url = terms, terms/{term GUID}
 *      $url = courses, courses/{course GUID}, courses/{course GUID}/sections
 */
function deleteEntity($url) {

  $xml = "";
  $method = "DELETE";
  $params = array();

  $result = callRestService("$url", "$xml", "$method", $params);

  if($result != "") {
    $doc = new DOMDocument('1.0');
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;
    $doc->loadXML($result);

    echo "\n-----------\n";
    echo $doc->saveXML();
    echo "-----------\n";
  }
}// end of deleteEntity function

/**
 * Display usage information
 */
function displayUsage() {
    echo "Usage: php query.php [create | read | update | delete] {REST URI} {ESS XML}\n\n";
}// end of displayUsage function

?>
