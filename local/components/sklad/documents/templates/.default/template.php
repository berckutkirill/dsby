<?php
$json = [];
foreach ($arResult["ITEMS"] as $doc) {
    $doors = [];

    foreach ($doc['PRODUCTS'] as $offerArr) {

        if ($resOffers[$offerArr['ELEMENT_ID']]) {
            $keys = explode(':', $resOffers[$offerArr['ELEMENT_ID']]);
            $element = $keys[0];
            $offerItem = $keys[1];
        } else {
            foreach ($arResult['PRODUCT_LIST'] as $key => $arItem) {
                foreach ($arItem['OFFERS'] as $k => $offer) {
                    if ($offer['ID'] == $offerArr['ELEMENT_ID']) {
                        $resOffers[$offerArr['ELEMENT_ID']] = $key . ':' . $k;
                        $element = $key;
                        $offerItem = $k;
                        break;
                    }
                }
                unset($offer);
            }
            unset($arItem);
        }
        $Item = $arResult['PRODUCT_LIST'][$element];
        $arOffer = $Item['OFFERS'][$offerItem];


        if (!$arOffer) {
            continue;
        }

        $out = [];
        $ins = [];
        $furn = $Item['PROPERTIES']['FURNISH'];
        foreach ($Item["PROPERTIES"] as $code => $val) {
            if (strpos($code, 'OTDELKA_SNARUZHI') === 0) {
                $out[] = $val['VALUE_ENUM'];
            } elseif (strpos($code, 'OTDELKA_VNUTRI') === 0) {
                $ins[] = $val['VALUE_ENUM'];
            }
        }
        $data = [];
        foreach ($doc['DATA'] as $prod) {
            if ($prod['id'] == $arOffer["ID"]) {
                $data = $prod;
            }
        }
        $doors[] = [
            "id" => $offerArr["ELEMENT_ID"],
            "name" => $Item["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"],
            "type" => $Item["PROPERTIES"]["FOR_WHAT"]["VALUE_ENUM"][0],
            "art" => $arOffer["PROPERTIES"]["ARTICLE"]["VALUE"] ? $arOffer["PROPERTIES"]["ARTICLE"]["VALUE"] : 'empty',
            "width" => $arOffer["PROPERTIES"]["WIDTH"]["VALUE_ENUM"],
            "height" => $Item["PROPERTIES"]["CHARAKTER_HEIGHT"]["VALUE_ENUM"],
            "contour" => $Item["PROPERTIES"]["CHARAKTER_TINER"]["VALUE_ENUM"],
            "open_side" => $arOffer["PROPERTIES"]["OPEN_SIDE"]["VALUE_ENUM"],
            "img_src_f" => $Item["PREVIEW_PICTURE"]["SRC"],
            "img_src_b" => $Item["PROPERTIES"]["VIEW_OUTSIDE_ANONS"]["SRC"],
            "otdelka_f" => $out,
            "otdelka_b" => $ins,
            "furniture" => $furn,
            "price" => intval($arOffer["PRICE"]),
            "quantity" => intval($arOffer['QUANTITY']),
            "quantity_reserved" => intval($arOffer['QUANTITY_RESERVED']),
            "order" => [
                "quantity" => intval($offerArr['AMOUNT']),
                "comment" => $data['comment'],
                "changed" => $data['changed'],
            ]
        ];
    }

    $json[] = [
        'id' => $doc['ID'],
        'date' => $doc['DATE_DOCUMENT'],
        'date_time' => $doc['DATE_DOCUMENT_TIME'],
        'object' => $doc['USER']['NAME'],
        'total' => intval($doc['TOTAL']),
        'status' => strtolower($doc['STATUS']),
        'comment' => $doc['COMMENTARY'],
        'doors' => $doors
    ];
}


if($arResult['EndPage'] || count($json) == 0) {
    $json[] = true;
} else {
    $json[] = false;
}

echo json_encode($json);
