<?php
set_time_limit(0);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/pricer/PHPExcel.php");

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

function getGeo($data) {
    global $base_url;
    $url = $base_url . urlencode($data[0] . ' ' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . ' ' . $data[4]. ' ' . $data[5]);
    return json_decode(file_get_contents($url), true);
}

function getArray($File) {
    $response = [];
    if (($handle = fopen($File, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $response[] = $data;
        }
        fclose($handle);
    }
    return $response;
}

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

if ($_FILES['file']) {
    CModule::IncludeModule("highloadblock");
    $base_url = "https://geocode-maps.yandex.ru/1.x/?format=json&results=1&geocode=";
    $excelData = getArray($_FILES['file']['tmp_name']);

    $hlblock = HL\HighloadBlockTable::getById(17)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    foreach ($excelData as $key => $newLine) {
        $c = explode(" ", $newLine[7]);
        $newLine[7] = $c[1] . "," . $c[0];

        $data = [
            "UF_COUNTRY" => $newLine[0],
            "UF_REGION" => $newLine[1],
            "UF_ACTIVE" => 'Y',
            "UF_PLACE" => $newLine[2],
            "UF_STREET" => $newLine[3],
            "UF_HOME_NUMBER" => $newLine[4],
            "UF_CORPUS" => $newLine[5],
            "UF_NAME" => $newLine[6],
            "UF_COORDS" => $newLine[7]
        ];
        $entity_data_class::add($data);
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">send</button>
</form>