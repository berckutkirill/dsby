<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
?>
<div class="catalog_wrap justified_container">
<?
$APPLICATION->IncludeComponent("bitrix:menu", "sidebar_multi_ajax", Array(
	"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"COMPONENT_TEMPLATE" => "sidebar_multi"
	),
	$component
);

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
}
else
{
	$basketAction = (isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '');
}
$intSectionID = 0;
?><?

if($_GET["sort"] == "price")
{
	$arParams["ELEMENT_SORT_FIELD"] = "PROPERTY_MINIMUM_PRICE";
	$arParams["~ELEMENT_SORT_FIELD"] = "PROPERTY_MINIMUM_PRICE";
	$arParams["ELEMENT_SORT_FIELD2"] = "shows";
	$arParams["~ELEMENT_SORT_FIELD2"] = "asc";
	if($_GET["order"] == "up")
	{
		$arParams["ELEMENT_SORT_ORDER"] = "ASC";
	}
	elseif($_GET["order"] == "down")
	{
		$arParams["ELEMENT_SORT_ORDER"] = "DESC";
	}
	else
	{
		$arParams["ELEMENT_SORT_ORDER"] = "ASC";
	}
	$arParams["ELEMENT_SORT_ORDER2"] = $arParams["ELEMENT_SORT_ORDER"];
}


if($_GET["filter"]["IN_STOCK"] == "Y") {
	$GLOBALS['arrFilter']['PROPERTY_DESTINATION_ICON'][] = 1415;
}
if($_GET["filter"]["ON_SHARE"] == "Y") {
	$GLOBALS['arrFilter']['PROPERTY_DESTINATION_ICON'][] = 1417;
}
if($_GET["filter"]["NEW"] == "Y") {
	$GLOBALS['arrFilter']['PROPERTY_DESTINATION_ICON'][] = 1510;
}
if($_GET["filter"]["HIT"] == "Y") {
	$GLOBALS['arrFilter']['PROPERTY_DESTINATION_ICON'][] = 1416;
}
if(!V_KATEGORII_VNALICHII) {
	$GLOBALS['arrFilter']["!PROPERTY_IN_STOCK"] = 1474;
}

$intSectionID = $APPLICATION->IncludeComponent(
	"rest:catalog.section", "new_with_sku_yandex",
	array(
		 "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SEF_MODE" => "Y",
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"DEFAULT_H1" => "Каталог входных дверей",
		"FOR_PATH" => $arResult["VARIABLES"]["SECTION_CODE"],
		"CACHE_FILTER" => "N",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"]
	),
	$component
);
$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
unset($basketAction);
if (ModuleManager::isModuleInstalled("sale"))
{
	$arRecomData = array();
	$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
	{
		$arRecomData = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		if (Loader::includeModule("catalog"))
		{
			$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
			$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
		}
		$obCache->EndDataCache($arRecomData);
	}
	if (!empty($arRecomData))
	{
		if (!isset($arParams['USE_SALE_BESTSELLERS']) || $arParams['USE_SALE_BESTSELLERS'] != 'N')
		{
			?><?$APPLICATION->IncludeComponent("bitrix:sale.bestsellers", "", array(
				"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
				"PAGE_ELEMENT_COUNT" => "5",
				"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
				"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
				"SHOW_NAME" => "Y",
				"SHOW_IMAGE" => "Y",
				"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
				"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
				"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
				"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
				"LINE_ELEMENT_COUNT" => 5,
				"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"BY" => array(
					0 => "AMOUNT",
				),
				"PERIOD" => array(
					0 => "15",
				),
				"FILTER" => array(
					0 => "CANCELED",
					1 => "ALLOW_DELIVERY",
					2 => "PAYED",
					3 => "DEDUCTED",
					4 => "N",
					5 => "P",
					6 => "F",
				),
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"ORDER_FILTER_NAME" => "arOrderFilter",
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action")."_slb",
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"SHOW_PRODUCTS_".$arParams["IBLOCK_ID"] => "Y",
				"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
				"ADDITIONAL_PICT_PROP_".$arParams['IBLOCK_ID'] => $arParams['ADD_PICT_PROP'],
				"ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP']
			),
			$component,
			array("HIDE_ICONS" => "Y")
			);
		}
		if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
		{
			?><?$APPLICATION->IncludeComponent("bitrix:catalog.bigdata.products", "", array(
				"LINE_ELEMENT_COUNT" => 5,
				"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action")."_cbdp",
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
				"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"SHOW_NAME" => "Y",
				"SHOW_IMAGE" => "Y",
				"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
				"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
				"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
				"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
				"PAGE_ELEMENT_COUNT" => 5,
				"SHOW_FROM_SECTION" => "Y",
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"DEPTH" => "2",
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SHOW_PRODUCTS_".$arParams["IBLOCK_ID"] => "Y",
				"ADDITIONAL_PICT_PROP_".$arParams["IBLOCK_ID"] => $arParams['ADD_PICT_PROP'],
				"LABEL_PROP_".$arParams["IBLOCK_ID"] => "-",
				"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				"SECTION_ID" => $intSectionID,
				"SECTION_CODE" => "",
				"SECTION_ELEMENT_ID" => "",
				"SECTION_ELEMENT_CODE" => "",
				"PROPERTY_CODE_".$arParams["IBLOCK_ID"] => $arParams["LIST_PROPERTY_CODE"],
				"CART_PROPERTIES_".$arParams["IBLOCK_ID"] => $arParams["PRODUCT_PROPERTIES"],
				"RCM_TYPE" => (isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : ''),
				"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
				"ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP']
			),
			$component,
			array("HIDE_ICONS" => "Y")
			);
		}
	}
}
?>

</div>