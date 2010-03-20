<?php

$query = 'select * from html where url = \'http://www.chuck-norris-facts.org/alle_facts\' and xpath=\'//table[@class="views-table"]/tbody\'';
$api = 'http://query.yahooapis.com/v1/public/yql?q='.
        urlencode($query).'&format=json';
               
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$data = json_decode($output);

$facts = $data->query->results->tbody->tr;
$num_facts = sizeof($facts);

echo "<p>There are currently ".$num_facts." Chuck Norris facts in the database.</p>";

$random_fact = rand(0, $num_facts);

echo "<p>". $facts[$random_fact]->td->a->content ."</p>";
?>