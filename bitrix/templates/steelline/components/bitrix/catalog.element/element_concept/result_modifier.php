<?php

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
//print_r($arResult);
//die();
$doubles = $arResult["PROPERTIES"]["DOUBLE"]["VALUE"] ? true : false;
$MY_SEO = [
    "MY_PRICE" => $arResult["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_VALUE"],
    "MY_FOR" => $MF,
    "MY_THICKNESS" => $arResult["PROPERTIES"]["CHARAKTER_CONST_THICKNESS_CLOTH"]["VALUE"],
    "MY_CLASS" => $arResult["PROPERTIES"]["CHARAKTER_CONST_SOUND_INSULATION"]["VALUE"]
];


$cp = $this->__component;

if (is_object($cp)) {
    $cp->arResult['MY_SEO'] = $MY_SEO;
    $cp->SetResultCacheKeys(array('MY_SEO'));
}

$arResult["CONCEPT_PICTURE_INTERIOR_BIG"] = CFile::GetPath($arResult["PROPERTIES"]["CONCEPT_PICTURE_INTERIOR"]["VALUE"]);
$arResult["CONCEPT_PICTURE_INTERIOR_SMALL"] = getResizeImage($arResult["PROPERTIES"]["CONCEPT_PICTURE_INTERIOR"]["VALUE"], 1290, 860);

$concept_stock = $arResult["PROPERTIES"]["CONCEPT_IN_STOCK"]["VALUE"] == "yes" ? true : false;

if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) {
    $i = 0;
    foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["~VALUE"] as $key => $dest) {
        if ($concept_stock) {
            if ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$key] == "concept" || $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$key] == "stock")
                continue;
            if ($i == 0) {
                $destination = "<span class='".$arResult["PROPERTIES"]["DESTINATION_ICON"]['VALUE_XML_ID'][$key]."'>".$dest;
                $i++;
            } else {
				$destination .= "</span> · " . "<span class='".$arResult["PROPERTIES"]["DESTINATION_ICON"]['VALUE_XML_ID'][$key]."'>". $dest;
            }
        } else {
            if ($key == 0) {
                $destination = "<span class='".$arResult["PROPERTIES"]["DESTINATION_ICON"]['VALUE_XML_ID'][$key]."'>".$dest;
            } else {
                $destination .= "</span>, " . "<span class='".$arResult["PROPERTIES"]["DESTINATION_ICON"]['VALUE_XML_ID'][$key]."'>".$dest;
            }
        }
    }
    $arResult["DESTINATION_ICON"] = $destination."</span>";
}
$salons = GetHBlock(19, ["UF_XML_ID" => $arResult["PROPERTIES"]["CONCEPT_SALONS"]["VALUE"]]);
foreach ($salons as $key => $salon) {
    $arResult["SALONS"][$key]["NAME"] = $salon["UF_NAME"];
    $arResult["SALONS"][$key]["LINK"] = $salon["UF_LINK"];

    $all_salons .= $salon["UF_NAME"] . "<br />";
}
$arResult["ALL_SALONS"] = $all_salons;


$arResult["DOORS"]["WITHIN"]["BIG"] = $arResult["PREVIEW_PICTURE"]["SRC"];
$arResult["DOORS"]["WITHIN"]["SMALL"] = getResizeImage($arResult["PREVIEW_PICTURE"]["ID"], 434, 841);

if (!$doubles) {
    $w_w_b = $doubles ? 510 : 280;
    $h_w_b = $doubles ? 726 : 776;

    $w_w_s = $doubles ? 255 : 190;
    $h_w_s = $doubles ? 362 : 388;
}
$arResult["DOORS"]["WITHIN"]["SMALL_BOTTOM"]["BIG"] = getResizeImage($arResult["PREVIEW_PICTURE"]["ID"], $w_w_b, $h_w_b);
$arResult["DOORS"]["WITHIN"]["SMALL_BOTTOM"]["SMALL"] = getResizeImage($arResult["PREVIEW_PICTURE"]["ID"], $w_w_s, $h_w_s);

$arResult["DOORS"]["OUTSIDE"]["BIG"] = CFile::GetPath($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]);
$arResult["DOORS"]["OUTSIDE"]["SMALL"] = getResizeImage($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"], 434, 841);

if (!$doubles) {
    $w_o_b = $doubles ? 462 : 280;
    $h_o_b = $doubles ? 700 : 776;

    $w_o_s = $doubles ? 231 : 190;
    $h_o_s = $doubles ? 350 : 388;
}

$arResult["DOORS"]["OUTSIDE"]["SMALL_BOTTOM"]["BIG"] = getResizeImage($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"], $w_o_b, $h_o_b);
$arResult["DOORS"]["OUTSIDE"]["SMALL_BOTTOM"]["SMALL"] = getResizeImage($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"], $w_o_s, $h_o_s);


$arResult["CONCEPT_PHOTO_PROFESSIONAL"]["BIG"] = CFile::GetPath($arResult["PROPERTIES"]["CONCEPT_PHOTO_PROFESSIONAL"]["VALUE"]);
$arResult["CONCEPT_PHOTO_PROFESSIONAL"]["SMALL"] = getResizeImage($arResult["PROPERTIES"]["CONCEPT_PHOTO_PROFESSIONAL"]["VALUE"], 146, 146);

function getResizeImage($idFile, $width = 860, $heigth = 583) {
    $file = CFile::ResizeImageGet($idFile, array('width' => $width, 'height' => $heigth), BX_RESIZE_IMAGE_PROPORTIONAL);
    return $file["src"];
}

for ($i = 1; $i < 12; $i++) {
    $fields = [
        "CONCEPT_PICTURE_" . $i,
        "CONCEPT_TITLE_TEXT_1_" . $i,
        "CONCEPT_TEXT_TITLE_TEXT_1_" . $i,
        "CONCEPT_TITLE_TEXT_2_" . $i,
        "CONCEPT_TEXT_TITLE_TEXT_2_" . $i,
        "CONCEPT_TITLE_FACTOID_" . $i,
        "CONCEPT_TEXT_FACTOID_" . $i,
        "CONCEPT_MIRROR_" . $i,
        "CONCEPT_SORTING_BLOCK_" . $i
    ];

    foreach ($fields as $key => $field) {
        if ($i >= 10) {
            $delete = -3;
        } else {
            $delete = -2;
        }
        if (empty($arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"]))
            continue;
        if ($field == "CONCEPT_PICTURE_" . $i) {
            $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"]][substr($field, 0, $delete) . "_BIG"] = CFile::GetPath($arResult["PROPERTIES"][$field]["VALUE"]);
            $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"]][substr($field, 0, $delete) . "_SMALL"] = getResizeImage($arResult["PROPERTIES"][$field]["VALUE"]);
            $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"]]["SORT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"];
        } else {
            $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"]][substr($field, 0, $delete)] = $arResult["PROPERTIES"][$field]["~VALUE"];
            $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"]]["SORT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_BLOCK_" . $i]["VALUE"];
        }
    }
}
if ($arResult["PROPERTIES"]["CONCEPT_SORTING_DESING_HTML"]["VALUE"]) {
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_DESING"]["VALUE"]]["CODE"] = "CONCEPT_SORTING_DESING_HTML";
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_DESING"]["VALUE"]]["TEXT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_DESING_HTML"]["~VALUE"]["TEXT"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_DESING"]["VALUE"]]["SORT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_DESING"]["VALUE"];
}
if ($arResult["PROPERTIES"]["CONCEPT_MANAGER_HAND"]["VALUE"]) {
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["CODE"] = "CONCEPT_MANAGER_HAND";
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["PICTURE_BIG"] = CFile::GetPath($arResult["PROPERTIES"]["CONCEPT_MANAGER_HAND"]["VALUE"]);
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["PICTURE_SMALL"] = getResizeImage($arResult["PROPERTIES"]["CONCEPT_MANAGER_HAND"]["VALUE"], 1170, 778);

    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["TITLE_TEXT_1"] = $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_1_HAND"]["~VALUE"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["TEXT_1"] = $arResult["PROPERTIES"]["CONCEPT_TEXT_1_HAND"]["~VALUE"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["TITLE_TEXT_2"] = $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_2_HAND"]["~VALUE"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["TEXT_2"] = $arResult["PROPERTIES"]["CONCEPT_TEXT_2_HAND"]["~VALUE"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["TITLE_TEXT_3"] = $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_3_HAND"]["~VALUE"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["TEXT_3"] = $arResult["PROPERTIES"]["CONCEPT_TEXT_3_HAND"]["~VALUE"];
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["VALUE"]]["SORT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_HAND"]["~VALUE"];
}

if ($arResult["PROPERTIES"]["CONCEPT_SORTING_ENTR"]["VALUE"]) {
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_ENTR"]["VALUE"]]["CODE"] = "CONCEPT_SORTING_ENTR";
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_ENTR"]["VALUE"]]["SORT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_ENTR"]["VALUE"];
}

if ($arResult["PROPERTIES"]["CONCEPT_SORTING_CONSULTATNT"]["VALUE"]) {
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_CONSULTATNT"]["VALUE"]]["CODE"] = "CONCEPT_SORTING_CONSULTATNT";
    $result[$arResult["PROPERTIES"]["CONCEPT_SORTING_CONSULTATNT"]["VALUE"]]["SORT"] = $arResult["PROPERTIES"]["CONCEPT_SORTING_CONSULTATNT"]["VALUE"];
}
ksort($result);

$arResult["ITEMS"] = $result;
//print_r($arResult["ITEMS"] );

if ($arResult["PROPERTIES"]["CONCEPT_PHOTO_MANAGER"]["VALUE"]) {
    $arResult["MANAGER_PHOTO"]["BIG"] = CFile::GetPath($arResult["PROPERTIES"]["CONCEPT_PHOTO_MANAGER"]["VALUE"]);
    if (!$doubles) {
        $arResult["MANAGER_PHOTO"]["SMALL"] = getResizeImage($arResult["PROPERTIES"]["CONCEPT_PHOTO_MANAGER"]["VALUE"], 640, 1058);
    } else {
        $arResult["MANAGER_PHOTO"]["SMALL"] = getResizeImage($arResult["PROPERTIES"]["CONCEPT_PHOTO_MANAGER"]["VALUE"], 545, 970);
    }
}


if ($arResult["PROPERTIES"]["CONCEPT_SIMILAR_CONCEPT"]["VALUE"]) {
    $arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["PROPERTIES"]["CONCEPT_SIMILAR_CONCEPT"]["VALUE"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        $concept["NAME"] = $arFields["NAME"];
        $concept["DETAIL_PAGE_URL"] = $arFields["DETAIL_PAGE_URL"];

        $concept["PICTURE_BIG"] = CFile::GetPath($arProps["CONCEPT_PICTURE_INTERIOR"]["VALUE"]);
        $concept["PICTURE_SMALL"] = getResizeImage($arProps["CONCEPT_PICTURE_INTERIOR"]["VALUE"], 770, 513);

//        print_r($arProps);
        $i = 0;
        foreach ($arProps["DESTINATION_ICON"]["VALUE"] as $key => $dest) {
            if ($arProps["DESTINATION_ICON"]["VALUE_XML_ID"][$key] == "concept") {
                continue;
            }

            if ($i == 0) {
                $destination = $dest;
                $i++;
            } else {
                $destination .= ", " . $dest;
            }
            $concept["DESTINATION_ICON_BOTTOM"] = strtolower($destination);
        }
        $arResult["OTHER_CONCEPT"] = $concept;
    }

    $arSelects = ["ID", "IBLOCK_ID", "NAME", "SORT"];
    $arFilters = ["PROPERTY_CML2_LINK" => $arFields["ID"], "ACTIVE" => "Y", "IBLOCK_ID" => 21];
    $ress = CIBlockElement::GetList([], $arFilters, false, false, $arSelects);
    while ($ob = $ress->GetNextElement()) {
        $arFieldss = $ob->GetFields();
        $offer["ID"] = $arFieldss["ID"];
        $offer["NAME"] = $arFieldss["NAME"];
        $MIN_PRICE = getPriceWithDiscount($offer["ID"]);
        $offer["MIN_PRICE"]["VALUE"] = round($MIN_PRICE["PRICE"]);
        $offer["MIN_PRICE"]["DISCOUNT_VALUE"] = round($MIN_PRICE["DISCOUNT_PRICE"]);
    }

    if ($offer["MIN_PRICE"]["DISCOUNT_VALUE"] != $offer["MIN_PRICE"]["VALUE"]) {
        $arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"] = $offer["MIN_PRICE"]["DISCOUNT_VALUE"];
    }

    $arResult["OTHER_CONCEPT"]["PRICE"] = $arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"] ? $offer["MIN_PRICE"]["VALUE"] : $offer["MIN_PRICE"]["DISCOUNT_VALUE"];
}


if ($concept_stock) {
    foreach ($arResult["OFFERS"] as $key => &$arOffer) {
        /* пока торговых предложений по 1 штуки
          $arOffer["PICTURE_WITHIN_SMALL"] = getResizeImage($arOffer["DETAIL_PICTURE"]["ID"], 34, 63);
          $arOffer["PICTURE_OUTSIDE_SMALL"] = getResizeImage($arOffer["PROPERTIES"]["DECOR_PHOTO_IN"]["VALUE"], 34, 63);
         */
        $arOffer["PICTURE_WITHIN_SMALL"] = getResizeImage($arResult["PREVIEW_PICTURE"]["ID"], 34, 63);
        $arOffer["PICTURE_OUTSIDE_SMALL"] = getResizeImage($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"], 34, 63);
    }
}