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

include_once("echo-params.php");
include_once "oauth-php/library/OAuthStore.php";
include_once "oauth-php/library/OAuthRequester.php";

function callRestService($path, $data, $method, $params) {
    try {
        $options = array('consumer_key' => $GLOBALS["echoapikey"], 'consumer_secret' => $GLOBALS["echoapisecret"]);
        
        OAuthStore::instance("2Leg", $options );

        $curl_options = array(CURLOPT_SSL_VERIFYPEER => false, CURLOPT_HTTPHEADER => Array("Content-Type: application/xml"));

        $request = new OAuthRequester($GLOBALS["echobaseresturl"] . $path, $method, $params, $data);
/**
	echo "*** DEBUG Request ***\n";
	print_r($request);
	echo "*********************\n";
**/

        $result = $request->doRequest(0, $curl_options);

/**
	echo "*** DEBUG Result ***\n";
	print_r($result);
	echo "********************\n";
**/
        $data = $result['body'];
      
    } catch (Exception $e) {
        print_r($e);
        return '';
    }

    return $data;
}

?>
