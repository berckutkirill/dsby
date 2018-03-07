<?php

ini_set("memory_limit", "512M");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$currency = 'BYN';

$yml = '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="' . date("Y-m-d H:i") . '">
<shop>
<name>Стальная линия</name>
<company>Стальная линия</company>
<url>https://ds-steelline.by</url>
<currencies>
<currency id="' . $currency . '" rate="1"/>
</currencies>' . "\r\n";
$xmlcategories = "<categories>" . "\r\n";
$xmloffers = "<offers>" . "\r\n";
$domain = "https://" . $_SERVER["HTTP_HOST"];
$j = 1;
$ofid = 10000;

header("Content-Type:text/xml; charset=utf-8");
CModule::IncludeModule('iblock');

function getCatalog() {
    global $description;
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PICTURE", "DETAIL_TEXT", "CODE", "IBLOCK_SECTION_ID", "IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID" => 22, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array("ID" => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $id_prop = [341, 342, 343, 344, 346, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 374, 358, 359, 361, 362, 377, 379, 380, 381, 389, 390, 393, 434];
        $IDS[] = $arFields["ID"];

        $prooops = "";
        $prooops_val = "";
        foreach ($arProps as $val) {
            if (!in_array($val["ID"], $id_prop)) {
                continue;
            }
            if (!empty($val["VALUE"])) {
                if (is_array($val["VALUE"])) {
                    $prooops_val .= "<tr><td style='border:1px solid #000;'>" . $val["NAME"] . "</td><td style='border:1px solid #000;'>";
                    foreach ($val["VALUE"] as $key => $v) {
                        $prooops_val .= ($key != 0 ? ", " : "") . $v . ($val["HINT"] ? " " . $val["HINT"] : "");
                    }
                    $prooops_val .= "</td></tr>";
                } else {
                    $prooops_val .= "<tr><td style='border:1px solid #000;'>" . $val["NAME"] . "</td><td style='border:1px solid #000;'>" . $val["VALUE"] . " " . $val["HINT"] . "</td></tr>";
                }
            }
        }

        $prooops = "<table style='border-collapse:collapse;margin: 0 auto;width:600px;'><thead><tr><td colspan='2'><b>Технические характеристики</b></td></tr></thead>" . $prooops_val . "</table>";

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
    $arSelect = ["ID", "IBLOCK_ID", "NAME", "SORT", "PROPERTY_CML2_LINK", "DETAIL_PICTURE", "CATALOG_GROUP_1", "PROPERTY_DECOR_PHOTO_IN", "PROPERTY_DECOR_ARTICLE"];
    $arFilter = ["PROPERTY_CML2_LINK" => $IDS, "IBLOCK_ID" => 21, "ACTIVE" => "Y"];
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arPropss = $ob->GetProperties();

        $prooopss = "";
        $id_props = [428, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 383, 384, 404];
        if (!empty($arPropss)) {
            $prooopss .= "<table style='border-collapse:collapse;margin: 0 auto;width:600px;'><thead><tr><td colspan='2'><b>Индивидуальные характеристики</b></td></tr></thead>";

            foreach ($arPropss as $val) {
                if (!in_array($val["ID"], $id_props)) {
                    continue;
                }

                if (!empty($val["VALUE"])) {
                    $prooopss .= "<tr><td style='border:1px solid #000;'>" . $val["NAME"] . "</td><td style='border:1px solid #000;'>" . $val["VALUE"] . " " . $val["HINT"] . "</td></tr>";
                }
            }
            $prooopss .= "</table>";
        }
        $arFields["photo_in"] = CFile::GetPath($arFields["PROPERTY_DECOR_PHOTO_IN_VALUE"]);
        $arFields["text"] = $description[$arFields["PROPERTY_CML2_LINK_VALUE"]] . $prooopss;
        $offers[$arFields["PROPERTY_CML2_LINK_VALUE"]][] = $arFields;
    }
    return $offers;
}

$catalog = getCatalog();
$offers = getOffers();

$filter = array("IBLOCK_ID" => 22, "ACTIVE" => "Y", "IBLOCK_ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y");
$sectionIterator = CIBlockSection::GetList(array("LEFT_MARGIN" => "ASC"), $filter, false, array('ID', 'IBLOCK_SECTION_ID', 'NAME'));
while ($section = $sectionIterator->Fetch()) {
    $section["ID"] = (int) $section["ID"];
    $section["IBLOCK_SECTION_ID"] = (int) $section["IBLOCK_SECTION_ID"];
    $arAvailGroups[$section["ID"]] = $section;
}

foreach ($arAvailGroups as &$value) {
    $xmlcategories .= '<category id="' . $value['ID'] . '"' . ($value['IBLOCK_SECTION_ID'] > 0 ? ' parentId="' . $value['IBLOCK_SECTION_ID'] . '"' : '') . '>' . $value['NAME'] . '</category>' . "\n";
}

foreach ($catalog as $item) {

    $description = htmlspecialchars($item["PREVIEW_TEXT"], ENT_XML1, 'UTF-8');
    if (is_array($offers[$item["ID"]])) {

        foreach ($offers[$item["ID"]] as $offer) {
            if (!$offer["CATALOG_PRICE_1"]) {
                continue;
            }
            $descr = "";
            $sale = "";
            if ($item["IBLOCK_SECTION_ID"] == 54 || $item["IBLOCK_SECTION_ID"] == 53) {
                $available = "true";
            } else {
                $available = "false";
                $sale = "<sales_notes>Под заказ</sales_notes>\r\n";
            }
            $descr = $offer["text"];
            $descr = "<![CDATA[\n" . $descr . "\n]]>";
            $picrure = $offer["photo_in"] ? '<picture>' . $domain . $offer["photo_in"] . '</picture>' . "\r\n" : "";

            $offer['NAME'] = htmlspecialchars($offer['NAME'], ENT_XML1, 'UTF-8');
            $img_id = $offer["DETAIL_PICTURE"] ? $offer["DETAIL_PICTURE"] : $item["DETAIL_PICTURE"];
            $img = $domain . CFile::GetPath($img_id);
            $xmloffers .= '<offer id="' . $offer["ID"] . '" available="' . $available . '">' .
                    "\r\n" . '<url>' . $item["link"] . '</url>'
                    . "\r\n" . '<price>' . $offer["CATALOG_PRICE_1"] . '</price>' .
                    "\r\n" . '<currencyId>' . $currency . '</currencyId>' . "\r\n"
                    . '<categoryId>' . $item["IBLOCK_SECTION_ID"] . '</categoryId>' . "\r\n"
                    . '<picture>' . $img . '</picture>' . "\r\n" . $picrure .
                    '<name>' . "Стальная Линия " . $item["NAME"] . ($offer["PROPERTY_DECOR_ARTICLE_VALUE"] ? " (" . $offer["PROPERTY_DECOR_ARTICLE_VALUE"] . ")" : "") . '</name>' . "\r\n" .
                    '<description>' . $descr . '</description>' . "\r\n" . $sale .
                    '</offer>' . "\r\n";
        }
    } else {
        if (!$item["CATALOG_PRICE_1"]) {
            continue;
        }
        $sale = "";
        $descr = "";
        $descr = $item["DETAIL_TEXT"];
        $descr = "<![CDATA[\n" . $descr . "\n]]>";
        if ($item["IBLOCK_SECTION_ID"] == 54 || $item["IBLOCK_SECTION_ID"] == 53) {
            $available = "true";
        } else {
            $available = "false";
            $sale = "<sales_notes>Под заказ</sales_notes>\r\n";
        }
        $img = $domain . CFile::GetPath($item["DETAIL_PICTURE"]);
        $item['NAME'] = htmlspecialchars($item['NAME'], ENT_XML1, 'UTF-8');
        $xmloffers .= '<offer id="' . $item["ID"] . '" available="' . $available . '">'
                . "\r\n" . '<url>' . $domain . $item["link"] . '</url>' . "\r\n" .
                '<price>' . $item["CATALOG_PRICE_1"] . '</price>' .
                "\r\n" . '<currencyId>' . $currency . '</currencyId>' . "\r\n" .
                '<categoryId>' . $item['IBLOCK_SECTION_ID'] . '</categoryId>' . "\r\n" .
                '<picture>' . $img . '</picture>' . "\r\n" .
                '<name>' . $item['NAME'] . '</name>' . "\r\n" .
                '<description>' . $descr . '</description>' . "\r\n" . $sale .
                '</offer>' . "\r\n";
    }
};
$xmloffers .= "</offers>" . "\r\n";
$xmlcategories .= "</categories>" . "\r\n";
$yml .= $xmlcategories . $xmloffers . "</shop>\r\n</yml_catalog>" . "\r\n";
echo $yml;

