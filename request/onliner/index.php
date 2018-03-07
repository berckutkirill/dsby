<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

require $_SERVER['DOCUMENT_ROOT'] . '/request/onliner/B2BClass.php';

Bitrix\Main\Loader::includeModule('iblock');

$arSelect = ["ID", "IBLOCK_ID", "PROPERTY_ID_ONLINER"];
$arFilter = ["IBLOCK_ID" => 21, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "!PROPERTY_ID_ONLINER" => false];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $ar_res = CPrice::GetBasePrice($arFields['ID']);

    $price[$arFields['PROPERTY_ID_ONLINER_VALUE']] = $ar_res["PRICE"];
}
$B2BOnliner = new B2BOnliner();
$B2BOnliner->auth();
$csv = $B2BOnliner->getCsv();

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
// Disable caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies


$fp = fopen('php://output', 'w');
foreach ($csv as $row) {

    if ($price[$row[4]]) {
        $row[5] = $price[$row[4]];
    } else {
        $row[5] = 0;
    }

    fputcsv($fp, $row, ';');
}
fclose($fp);


