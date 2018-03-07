<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

if (!empty($arResult["SEARCH"])) {
    foreach ($arResult["SEARCH"] as $arItem) {
        $ids[] = $arItem["ID"];
    }
    ?>    
    <?

    $APPLICATION->IncludeComponent(
            "rest:catalog.section", "new_with_sku_rest_search", array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "22",
        "SEF_MODE" => "Y",
        "NO_TPL" => true,
        "ELEMENT_SORT_FIELD" => "shows",
        "ELEMENT_SORT_ORDER" => "DESC",
        "SEF_FOLDER" => "/rest/",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "PAGE_ELEMENT_COUNT" => 12,
        "DEFAULT_H1" => "Входные двери",
        "FOR_PATH" => $_SERVER['REQUEST_URI'],
        "CACHE_FILTER" => "N",
        "SECTION_URL" => "/catalog-dverei/#SECTION_CODE#/",
        "DETAIL_URL" => "/catalog-dverei/stalnaya-liniya/#ELEMENT_CODE#.html",
        "FILTER_ID" => $ids,
        "SEARCH" => "YES"
            ), false
    );
    ?>
<? } ?>