<?php

$json = [];


foreach ($arResult as $arItem) {
    $out = [];
    $ins = [];
    if ($arItem["OFFERS"]) {
        $furn = $arItem['PROPERTIES']['FURNISH'];
        foreach ($arItem["PROPERTIES"] as $code => $val) {
            if (strpos($code, 'OTDELKA_SNARUZHI') === 0) {
                $out[] = $val['VALUE_ENUM'];
            } elseif (strpos($code, 'OTDELKA_VNUTRI') === 0) {
                $ins[] = $val['VALUE_ENUM'];
            }
        }
        foreach ($arItem["OFFERS"] as $arOffer) {
            $json[] = [
                "id" => $arOffer["ID"],
                "name" => $arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"],
                "type" => $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_ENUM"][0],
                "art" => $arOffer["PROPERTIES"]["ARTICLE"]["VALUE"] ? $arOffer["PROPERTIES"]["ARTICLE"]["VALUE"] : 'empty',
                "width" => $arOffer["PROPERTIES"]["WIDTH"]["VALUE_ENUM"],
                "height" => $arItem["PROPERTIES"]["CHARAKTER_HEIGHT"]["VALUE_ENUM"],
                "contour" => $arItem["PROPERTIES"]["CHARAKTER_TINER"]["VALUE_ENUM"],
                "open_side" => $arOffer["PROPERTIES"]["OPEN_SIDE"]["VALUE_ENUM"],
                "img_src_f" => $arItem["PREVIEW_PICTURE"]["SRC"],
                "img_src_b" => $arItem["PROPERTIES"]["VIEW_OUTSIDE_ANONS"]["SRC"],
                "otdelka_f" => $out,
                "otdelka_b" => $ins,
                "furniture" => $furn,
                "quantity" => intval($arOffer['QUANTITY']),
                "quantity_reserved" => intval($arOffer['QUANTITY_RESERVED']),
                "price" => intval($arOffer["PRICE"])
            ];
        }
    }
}

echo json_encode($json);
