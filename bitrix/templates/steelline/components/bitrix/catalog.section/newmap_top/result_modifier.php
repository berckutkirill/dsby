<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
$items = $arResult["ITEMS"];
$arResult["ITEMS"] = ["FLAT"=>[], "HOME" => []];
foreach($items as $arItem) {
 $MIN_OFFER = getOffersWithMinPrice($arItem["ID"]);


        $arItem["PREVIEW_PICTURE"] = $MIN_OFFER["DETAIL_PICTURE"];
        $arItem["PREVIEW_PICTURE2"] = $MIN_OFFER["DETAIL_PICTURE_2"];
	
	if(in_array("flat", $arItem["PROPERTIES"]["APPOINTMENT"]["VALUE_XML_ID"])) {
		$arResult["ITEMS"]["FLAT"][] = $arItem;
	} else {
		$arResult["ITEMS"]["HOME"][] = $arItem;
	}
}
?>