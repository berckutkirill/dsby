<?php
require_once(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog.php");
Bitrix\Main\Loader::includeModule('catalog');

$ID = (isset($_REQUEST['ID']) ? (int)$_REQUEST['ID'] : 0);
if ($ID < 0) {
    $ID = 0;
}


// add Document


$contractorId = (isset($_POST['CONTRACTOR_ID']) ? (int) $_POST['CONTRACTOR_ID'] : 0); // ID Поставщика
$result = array();
$docId = 0;
$currency = (!empty($_POST["CAT_CURRENCY_STORE"]) ? (string) $_POST["CAT_CURRENCY_STORE"] : ''); // Валюта

$userId = (int) $USER->GetID(); 
$docType = 'A'; // Doctype A = Приход

$arGeneral = array(
    "DOC_TYPE" => $docType,
    "SITE_ID" => "s1",
    "DATE_DOCUMENT" => $_POST["DOC_DATE"],
    "CREATED_BY" => $userId,
    "MODIFIED_BY" => $userId,
    "COMMENTARY" => "Коммент",
);

if ($contractorId > 0) {
    $arGeneral["CONTRACTOR_ID"] = $contractorId;
}
if ($currency != '') {
    $arGeneral["CURRENCY"] = $currency;
}

if (isset($_POST["CAT_DOCUMENT_SUM"])) {
    $arGeneral["TOTAL"] = (float) $_POST["CAT_DOCUMENT_SUM"];
}

if ($ID > 0) {  // Если указан ID изначально в get, значит хотим обновить
    unset($arGeneral['CREATED_BY']);
    if (CCatalogDocs::update($ID, $arGeneral)) {
        $docId = $ID;
    }
} else {
    $ID = $docId = CCatalogDocs::add($arGeneral);
}


if ($ID > 0) {  // если обновили или добавили, нужно удалить все товары которые до этого возможно были в документе
    $dbElement = CCatalogStoreDocsElement::getList(array(), array("DOC_ID" => $ID), false, false, array("ID"));
    while ($arElement = $dbElement->Fetch()) {
        CCatalogStoreDocsElement::delete($arElement["ID"]);
        $dbDocsBarcode = CCatalogStoreDocsBarcode::getList(array(), array("DOC_ELEMENT_ID" => $arElement["ID"]), false, false, array("ID")); // удаляем старые штрихкоды
        while ($arDocsBarcode = $dbDocsBarcode->Fetch()) {
            CCatalogStoreDocsBarcode::delete($arDocsBarcode["ID"]);
        }
    }
}

if (isset($_POST["PRODUCT"]) && is_array($_POST["PRODUCT"]) && $docId) { // И теперь если есть продукты в $_POST, добавляем их
    $arProducts = ($_POST["PRODUCT"]);
    foreach ($arProducts as $key => $val) {
        $storeTo = $val["STORE_TO"];
        $storeFrom = $val["STORE_FROM"];

        $arAdditional = array(
            "AMOUNT" => $val["AMOUNT"],
            "ELEMENT_ID" => $val["PRODUCT_ID"],
            "PURCHASING_PRICE" => $val["PURCHASING_PRICE"],
            "STORE_TO" => $storeTo,
            "STORE_FROM" => $storeFrom,
            "ENTRY_ID" => $key,
            "DOC_ID" => $docId,
        );

        $docElementId = CCatalogStoreDocsElement::add($arAdditional);

        if ($docElementId && isset($val["BARCODE"])) {
            $arBarcode = array();
            if (!empty($val["BARCODE"])) {
                $arBarcode = explode(', ', $val["BARCODE"]);
            }

            if (!empty($arBarcode)) {
                foreach ($arBarcode as $barCode) {
                    CCatalogStoreDocsBarcode::add(array("BARCODE" => $barCode, "DOC_ELEMENT_ID" => $docElementId)); // добавляем штрихкод
                }
            }
        }
    }
}
