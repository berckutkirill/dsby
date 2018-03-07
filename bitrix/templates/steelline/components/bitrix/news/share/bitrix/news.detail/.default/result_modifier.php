<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arSelect = Array("ID","IBLOCK_ID", "NAME","DETAIL_PAGE_URL","DETAIL_PICTURE","PREVIEW_PICTURE", "ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>IntVal($arResult["IBLOCK_ID"]), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("sort"=>"asc"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
$arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
$arFields["PROPERTIES"] = $arProps;
$arFields["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arFields["ACTIVE_FROM"]));
$arFields["DISPLAY_ACTIVE_FROM"] = strtolower($arFields["DISPLAY_ACTIVE_FROM"]);
$arResult["SIDEBAR"][] = $arFields;
}

$nTopCount = $arResult["PROPERTIES"]["COUNT_USLUG"]["VALUE"]?$arResult["PROPERTIES"]["COUNT_USLUG"]["VALUE"]:1;
$arSelect = Array("ID","IBLOCK_ID", "NAME","DETAIL_PAGE_URL","DETAIL_PICTURE","PREVIEW_PICTURE", "ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>7, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_KLICKABLE_VALUE"=>"Y");
$res = CIBlockElement::GetList(Array("sort"=>"asc"), $arFilter, false,  array("nTopCount"=>$nTopCount), $arSelect);
while($ob = $res->GetNextElement())
{
$arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
$arFields["PROPERTIES"] = $arProps;
$arFields["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arFields["ACTIVE_FROM"]));
$arFields["DISPLAY_ACTIVE_FROM"] = strtolower($arFields["DISPLAY_ACTIVE_FROM"]);
$arResult["SIDEBAR_TO"][] = $arFields;
}
?>