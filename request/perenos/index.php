<?php
die();
define("NEW_IBLOCK", 19);
require_once(filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . "/bitrix/modules/main/include/prolog.php");
Bitrix\Main\Loader::includeModule('iblock');


$arSelect = ["ID", "ACTIVE", "IBLOCK_ID", "NAME", "CODE", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PREVIEW_TEXT", "DETAIL_TEXT"];
$arFilter = ["IBLOCK_ID" => 4, 'ID' => ['1262', '1263', '1264', '1265' ]];

$res = CIBlockElement::GetList(['sort' => 'asc'], $arFilter, false, false, $arSelect);


$property_enums = CIBlockPropertyEnum::GetList([], ["IBLOCK_ID" => NEW_IBLOCK]);
while ($enum_fields = $property_enums->GetNext()) {
 
    $PROPS[$enum_fields["PROPERTY_CODE"]][$enum_fields["VALUE"]] = $enum_fields["ID"];
}



while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProperties = $ob->GetProperties();

    foreach ($arProperties as $code => $property) {
        if (strpos($code, "KONSTRUKTOR_") === 0) {
            unset($arProperties[$code]);
            continue;
        }
    }
    $arFields["PROPERTIES"] = $arProperties;
    try {
        $pid = addElement($arFields);
    } catch (\Exception $e) {
        print_r($e->getMessage());
        die();
    }
}

function getPropertyFArray($ar) {
    foreach ($ar as $i => $id) {
        $result["n" . $i] = getPropertyF($id);
    }
    return $result;
}

function getPropertyF($id) {
    return CFile::MakeFileArray(CFile::GetPath($id));
}

function addElement($arItem) {
    global $PROPS;
    $el = new CIBlockElement;
    foreach ($arItem["PROPERTIES"] as $code => $property) {
        if ($property["PROPERTY_TYPE"] == "F") {
            if (\is_array($property["VALUE"])) {
                $PROP[$code] = getPropertyFArray($property["VALUE"]);
            } else {
                $PROP[$code] = getPropertyF($property["VALUE"]);
            }
        } elseif ($property["PROPERTY_TYPE"] == "L") {
            $PROP[$code] = $PROPS[$code][$property["VALUE"]];
        } else {
            $PROP[$code] = $property["VALUE"];
        }
    }
   
    /*
     * ARTICLE
     * BARCODE 
     * SIDE_OPEN
     * OTDELKA_VNUTRI_OTDELKA
     * OTDELKA_VNUTRI_TOLSHINA
     * OTDELKA_VNUTRI_MATERIAL
     * OTDELKA_VNUTRI_COLOR
     * OTDELKA_VNUTRI_FREZEROVKA
     * OTDELKA_VNUTRI_PATINA
     * OTDELKA_SNARUZHI_OTDELKA
     * OTDELKA_SNARUZHI_TOLSHINA
     * OTDELKA_SNARUZHI_MATERIAL
     * OTDELKA_SNARUZHI_COLOR
     * OTDELKA_SNARUZHI_FREZEROVKA
     * OTDELKA_SNARUZHI_PATINA
     * VIEW_OUTSIDE_DETAIL
     * VIEW_OUTSIDE_ANONS
     * WIDTH
     * HEIGHT
     * CHARAKTER_TINER
     * NABOR_FURNITUR
     */
    $PROP["IN_CATALOG"] = $arItem["ID"];


    $arLoadProductArray = [
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID" => NEW_IBLOCK,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $arItem["NAME"],
        "CODE" => $arItem["CODE"],
        "ACTIVE" => $arItem["ACTIVE"],
        "PREVIEW_TEXT" => $arItem["PREVIEW_TEXT"],
        "DETAIL_TEXT" => $arItem["DETAIL_TEXT"],
        "DETAIL_PICTURE" => CFile::MakeFileArray(CFile::GetPath($arItem["DETAIL_PICTURE"])),
        "PREVIEW_PICTURE" => CFile::MakeFileArray(CFile::GetPath($arItem["PREVIEW_PICTURE"]))
    ];

    $PRODUCT_ID = $el->Add($arLoadProductArray);

    if ($PRODUCT_ID) {
        return $PRODUCT_ID;
    } else {
        throw new Exception($el->LAST_ERROR);
    }
}
