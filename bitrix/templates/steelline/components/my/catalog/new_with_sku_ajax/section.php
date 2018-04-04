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

	if($arResult["VARIABLES"]["SECTION_CODE"]) {
		$APPLICATION->IncludeComponent("my:catalog.chain", "", Array(
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"SET_TITLE" => "Y",
			"SET_BROWSER_TITLE" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_META_DESCRIPTION" => "Y"
			),
			$component
		);
	}
?>

		<?
		$APPLICATION->IncludeComponent(
			"rest:catalog.section", "new_with_sku_not_rest", array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "22",
			"SEF_MODE" => "Y",
			"NO_TPL" => true,
			"ELEMENT_SORT_FIELD" => "shows",
			"ELEMENT_SORT_ORDER" => "DESC",
			"ELEMENT_SORT_FIELD2" => "shows",
			"ELEMENT_SORT_ORDER2" => "DESC",
			"SEF_FOLDER" => "/rest/",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "360000",
			"PAGE_ELEMENT_COUNT" => 12,
			"DEFAULT_H1" => "Входные двери",
			"FOR_PATH" => $_SERVER['REQUEST_URI'],
			"CACHE_FILTER" => "N",
			"SECTION_URL" => "/catalog-dverei/#SECTION_CODE#/",
			"DETAIL_URL" => "/catalog-dverei/stalnaya-liniya/#ELEMENT_CODE#.html"
			), false
		);?>

<?
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
<script>
		$(document).on("click",".disabled, .no_link",function(event) {
			event.preventDefault();
			return false;
		})
		/*SORT*/
		$(".catalog_main_header_sort_title").on("click", function(event) {
			event.stopPropagation();
			if(!$(".catalog_main_header_sort_list").hasClass("open")){
				$(".catalog_main_header_sort_list").addClass("open");
			} else {
				$(".catalog_main_header_sort_list").removeClass("open");
			}
		});
		$("body").on("click", function() {
			if($(".catalog_main_header_sort_list").hasClass("open")){
				$(".catalog_main_header_sort_list").removeClass("open");
			}
		});
		$(".catalog_main_header_sort_listitem").on("click", function(event) {
			event.stopPropagation();
			if(!$(this).hasClass("selected")){
				$(this).siblings().removeClass("selected");
				$(this).addClass("selected");
				$(".catalog_main_header_sort_type").text($(this).text());
				$(".catalog_main_header_sort_list").removeClass("open");
				if($(this).attr("data-selection") == "shows") {
					dataSorfAndFilter.SORT_FIELD = $(this).attr("data-selection");
					dataSorfAndFilter.SORT_ORDER = "DESC";
				} else {
					dataSorfAndFilter.SORT_ORDER = $(this).attr("data-selection");
					dataSorfAndFilter.SORT_FIELD = "PROPERTY_MINIMUM_PRICE";
				}
				doubleDoorsArr.current_position = 0;
				renderPage(1, false, dataSorfAndFilter);

			}
			
		})
		/*FIXED SIDEBAR*/
		var sidebar__position = $('.catalog_sidebar').offset().top - parseInt($('.catalog_sidebar').css('margin-top'));
		$(window).scroll(function() {
			if($(document).scrollTop()>sidebar__position){
				$(".catalog_sidebar_wrap").addClass("fixed");
			} else {
				$(".catalog_sidebar_wrap").removeClass("fixed");
			}
		});
		// $(window).scroll(function() {
		// 	if($(document).scrollTop()>700){
		// 		$(".catalog_sidebar_arrow").addClass("show");
		// 	} else {
		// 		$(".catalog_sidebar_arrow").removeClass("show");
		// 	}
		// });
		$(".catalog_sidebar_arrow").on("click", function() {
			$('html,body').animate({
            	scrollTop: 0
       		}, 700);
		});

		/*CHAT FACTOID*/
		$(document).ready(function() {
			$(document).on("click", ".factoid_16 a", function(e) {
				e.preventDefault();
				$('.b24-widget-button-wrapper').addClass('b24-widget-button-bottom b24-widget-button-disable');
				$('[data-b24-crm-button-widget="openline_livechat"]').find('.b24-widget-button-social-tooltip').trigger("click");
				$('.bx-imopenlines-config-sidebar').css('z-index', '10160');
			})
		});

	</script>