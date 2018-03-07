<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$FURNISH_INSIDE = CFile::GetPath($arResult["PROPERTIES"]["VIEW_INSIDE"]["VALUE"]);
$FURNISH_OUTSIDE = CFile::GetPath($arResult["PROPERTIES"]["VIEW_OUTSIDE"]["VALUE"]);
$DETAIL_2 = CFile::GetPath($arResult["PROPERTIES"]["VIEW_OUTSIDE_DETAIL"]["VALUE"]);

$hblock = GetHBlock(3);
foreach($hblock as $eq)
{
	$BASIC[$eq["UF_XML_ID"]] = $eq;
	$BASIC[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

$hblock = GetHBlock(6);
foreach($hblock as $eq)
{
	$VARIANTS[$eq["UF_XML_ID"]] = $eq;
	$VARIANTS[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
	$VARIANTS[$eq["UF_XML_ID"]]["UF_DOBOR_SRC"] = CFile::GetPath($eq["UF_DOBOR"]);
}

$SNAR = $VARIANTS[$arResult["PROPERTIES"]["FURNISH_OUTSIDE"]["VALUE"]];
$VNUTR = $VARIANTS[$arResult["PROPERTIES"]["FURNISH_INSIDE"]["VALUE"]];

$hblock = GetHBlock(4);
foreach($hblock as $eq)
{
	$NAD_KARTOI[$eq["UF_XML_ID"]] = $eq;
	$NAD_KARTOI[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

$hblock = GetHBlock(8);
foreach($hblock as $eq)
{
	$PICCHAR[$eq["UF_XML_ID"]] = $eq;
	$PICCHAR[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

foreach($PICCHAR as $code => $file)
{
	$FILE_TTH[$code]["FILE"] = $file["FILE_SRC"];
	$FILE_TTH[$code]["TEXT"] = $file["UF_DESCRIPTION"];
	$FILE_TTH[$code]["NAME"] = $file["UF_NAME"];
	$FILE_TTH[$code]["TOOLTIP"] = $file["UF_TOOLTIP"];
}

foreach($arResult["PROPERTIES"] as $code => $val)
{
	if(strpos($code,"CHARAKTER_") === 0)
	{
		if($val["VALUE"])
		{
			if($val["PROPERTY_TYPE"] == "S")
			{
				$TEXT_TTH[$code]["TEXT"] = $val["VALUE"];
				$TEXT_TTH[$code]["TOOLTIP"] = $val["HINT"];
				$TEXT_TTH[$code]["NAME"] = $val["NAME"];
			}
			elseif($val["PROPERTY_TYPE"] == "F")
			{
				$FILE_TTH[$code]["FILE"] = CFile::GetPath($val["VALUE"]);
				$FILE_TTH[$code]["TEXT"] = $val["DESCRIPTION"];
			
				$FILE_TTH[$code]["TOOLTIP"] = $arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]?$arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]:$val["HINT"];
				$FILE_TTH[$code]["NAME"] = $val["NAME"];
			}
		}

	}
	elseif(strpos($code,"DOPCHARAKTER_") === 0)
	{
		if($val["VALUE"])
		{
			if($code == "DOPCHARAKTER_FURNISH_OUTSIDE")
			{
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["FILE"] = $SNAR["FILE_SRC"];
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["TOOLTIP"] = $SNAR["UF_TOOLTIP"];
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["TEXT"] = $val["VALUE"];
				$FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["NAME"] = $val["NAME"];
			}
			elseif($code == "DOPCHARAKTER_FURNISH_INSIDE")
			{
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["FILE"] = $VNUTR["FILE_SRC"];
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["TOOLTIP"] = $VNUTR["UF_TOOLTIP"];
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["TEXT"] = $val["VALUE"];
				$FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["NAME"] = $val["NAME"];
			}
		}
	}
}
if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y")
{
	$FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH."/img/dvupolnaya.png";
	$FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]?$arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]:"Левое или правое";
	$FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
	$FILE_TTH["STORONA"]["NAME"] = "Направление открытия";
}
else
{
	$FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH."/img/odnopolnaya.png";
	$FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]?$arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]:"Левое или правое";
	$FILE_TTH["STORONA"]["NAME"] = "Направление открытия";
	$FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
}
$hblock = GetHBlock(7);
foreach($hblock as $eq)
{
	$NAME_FURNISH[$eq["UF_XML_ID"]]["NAME"] = $eq["UF_NAME"];
	$NAME_FURNISH[$eq["UF_XML_ID"]]["PRICE"] = intVal($eq["UF_DESCRIPTION"]);
}
?>
<script type="text/javascript">
var google_tag_params = {
ecomm_prodid: <?=$arResult["ID"]?>
};
ga('ec:addProduct', {
  'id': '<?=$arResult["ID"]?>',
  'name': '<?=$arResult["NAME"]?>'
});
ga('ec:setAction', 'detail');
ga('send', 'event');
</script>
<div class="item">
			<div class="wrap">
				<div class="top clearfix">
					<div class="left">
						<h1><?=$arResult["NAME"]?></h1>
						
						<div class="galery">
							<div class="ls">
								<h5>Вид снаружи</h5>
								<p class="img big"><img src="<?=$FURNISH_OUTSIDE?>" alt="<?=$arResult["NAME"]?>" data-src="<?=$FURNISH_OUTSIDE?>"></p>
							</div>
							<div class="mid">
								<div class="prop">
									<span <?=in_array(3, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
									<span <?=in_array(2, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
									<span <?=in_array(1, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
								</div>
								<p class="img big"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"></p>
								<p class="img big"><img src="<?=$DETAIL_2?>" alt="<?=$arResult["NAME"]?>" data-src="<?=$DETAIL_2?>"></p>
							</div>
							<div class="rs">
								<h5>Вид внутри</h5>
								<p class="img big"><img src="<?=$FURNISH_INSIDE?>" alt="<?=$arResult["NAME"]?>" data-src="<?=$FURNISH_INSIDE?>"></p>
							</div>
							<div class="popup_img">
								<i class="close">x</i>
								<b class="prev"></b>
								<b class="next"></b>
								<img src="" alt="">
							</div>
							<script>
						$(function(){
							var opt = [
								'.galery',// main block
								'.contr li',// wrappers mini pictures
								'.big',// wrapper big picture
								'.popup_img',//wrapper popup window
								'.prev',// previous button in popup
								'.next',// next button in popup
								'.close',// close button in popup
								'.fade',// fade layer
								'.curr img',// selected mini picture
								'data-src',// data-attribute with src big pictures
							]
							var galery = new Galery(opt);
						});
						</script>
						</div>
						<div class="text">
							<h3>Описание</h3>
							<?=$arResult["~DETAIL_TEXT"]?>
						</div>
					</div>
					<div class="right">
					<?if($arResult["PROPERTIES"]["MODEL_IN"]["VALUE_XML_ID"] == 1) {?>
						<p class="salon">Модель представлена в салоне</p>
						<? } ?>
						<div class="clearfix">
							<?if($arResult["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) {?>
							<div class="status">
								<h4>На складе в Минске</h4>
								<div class="bottom">
									<p>Установка в течение</p>
									<span>24 часов</span>
								</div>
							</div>
							<? }  else { ?>
							<div class="status no">
								<h4>Под заказ</h4>
								<div class="bottom">
									<p>Доставка</p>
									<span><?=$arResult["PROPERTIES"]["DELIVERY_TIME"]["VALUE"]?></span>
								</div>
							</div>
							<? }
							if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class = "sale";
							?>
							<div class="base <?=$class?>">
								<p>Цена базовой комплектации</p>
								<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
								<span class="price_old"><?=toPrice($arResult["MIN_PRICE"]["VALUE"]);?> Br</span>
								<? } ?>
								<span class="price"><?=toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]);?> Br</span>
							</div>
						</div>
						<h3>Базовая комплектация</h3>
						<ul class="props clearfix">
							<?foreach($arResult["PROPERTIES"]["BASE_EQUIPMENT"]["VALUE"] as $id):?>
							<li>
								<img src="<?=$BASIC[$id]["FILE_SRC"]?>" alt="<?=$BASIC[$id]["UF_NAME"]?>">
								<p class="tip"><?=$BASIC[$id]["UF_NAME"]?></p>
							</li>
							<?endforeach;?>
						</ul>
						<h3>Отделка </h3>
						<div class="clearfix">
							<div class="color">
								<div class="inner">
									<p class="border">Снаружи</p>
									<p><?=$SNAR["UF_FULL_DESCRIPTION"]?></p>
								</div>
								<img src="<?=$SNAR["FILE_SRC"]?>" alt="Снаружи">
							</div>
							<div class="color">
								<div class="inner">
									<p class="border">Внутри</p>
									<p><?=$VNUTR["UF_FULL_DESCRIPTION"]?></p>
								</div>
								<img src="<?=$VNUTR["FILE_SRC"]?>" alt="Внутри">
							</div>
						</div>

						<div class="more clearfix">
							<div class="text_param clearfix">
								<h3>Размер</h3>
								<div class="float border">
									<h5>Высота:</h5>
									<p class="hw"><?=$arResult["PROPERTIES"]["HEIGHT_RIGHT"]["VALUE"]?></p>
									<h5>Ширина:</h5>
									<p class="hw"><?=$arResult["PROPERTIES"]["WEIGHT_RIGHT"]["VALUE"]?></p>
								</div>
								<div class="float">
									<p>Стандартная площадь коробки: <b>до 206 дм<sup>2</sup></b></p>
									<p>Доплата за каждые <br><b>1 дм<sup>2</sup> – от 38 000 Br</b></p>
								</div>
							</div>
							<ul class="icons clearfix">
								<?foreach($NAD_KARTOI as $item){?>
								<li>
									<img src="<?=$item["FILE_SRC"]?>" alt="<?=$item["UF_NAME"]?>">
									<p class="tip"><?=$item["UF_NAME"]?></p>
								</li>
								<? } ?>
							</ul>
							<div class="right_prop">
								<div class="set_price">
									<p>Стоимость<br>установки от</p>
									<span><?=toPrice($arResult["PROPERTIES"]["COST_INSTALL"]["VALUE"])?> Br</span>
								</div>
								<a onclick="addToCart('<?=$arResult["ID"]?>','<?=$arResult["NAME"]?>','<?=$arResult["BUY_URL"]?>'); return !ga.loaded;" href="<?=$arResult["BUY_URL"]?>">Заказать дверь</a>
							</div>
							<div class="free">Бесплатный<br>замер</div>
						</div>
						<h3>Остались вопросы? Звоните</h3>
						<span class="vel"><?=VEL_CODE?> <?=VEL_PHONE?></span>
						<span class="mts"><?=MTS_CODE?> <?=MTS_PHONE?></span>
					</div>
				</div>
				<div class="fix_area">
					<div class="wrap">
						<div class="img">
							<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>">
							<img src="<?=$DETAIL_2?>" alt="<?=$arResult["NAME"]?>">
						</div>
						<p class="name"><?=$arResult["NAME"]?></p>
						<div class="prop">
							<span <?=in_array(3, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
							<span <?=in_array(2, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
							<span <?=in_array(1, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
						</div>
						<div class="status">
						
						
						
							<?if($arResult["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) { ?>
								<span >На складе в Минске</span>
							<? } else { ?>
								<span class="not">На складе в Минске</span>
							<? } ?>
							<?if($arResult["PROPERTIES"]["MODEL_IN"]["VALUE_XML_ID"] == 1) {?>
								<span>Модель в салоне</span>
							<? } else { ?>
								<span  class="not">Модель в салоне</span>
							<? } ?>
						</div>
						<a  class="zakaz" onclick="addToCart('<?=$arResult["ID"]?>','<?=$arResult["NAME"]?>','<?=$arResult["BUY_URL"]?>'); return !ga.loaded;" href="<?=$arResult["BUY_URL"]?>">Заказать дверь</a>
						<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class2 = "sale";?>
						<div class="cost <?=$class2?>">
							<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
							<span class="price_old"><?=toPrice($arResult["MIN_PRICE"]["VALUE"]);?> Br</span>
							<? } ?>
							<span class="price"><?=toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]);?> Br</span>
						</div>
						
					</div>
				</div>
				<script>
					$(function() {
						var top = $(document).scrollTop(),
							fix = $('.fix_area'),
							point = $('.item .tech').offset().top;
						top >= point ? fix.fadeIn(150):fix.fadeOut(150);
						$(document).scroll(function() {
							top = $(document).scrollTop();
							top >= point ? fix.fadeIn(150):fix.fadeOut(150);
						})
					})
				</script>
				<div class="tech clearfix">
					<div class="left">
						<h3>Технические характеристики</h3>
						<table>
							<?foreach($FILE_TTH as $code => $TTH){?>
							<tr class="tab" data-tab="<?=$code?>">
								<td><?=$TTH["NAME"]; ?></td>
								<td><?=$TTH["TEXT"]; if($TTH["TOOLTIP"]){ echo "<i class='inf'><span class='tooltip'>".$TTH["TOOLTIP"]."</span></i>";}?></td>
							</tr>
							<? } ?>
							<?foreach($TEXT_TTH as $code => $TTH){?>
							<tr>
								<td><?=$TTH["NAME"]?></td>
								<td><?=$TTH["TEXT"]; if($TTH["TOOLTIP"]){ echo "<i class='inf'><span class='tooltip'>".$TTH["TOOLTIP"]."</span></i>";}?></td>
							</tr>
							<? } ?>
						</table>
					</div>
					<div class="right">
						<h3>В базовую комплектацию входят</h3>
						<ul class="tabs clearfix">
							<?foreach($FILE_TTH as $code => $TTH){?>
								<li data-tab="<?=$code?>" class="<?=$code?>">
									<p class="img"><img src="<?=$TTH["FILE"]?>" alt="<?=$TTH["NAME"]?>"></p>
									<span><?=$TTH["NAME"]?></span>
								</li>
							<? } ?>
						</ul>
					</div>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					".default",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/important_for_cost.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
				<script>
							$(function() {
								$('.main_foto button').on('click',function() {
									var src = $(this).attr('data-src');
									$(this).closest('.main_foto').find('button').removeClass('active');
									$(this).addClass('active');
									$(this).closest('.main_foto').find('img').attr('src',src);
								})
							})
						</script>
				<div class="otdelka clearfix">
					<h3>Варианты отделки</h3>
					<div class="main_foto">
						<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>">
						<div class="button clearfix">
							<button class="active in" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">Снаружи</button>
							<button class="out" data-src="<?=$DETAIL_2?>">Внутри</button>
						</div>
					</div>
						<div class="right">
						<div class="line">
							<h4>Отделка снаружи: <?=$NAME_FURNISH[$arResult["PROPERTIES"]["FURNISH_NAME_1"]["VALUE"]]["NAME"]?></h4>
							<?if($arResult["PROPERTIES"]["FURNISH_ICONS_1"]["VALUE"]){?>
							<ul class="icons">
								<?foreach($arResult["PROPERTIES"]["FURNISH_ICONS_1"]["VALUE"] as $id){?>
									<li><img src="<?=$BASIC[$id]["FILE_SRC"]?>" alt="<?=$BASIC[$id]["UF_NAME"]?>"></li>
								<? } ?>
							</ul>
							<? } 
							$i = 0;
							?>
							<ul class="colors clearfix c_<?=count($arResult["PROPERTIES"]["FURNISH_COLOR_1"]["VALUE"])?>">
								<?foreach($arResult["PROPERTIES"]["FURNISH_COLOR_1"]["VALUE"] as $id){
									$base = $i?"":"base";
									$i++;
								?>
									<li>
										<span><?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?></span>
										<p class="<?=$base?> img"><img src="<?=$VARIANTS[$id]["FILE_SRC"]?>" alt="<?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?>"></p>
									</li>
								<? } ?>
							</ul>
						</div>
						
						<div class="line">
							<h4>Отделка внутри: <?=$NAME_FURNISH[$arResult["PROPERTIES"]["FURNISH_NAME_2"]["VALUE"]]["NAME"]?></h4>
							<?if($arResult["PROPERTIES"]["FURNISH_ICONS_2"]["VALUE"]){?>
							<ul class="icons">
								<?foreach($arResult["PROPERTIES"]["FURNISH_ICONS_2"]["VALUE"] as $id){?>
									<li><img src="<?=$BASIC[$id]["FILE_SRC"]?>" alt="<?=$BASIC[$id]["UF_NAME"]?>"></li>
								<? } ?>
							</ul>
							<? } 
							$i = 0;?>
							<ul class="colors clearfix c_<?=count($arResult["PROPERTIES"]["FURNISH_COLOR_2"]["VALUE"])?>">
								<?foreach($arResult["PROPERTIES"]["FURNISH_COLOR_2"]["VALUE"] as $id){
									$base = $i?"":"base";
									$i++;
								?>
									<li>
										<span><?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?></span>
										<p class="<?=$base?> img"><img src="<?=$VARIANTS[$id]["FILE_SRC"]?>" alt="<?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?>"></p>
									</li>
								<? } ?>
							</ul>

						</div>
						<? $price = $NAME_FURNISH[$arResult["PROPERTIES"]["FURNISH_NAME_2"]["VALUE"]]["PRICE"];
						if($price) { 
						?>
						<div class="line">
							<div class="dop">
								<h4>Доборы</h4>
								<p>Доборы выполняются из того же материала, что и дверь со стороны установки.</p>
								<p>Стоимость комплекта доборов с отделкой “<?=$NAME_FURNISH[$arResult["PROPERTIES"]["FURNISH_NAME_2"]["VALUE"]]["NAME"]?>”.............................. <span>от <?=number_format($price,0," "," ")?> Br</span></p>
								<p class="last">Возможны цветовые варианты доборов для данной двери:</p>
							</div>
							<? if($arResult["PROPERTIES"]["FURNISH_COLOR_2"]["VALUE"]) { ?>
							<ul class="colors clearfix c_<?=count($arResult["PROPERTIES"]["FURNISH_COLOR_2"]["VALUE"])?>">
							<?foreach($arResult["PROPERTIES"]["FURNISH_COLOR_2"]["VALUE"] as $id){
								$base = $i?"":"base";
								$i++;
							?>
								<li>
									<span><?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?></span>
									<p class="<?=$base?> img"><img src="<?=$VARIANTS[$id]["UF_DOBOR_SRC"]?$VARIANTS[$id]["UF_DOBOR_SRC"]:$VARIANTS[$id]["FILE_SRC"];?>" alt="<?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?>"></p>
								</li>
							<? } ?>
							</ul>
							<? } ?>
						</div>
						<? } ?>
					</div>
				</div>
<?
if($arResult["PROPERTIES"]["ANOTHER_COMPLECT"]["VALUE"])
{
	global $filter;
	$filter = array("ID" => $arResult["PROPERTIES"]["ANOTHER_COMPLECT"]["VALUE"]);
	$APPLICATION->IncludeComponent("bitrix:catalog.section", "another", Array(
	"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "4",	// Инфоблок
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
		"FILTER_NAME" => "filter",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"PAGE_ELEMENT_COUNT" => "16",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "URL",
			2 => "",
		),
		"OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		"LABEL_PROP" => "-",	// Свойство меток товара
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
		"ADD_TO_BASKET_ACTION" => "ADD",	// Показывать кнопку добавления в корзину или покупки
		"DISPLAY_COMPARE" => "N",	// Разрешить сравнение товаров
		"PAGER_TEMPLATE" => "arrows",	// Шаблон постраничной навигации
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
	false
);
}
?>
				<div class="dogon">
					<h3>Виды доборов</h3>
					<ul class="clearfix pics">
						<li>
							<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/img/dogon1.jpg" alt=""></div>
							<p>Добор под прямым углом</p>
						</li>
						<li>
							<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/img/dogon2.jpg" alt=""></div>
							<p>Г-образный добор</p>
						</li>
						<li>
							<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/img/dogon3.jpg" alt=""></div>
							<p>Добор под углом</p>
						</li>
					</ul>
					<p class="mark">Установка доборов является завершающим этапом и производится после установки двери и отделки помещения</p>
					<p class="mark">Расчет стоимости доборов производится только после монтажа двери</p>
					<p class="mark">Сроки изготовления доборов уточняйте у менеджеров</p>
					<div class="portal">
						<h4>Виды наличника и портала</h4>
						<ul class="clearfix">
							<li>
								<p>Наличник Cтандарт</p>
								<img src="<?=SITE_TEMPLATE_PATH?>/img/portal1.jpg" alt="">
								<p>120 000 Br/м.п</p>
							</li>
							<li>
								<p>Наличник Премиум</p>
								<img src="<?=SITE_TEMPLATE_PATH?>/img/portal2.jpg" alt="">
								<p>165 000 Br/м.п</p>
							</li>
							<li>
								<p>Портал Лого</p>
								<img src="<?=SITE_TEMPLATE_PATH?>/img/portal3.jpg" alt="">
								<p>83 000 Br/м.п</p>
							</li>
							<li>
								<p>Портал Найс</p>
								<img src="<?=SITE_TEMPLATE_PATH?>/img/portal4.jpg" alt="">
								<p>495 000 Br/м.п</p>
							</li>
							<li>
								<p>Портал Византия</p>
								<img src="<?=SITE_TEMPLATE_PATH?>/img/portal5.jpg" alt="">
								<p>660 000 Br/м.п</p>
							</li>
						</ul>
					</div>
				</div>
				<!--div class="type_door clearfix">
					<h3>Выбор типа дверной коробки</h3>
					<div class="left">
						<p>Двери с двумя контурами уплотнения<br><span>Толщина полотна 85 мм</span></p>
					</div>
					<div class="left">
						<p>Двери с тремя контурами уплотнения<br><span>Толщина полотна 100 мм</span></p>
					</div>
				</div-->
			</div>
		</div>

<?
	/*
global $arrFilter;
$arrFilter = array("PROPERTY_IN_KONSTR" => false);

$furns = $APPLICATION->IncludeComponent("my:catalog.section.furns", "template1", Array(
	"COMPONENT_TEMPLATE" => ".default",
	"INCLUDE_TEMPLATE" => false,
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "11",	// Инфоблок
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "undefined",
			2 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "asc",	// Порядок второй сортировки элементов
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"PAGE_ELEMENT_COUNT" => "300",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
		),
		"OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		"LABEL_PROP" => "-",	// Свойство меток товара
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
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
		"CURRENCY_ID" => "BYR",	// Валюта, в которую будут сконвертированы цены
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
	),
	false
);
global $arrFilter;
$arrFilter = array("ID" => $arResult["ID"]);

$APPLICATION->IncludeComponent("my:catalog.section.konstructor", "template3", Array(
	"COMPONENT_TEMPLATE" => "template1",
		"INCLUDE_TEMPLATE" => true,
		"FURNS" => $furns,
		"PAGE" => "CARTPAGE",
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"IBLOCK_ID" => "4",	// Инфоблок
		"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_USER_FIELDS" => array(	// Свойства раздела
			0 => "",
			1 => "undefined",
			2 => "",
		),
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки элементов
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
		"FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
		"HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
		"PAGE_ELEMENT_COUNT" => "300",	// Количество элементов на странице
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
		"PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "undefined",
			2 => "",
		),
		"OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
		"LABEL_PROP" => "-",	// Свойство меток товара
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
		"CACHE_TYPE" => "Y",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
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
		"PRICE_CODE" => array(	// Тип цены
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"CONVERT_CURRENCY" => "Y",	// Показывать цены в одной валюте
		"CURRENCY_ID" => "BYR",	// Валюта, в которую будут сконвертированы цены
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
	),
	false
);*/

if($arResult["PROPERTIES"]["SOME_PRODS"]["VALUE"])
{
	global $filter;
	$filter = array("ID" => $arResult["PROPERTIES"]["SOME_PRODS"]["VALUE"]);
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section", 
		"", 
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
			"FILTER_NAME" => "filter",
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			"HIDE_NOT_AVAILABLE" => "N",
			"PAGE_ELEMENT_COUNT" => "16",
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
			"PAGER_TEMPLATE" => "arrows",
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
		$component
	);
}
?>