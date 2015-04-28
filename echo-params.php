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

    $echoprotocol = "https";
    $echohostname = "echo360.city.ac.uk";
    $echoapipath = "ess/scheduleapi/v1";
    //$echoport = "8443";

    $echobaseresturl = $echoprotocol . "://" . $echohostname . ":" . $echoport . "/" . $echoapipath . "/";

    // The following variables need to be set to an existing ESS Trusted System record key-secret pair
    $echoapikey = "m26dev";
    $echoapisecret = "UgCwDAltr094NFY7EG/JEQI4QVa9lmDEKDN4A7BCpNPFeJrFfAufCt1LQuRDh/Ko98YwNzqgdRfGFZm2cdwpXA==";
?>
