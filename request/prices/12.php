<?php

ini_set("memory_limit", "512M");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

function getCatalog() {
    global $description;
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PICTURE", "DETAIL_TEXT", "CODE", "IBLOCK_SECTION_ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID" => 22, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $id_prop = [341, 342, 343, 344, 346, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 374, 358, 359];
        $IDS[] = $arFields["ID"];

        $prooops = "";

        foreach ($arProps as $val) {
            if (!in_array($val["ID"], $id_prop)) {
                continue;
            }
            if (!empty($val["VALUE"])) {
                $prooops .= $val["NAME"] . " - " . $val["VALUE"] . $val["HINT"] . "</br>";
            }
        }

        $IDS[] = $arFields["ID"];
        $items[] = [
            'id' => $arFields['ID'],
            'title' => $arFields['NAME'],
            'link' => 'https://ds-steelline.by/catalog-dverei/stalnaya-liniya/' . $arFields['CODE'] . '.html'
        ];
        $arFields['link'] = 'https://ds-steelline.by/catalog-dverei/stalnaya-liniya/' . $arFields['CODE'] . '.html';
        $catalog[] = $arFields;
        $k = "<p><b>Бесплатный замер и официальная гарантия - 2 года</b></p>";
        $description[$arFields['ID']] = $k . $arFields["~DETAIL_TEXT"] . $prooops;
    }
    return $catalog;
}

$categories = [];

function getOffers() {
    global $description;
    $arSelect = ["ID", "IBLOCK_ID", "NAME", "SORT", "PROPERTY_CML2_LINK", "DETAIL_PICTURE", "CATALOG_GROUP_1", "PROPERTY_DECOR_PHOTO_IN"];
    $arFilter = ["PROPERTY_CML2_LINK" => $IDS, "IBLOCK_ID" => 21, "ACTIVE" => "Y"];
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arPropss = $ob->GetProperties();

        $prooops = "";
        $id_props = [428, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 383, 384, 404];
        foreach ($arPropss as $val) {
            if (!in_array($val["ID"], $id_props)) {
            
                continue;
            }
            if (!empty($val["VALUE"])) {
                $prooops .= $val["NAME"] . " - " . $val["VALUE"] . " " . $val["HINT"] . "</br>";
            }
        }
        $arFields["photo_in"] = CFile::GetPath($arFields["PROPERTY_DECOR_PHOTO_IN_VALUE"]);
        $arFields["text"] = $description[$arFields["PROPERTY_CML2_LINK_VALUE"]] . $prooops;
        $offers[$arFields["PROPERTY_CML2_LINK_VALUE"]][] = $arFields;
    }
    return $offers;
}

$catalog = getCatalog();
$offers = getOffers();

print_r($offers);
