<?php
  require "../../../vendor/autoload.php";
  //read an excel file
  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  $spreadsheet = $reader->load("../../files/indicatorsData.xlsx");
  $sheetData = $spreadsheet->getActiveSheet()->toArray();

  //get the values of the first column
  $countries = array_column($sheetData, 1);

  //remove the 3 first values of the array
  array_splice($countries, 0, 3);

  //remove all the empty values of the array
  $countries = array_filter($countries);

  $country = "Brazil";

  //echo all the values of the array
  for($i = 4; $i < count($countries); $i++){
    if($sheetData[$i][1] == $country){
      for($j = 0; $j < count($sheetData[$i]); $j++){
        echo $sheetData[$i][$j] . "  ";
      }
      break;
    }
  }

  /*
    discover the needed columns to get the data,
    then filter by the country when clicking on the country
  */

?>