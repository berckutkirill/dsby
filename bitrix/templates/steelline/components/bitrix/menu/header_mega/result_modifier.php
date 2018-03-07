<?php

$page = $APPLICATION->GetCurPage();

foreach ($arResult as $key => &$arItem) {
    if ($arItem["PARAMS"]["level_type"]) {
        $levels[$arItem["PARAMS"]["level_type"]][] = $arItem;
        unset($arResult[$key]);
    }
    if ($arItem["SELECTED"] == 1) {
        if ($arItem["LINK"] != $page) {
            $arItem["SELECTED"] = 0;
        }
    }
    if ($arItem["PARAMS"]["menu"] == "action") {
        $menu = true;
    }
}

foreach ($arResult as &$arItem) {
    if ($levels[$arItem["PARAMS"]["level"]]) {
        $arItem["CHILD"] = $levels[$arItem["PARAMS"]["level"]];
    }
    $results[] = $arItem;
}

$arResult["ITEMS"] = $results;

if ($menu) {
    if (CModule::IncludeModule('iblock')) {
        $arSelect = Array("ID", "NAME", "PROPERTY_ACTIVE_TO", "DETAIL_PAGE_URL");
        $arFilter = Array("IBLOCK_ID" => 8, "ACTIVE" => "Y", ">=PROPERTY_ACTIVE_TO" => date('Y-m-d'));

        $res = CIBlockElement::GetList(Array("id" => "asc"), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $result[] = $arFields;
        }
        $arResult["ACTIONS"] = $result;
    }
}
$arResult["PAGE"] = $page;
