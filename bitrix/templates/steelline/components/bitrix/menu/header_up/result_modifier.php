<?php

$page = $APPLICATION->GetCurPage();

foreach ($arResult as $key => &$arItem) {
    if ($arItem["SELECTED"] == 1) {
        if ($arItem["LINK"] != $page) {
            $arItem["SELECTED"] = 0;
        }
    }
}