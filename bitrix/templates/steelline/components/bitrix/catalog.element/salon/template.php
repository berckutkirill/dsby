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
$this->setFrameMode(true);

?>
<div class="mgz_land <?=$arResult["CODE"]?>">
	<div class="wrap">
		<h1 class="title"><?=$arResult["NAME"]?></h1>
		<div class="intro">
			<h3>Адрес</h3>
			<?foreach($arResult["PROPERTIES"]["ADRESS"]["~VALUE"] as $val) { ?>
				<p><?=$val?></p>
			<? } ?>
			<h3>Режим работы</h3>
			<?foreach($arResult["PROPERTIES"]["WORK_TIME"]["VALUE"] as $val) { ?>
				<p><?=$val?></p>
			<? } ?>
			<h3>Телефоны</h3>
			<?foreach($arResult["PROPERTIES"]["PHONES"]["VALUE"] as $val) { ?>
				<p><?=$val?></p>
			<? } ?>
			<p class="arrow">Количество образцов в салоне</p>
			<button class="map_open">Посмотреть на карте</button>
			<span class="trigger"><i><?=$arResult["PROPERTIES"]["COUNT_MODELS"]["VALUE"]?></i><br>дверей</span>
		</div>
		<div id="map">
			<?=$arResult["PROPERTIES"]["MAP_SCRIPT"]["~VALUE"]?>
		</div>
		<div class="showcase clearfix">

			<div class="case c1 zoom"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["PHOTOS_ON_PAGE"]["VALUE"][0]);?>" alt=""></div>
			<div class="case c2"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["PHOTOS_ON_PAGE"]["VALUE"][1]);?>" alt=""></div>
			<div class="case c3 zoom"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["PHOTOS_ON_PAGE"]["VALUE"][2]);?>" alt=""></div>
			<div class="case c4">
				<img src="<?=CFile::GetPath($arResult["PROPERTIES"]["PHOTOS_ON_PAGE"]["VALUE"][3]);?>" alt="">
				<span class="shad"></span>
				<div class="text">
					<p>Образцы дверей из каталога,<br>представленные в салоне</p>
					<button class="trigger">Посмотреть</button>
				</div>
			</div>
			<div class="case c5 zoom"><img src="<?=CFile::GetPath($arResult["PROPERTIES"]["PHOTOS_ON_PAGE"]["VALUE"][4]);?>" alt=""></div>
		</div>
	</div>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"uslugi_land", 
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
			"COMPONENT_TEMPLATE" => "uslugi_land"
		),
		false
	);?>
	<div class="form">
		<div class="wrap">
			<h3>У Вас появились вопросы?</h3>
			<p>Закажите обратный звонок — наши менеджеры</p>
			<p>Вам обязательно перезвонят в рабочее время</p>
			<form action="/request/salon.php" method="post" class="clearfix validate">
                    <input type="hidden" name="my_address">
                    <input type="text" name="login" class="my_login">
				<input type="hidden" name="email" value="<?=$arResult["PROPERTIES"]["EMAIL_TO"]["VALUE"]?>">
				<input type="hidden" name="salon_id" value="<?=$arResult["ID"]?>">
				<input type="hidden" name="salon" value="<?=$arResult["NAME"]?>">
				<div class="input">
					<span>Ваш номер телефона</span>
					<input type="text" name="phone" class="must" data-valid="phone">
				</div>
				<div class="input">
					<span>Ваше имя</span>
					<input type="text" name="name" class="must">
				</div>
				<button type="submit">Отправить</button>
			</form>
		</div>
	</div>
	<div class="examples">
		<div class="wrap">
			<h3 class="title">Двери из каталога, которые представлены в салоне</h3>
			<!--form action="" class="filter clearfix">
				<input type="checkbox" value="" id="check1">
				<label for="check1">Все двери</label>
				<input type="checkbox" value="" id="check2">
				<label for="check2">Для дома</label>
				<input type="checkbox" value="" id="check3">
				<label for="check3">Для квартиры</label>
				<input type="checkbox" value="" id="check4">
				<label for="check4">Тёмные</label>
				<input type="checkbox" value="" id="check5">
				<label for="check5">Светлые</label>
			</form-->
<?
if($arResult["PROPERTIES"]["MODELS"]["VALUE"]) {
global $arrFilter;
$arrFilter = array("GLOBAL_ACTIVE"=>"Y", "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["MODELS"]["VALUE"]);

$APPLICATION->IncludeComponent("bitrix:catalog.section", "shops", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "22",	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "PROPERTY_SPECIAL",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Товары, не доступные для покупки
		"PAGE_ELEMENT_COUNT" => "1000",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "URL",
			2 => "",
		),
		"OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
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
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"BASKET_URL" => "/cart/",	// URL, ведущий на страницу с корзиной покупателя
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"COMPONENT_TEMPLATE" => "search",
		"OFFERS_FIELD_CODE" => array(	// Поля предложений
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(	// Свойства предложений
			0 => "DECOR_ARTICLE",
			1 => "DECOR_PHOTO_IN",
			2 => "CHARAKTER_DECOR_BASE_OUT",
			3 => "CHARAKTER_DECOR_BASE_IN",
			4 => "CHARAKTER_DECOR_THICKNESS_BASE_OUT",
			5 => "CHARAKTER_DECOR_THICKNESS_BASE_IN",
			6 => "CHARAKTER_DECOR_TECH_OUT",
			7 => "CHARAKTER_DECOR_TECH_IN",
			8 => "CHARAKTER_DECOR_COVER_OUT",
			9 => "CHARAKTER_DECOR_COVER_IN",
			10 => "CHARAKTER_DECOR_COLOR_OUT",
			11 => "CHARAKTER_DECOR_COLOR_IN",
			12 => "CHARAKTER_DECOR_OPTIONS_PAINTING_BOX_IN",
			13 => "CHARAKTER_DECOR_OPTIONS_PAINTING_BOX_OUT",
			14 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",	// По какому полю сортируем предложения товара
		"OFFERS_SORT_ORDER" => "asc",	// Порядок сортировки предложений товара
		"OFFERS_SORT_FIELD2" => "id",	// Поле для второй сортировки предложений товара
		"OFFERS_SORT_ORDER2" => "desc",	// Порядок второй сортировки предложений товара
		"BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
		"OFFERS_CART_PROPERTIES" => "",	// Свойства предложений, добавляемые в корзину
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
	),
	false
);
}
?>
			<div class="foot">
				<a href="/catalog-dverei/">Каталог дверей на сайте</a>
			</div>
		</div>
	</div>
	<script>
		$(function() {
			$('.map_open').click(function() {
				$('#map').toggleClass('show');
				$('#map').hasClass('show') ? $(this).text('Свернуть карту') : $(this).text('Посмотреть на карте');
				$('html, body').animate({ scrollTop: $(this).offset().top }, 500);
			});
			$('.trigger').click(function() {
				$('html, body').animate({ scrollTop: $('.examples').offset().top }, 1000);
			})
		})
	</script>
</div>