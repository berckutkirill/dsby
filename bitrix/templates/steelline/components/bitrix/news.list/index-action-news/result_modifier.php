<?php

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_ACTIVE_TO", "DETAIL_PAGE_URL", "PROPERTY_DATE_FOR_MAIN");
$arFilter = Array("IBLOCK_ID" => 8, "ACTIVE" => "Y", ">=PROPERTY_ACTIVE_TO" => date('Y-m-d'));

$res = CIBlockElement::GetList(Array("id" => "desc"), $arFilter, false, Array("nPageSize" => 1), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $result[] = $arFields;
}

$arResult["ACTION"] = $result[0];
unset($result);
//print_r($arResult);
