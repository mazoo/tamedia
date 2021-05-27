<?php

$file = 'is24-2021-04-30';
//$file = 'ff-2021-04-30';

$json_file = file_get_contents('./sql-data/' . $file .'.jsonl');

$jsons = explode(PHP_EOL, str_replace("\r", "", $json_file));
if(empty($jsons[count($jsons)-1])) {
  unset($jsons[count($jsons)-1]);
}

//record.adId
//record.saleType
//record.source
//record.language
//record.originalPropertyCategory
//record.propertyCategory
//record.sellerType
//record.price
//record.netPrice
//record.propertyLocation.region
//record.propertyLocation.canton
//record.propertyLocation.cantonCode
//record.propertyLocation.country
//record.propertyLocation.countryCode
//record.propertyLocation.city
//record.propertyLocation.street
//record.propertyLocation.zip
//record.publishedDate
//record.url

$insert_into = <<<SQL
    INSERT INTO `tamedia_listings` (`record.adId`, `record.saleType`,`record.source`,`record.language`,`record.originalPropertyCategory`,`record.propertyCategory`,`record.paymentInterval`,`record.sellerType`,`record.price`,`record.netPrice`,`record.propertyLocation.region`,`record.propertyLocation.canton`,`record.propertyLocation.cantonCode`,`record.propertyLocation.country`,`record.propertyLocation.countryCode`,`record.propertyLocation.city`,`record.propertyLocation.street`,`record.propertyLocation.zip`, `record.publishedDate`, `record.url`) VALUES
SQL;

file_put_contents($file . '.sql', $insert_into.PHP_EOL , FILE_APPEND);

$rows = count($jsons);

echo $rows;

foreach($jsons as $key => $json) {

  $decoded = json_decode($json);

  $insert = "(" . $decoded->record->adId . ",";
  $insert .= "'" . $decoded->record->saleType . "',";
  $insert .= "'" . $decoded->record->source . "',";
  $insert .= "'" . $decoded->record->language . "',";
  $insert .= "'" . $decoded->record->originalPropertyCategory . "',";
  $insert .= "'" . $decoded->record->propertyCategory . "',";
  $insert .= "'" . $decoded->record->paymentInterval . "',";
  $insert .= "'" . $decoded->record->sellerType . "',";
  $insert .= ParseFloat($decoded->record->price) . ",";
  $insert .= ParseFloat($decoded->record->netPrice) . ",";
  $insert .= "'" . addslashes($decoded->record->propertyLocation->region) . "',";
  $insert .= "'" . addslashes($decoded->record->propertyLocation->canton) . "',";
  $insert .= "'" . $decoded->record->propertyLocation->cantonCode . "',";
  $insert .= "'" . addslashes($decoded->record->propertyLocation->country) . "',";
  $insert .= "'" . $decoded->record->propertyLocation->countryCode . "',";
  $insert .= "'" . addslashes($decoded->record->propertyLocation->city) . "',";
  $insert .= "'" . addslashes($decoded->record->propertyLocation->street) . "',";
  $insert .= "'" . $decoded->record->propertyLocation->zip . "',";
  $insert .= "'" . date('Y-m-d H:i:s', strtotime($decoded->record->publishedDate)) . "',";
  $insert .=  "'" . $decoded->record->url . "')";

  if($key+1 === $rows) {
    $insert .= ';';
  } else {
    $insert .= ',';
  }

  //if($key > 50) break;

  //echo $decoded->record->price . PHP_EOL;
  //echo ParseFloat($decoded->record->price) . PHP_EOL;
  //echo $key ." \t" .$insert. PHP_EOL;
  //echo $key.PHP_EOL;
  //echo $rows.PHP_EOL;
  file_put_contents($file . '.sql', $insert.PHP_EOL , FILE_APPEND);
}


function ParseFloat($floatString){
  $floatString = str_replace(',' , "", $floatString);
  return floatval($floatString);
}