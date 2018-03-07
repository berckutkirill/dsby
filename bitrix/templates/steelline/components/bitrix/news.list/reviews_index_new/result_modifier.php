<?php

foreach ($arResult["ITEMS"] as $key => $arItem) {
    $reviews[$key]["ID"] = $arItem["ID"];
    $reviews[$key]["NAME"] = $arItem["PROPERTIES"]["NAME"]["VALUE"] . ". " . $arItem["PROPERTIES"]["ADDRESS"]["VALUE"];
    $reviews[$key]["REVIEW"] = $arItem["PROPERTIES"]["REVIEW"]["~VALUE"]["TEXT"];
}

unset($arResult["ITEMS"]);
shuffle($reviews);
$arResult["ITEMS"] = $reviews;
