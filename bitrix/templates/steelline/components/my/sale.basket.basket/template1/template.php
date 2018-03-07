<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixBasketComponent $component */
$hblock = GetHBlock(8);

foreach($hblock as $eq)
{
	$PICCHAR[$eq["UF_XML_ID"]]["TEXT"] = $eq["UF_DESCRIPTION"];
	$PICCHAR[$eq["UF_XML_ID"]]["FILE"] = CFile::GetPath($eq["UF_FILE"]);
	$PICCHAR[$eq["UF_XML_ID"]]["NAME"] = $eq["UF_NAME"];
}

	$arBasketItems = $arResult["arBasketItems"];
	$sum = $arResult["sum"];
	$sum_discount = $arResult["sum_discount"];
	$obl_js = $arResult["obl_js"];
	$Basket = $arResult["Basket"];
?>

<script>


var items = <?php echo json_encode($obl_js);?>;

function transaction()
{
	var now = new Date();
	var idsFbq = [];
	ga('ec:setAction', 'purchase', {
	  'id': now,
	});

	for(var i in items) {
		idsFbq.push(items[i]['id']);
	}

	var _tmr = _tmr || [];
	_tmr.push({
		type: 'itemView',
		productid: idsFbq,
		pagetype: 'purchase',
		totalvalue: <?=$sum_discount?>,
		list: 1,
	});


	fbq('track', 'Purchase', {
		value:'<?=$sum_discount?>',
		currency:'RUB',
		content_ids:idsFbq,
		content_type:'product'
	});
	ga('send', 'event');
	return true;
}
</script>
		<h1 class="title">Бланк заказа входной двери</h1>
		<? if(empty($arResult)) { ?>
		<div class="step1 clearfix emptty">
			<h2>Шаг 1</h2>
			<p>Выберите входную дверь из каталога</p> <a href="/catalog-dverei">Выбрать дверь</a>
		</div>
		<? } else { ?>
		<div class="step1 clearfix">
			<h2>Шаг 1</h2>
			<div class="doors">
				<?php
				$first = true;
				foreach($arBasketItems as $arItem) {
					$PROPS = $Basket[$arItem["ID"]];
					foreach($arItem["PROPERTIES"] as $code => $val)
					{
						if(strpos($code,"CHARAKTER_") === 0)
						{
							if($val["VALUE"])
							{
								if($val["PROPERTY_TYPE"] == "S" || $val["PROPERTY_TYPE"] == "L")
								{
									$TTH[$code]["TEXT"] = $val["VALUE"];
									$TTH[$code]["NAME"] = $val["NAME"];
								}
								elseif($val["PROPERTY_TYPE"] == "F")
								{

									$TTH[$code]["TEXT"] = $val["DESCRIPTION"];
									$TTH[$code]["NAME"] = $val["NAME"];
								}
							}

						}
						elseif(strpos($code,"DOPCHARAKTER_") === 0)
						{
							if($val["VALUE"])
							{
								$TTH[$code]["TEXT"] = $val["VALUE"];
								$TTH[$code]["NAME"] = $val["NAME"];
							}
						}
					}
				?>
				<div class="door clearfix"  data-id="<?php echo $PROPS["ID"]?>">
					<div class="imgs clearfix">
						<div class="img">
							<div class="eye">
							<img src="<?=$arItem["DETAIL_PICTURE"]?>" alt="<?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?>">
							</div>
							<span>Снаружи</span>
						</div>
						<div class="img">
							<div class="eye">
							<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["VIEW_OUTSIDE_DETAIL"]["VALUE"])?>" alt="<?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?>">
							</div>
							<span>Внутри</span>
						</div>
					</div>
					<div class="params">
						<h3 class="name"><?php echo $arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?> <?php echo $arItem["PROPERTIES"]["NAME_EN"]["VALUE"]?></h3>
						<div class="price">
								<span class="curr js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
									<?php echo toPrice($PROPS["DISCOUNT_PRICE"])?> руб.</span>
								</span>
							<?if($PROPS["PRICE"] > $PROPS["DISCOUNT_PRICE"]) { ?>
								<span class="old js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
									<?php echo toPrice($PROPS["PRICE"])?> руб.</span>
								</span>
							<? } ?>
						</div>

						<?if($arItem["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) { ?>
							<p class="deliv">Установка в течение 24 часов</p>
						<? }  else { ?>
							<p class="deliv">Доставка в течение <?=$arItem["PROPERTIES"]["DELIVERY_TIME"]["VALUE"]?></p>
						<? } ?>
						<div class="prop">
							<span>Снаружи</span>
							<p><?php echo $arItem["SOSTAV_TTH"]["OTDELKA_SNARUZHI"]["TEXT"] ?></p>
						</div>
						<div class="prop">
							<span>Внутри</span>
							<p><?php echo $arItem["SOSTAV_TTH"]["OTDELKA_VNUTRI"]["TEXT"] ?></p>
						</div>
						<div class="quant_wrap clearfix">
							<span class="q_name">Количество</span>
							<div class="quantity">
								<span id="minus_<?php echo $PROPS["ID"]?>" class="minus">-</span>
								<input data-id="<?php echo $PROPS["ID"]?>"  class="quantity_input" id="quantity_<?php echo $PROPS["ID"]?>" value="<?php echo intVal($PROPS["QUANTITY"])?>" disabled>
								<span id="plus_<?php echo $PROPS["ID"]?>" class="plus">+</span>
							</div>
						</div>
						<span class="tech" data-open=".tech_popup">Технические характеристики</span>
						<a href="/catalog-dverei" class="add_door" title="добавить дверь"></a>
						<span class="delete delete_from_cart" title="удалить дверь"></span>
					</div>
					<div class="tech_popup popup">
						<i class="close"></i>
						<h4>Технические характеристики</h4>
						<table>
							<tbody>
							<?php
							foreach($TTH as $tth) { ?>
									<tr>
										<td><?php echo $tth["NAME"]?> </td>
										<td><?php echo $tth["TEXT"]?></td>
									</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="info">
				<p><b>Гарантия на дверь 24 месяца</b></p>
				<p class="mg">Гарантийное обслуживание дверей «Стальная линия» осуществляется в течение 24 месяцев <br>со дня покупки, если все замеры и монтаж были выполнены сотрудниками нашей компании. </p>
				<p><b>Замер проема двери —</b> <b><i>бесплатно</i></b></p>
				<p> — В соответствии с характеристиками старой двери, определяется стоимость демонтажа.</p>
				<p> — Происходит расчет стоимости доставки. Специалист по монтажу и установке определит фактический размер проёма.</p>
				<p>— Стоимость монтажа двери зависит от вида выбранной модели.</p>
			</div>
			<div class="popup_img popup open">
				<i class="close">x</i>
				<img src="" alt="">
			</div>
			<script>
				$(function() {
					$('.door .eye').click(function() {
						$('.popup_img img').attr('src',$(this).find('img').attr('src'));
						$('.popup_img, .fade').fadeIn(150);
					});
					
					var popup = new Popup();
				})
			</script>
		</div>
		<? } ?>
		<div class="step2 clearfix">
			<h2>Шаг 2</h2>

			<form onsubmit="transaction();" action="/cart/order/" method="post" class="form validate">
				<h3>форма заказа</h3>
				<p>Общая сумма</p>
				
				<span class="price_all js_price_gen">
						<b class="new_rub"><i class="js_denomination_price"></i> руб.</b><br>
						<b class="old_rub js_old_denomination_price" id="price_all"><?php echo toPrice($sum_discount)?> руб.</b>
				</span>
				<span>Cалон для заключения договора</span>
				<select name="salon_id" id="saloons" class="salon_select err">
					<option value="">-- Выберите салон --</option>
				</select>
				<span>Имя</span>
				<input type="text" name="name" class="must">
				<span>Телефон</span>
				<input type="text" name="phone" class="must">
				<span>Комментарий</span>
				<textarea name="comment"></textarea>
				<button type="submit">Отправить заказ</button>
			</form>
			<div class="map_right">
<?
$IDS = explode(",", SALOONS);
global $arrFilter;
$arrFilter = array("ID" => $IDS);
$APPLICATION->IncludeComponent("bitrix:catalog.section", "map_blank_new", Array(
	"COMPONENT_TEMPLATE" => "map",
		"IBLOCK_TYPE" => "other",	// Тип инфоблока
		"IBLOCK_ID" => "17",	// Инфоблок
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "undefined",
			2 => "",
		),
		"ELEMENT_SORT_FIELD" => "PROPERTY_COUNT_MODELS",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "PROPERTY_COUNT_MODELS",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
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
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
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
		"DISPLAY_COMPARE" => "N",
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
</div>
<div class="fade2"><i class="close"></i></div>
<style>
	.blank_zakaza{
		display:none !important;
	} 
</style>