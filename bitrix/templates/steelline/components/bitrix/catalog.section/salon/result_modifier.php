<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
}
foreach($arResult["ITEMS"] as &$arItem) {
	if($arItem["OFFERS"]) {
		usort($arItem["OFFERS"], "minP");
		$arItem["MIN_PRICE"] = $arItem["OFFERS"][0]["MIN_PRICE"];
	}
}
?>