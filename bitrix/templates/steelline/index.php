<?$APPLICATION->IncludeComponent(

	"bitrix:catalog.section", 

	"slider", 

	array(

		"IBLOCK_TYPE" => "other",

		"IBLOCK_ID" => "6",

		"SECTION_ID" => "",

		"SECTION_CODE" => "",

		"SECTION_USER_FIELDS" => array(

			0 => "",

			1 => "",

		),

		"ELEMENT_SORT_FIELD" => "sort",

		"ELEMENT_SORT_ORDER" => "asc",

		"ELEMENT_SORT_FIELD2" => "sort",

		"ELEMENT_SORT_ORDER2" => "asc",

		"FILTER_NAME" => "arrFilter",

		"INCLUDE_SUBSECTIONS" => "Y",

		"SHOW_ALL_WO_SECTION" => "Y",

		"HIDE_NOT_AVAILABLE" => "N",

		"PAGE_ELEMENT_COUNT" => "30",

		"LINE_ELEMENT_COUNT" => "3",

		"PROPERTY_CODE" => array(

			0 => "URL",

			1 => "",

		),

		"OFFERS_LIMIT" => "5",

		"TEMPLATE_THEME" => "blue",

		"ADD_PICT_PROP" => "-",

		"LABEL_PROP" => "-",

		"PRODUCT_SUBSCRIPTION" => "N",

		"SHOW_DISCOUNT_PERCENT" => "N",

		"SHOW_OLD_PRICE" => "N",

		"SHOW_CLOSE_POPUP" => "N",

		"MESS_BTN_BUY" => "Купить",

		"MESS_BTN_ADD_TO_BASKET" => "В корзину",

		"MESS_BTN_SUBSCRIBE" => "Подписаться",

		"MESS_BTN_COMPARE" => "Сравнить",

		"MESS_BTN_DETAIL" => "Подробнее",

		"MESS_NOT_AVAILABLE" => "Нет в наличии",

		"SECTION_URL" => "",

		"DETAIL_URL" => "",

		"SECTION_ID_VARIABLE" => "SECTION_ID",

		"AJAX_MODE" => "N",

		"AJAX_OPTION_JUMP" => "N",

		"AJAX_OPTION_STYLE" => "Y",

		"AJAX_OPTION_HISTORY" => "N",

		"CACHE_TYPE" => "A",

		"CACHE_TIME" => "36000000",

		"CACHE_GROUPS" => "Y",

		"SET_TITLE" => "Y",

		"SET_BROWSER_TITLE" => "Y",

		"BROWSER_TITLE" => "-",

		"SET_META_KEYWORDS" => "Y",

		"META_KEYWORDS" => "-",

		"SET_META_DESCRIPTION" => "Y",

		"META_DESCRIPTION" => "-",

		"ADD_SECTIONS_CHAIN" => "N",

		"SET_STATUS_404" => "N",

		"CACHE_FILTER" => "N",

		"ACTION_VARIABLE" => "action",

		"PRODUCT_ID_VARIABLE" => "id",

		"PRICE_CODE" => array(

		),

		"USE_PRICE_COUNT" => "N",

		"SHOW_PRICE_COUNT" => "1",

		"PRICE_VAT_INCLUDE" => "Y",

		"CONVERT_CURRENCY" => "N",

		"BASKET_URL" => "/personal/basket.php",

		"USE_PRODUCT_QUANTITY" => "N",

		"ADD_PROPERTIES_TO_BASKET" => "Y",

		"PRODUCT_PROPS_VARIABLE" => "prop",

		"PARTIAL_PRODUCT_PROPERTIES" => "N",

		"PRODUCT_PROPERTIES" => array(

		),

		"ADD_TO_BASKET_ACTION" => "ADD",

		"DISPLAY_COMPARE" => "N",

		"PAGER_TEMPLATE" => ".default",

		"DISPLAY_TOP_PAGER" => "N",

		"DISPLAY_BOTTOM_PAGER" => "Y",

		"PAGER_TITLE" => "Товары",

		"PAGER_SHOW_ALWAYS" => "N",

		"PAGER_DESC_NUMBERING" => "N",

		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",

		"PAGER_SHOW_ALL" => "N",

		"AJAX_OPTION_ADDITIONAL" => "",

		"PRODUCT_QUANTITY_VARIABLE" => "quantity"

	),

	false

);?>
<?$APPLICATION->IncludeComponent(

	"bitrix:catalog.section", 

	"hits", 

	array(

		"IBLOCK_TYPE" => "catalog",

		"IBLOCK_ID" => "4",

		"SECTION_ID" => "",

		"SECTION_CODE" => "",

		"SECTION_USER_FIELDS" => array(

			0 => "",

			1 => "",

		),

		"ELEMENT_SORT_FIELD" => "PROPERTY_SPECIAL",

		"ELEMENT_SORT_ORDER" => "desc",

		"ELEMENT_SORT_FIELD2" => "id",

		"ELEMENT_SORT_ORDER2" => "desc",

		"FILTER_NAME" => "arrFilter",

		"INCLUDE_SUBSECTIONS" => "Y",

		"SHOW_ALL_WO_SECTION" => "Y",

		"HIDE_NOT_AVAILABLE" => "N",

		"PAGE_ELEMENT_COUNT" => "9",

		"LINE_ELEMENT_COUNT" => "3",

		"PROPERTY_CODE" => array(

			0 => "",

			1 => "URL",

			2 => "",

		),

		"OFFERS_LIMIT" => "5",

		"TEMPLATE_THEME" => "blue",

		"ADD_PICT_PROP" => "-",

		"LABEL_PROP" => "-",

		"PRODUCT_SUBSCRIPTION" => "N",

		"SHOW_DISCOUNT_PERCENT" => "N",

		"SHOW_OLD_PRICE" => "N",

		"SHOW_CLOSE_POPUP" => "N",

		"MESS_BTN_BUY" => "Купить",

		"MESS_BTN_ADD_TO_BASKET" => "В корзину",

		"MESS_BTN_SUBSCRIBE" => "Подписаться",

		"MESS_BTN_COMPARE" => "Сравнить",

		"MESS_BTN_DETAIL" => "Подробнее",

		"MESS_NOT_AVAILABLE" => "Нет в наличии",

		"SECTION_URL" => "",

		"DETAIL_URL" => "",

		"SECTION_ID_VARIABLE" => "SECTION_ID",

		"AJAX_MODE" => "N",

		"AJAX_OPTION_JUMP" => "N",

		"AJAX_OPTION_STYLE" => "Y",

		"AJAX_OPTION_HISTORY" => "N",

		"CACHE_TYPE" => "A",

		"CACHE_TIME" => "36000000",

		"CACHE_GROUPS" => "Y",

		"SET_TITLE" => "N",

		"SET_BROWSER_TITLE" => "N",

		"BROWSER_TITLE" => "-",

		"SET_META_KEYWORDS" => "Y",

		"META_KEYWORDS" => "-",

		"SET_META_DESCRIPTION" => "N",

		"META_DESCRIPTION" => "-",

		"ADD_SECTIONS_CHAIN" => "N",

		"SET_STATUS_404" => "N",

		"CACHE_FILTER" => "N",

		"ACTION_VARIABLE" => "action",

		"PRODUCT_ID_VARIABLE" => "id",

		"PRICE_CODE" => array(

			0 => "BASE",

		),

		"USE_PRICE_COUNT" => "N",

		"SHOW_PRICE_COUNT" => "1",

		"PRICE_VAT_INCLUDE" => "Y",

		"CONVERT_CURRENCY" => "N",

		"BASKET_URL" => "/cart/",

		"USE_PRODUCT_QUANTITY" => "N",

		"ADD_PROPERTIES_TO_BASKET" => "Y",

		"PRODUCT_PROPS_VARIABLE" => "prop",

		"PARTIAL_PRODUCT_PROPERTIES" => "N",

		"PRODUCT_PROPERTIES" => array(

		),

		"ADD_TO_BASKET_ACTION" => "ADD",

		"DISPLAY_COMPARE" => "N",

		"PAGER_TEMPLATE" => ".default",

		"DISPLAY_TOP_PAGER" => "N",

		"DISPLAY_BOTTOM_PAGER" => "Y",

		"PAGER_TITLE" => "Товары",

		"PAGER_SHOW_ALWAYS" => "N",

		"PAGER_DESC_NUMBERING" => "N",

		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",

		"PAGER_SHOW_ALL" => "N",

		"AJAX_OPTION_ADDITIONAL" => "",

		"PRODUCT_QUANTITY_VARIABLE" => "quantity"

	),

	false

);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template1", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"AREA_FILE_SHOW" => "file",	// Показывать включаемую область
		"PATH" => SITE_TEMPLATE_PATH."/index_include.php",	// Путь к файлу области
		"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>

  <?$APPLICATION->IncludeComponent(

	"bitrix:main.include",

	".default",

	Array(

		"AREA_FILE_SHOW" => "file",

		"PATH" => "/about_index.php",

		"EDIT_TEMPLATE" => ""

	)

);?>

<?/*$APPLICATION->IncludeComponent(

	"bitrix:main.include",

	".default",

	Array(

		"AREA_FILE_SHOW" => "file",

		"PATH" => SITE_TEMPLATE_PATH."/important_for_cost.php",

		"EDIT_TEMPLATE" => ""

	)

);*/?>

<?

global $arrFilter_uslugi;

$arrFilter_uslugi = array("PROPERTY_KLICKABLE_VALUE" => "Y");

$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"uslugi_index", 
	array(
		"IBLOCK_TYPE" => "Uslugi",
		"IBLOCK_ID" => "7",
		"NEWS_COUNT" => "6",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter_uslugi",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "KLICKABLE",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "/uslugi/#ELEMENT_CODE#.html",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "uslugi_index"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(

	"bitrix:news.list", 

	"stati_index", 

	array(

		"IBLOCK_TYPE" => "news",

		"IBLOCK_ID" => "1",

		"NEWS_COUNT" => "3",

		"SORT_BY1" => "ACTIVE_FROM",

		"SORT_ORDER1" => "DESC",

		"SORT_BY2" => "SORT",

		"SORT_ORDER2" => "ASC",

		"FILTER_NAME" => "",

		"FIELD_CODE" => array(

			0 => "",

			1 => "",

		),

		"PROPERTY_CODE" => array(

			0 => "TAGS",

			1 => "",

		),

		"CHECK_DATES" => "Y",

		"DETAIL_URL" => "/poleznaya-informaciya/#ELEMENT_CODE#.html",

		"AJAX_MODE" => "N",

		"AJAX_OPTION_JUMP" => "N",

		"AJAX_OPTION_STYLE" => "Y",

		"AJAX_OPTION_HISTORY" => "N",

		"CACHE_TYPE" => "A",

		"CACHE_TIME" => "36000000",

		"CACHE_FILTER" => "N",

		"CACHE_GROUPS" => "Y",

		"PREVIEW_TRUNCATE_LEN" => "",

		"ACTIVE_DATE_FORMAT" => "d.m.Y",

		"SET_TITLE" => "Y",

		"SET_BROWSER_TITLE" => "Y",

		"SET_META_KEYWORDS" => "Y",

		"SET_META_DESCRIPTION" => "Y",

		"SET_STATUS_404" => "N",

		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",

		"ADD_SECTIONS_CHAIN" => "Y",

		"HIDE_LINK_WHEN_NO_DETAIL" => "N",

		"PARENT_SECTION" => "",

		"PARENT_SECTION_CODE" => "",

		"INCLUDE_SUBSECTIONS" => "Y",

		"DISPLAY_DATE" => "Y",

		"DISPLAY_NAME" => "Y",

		"DISPLAY_PICTURE" => "Y",

		"DISPLAY_PREVIEW_TEXT" => "Y",

		"PAGER_TEMPLATE" => ".default",

		"DISPLAY_TOP_PAGER" => "N",

		"DISPLAY_BOTTOM_PAGER" => "Y",

		"PAGER_TITLE" => "Новости",

		"PAGER_SHOW_ALWAYS" => "N",

		"PAGER_DESC_NUMBERING" => "N",

		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",

		"PAGER_SHOW_ALL" => "N",

		"AJAX_OPTION_ADDITIONAL" => ""

	),

	false

);?>