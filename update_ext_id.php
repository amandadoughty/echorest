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
            if ($i < 100) {
                if (isset($section->alternateId)) {
                    // echo $section->alternateId;
                }

                echo $sectionsummary->id . "\n";

                $url = "sections/$sectionsummary->id";
                $result = callRestService("$url", "$xml", "$method", $params);
                $sections[] = simplexml_load_string($result);


                $i++;
            }
        }
}





foreach ($sections as $section) {
    foreach ($section->properties->property as $property) {

        if ($property->key == 'external-system-id-1' && $property->value != '') {
            echo $property->value . "\n";


            $doc = new DOMDocument();
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;

            $root = $doc->createElement('section');
            $root = $doc->appendChild($root);

            $alternateId = $doc->createElement('alternateId');
            $alternateId = $root->appendChild($alternateId);

            $text = $doc->createTextNode($property->value);
            $text = $alternateId->appendChild($text);


            // $doc->save("data/{$section->id}.xml");

            $url = "sections/{$section->id}";
            $xml = "data/{$section->id}.xml";
            $method = "PUT";
            $params = array();

            $result = callRestService("$url", "$xml", "$method", $params);


        }
    }
}



// <property>
//       <key>external-system-id-1</key>
//       <value/>
//     </property>