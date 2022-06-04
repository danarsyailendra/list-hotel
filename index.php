<?php

require_once "Hotel.php";

$hotel = new Hotel();
$start = $argv[1];
$limit = $argv[2];
$sort = (empty($argv[3])) ? null : $argv[3];
$list = $hotel->listHotels($start, $limit, $sort);

//echo $start;
print_r($list);