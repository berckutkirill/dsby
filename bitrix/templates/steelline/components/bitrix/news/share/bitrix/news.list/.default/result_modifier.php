<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arSelect = Array("ID","IBLOCK_ID", "NAME","DETAIL_PAGE_URL","DETAIL_PICTURE","PREVIEW_PICTURE", "ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>IntVal($arResult["ID"]), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
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
$nTopCount = $arResult["PROPERTIES"]["COUNT_USLUG"]["VALUE"]?$arResult["PROPERTIES"]["COUNT_USLUG"]["VALUE"]:3;
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
$date1=  date('Y-m-d');
foreach($arResult["ITEMS"] as $k => $arItem)
{
	$date2=  $arItem["PROPERTIES"]["ACTIVE_TO"]["VALUE"];
	if((strtotime($date1) < strtotime($date2)) && !count($arResult["ACTIVE_ACTION"]))
	{
		$arResult["ACTIVE_ACTION"][] = $arItem;
		unset($arResult["ITEMS"][$k]);
	}
	else
	{
		if((strtotime($date1) < strtotime($date2))) {
			$arItem['CONTINUES'] = true;
		}
		$arResult["NOACTIVE_ACTION"][] = $arItem;
		unset($arResult["ITEMS"][$k]);
	}
}

?>
