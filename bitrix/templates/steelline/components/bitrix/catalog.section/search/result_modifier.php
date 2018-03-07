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
	$flat["CLASS"] = in_array("flat", $arItem["PROPERTIES"]["APPOINTMENT"]["VALUE_XML_ID"]) ? "class='active'":"";
	$flat["VALUE"] = getMessage("FOR_FLAT");

	$home["CLASS"] = in_array("home", $arItem["PROPERTIES"]["APPOINTMENT"]["VALUE_XML_ID"]) ? "class='active'":"";
	$home["VALUE"] = getMessage("FOR_HOME");

	$arItem["APPOINTMENTS"] = ["flat" => $flat, "home" => $home];
	if($arItem["OFFERS"]) {
		usort($arItem["OFFERS"], "minP");
		$arItem["MIN_PRICE"] = $arItem["OFFERS"][0]["MIN_PRICE"];
		$arItem["PREVIEW_PICTURE"]["SRC"] = $arItem["OFFERS"][0]["DETAIL_PICTURE"]["SRC"];
	}
}
?>