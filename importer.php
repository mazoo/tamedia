<?php

$file = 'is24-2021-04-30';
//$file = 'ff-2021-04-30';

$json_file = file_get_contents('./sql-data/' . $file .'.jsonl');

$jsons = explode(PHP_EOL, str_replace("\r", "", $json_file));
if(empty($jsons[count($jsons)-1])) {
  unset($jsons[count($jsons)-1]);
}

$insert_into = <<<SQL
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
    INSERT INTO `tamedia_listings` (`record.adId`, `record.saleType`,`record.source`,`record.language`,`record.originalPropertyCategory`,`record.propertyCategory`,`record.paymentInterval`,`record.sellerType`,`record.price`,`record.netPrice`,`record.propertyLocation.region`,`record.propertyLocation.canton`,`record.propertyLocation.cantonCode`,`record.propertyLocation.country`,`record.propertyLocation.countryCode`,`record.propertyLocation.city`,`record.propertyLocation.street`,`record.propertyLocation.zip`, `record.publishedDate`, `record.url`, `record.company.logo`, `record.company.name`, `record.ownObjectUrl`, `record.seller.name`, `record.seller.image`) VALUES
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
  $insert .= "'" . addslashes($decoded->record->url) . "',";
  $insert .= "'" . addslashes($decoded->record->company->logo) . "',";
  $insert .= "'" . addslashes($decoded->record->company->name) . "',";
  $insert .= "'" . (is_array($decoded->record->ownObjectUrl) ? addslashes($decoded->record->ownObjectUrl[0]): '') . "',";
  $insert .= "'" . addslashes($decoded->record->seller->name) . "',";
  $insert .= "'" . addslashes($decoded->record->seller->image) . "')";

  if($key+1 === $rows) {
    $insert .= ';';
  } else {
    $insert .= ',';
  }

  //if($key > 17000) break;

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