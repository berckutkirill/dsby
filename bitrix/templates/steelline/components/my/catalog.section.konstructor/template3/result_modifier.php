<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$Furnish = GetHBlock(7);
$CvetBlock = GetHBlock(10);
$RuchkiS = GetHBlock(11);
$CylinderS = GetHBlock(12);

foreach($RuchkiS as $k => $val) {

	$colors = array();
	foreach($val["UF_HJK"] as $key => $hex)
	{
		$description = $val["UF_GGFF"][$key];
		$colors[] = array("HEX_COLOR" => $hex, "VALUE" => $description, "HAND_ID" => $key, "PRICE" => $val["UF_NACC"][$key]);
	}
	$name = $val["UF_NAME"];
	$Ruchki[$val["UF_XML_ID"]] = array("NAME" => $name, "COLORS" => $colors, "PRICE" => $val["UF_GUU"]);
}


foreach($CylinderS as $k => $val){
	
	$colors = array();
	foreach($val["UF_HJKU"] as $key => $hex)
	{
		$description = $val["UF_KJL"][$key];
		$colors[] = array("HEX_COLOR" => $hex, "VALUE" => $description, "CILYNDER_ID" => $key);
		
	}
	$name = $val["UF_NAME"];
	$Cylinders[$val["UF_XML_ID"]] = array("NAME" => $name, "VALUE_ID" => $val["UF_XML_ID"], "COLORS" => $colors);

}



foreach($CvetBlock as $k => $val){
	
	$src = CFile::GetPath($val["UF_FILE"]);
	$name = $val["UF_NAME"];
	$Cvet[$val["UF_XML_ID"]] = array("VALUE" => $name, "PRICE" => $val["UF_JIII"], "FILE" => $src);

}



foreach($arResult["ITEMS"] as $arItem) {
	$PICTURES[$arItem["ID"]] = array("OUTSIDE" => $arItem["PREVIEW_PICTURE"]["SRC"], "INSIDE" => CFile::GetPath($arItem["PROPERTIES"]["VIEW_OUTSIDE_ANONS"]["VALUE"]));
	$arItem["PROPERTIES"]["KONSTRUKTOR_MODELD"]["BASE_PRICE"] = $arItem["PROPERTIES"]["KONSTRUKTOR_BASPRICE"]["VALUE"];
	
	foreach($arItem["PROPERTIES"]["KONSTRUKTOR_KONTUR"]["VALUE"] as $k => $v){
		$price = $arItem["PROPERTIES"]["KONSTRUKTOR_NAC_KONTUR"]["VALUE"][$k];
		if($price) continue;
		$arItem["PROPERTIES"]["KONSTRUKTOR_MODELD"]["VALUE"] .= " ".$v." контура";
		break;
	}
	
	$arItem["PROPERTIES"]["KONSTRUKTOR_MODELD"]["VALUE"] = $arItem["PROPERTIES"]["KONSTRUKTOR_MODELD"]["VALUE"]." ".$kontur;
	
	
	foreach($arItem["PROPERTIES"] as $code => $property) {
		if(strpos($code, "KONSTRUKTOR_NAC_") === 0) {
			if($property["DEFAULT_VALUE"] && !$property["VALUE"])
				$property["VALUE"] = $property["DEFAULT_VALUE"];
		
			if(!$property["VALUE"]) continue;
		
			$id = str_replace("KONSTRUKTOR_NAC_", "", $code);
			$prop_id = preg_replace("#[^\d]#", "", $id);
			$id = str_replace("_".$prop_id, "", $id);
			
			
			$VATS[$arItem["ID"]][$id][$prop_id] = $property["VALUE"];
		} elseif(strpos($code, "KONSTRUKTOR_") === 0) {
			if(!$property["VALUE"]) continue;
			$id = str_replace("KONSTRUKTOR_", "", $code);
			
			if($property["MULTIPLE"] == "Y") {
				if($property["PROPERTY_TYPE"] == "L") {
					foreach($property["VALUE"] as $k => $val) {
						$VALUE_ENUM_ID = $property["VALUE_ENUM_ID"][$k];

						if(!$VALUES[$VALUE_ENUM_ID]) {
							$res = array("VALUE_ID" => $VALUE_ENUM_ID, 
										"VALUE" => $val,
										"CODE" => $id, 
										"NAME" => $property["NAME"],
										"ITEM_ID" => $arItem["ID"]
										);
							if($property["BASE_PRICE"]){
								$res["BASE_PRICE"] = $property["BASE_PRICE"];
							}
							
							$VALUES[$VALUE_ENUM_ID] = $res;
						}
					}
					
				} elseif($property["PROPERTY_TYPE"] == "S") {
					if($property["USER_TYPE"]) {
						foreach($property["VALUE"] as $k => $val) {
							$VALUE_ENUM_ID = $property["PROPERTY_VALUE_ID"][$k];
	
							if(!$VALUES[$VALUE_ENUM_ID]) {
								$res = array("VALUE_ID" => $VALUE_ENUM_ID, 
											"VALUE" => $val,
											"CODE" => $id, 
											"NAME" => $property["NAME"],
											"ITEM_ID" => $arItem["ID"]
											);
								if($property["BASE_PRICE"]){
									$res["BASE_PRICE"] = $property["BASE_PRICE"];
								}
								$VALUES[$VALUE_ENUM_ID] = $res;
							}
	
						}
					} else {
						foreach($property["VALUE"] as $k => $val) {
							$VALUE_ENUM_ID = $property["PROPERTY_VALUE_ID"][$k];
							if(in_array($val, $VALUES_S[$id])) continue;
							
							if(!$VALUES[$VALUE_ENUM_ID]) {
								$res = array("VALUE_ID" => $property["VALUE_ENUM_ID"], 
											"VALUE" => $val,
											"CODE" => $id, 
											"NAME" => $property["NAME"],
											"ITEM_ID" => $arItem["ID"]
											);
								if($property["BASE_PRICE"]) {
									$res["BASE_PRICE"] = $property["BASE_PRICE"];
								}
								
								$VALUES[$VALUE_ENUM_ID] = $res;
								$VALUES_S[$id][] = $val;
							}
						}
					}
				}
			} else {
				if($property["PROPERTY_TYPE"] == "S") {
					if($property["USER_TYPE"]) {
						$VALUE_ENUM_ID = $property["PROPERTY_VALUE_ID"];
						if(!$VALUES[$VALUE_ENUM_ID]) {
								$res = array("VALUE_ID" => $VALUE_ENUM_ID,
											"VALUE" => $property["VALUE"],
											"CODE" => $id,
											"NAME" => $property["NAME"],
											"ITEM_ID" => $arItem["ID"]
											);
								if($property["BASE_PRICE"]){
									$res["BASE_PRICE"] = $property["BASE_PRICE"];
								}
								$VALUES[$VALUE_ENUM_ID] = $res;
						}
					} else {
						$VALUE_ENUM_ID = $property["PROPERTY_VALUE_ID"];
						if(in_array($val, $VALUES_S[$id])) continue;
						
						if(!$VALUES[$VALUE_ENUM_ID]) {
							$res = array("VALUE_ID" => $VALUE_ENUM_ID, 
										"VALUE" => $val,
										"CODE" => $id, 
										"NAME" => $property["NAME"],
										"ITEM_ID" => $arItem["ID"]
										);
							if($property["BASE_PRICE"]) {
								$res["BASE_PRICE"] = $property["BASE_PRICE"];
							}
							
							$VALUES[$VALUE_ENUM_ID] = $res;
							$VALUES_S[$id][] = $val;
						}
					}
				} elseif($property["PROPERTY_TYPE"] == "L") {
					$VALUE_ENUM_ID = $property["VALUE_ENUM_ID"];
					if(!$VALUES[$VALUE_ENUM_ID]) {
							$res = array("VALUE_ID" => $VALUE_ENUM_ID,
										"VALUE" => $property["VALUE"],
										"CODE" => $id,
										"NAME" => $property["NAME"],
										"ITEM_ID" => $arItem["ID"]
										);
							if($property["BASE_PRICE"]){
								$res["BASE_PRICE"] = $property["BASE_PRICE"];
							}
							if($id == "MODELD") {
								$res["KOL"] = $arItem["PROPERTIES"]["KONSTRUKTOR_KOL"]["VALUE_ENUM_ID"];
								$res["HOME"] = $arItem["PROPERTIES"]["KONSTRUKTOR_HOME"]["VALUE_ENUM_ID"];
							}
							
							$VALUES[$VALUE_ENUM_ID] = $res;
					}
				} elseif($property["PROPERTY_TYPE"] == "E") {
					$VALUE_ENUM_ID = $property["PROPERTY_VALUE_ID"];

					if(!$VALUES[$VALUE_ENUM_ID]) {
							$res = array("VALUE_ID" => $VALUE_ENUM_ID,
										"VALUE" => $property["VALUE"],
										"CODE" => $id,
										"NAME" => $property["NAME"],
										"ITEM_ID" => $arItem["ID"]
										);
							if($property["BASE_PRICE"]){
								$res["BASE_PRICE"] = $property["BASE_PRICE"];
							}
							if($id == "MODELD") {
								$res["KOL"] = $arItem["PROPERTIES"]["KONSTRUKTOR_KOL"]["VALUE_ENUM_ID"];
								$res["HOME"] = $arItem["PROPERTIES"]["KONSTRUKTOR_HOME"]["VALUE_ENUM_ID"];
							}

							$VALUES[$VALUE_ENUM_ID] = $res;
					}
				}
			}
		}
	}
	if(!$base){
		$base = $arItem["ID"];
	}
}


foreach($Furnish as $k => $val) {

	$colors = array();
	foreach($val["UF_OTDELKA"] as $key => $id)
	{
		$src = CFile::GetPath($id);
		$description = $val["UF_NAMES"][$key];

		$colors[] = array("file" => $src, "description" => $description);
	}

	$name = $val["UF_NAME"];
	$price = $val["UF_UIU"];


	$Furns[$val["UF_XML_ID"]] = array("VALUE" => $name, "PRICE" => $price, "COLORS" => $colors);
};

foreach($VALUES as $val) {
	if($base != $val["ITEM_ID"] && $val["CODE"] != "MODELD" && $val["CODE"] != "KOL" && $val["CODE"] != "HOME") continue;
	if($val["CODE"] == "BLOKKH" || $val["CODE"] == "BLOHKKH")
	{
		$id = $val["VALUE"];
		$val["VALUE"] = $Furns[$id]["VALUE"];
		$val["VALUE_ID"] = $id;
		
	} elseif($val["CODE"] == "RUCHKA"){
		
		$id = $val["VALUE"];
		$val["VALUE"] = $Ruchki[$id]["NAME"];
		$val["COLORS"] = $Ruchki[$id]["COLORS"];
		$val["VALUE_ID"] = $id;

	} elseif($val["CODE"] == "CILL"){

		$id = $val["VALUE"];
		$val["VALUE"] = $Cylinders[$id]["NAME"];
		$val["COLORS"] = $Cylinders[$id]["COLORS"];
		$val["VALUE_ID"] = $id;

	} elseif($val["CODE"] == "DOVOD" || $val["CODE"] == "NAKL" || $val["CODE"] == "GERK" || $val["CODE"] == "GLAZZ" || $val["CODE"] == "ZADV" || $val["CODE"] == "STOR") {
		if($VATS[$val["ITEM_ID"]][$val["CODE"]][$val["VALUE_ID"]]){
			$val["PRICE"] = $VATS[$val["ITEM_ID"]][$val["CODE"]][$val["VALUE_ID"]];
		}
	
		if(!in_array($val["VALUE"], $DOP[$val["CODE"]]))
		{
			$DOP[$val["CODE"]][$val["VALUE_ID"]]["VALUE"] = $val["VALUE"];
			$DOP[$val["CODE"]][$val["VALUE_ID"]]["PRICE"] = $val["PRICE"];
		}
			
	} else {
		if($VATS[$val["ITEM_ID"]][$val["CODE"]][$val["VALUE_ID"]]){
			
			$val["PRICE"] = $VATS[$val["ITEM_ID"]][$val["CODE"]][$val["VALUE_ID"]];
		}
	}
	$Filter[$val["CODE"]][] = $val;

}

$Filter["INSIDE"] = $Furns;
$Filter["OUTSIDE"] = $Furns;
$Filter["DOP"] = $DOP;


foreach($arParams["FURNS"]["ITEMS"] as $furn) {
$price = $furn["MIN_PRICE"]["VALUE"];
	$array = array(
		"ID" => $furn["ID"],
		"NAME" => $furn["PROPERTIES"]["KONSTRUKTOR_NAMENEW"]["VALUE"],
		"FILE" => $furn["DETAIL_PICTURE"]["SRC"],
		"PRICE" => $price,
	);
	unset($furn["PROPERTIES"]["KONSTRUKTOR_NAMENEW"]);
	
	foreach($furn["COMPLECT"] as $comp)
	{
		if(!$items[$comp["ID"]]) {
			$pic = CFile::GetPath($comp["DETAIL_PICTURE"]);
			$name = $comp["NAME"];
			$text = $comp["~DETAIL_TEXT"];
			foreach($comp["PROPERTIES"] as $code => $val)
			{
				if(strpos($code,"CHARACKTER_") === 0)
				{
					$items[$comp["ID"]]["PROPS"][$code] = $val;
				}
			}
			$items[$comp["ID"]]["NAME"] = $name;
			$items[$comp["ID"]]["SRC"] = $pic;
			$items[$comp["ID"]]["TEXT"] = $text;
		}
		$array["GALERY"][] = array("FILE" => CFile::GetPath($comp["DETAIL_PICTURE"]));
		$array["NABOR"][] = array("NAME" => $comp["NAME"]);
	};
	
	foreach($furn["PROPERTIES"]["KONSTRUKTOR_RUCHKI"]["VALUE"] as $hand)
	{
		$array["HANDS"][$hand] = $Ruchki[$hand];
	};

	$cyl = $furn["PROPERTIES"]["KONSTRUKTOR_CILINDR"]["VALUE"][0];
	{
		$array["CILYNDER"] = $Cylinders[$cyl];
	};
	unset($furn["PROPERTIES"]["KONSTRUKTOR_CILINDR"]);
	unset($furn["PROPERTIES"]["KONSTRUKTOR_RUCHKI"]);
	

	if($furn["PROPERTIES"]["KONSTRUKTOR_NOCHNAYA"]["VALUE"]) {
	
		$array["PROPERTIES"]["NOCHNAYA"]["NAME"] = $furn["PROPERTIES"]["KONSTRUKTOR_NOCHNAYA"]["NAME"];
		foreach($furn["PROPERTIES"]["KONSTRUKTOR_NOCHNAYA"]["VALUE"] as $i => $val) {
			$array["PROPERTIES"]["NOCHNAYA"]["VALUE_ID"] = $furn["PROPERTIES"]["KONSTRUKTOR_NOCHNAYA"]["VALUE_ENUM_ID"][$i];		
			$array["PROPERTIES"]["NOCHNAYA"]["VALUE"][] = $val;
		};
		
	}
	
	if($furn["PROPERTIES"]["KONSTRUKTOR_DEVIATOR"]["VALUE"]) {
		$array["PROPERTIES"]["DEVIATOR"]["NAME"] = $furn["PROPERTIES"]["KONSTRUKTOR_DEVIATOR"]["NAME"];
		
		foreach($furn["PROPERTIES"]["KONSTRUKTOR_DEVIATOR"]["VALUE"] as $i => $val) {
			
			$array["PROPERTIES"]["DEVIATOR"]["VALUE_ID"] = $furn["PROPERTIES"]["KONSTRUKTOR_DEVIATOR"]["VALUE_ENUM_ID"][$i];
			$array["PROPERTIES"]["DEVIATOR"]["VALUE"][] = $val;
		};
	}

	if($furn["PROPERTIES"]["KONSTRUKTOR_VERH"]["VALUE"]) {
		$array["PROPERTIES"]["ZAMOKL"]["NAME"] = $furn["PROPERTIES"]["KONSTRUKTOR_VERH"]["NAME"];
		
		foreach($furn["PROPERTIES"]["KONSTRUKTOR_VERH"]["VALUE"] as $i => $val) {
			$array["PROPERTIES"]["ZAMOKL"]["VALUE_ID"] = $furn["PROPERTIES"]["KONSTRUKTOR_VERH"]["VALUE_ENUM_ID"][$i];
			$array["PROPERTIES"]["ZAMOKL"]["VALUE"][] = $val;
		};
	}
	if($furn["PROPERTIES"]["KONSTRUKTOR_NIZ"]["VALUE"]) {
		$array["PROPERTIES"]["NIGG"]["NAME"] = $furn["PROPERTIES"]["KONSTRUKTOR_NIZ"]["NAME"];
		
		foreach($furn["PROPERTIES"]["KONSTRUKTOR_NIZ"]["VALUE"] as $i => $val) {
			$array["PROPERTIES"]["NIGG"]["VALUE_ID"] = $furn["PROPERTIES"]["KONSTRUKTOR_NIZ"]["VALUE_ENUM_ID"][$i];
			$array["PROPERTIES"]["NIGG"]["VALUE"][] = $val;
		};
	}
	if($furn["PROPERTIES"]["KONSTRUKTOR_ZAMM"]["VALUE"]) {
	
		$array["PROPERTIES"]["ZAMM"]["NAME"] = $furn["PROPERTIES"]["KONSTRUKTOR_ZAMM"]["NAME"];
		$array["PROPERTIES"]["ZAMM"]["VALUE_ID"] = $furn["PROPERTIES"]["KONSTRUKTOR_ZAMM"]["VALUE_ENUM_ID"];
		$array["PROPERTIES"]["ZAMM"]["VALUE"] = $furn["PROPERTIES"]["KONSTRUKTOR_ZAMM"]["VALUE"];
		
	}
	
	

	
	
	$Filter["FURNS"][] = $array;
	
}



$Filter["BLOCK_COLOR"] = $Cvet;
$Filter["PICTURES"] = $PICTURES;
$arResult["POPUPS"]["FURNS"] = $items;
$arResult["FILTER"] = $Filter;


?>