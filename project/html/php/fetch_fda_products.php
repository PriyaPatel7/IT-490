<?php
include_once 'db_util.php';
include_once 'create_fda_tables.php';
include_once 'config.php';

function fetch_ndc($skip, $limit) {
    $endpoint = "https://api.fda.gov/drug/ndc.json";
    $search_by="finished:true";
    $params = array('api_key' => FDA_API_KEY, 'search' => $search_by, 'limit'=> $limit);
    if ($skip > 0) {
	    $params['skip'] = $skip;
    }
    $url = $endpoint . '?' . http_build_query($params);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $info = curl_getinfo($ch);
    print_r($info);

    if(curl_error($ch)) {
	    echo(curl_error($ch));
	    $rc = 1;
    } else {
	    $rc = 0;
    }
    curl_close($ch);

    if ($rc == 0) {
	    return ['rc' => $rc, 'data' => json_decode($result, true)];
    }
    return ['rc' => 1, 'data' => null];
}

$skip = 0;
$limit = 200;
$conn = connect_to_db();

while(true) {
    echo "Total records processed " . $skip;

    list('rc' => $rc, 'data' => $obj) = fetch_ndc($skip, $limit);
    if ($rc != 0) {
	    echo "Sync failed ";
	    return;
    }

    if (!isset($total)) {
       $meta = $obj["meta"];
       $total = $meta['results']['total'];
    }


    if (!array_key_exists("results", $obj))
    {
	    echo "Invalid data returned";
	    print_r($obj);
	    break;
    }

    $objects = $obj['results'];
    $current_len = count($obj['results']);
    $skip = $skip + $current_len;

    foreach($objects as $elem)  {
      insert_product($conn, $elem['product_ndc'], $elem['generic_name'], $elem['brand_name'],$elem['labeler_name']);
    }

    if($current_len < $limit) {
	    break;
    }
    echo "Total records processed " . $skip;
    if ($skip >= MAX_FDA_PRODUCTS) {
      break;
    }
}

close_db($conn);

?>
