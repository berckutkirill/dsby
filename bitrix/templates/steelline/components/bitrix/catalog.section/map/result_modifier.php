<?
foreach($arResult["ITEMS"] as $arItem)
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