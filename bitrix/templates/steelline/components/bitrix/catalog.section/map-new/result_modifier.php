<?

//print_r($arResult);


foreach ($arResult["ITEMS"] as $key => $arItem) {
    if ($arItem["CODE"] == "trum" || $arItem["CODE"] == "dzer") {
        $result[$arItem["CODE"]]["COUNT_MODELS"] = $arItem["PROPERTIES"]["COUNT_MODELS"]["VALUE"];
    }

    $data_maps[$key]['type'] = $arItem["PROPERTIES"]["IS_SALON"]["VALUE_XML_ID"] == 1 ? "FS" : "BS";

    $data_maps[$key]['coords']["lat"] = floatval(trim(stristr($arItem["PROPERTIES"]["COORDINATES"]["VALUE"], ",", true)));
    $data_maps[$key]['coords']["lng"] = floatval(trim(str_replace(",", "", stristr($arItem["PROPERTIES"]["COORDINATES"]["VALUE"], ","))));

    $data_maps[$key]['img'] = CFile::GetPath($arItem["PROPERTIES"]["PHOTO_FOR_MAP"]["VALUE"]);

    $data_maps[$key]['address'] = strip_tags($arItem["PROPERTIES"]["BALOON_CONTENT"]["~VALUE"]["TEXT"]);
    $data_maps[$key]['link'] = $arItem["PROPERTIES"]["HREF_ABOUT"]["VALUE"] ? $arItem["PROPERTIES"]["HREF_ABOUT"]["VALUE"] : $arItem["PROPERTIES"]["SALON_PAGE"]["VALUE"];

    foreach ($arItem["PROPERTIES"]["DAY_WORK_MAP"]["VALUE"] as $keyd => $valueDay) { 
        $data_maps[$key]['work'][$keyd]["days"] = $valueDay;
        $data_maps[$key]['work'][$keyd]["time"] = $arItem["PROPERTIES"]["TIME_WORK_MAP"]["VALUE"][$keyd];
    }

    foreach ($arItem["PROPERTIES"]["PHONES"]["VALUE"] as $keyp => $valuePhone) {
        $data_maps[$key]["phone"][$keyp] = $valuePhone;
    }

    $data_maps[$key]["ex"] = $arItem["PROPERTIES"]["COUNT_MODELS"]["VALUE"];
}

$arResult["SALONS"] = $result;
$arResult["DATA_MAPS"] = $data_maps;
//print_r($arResult["DATA_MAPS"] );


