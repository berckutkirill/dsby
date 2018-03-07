<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="air"></div>
<div class="action catalog">
	<div class="wrap clearfix">
		<div class="sidebar">
			<h2>Услуги салона</h2>
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include", 
				".default", 
				array(
					"COMPONENT_TEMPLATE" => ".default",
					"AREA_FILE_SHOW" => "file",
					"SIDEBAR_DOP" => $arResult["SIDEBAR_TO"],
					"PATH" => "/include/sidebar_dop.php",
					"EDIT_TEMPLATE" => "standard.php"
				),
				false
			);?>
		</div>
		<div class="content">
			<h1 class="title">Используйте код активации и получите скидку на дверь!</h1>
			<div class="img">
				<div class="ended"></div>
				<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>">
			</div>
			<div class="text">
				<h3>Весенняя акция на входные двери «Стальная линия» продлена!</h3>
				<p>Для владельцев акционного кода, полученного ранее, предоставлена возможность приобрести дверь со&nbsp;скидкой 5-10%. Акция действует с 22 по 27 марта 2016 года. Коды скидок не суммируются. Если вы забыли или потеряли ранее полученный код, то вы получите скидку на покупку двери, сообщив свой номер телефона менеджеру в салоне.</p>
			</div>
			<?if($arResult["ID"] == 773) { ?>
				<div class="gen_code clearfix">
					<div class="my-flex-container">
						<div class="info my-flex-block">
							<p class="fs14">Приобрести двери со скидкой можно в <span onclick="dataOpen();" class="blue_text" data-open="#mapPopup">магазинах «Стальная линия»</span> по адресам:</p>
							<p>г. Минск, пр. Дзержинского, 131</p>
							<p>г. Минск, ул. Кальварийская, 7Б-6 (ТЦ "Трюм")</p>
						</div>
						<div class="inf my-flex-block">
							<p>Уточнить информацию</p>
							<p>Вы можете по телефону</p>
							<span>+375 (44) 769-78-50</span>
						</div>
					</div>
				</div>
			<? } ?>
<?
global $filter;
if( $arResult["PROPERTIES"]["PRODS"]["VALUE"])
{

$arParams["ELEMENT_SORT_FIELD"] = "SORT";
$arParams["ELEMENT_SORT_ORDER"] = "ASC";
if(filter_input(INPUT_GET, "sort") == "price")
{
	$arParams["ELEMENT_SORT_FIELD"] = "PROPERTY_MINIMUM_PRICE";
	if(filter_input(INPUT_GET, "order") == "up")
	{
		$arParams["ELEMENT_SORT_ORDER"] = "ASC";
	}
	elseif(filter_input(INPUT_GET, "order") == "down")
	{
		$arParams["ELEMENT_SORT_ORDER"] = "DESC";
	}
	else
	{
		$arParams["ELEMENT_SORT_ORDER"] = "ASC";
	}
}

$filter = array("ID" => $arResult["PROPERTIES"]["PRODS"]["VALUE"]);
$APPLICATION->IncludeComponent("bitrix:catalog.section", "shares", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "4",	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"FILTER_NAME" => "filter",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"PAGE_ELEMENT_COUNT" => "22",	// Количество элементов на странице
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
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
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
		"DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
	),
	$component
);
}
?>
			<?if($arResult["ID"] == 773) { ?>
			<div class="clearfix"></div>
				<div class="gen_code clearfix">
					<div class="my-flex-container">
						<div class="info my-flex-block">
							<p class="fs14">Приобрести двери со скидкой можно в магазинах «Стальная линия» по адресам:</p>
							<p>г. Минск, пр. Дзержинского, 131</p>
							<p>г. Минск, ул. Кальварийская, 7Б-6 (ТЦ "Трюм")</p>
						</div>
						<div class="inf my-flex-block">
							<p>Уточнить информацию</p>
							<p>Вы можете по телефону</p>
							<span>+375 (44) 769-78-50</span>
						</div>
					</div>
				</div>
			<script>
				function dataOpen() {
					gaRequest("Открыл карту на акции");
					$(".mapPopup2").removeClass("mapPopup2");
				}
				$(function(){
					$(".fade2, close").on("click", function(){
						$(".mapPopup").addClass("mapPopup2");
					})
				})
				$(".get_code_form").on("submit", function(e){
					e.preventDefault();
					var this_form = $(this);
					gaRequest("Получить код");
					if(!this_form.find(".phone_value").val()) return false;
					$.ajax({
						url : $(this).attr("action"),
						data : {"phone" : this_form.find(".phone_value").val()},
						type : "post",
						success : function(res) {
							$(".action_code").text(res);
						}
					})
				})
			</script>
			<? } ?>
		</div>
	</div>
</div>
<? if($arResult["ID"] == 773) { ?>
<div class="popup mapPopup mapPopup2" id="mapPopup">
<?
global $arrFilter;
$arrFilter = array("ID" => array(616, 619));
$APPLICATION->IncludeComponent("bitrix:catalog.section", "map_detail", Array(
	"COMPONENT_TEMPLATE" => "map",
		"IBLOCK_TYPE" => "other",	// Тип инфоблока
		"IBLOCK_ID" => "17",	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "undefined",
			2 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "N",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"PAGE_ELEMENT_COUNT" => "300",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"PROPERTY_CODE" => array(	// Свойства
			0 => "ADRESS",
			1 => "WORK_TIME",
			2 => "ADRESS_IN_SELECT",
			3 => "COORDINATES",
			4 => "OBLOST",
			5 => "SITE",
			6 => "BALOON_CONTENT",
			7 => "PHONES",
			8 => "undefined",
			9 => "",
		),
		"OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
		"SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
		"SHOW_OLD_PRICE" => "N",	// Показывать старую цену
		"SHOW_CLOSE_POPUP" => "N",	// Показывать кнопку продолжения покупок во всплывающих окнах
		"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
		"MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
		"MESS_BTN_COMPARE" => "Сравнить",	// Текст кнопки "Сравнить"
		"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
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
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRICE_CODE" => "",	// Тип цены
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара
		"ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
		"DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		"LABEL_PROP" => "-",	// Свойство меток товара
	),
	false
);?>

</div>

<div class="fade2"><i class="close"></i></div>
<style>
.mapPopup2 {
    display: block !important;
    position: static;
    width: inherit;
    transform: translate(0,0);
	-moz-transform: translate(0,0);
    -ms-transform: translate(0,0);
    -webkit-transform: translate(0,0);
    -o-transform: translate(0,0);
}
</style>
<? } ?>