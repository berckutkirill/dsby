<?php

//print_r($arResult);

foreach ($arResult["ITEMS"] as $key => $arItem) {
//    print_r($arItem);
    $reviews[$key]["ID"] = $arItem["ID"];
    $reviews[$key]["NAME"] = $arItem["PROPERTIES"]["NAME"]["VALUE"] . ". " . $arItem["PROPERTIES"]["ADDRESS"]["VALUE"];
    $reviews[$key]["REVIEW"] = $arItem["PROPERTIES"]["REVIEW"]["~VALUE"]["TEXT"];
}

unset($arResult["ITEMS"]);
$arResult["ITEMS"] = $reviews;

