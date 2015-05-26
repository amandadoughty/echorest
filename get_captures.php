<?php

require_once('ess-rest.php');   // Need to configure echo-params.php for your EchoSystem

$url = "terms";
$xml = "";          // Not needed in this example
$method = "GET";
$params = array();

$result = callRestService("$url", "$xml", "$method", $params);


$terms = simplexml_load_string($result);

$i = 0;
$sections = array();

foreach ($terms->term as $term) {


        // echo $section->{'external-system-id-1'};
        // echo $term->{'id'};
        $url = "terms/$term->id/sections";
        $result = callRestService("$url", "$xml", "$method", $params);
        $sectionsummaries = simplexml_load_string($result);


        foreach ($sectionsummaries->section as $sectionsummary) {
            if ($i < 500) {

                // echo $sectionsummary->id . "\n";

                $url = "sections/$sectionsummary->id";
                $result = callRestService("$url", "$xml", "$method", $params);
                $section = simplexml_load_string($result);

                foreach ($section->properties->property as $property) {

                    if (preg_match('/^external-system-id-/', $property->key) && $property->value != '') {
                        $count = 0;

                        // echo $property->value . ':' . $section->id . "\n";

                        $url = "sections/$sectionsummary->id/captures";
                        $result = callRestService("$url", "$xml", "$method", $params);
                        $captures = simplexml_load_string($result);

                        foreach ($captures as $capture) {
                            if ($capture->title) {

                            // print_r ($capture);

                            echo $capture->status . "\n";
                                $count++;
                                // echo $capture->title . "\n";
                            }
                        }

                        // echo $property->value . ':' . $count . "\n";

                    }
                }


                $i++;
            }


        }
}



// $count = 0;

// foreach ($sections as $section) {
//     foreach ($section->properties->property as $property) {

//         if (preg_match('/^external-system-id-/', $property->key) && $property->value != '') {
//             echo $property->value . ':' . $section->id . "\n";





//         }
//     }
// }

