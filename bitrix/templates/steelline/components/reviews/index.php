<?
header('Content-Type: application/json');
$_GET["bitrix_include_areas"] = "N";
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$forPath = filter_input(INPUT_GET, "FOR_PATH", FILTER_SANITIZE_STRING);

$sort_field = filter_input(INPUT_GET, "SORT_FIELD", FILTER_SANITIZE_STRING);
$sort_order = filter_input(INPUT_GET, "SORT_ORDER", FILTER_SANITIZE_STRING);
$sort_field2 = filter_input(INPUT_GET, "SORT_FIELD2", FILTER_SANITIZE_STRING);
$sort_order2 = filter_input(INPUT_GET, "SORT_ORDE2", FILTER_SANITIZE_STRING);
$APPLICATION->IncludeComponent(
        "rest:catalog.section", "new_with_sku_rest", array(
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => "22",
    "SEF_MODE" => "Y",
    "ELEMENT_SORT_FIELD" => $sort_field,
    "ELEMENT_SORT_ORDER" => $sort_order,
    "ELEMENT_SORT_FIELD2" => $sort_field2,
    "ELEMENT_SORT_ORDER2" => $sort_order2,
    "SEF_FOLDER" => "/rest/",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "360000",
    "PAGE_ELEMENT_COUNT" => filter_input(INPUT_GET, "ELEMENTS_ON_PAGE", FILTER_VALIDATE_INT),
    "DEFAULT_H1" => "Входные двери",
    "FOR_PATH" => $forPath,
    "CACHE_FILTER" => "N",
    "SECTION_URL" => "/catalog-dverei/#SECTION_CODE#/",
    "DETAIL_URL" => "/catalog-dverei/stalnaya-liniya/#ELEMENT_CODE#.html"
        ), false
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");


