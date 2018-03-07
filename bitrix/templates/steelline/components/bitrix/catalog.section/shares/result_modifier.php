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
function cmp($a, $b) 
{
    if ($a["MIN_PRICE"]["DISCOUNT_VALUE"] == $b["MIN_PRICE"]["DISCOUNT_VALUE"]) {
        return 0;
    }
    return ($a["MIN_PRICE"]["DISCOUNT_VALUE"] < $b["MIN_PRICE"]["DISCOUNT_VALUE"]) ? -1 : 1;
}

usort($arResult["ITEMS"],"cmp");
?>