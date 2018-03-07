<?php


if(!empty($arResult))
{
	$arBasketItems = $arResult["arBasketItems"];
	$Basket = $arResult["Basket"];


	$Settings = array("OTDELKA_SNARUZHI" => 
				array("NAME" => "Отделка снаружи", "TOOLTIP" => "TOOLTIP", "CODES" => array("OTDELKA", "TOLSHINA", "MATERIAL", "COLOR", "FREZEROVKA", "PATINA")),
				"OTDELKA_VNUTRI" =>
				array("NAME" => "Отделка внутри", "TOOLTIP" => "TOOLTIP", "CODES" => array("OTDELKA", "TOLSHINA", "MATERIAL", "COLOR", "FREZEROVKA", "PATINA")),
				"NALICHNIK" => 
				array("NAME" => "Наличник", "TOOLTIP" => "TOOLTIP", "CODES" => array("OTDELKA","OTDELKA_VNUTRENIY", "POKRYTIE", "COLOR", "PATINA")));

	foreach($arBasketItems as $k => $arItem) {
		$sostav = [];
		$PROPS = $Basket[$arItem["ID"]];
		foreach($Settings as $tth_code => $tth_values_codes) {
			$NAME = $tth_values_codes["NAME"];
			$TOOLTIP = $arItem["PROPERTIES"][$tth_code."_".$tth_values_codes["TOOLTIP"]]["VALUE"];
			$TEXT = "";
			foreach($tth_values_codes["CODES"] as $code) {
				$value = $arItem["PROPERTIES"][$tth_code."_".$code]["VALUE"];
				if($value) {
					if($TEXT) {
						$TEXT .= ",";
					}
					$sostav[$tth_code][$code] = $value;
					$TEXT .= " ".trim($value);
				}
			}
			if($TEXT)
				$sostav[$tth_code] = array("NAME" => $NAME, "TOOLTIP" => $TOOLTIP, "TEXT" => $TEXT);
		}
		
		$arResult["arBasketItems"][$k]["SOSTAV_TTH"] = $sostav;
	}
}

