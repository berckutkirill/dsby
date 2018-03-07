<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
Bitrix\Main\Loader::includeModule('catalog');
Bitrix\Main\Loader::includeModule('iblock');
$q = "SELECT bcsd.ID, bcsd.DATE_CREATE, bcp.QUANTITY, bcp.QUANTITY_RESERVED, bcsd.DOC_TYPE, bcsd.STATUS, sd.STATUS as ST, bce.ELEMENT_ID, bce.AMOUNT FROM b_catalog_store_docs bcsd "
        . "JOIN b_catalog_docs_element bce ON bcsd.ID = bce.DOC_ID "
        . "JOIN b_catalog_product bcp ON bcp.ID = bce.ELEMENT_ID "
        . "JOIN stock_data sd ON sd.DOC_ID = bcsd.ID "
        . "ORDER BY bcsd.DATE_CREATE DESC";

$ob = $DB->Query($q);
$NS = [
    "ST" => ["canceled", "history", "approved"],
    "DOC_TYPE" => ["A", "D"]
];


$look = 1586;
while ($row = $ob->getNext()) {
    $hashDo = $row["DOC_TYPE"] . $row["ST"];
    if (!$res[$row["ELEMENT_ID"]]) {
        $res[$row["ELEMENT_ID"]] = ["REAL_QUANTITY_RESERVE" => $row["QUANTITY_RESERVED"] ? $row["QUANTITY_RESERVED"] : 0];
    }
    if ($look == $row["ELEMENT_ID"]) {
        $HISTORY[] = [
            "ID" => $row["ID"],
            "AMOUNT" => $row["AMOUNT"],
            "DOC_TYPE" => $row["DOC_TYPE"],
            "ST" => $row["ST"],
            "STATUS" => $row["STATUS"]
        ];
    }
    
    $IDS[] = $row["ELEMENT_ID"];
    
    switch ($hashDo) {

        case "Dcanceled":
            // $res[$row["ELEMENT_ID"]]["QUANTITY_RESERVE"]-=$row["AMOUNT"];
            break;
        case "Dhistory":
            $res[$row["ELEMENT_ID"]]["QUANTITY"]-=$row["AMOUNT"];
            break;
        case "Dapproved":
            $res[$row["ELEMENT_ID"]]["QUANTITY_RESERVE"]+=$row["AMOUNT"];
            break;
        case "Ahistory":
            $res[$row["ELEMENT_ID"]]["QUANTITY"]+=$row["AMOUNT"];
            break;
        default :
            break;
    }
  
}

$ob = $DB->Query($q);


function getStocks($IDS) {

        $result = [];
        $select = ['ID',
            'PRODUCT_ID',
            'AMOUNT',
            'STORE_ID',
            'STORE_NAME',
            'STORE_ADDR',
            'STORE_DESCR'];
        $rsStore = CCatalogStoreProduct::GetList([], ['PRODUCT_ID' => $IDS], false, false, $select);

        while ($arStore = $rsStore->fetch()) {
            $result[$arStore['PRODUCT_ID']] += $arStore["AMOUNT"];
        }
        return $result;
}
$STOCKS = getStocks(array_unique($IDS));

foreach ($res as $id => $row) {
    $row["REAL_QUANTITY"] = $STOCKS[$id];
    if ($row["QUANTITY_RESERVE"] != $row["REAL_QUANTITY_RESERVE"] || $row["QUANTITY"] != $row["REAL_QUANTITY"]) {
        $row["id"] = $id;
        
        if ($row["QUANTITY"] != $row["REAL_QUANTITY"]) {
            $result["q"][] = $row;
        }
       if ($row["QUANTITY_RESERVE"] != $row["REAL_QUANTITY_RESERVE"]) {
            $result["r"][] = $row;
            $q = "UPDATE b_catalog_product SET `QUANTITY_RESERVED` = '{$row["QUANTITY_RESERVE"]}' WHERE ID = $id;";
            $ob = $DB->Query($q);
        }
        
    }
}
print_r($result);


