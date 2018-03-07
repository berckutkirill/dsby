<?
if($arParams["FOR_ELEMENT_ID"]) {
	$db_props = CIBlockElement::GetProperty(IBLOCK_CATALOG, $arParams["FOR_ELEMENT_ID"], array("sort" => "asc"), Array("CODE"=>"ULIA_MODEL_IN_SALOONS"));
	while($ar_props = $db_props->Fetch()) {
		$IDS[] = $ar_props["VALUE"];
	}

	foreach($arResult["ITEMS"] as $key => $arItem)
	{
		if(!in_array($arItem["ID"], $IDS)) {
			$arResult["ITEMS"][$key]["HIDDEN"] = true;
		}
	}
}

foreach($arResult["ITEMS"] as $key => $arItem)
{
	if($arItem["PROPERTIES"]["OBLOST"]["VALUE"])
	{
		$OBL = $arItem["PROPERTIES"]["OBLOST"]["VALUE"];
		if($arItem["PROPERTIES"]["ADRESS_IN_SELECT"]["VALUE"])
		{
			if(!in_array(trim($arItem["PROPERTIES"]["ADRESS_IN_SELECT"]["VALUE"]), $SELECT[$OBL]))
			$SELECT[$OBL][] = $arItem["PROPERTIES"]["ADRESS_IN_SELECT"]["VALUE"];
		}
	}
}
$arResult["SELECT"] = $SELECT;
?>