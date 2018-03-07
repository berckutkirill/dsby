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

$FILE_TTH = $arResult["FURN_FILE_TTH"];

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
if($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") {
foreach($PICCHAR as $code => $file)
{
	$FILE_TTH[$code]["FILE"] = $file["FILE_SRC"];
	$FILE_TTH[$code]["TEXT"] = $file["UF_DESCRIPTION"];
	$FILE_TTH[$code]["NAME"] = $file["UF_NAME"];
	$FILE_TTH[$code]["TOOLTIP"] = $file["UF_TOOLTIP"];
}
}
$TEXT_TTH = $arResult["SOSTAV_TTH"];
foreach($arResult["PROPERTIES"] as $code => $val)
{
	if(strpos($code,"CHARAKTER_") === 0)
	{
		if($val["VALUE"])
		{
			if($val["PROPERTY_TYPE"] == "S" || $val["PROPERTY_TYPE"] == "L")
			{
				$TEXT_TTH[$code]["TEXT"] = $val["VALUE"];
				if($arResult["PROPERTIES"]["TOOLTIP_".$code] !== "0") {
					$TEXT_TTH[$code]["TOOLTIP"] = $arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]?$arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]:$val["HINT"];;
				}

				$TEXT_TTH[$code]["NAME"] = $val["NAME"];
			}
			elseif($val["PROPERTY_TYPE"] == "F")
			{
				$FILE_TTH[$code]["FILE"] = CFile::GetPath($val["VALUE"]);
				$FILE_TTH[$code]["TEXT"] = $val["DESCRIPTION"];
				if($arResult["PROPERTIES"]["TOOLTIP_".$code] !== "0") {
					$FILE_TTH[$code]["TOOLTIP"] = $arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]?$arResult["PROPERTIES"]["TOOLTIP_".$code]["VALUE"]:$val["HINT"];
				}
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
	$FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH."/img/storona_otkryvania.jpg";
 $FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]?$arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]:"Левая или правая";
 $FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
 $FILE_TTH["STORONA"]["NAME"] = "Сторона открывания";
}
else
{
 $FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH."/img/storona_otkryvania.jpg";
 $FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]?$arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"]:"Левая или правая";
 $FILE_TTH["STORONA"]["NAME"] = "Сторона открывания";
	$FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
}
$hblock = GetHBlock(7);
foreach($hblock as $eq)
{
	$NAME_FURNISH[$eq["UF_XML_ID"]]["NAME"] = $eq["UF_NAME"];
	$NAME_FURNISH[$eq["UF_XML_ID"]]["PRICE"] = intVal($eq["UF_DESCRIPTION"]);
}

$hblock = GetHBlock(13);
foreach($hblock as $eq)
{
	$UF_JAMBEAU[$eq["UF_XML_ID"]] = $eq;
	$UF_JAMBEAU[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}


foreach($arResult["PROPERTIES"]["ACTIVE_JAMBEAU"]["VALUE"] as $xml_id) {
	if($UF_JAMBEAU[$xml_id])
		$JAMBEAU[$xml_id] = $UF_JAMBEAU[$xml_id];
}
$SHOW_PRICE = ($arResult["PROPERTIES"]["SHOW_PRICE"]['VALUE'] != 'N');
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


(function(d,w){
	var n=d.getElementsByTagName("script")[0],
	s=d.createElement("script"),
	f=function(){n.parentNode.insertBefore(s,n);};
	s.type="text/javascript";
	s.async=true;
	s.src="http://track.recreativ.ru/trck.php?shop=1743&ttl=30&offer=<?=$arResult["ID"]?>&rnd="+Math.floor(Math.random()*999);
	if(window.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded", f, false);}
	else{f();}
})(document,window);

var _tmr = _tmr || [];
_tmr.push({
    type: 'itemView',
    productid: <?=$arResult["ID"]?>,
    pagetype: 'product',
    list: '1',
});

</script>
<?if($arResult["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3) { $class="sale_tmp"; } ?>
<div class="item <?=$class?>">
			<div class="wrap">
				<div class="top clearfix">
					<div class="left">
						<h1><?=$arResult["NAME"]?></h1>
						
						<div class="galery">
							<?if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] != "Y") { ?>
							<div class="ls">
								<h5>Вид снаружи</h5>
								<p class="img big"><img src="<?=$FURNISH_OUTSIDE?>" alt="<?=htmlentities($arResult["DETAIL_PICTURE"]['ALT']).", вид в интерьере";?>" data-src="<?=$FURNISH_OUTSIDE?>"></p>
							</div>
						<? } ?>
							<?if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") {
								$classMid = "double";
							} else {
								$classMid = "";
							}?>
							
							<div class="mid <?=$classMid?>">
								<div class="prop">
									<span <?=in_array(3, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
									<span <?=in_array(2, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
									<span <?=in_array(1, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
								</div>
								<p class="img big"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"].", вид снаружи"?>" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"></p>
								<p class="img big"><img src="<?=$DETAIL_2?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"].", вид изнутри"?>" data-src="<?=$DETAIL_2?>"></p>
								<?if($arResult["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3) { ?><span class="yarl"></span><? } ?>
							</div>

							<?if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] != "Y") { ?>
							<div class="rs">
								<h5>Вид внутри</h5>
								<p class="img big"><img src="<?=$FURNISH_INSIDE?>" alt="<?=htmlentities($arResult["DETAIL_PICTURE"]['ALT']).", вид в интерьере"?>" data-src="<?=$FURNISH_INSIDE?>"></p>
							</div>
							<? } ?>
							
							<div class="popup_img">
								<i class="close">x</i>
								<b class="prev"></b>
								<b class="next"></b>
								<img src="" alt="Двери Стальная линия">
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
						<?if($arResult["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3) { ?>
							<div class="sale_tmp_link_wrapper">
								<span class="sale_tmp_text">На данную модель распространяется скидка 5–10%, условия в разделе </span><a class="sale_tmp_link" href="/aktsii/skidki_k_8_marta.html">«Акции»</a>
							</div>
						<? } ?>
						<div class="text">
							<h3>Описание</h3>
							<?=$arResult["~DETAIL_TEXT"]?>
							<div class="likely">
							  <div class="facebook">Поделиться</div>
							  <div class="vkontakte">Поделиться</div>
							  <div class="twitter">Твитнуть</div>
							  <div class="odnoklassniki">Одноклассники</div>
							</div>
						</div>
					</div>
					<div class="right">
					<?if($arResult["PROPERTIES"]["MODEL_IN"]["VALUE_XML_ID"] == 1) {?>
						<p data-open="#mapPopup" class="salon">Модель представлена в салоне</p>
						<? } ?>
						<div class="clearfix">
							<?/*if($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") { */?>
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
								<h4>Дверь под заказ</h4>
								<div class="bottom">
									<p>Доставка</p>
									<span><?=$arResult["PROPERTIES"]["DELIVERY_TIME"]["VALUE"]?></span>
								</div>
							</div>
							<? }
/*}*/
							if($SHOW_PRICE) {
							if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class = "sale";
							?>
							<!--div class="base <?=$class?>">
								<p>Цена базовой комплектации</p>
								<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
								<span class="price_old js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
										<?if($arResult['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?=toPrice($arResult["MIN_PRICE"]["VALUE"]);?> руб.</span>
								</span>
								<? } ?>
								<span class="price js_price_gen <?if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") { ?> double <? } ?>">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
									<?if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" || $arResult['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?=toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]);?> руб.</span>
								</span>
							</div-->
							<? } ?>
						</div>
						<div class="base_equip">
							<h3>Базовая комплектация</h3>
							<ul class="props clearfix">
								<?foreach($arResult["PROPERTIES"]["BASE_EQUIPMENT"]["VALUE"] as $i => $id):
								if($i > 4) break;?><li>
									<img src="<?=$BASIC[$id]["FILE_SRC"]?>" alt="<?=htmlentities($BASIC[$id]["UF_NAME"])?>">
									<p class="tip"><?=$BASIC[$id]["UF_NAME"]?></p>
								</li>
								<?endforeach;?>
							</ul>
						</div>
						

						<div class="more clearfix">
						<?/* if($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") { */?>
							<h3>Информация к сведению</h3>
							<div class="clearfix">
							<div class="free">Бесплатный<br>замер<br><span class="old_rub">в пределах МКАД</span></div>
							<div class="free install js_price_gen">Установка двери<br> от <span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
								<span class="old_rub js_old_denomination_price">от <?=toPrice($arResult["PROPERTIES"]["COST_INSTALL"]["VALUE"])?> руб.</span></div>
							</div>
						<? /*}*/ ?>
							<div class="text_param clearfix">
								<!--h3>Размер</h3-->
								<div class="float border">
									<h5>Высота:</h5>
									<p class="hw"><?=$arResult["PROPERTIES"]["HEIGHT_RIGHT"]["VALUE"]?></p>
									<h5>Ширина:</h5>
									<p class="hw"><?=$arResult["PROPERTIES"]["WEIGHT_RIGHT"]["VALUE"]?></p>
								</div>
								<?  if($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") { ?>
								<div class="float">
									<p>Стандартная площадь коробки: <b>до <?if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"]) { ?>350<? } else {?>206<? } ?> дм<sup>2</sup></b></p>
									<?if($arResult["PROPERTIES"]["SURCHARGE_FOR_DM"]["VALUE"] && 1==2) { ?>
										<p class="js_price_gen">
											Доплата за каждые <br><b>1 дм<sup>2</sup> — от <span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
											<span class="old_rub js_old_denomination_price">от <?=number_format($arResult["PROPERTIES"]["SURCHARGE_FOR_DM"]["VALUE"], 0, " ", " ")?> руб.</span></b>
										</p>
									<? } ?>
								</div>
								<?  } else { ?>
								<!--div class="float">
									<p>Боковой добор с остеклением, верхний добор с остеклением: </p>
									<p class="hw">3 812 000 Br</p>
								</div-->
								<?  } ?>
							</div>
							
							<div class="right_prop">

								<span class="button where_buy" onclick='whereBye();' data-open="#mapPopup">Где купить</span>
<?if($SHOW_PRICE) { ?>
								<!--a onclick="addToCart('<?=$arResult["ID"]?>','<?=$arResult["NAME"]?>','<?=$arResult["BUY_URL"]?>'); return !ga.loaded;" href="<?=$arResult["BUY_URL"]?>">Заказать дверь</a-->
								<? } ?>
</div>
						</div>
						
						
					</div>
				</div>
				<!--div class="fix_area">
					<div class="wrap">
						<div class="img">
							<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=htmlentities($arResult["NAME"])?>">
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
						<?if($SHOW_PRICE) { ?>
						<a  class="zakaz" onclick="addToCart('<?=$arResult["ID"]?>','<?=$arResult["NAME"]?>','<?=$arResult["BUY_URL"]?>'); return !ga.loaded;" href="<?=$arResult["BUY_URL"]?>">Заказать дверь</a>

						<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class2 = "sale";?>

						<div class="cost <?=$class2?>">
							<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
							<span class="price_old js_price_gen">
								<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
								<span class="old_rub js_old_denomination_price">
								<?if($arResult['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?=toPrice($arResult["MIN_PRICE"]["VALUE"]);?> руб.
								</span>
							</span>
							<? } ?>
							<span class="price js_price_gen">
								<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
								<span class="old_rub js_old_denomination_price">
								<?if($arResult['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?=toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]);?> руб.
								</span>
							</span>
						</div>
						<? } ?>
					</div>
				</div-->
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
				<?if($arResult["PROPERTIES"]["DESIGNED"]["VALUE"] == "Y") { ?>
				<div class="ral_palitra clearfix">
					<h3>Варианты отделки двери под заказ</h3>
					<div class="left">
						<div class="sider js_sider">
							<div class="picker js_piker"></div>
							<div class="front js_front side">
								<img src="">
							</div>
							<div class="back js_back side">
								<img src="">
							</div>
						</div>
						<p class="text">При заказе двери с&nbsp;внутренней и&nbsp;внешней отделкой разных цветов, коробку рекомендуем также окрашивать в&nbsp;два цвета.</p>
					</div>

					<div class="right">
						<h3>Основные цветовые решения</h3>
						<p>Двери из новой коллекции имеют четыре основных цвета. Производство такой двери занимает минимальное количество дней.</p>
						<?if($arResult['COLOR_DESIGIONS']) { ?>
						<div class="colors_doors js_cool_line clearfix">
							<? foreach($arResult['COLOR_DESIGIONS'] as $color) {?>
							<span class="js_cool_line_el box js_palitra_door" data-front="<?=$color['PIC_1']?>" data-back="<?=$color['PIC_2']?>">
								<img src="<?=$color['PIC_1']?>" alt="">
								<span class="desc"><?=$color['COLOR']?></span>
							</span>
							<? } ?>
							<i class="js_line line"></i>
						</div>
						<? } ?>
						<p>Дверь в 6-ти дополнительных цветах незначительно увеличивает свою стоимость.<br>Срок производства остаётся без изменений.</p>
						<ul class="clearfix colors_square">
							<li>
								<span class="square"></span>
								<p>«Марсала»<br>RAL 3032</p>
							</li>
							<li>
								<span class="square"></span>
								<p>«Серебро»<br>RAL 9023</p>
							</li>
							<li>
								<span class="square"></span>
								<p>«Капучино»<br>RAL 1019</p>
							</li>
							<li>
								<span class="square"></span>
								<p>«Небесный»<br>RAL 5024</p>
							</li>
							<li>
								<span class="square"></span>
								<p>«Фисташковый»<br>RAL 6019</p>
							</li>
							<li>
								<span class="square"></span>
								<p>«Серый»<br>RAL 7044</p>
							</li>
						</ul>
						<h3>Мы не ограничиваем вас в выборе цвета</h3>
						<p class="palitra">Окраска в любой другой цвет RAL осуществляется по предварительному согласованию с менеджерами нашей компании. Всего таблица RAL включает 2 328 оттенков.</p>
					</div>
				</div>
				<script>
					$(function() {
						function cool_line(tgt) {
			                var el = tgt.find('.js_cool_line_el'),
			                    line = tgt.find('.js_line');

			                line.css({
			                    'width': el.eq(0).innerWidth()+'px',
			                    'left': el.eq(0).offset().left - tgt.offset().left +'px',
			                });

			                el.on('click', function() {
			                    var w = $(this).innerWidth(),
			                        l = $(this).offset().left;

			                    line.css({
			                        'width': w + 'px',
			                        'left': l - tgt.offset().left + 'px',
			                    });
			                })
			            };

			            cool_line($('.js_cool_line'));

						$('.js_palitra_door').eq(0).addClass('active');
			            $('.js_sider').find('img').eq(0).attr('src',
			            	$('.js_palitra_door').eq(0).attr('data-front'));
			            $('.js_sider').find('img').eq(1).attr('src',
			            	$('.js_palitra_door').eq(0).attr('data-back'));

			            $('.js_palitra_door').on('click',function() {
			            	var sides = $('.js_sider').find('img');

			            	$('.js_palitra_door').removeClass('active');
			            	$(this).addClass('active');
			            	sides.eq(0).attr('src',$(this).attr('data-front'));
			            	sides.eq(1).attr('src',$(this).attr('data-back'));
			            })

			            $('.js_piker').on('mousedown',function(){
							var door=$('.js_sider'),
								max = 360;

							door.on('mousemove',function(e){
								var centerCoord=e.clientX-door.offset().left,
									pickerCoord=e.clientX-door.offset().left;

								if (pickerCoord>=0&&pickerCoord<=max) {
									coord(centerCoord,pickerCoord);
								} else if (pickerCoord<0) {
									coord(0,0);
								} else if (pickerCoord>max) {
									coord(max,max);
								}
							});

						});
						function coord(w,l) {
							$('.js_front').css('width',w);
							$('.js_piker').css('left',l);
						};
						$(document).on('mouseup',function(){
							$('.js_sider').off('mousemove');
						});
						$('.js_piker').on('touchstart',function(){
							var door=$('.js_sider'),
								max = 446;

							door.on('touchmove',function(e){
								e.preventDefault();
								var delta = door.offset().left - $(document).scrollLeft();
								var centerCoord=e.originalEvent.touches[0].clientX-delta,
									pickerCoord=e.originalEvent.touches[0].clientX-delta;

								if (pickerCoord>=0&&pickerCoord<=max) {
									coord(centerCoord,pickerCoord);
								} else if (pickerCoord<0) {
									coord(0,0);
								} else if (pickerCoord>max) {
									coord(max,max);
								}
							});
				
						});
						$(document).on('touchend',function(){
							$('.js_sider').off('touchmove');
						});
					})
				</script>
				<? } ?>
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
									<p class="img"><img src="<?=$TTH["FILE"]?>" alt="<?=htmlentities($TTH["NAME"])?>"></p>
									<span><?=$TTH["NAME"]?></span>
								</li>
							<? } ?>
						</ul>
					</div>
				</div>
				<?
				if($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") {
				
					$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						".default",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/important_for_cost.php",
							"EDIT_TEMPLATE" => ""
						)
					);
				}
				?>
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
		<?if($arResult["PROPERTIES"]["DESIGNED"]["VALUE"] != "Y") { ?>
				<div class="otdelka clearfix">
					<h3>Варианты отделки под заказ</h3>
					<div class="main_foto">
						<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=htmlentities($arResult["DETAIL_PICTURE"]["ALT"])?>">
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
									<li><img src="<?=$BASIC[$id]["FILE_SRC"]?>" alt="<?=htmlentities($BASIC[$id]["UF_NAME"])?>"></li>
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
										<p class="<?=$base?> img"><img src="<?=$VARIANTS[$id]["FILE_SRC"]?>" alt="<?=htmlentities($VARIANTS[$id]["UF_FULL_DESCRIPTION"])?>"></p>
										<span><?=$VARIANTS[$id]["UF_FULL_DESCRIPTION"]?></span>
									</li>
								<? } ?>
							</ul>
						</div>
						
						<div class="line">
							<h4>Отделка внутри: <?=$NAME_FURNISH[$arResult["PROPERTIES"]["FURNISH_NAME_2"]["VALUE"]]["NAME"]?></h4>
							<?if($arResult["PROPERTIES"]["FURNISH_ICONS_2"]["VALUE"]){?>
							<ul class="icons">
								<?foreach($arResult["PROPERTIES"]["FURNISH_ICONS_2"]["VALUE"] as $id){?>
									<li><img src="<?=$BASIC[$id]["FILE_SRC"]?>" alt="<?=htmlentities($BASIC[$id]["UF_NAME"])?>"></li>
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
										<p class="<?=$base?> img"><img src="<?=$VARIANTS[$id]["FILE_SRC"]?>" alt="<?=htmlentities($VARIANTS[$id]["UF_FULL_DESCRIPTION"])?>"></p>
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
								<p class="js_price_gen">Стоимость комплекта доборов с отделкой «<?=$NAME_FURNISH[$arResult["PROPERTIES"]["FURNISH_NAME_2"]["VALUE"]]["NAME"]?>»....................... 
									 <span class="new_rub">от <span class="js_denomination_price"></span> руб. </span>
									<span class="old_rub js_old_denomination_price">(от <?=number_format($price,0," "," ")?> руб.)</span></p>
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
									<p class="<?=$base?> img"><img src="<?=$VARIANTS[$id]["UF_DOBOR_SRC"]?$VARIANTS[$id]["UF_DOBOR_SRC"]:$VARIANTS[$id]["FILE_SRC"];?>" alt="<?=htmlentities($VARIANTS[$id]["UF_FULL_DESCRIPTION"])?>"></p>
								</li>
							<? } ?>
							</ul>
							<? } ?>
						</div>
						<? } ?>
					</div>
				</div>
<? } ?>
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
if($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") {
	if($arResult["PROPERTIES"]["ACTIVE_TRANSOMS"]["VALUE"] == "Y" || count($JAMBEAU)  > 0) {
?>
<?if($arResult["PROPERTIES"]["DESIGNED"]["VALUE"] != "Y") { ?>
				<div class="dogon">
				<? if($arResult["PROPERTIES"]["ACTIVE_TRANSOMS"]["VALUE"] == "Y") { ?>
					<!--div class="dop_text_dobor clearfix">
						<div class="left">
							<h4>Доборы для входной двери</h4>
							<p>Приобретая готовую дверь, разработанную для стен со стандартной толщиной, владельцы новых квартир и загородных коттеджей сталкиваются с необходимостью штукатурить открытые участки между стеной и коробкой, перекрывать их гипсокартоном или пластиком. Более практичным решением является использование доборов.</p>
							<p>Добор — это две вертикальные и одна горизонтальная планка, которые перекрывают щели между стеной и коробкой. Использование доборов позволяет ускорить сборку и установку дверного блока, придать двери логично завершенный внешний вид. </p>
							<p>Доборы характеризуются длительным периодом эксплуатации.</p>
						</div>
						<div class="right">
							<h4>Важное о доборах</h4>
							<p>— Установка доборов является завершающим этапом и производится после установки двери и отделки помещения</p>
							<p>— Расчет стоимости доборов производится только после монтажа двери</p>
							<p>— Сроки изготовления доборов уточняйте у менеджеров</p>
						</div>
					</div-->
					<h3>Виды доборов</h3>
					<ul class="clearfix pics">
						<li>
							<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/img/dogon1.jpg" alt="Добор под прямым углом"></div>
							<p>Добор под прямым углом</p>
						</li>
						<li>
							<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/img/dogon2.jpg" alt="Г-образный добор"></div>
							<p>Г-образный добор</p>
						</li>
						<li>
							<div class="img"><img src="<?=SITE_TEMPLATE_PATH?>/img/dogon3.jpg" alt="Добор под углом"></div>
							<p>Добор под углом</p>
						</li>
					</ul>
					<p class="mark">Установка доборов является завершающим этапом и производится после установки двери и отделки помещения</p>
					<p class="mark">Расчет стоимости доборов производится только после монтажа двери</p>
					<p class="mark">Сроки изготовления доборов уточняйте у менеджеров</p>
					<? } ?>
					<? if(count($JAMBEAU) > 0) { ?>
					<div class="portal">
						<h4>Виды наличника и портала</h4>
						<div class="dop_text">
							<p>Дверные наличники и порталы являются инструментом декоративного обрамления дверного проема и представляют собой накладные фигурные профилированные планки.</p>
							<p>Наличник закрывает пространство между дверной коробкой и стеной.  Дверной наличник — <br>это обязательный элемент при продуманном дизайнерском подходе к оформлению дверного проема.</p>
							<p>Цвет элементов подбирается в соответствии <br>с отделкой выбранной модели двери.</p>
						</div>
						<ul class="clearfix">
							<?foreach($JAMBEAU as $val) { ?>
							<li>
								<img src="<?=$val["FILE_SRC"]?>" alt="<?=htmlentities($val["UF_NAME"])?>">
								<p class="name"><?=$val["UF_NAME"]?></p>
								<p class="js_price_gen price">
									<span class="new_rub">от <span class="js_denomination_price"></span> руб./м.п</span>
									<span class="old_rub js_old_denomination_price"><?=$val["UF_DESCRIPTION"]?></span>
								</p>
							</li>
							<? } ?>
						</ul>
					</div>
					<? } ?>
				</div>
				<? } ?>
				<div class="zamer_dop clearfix">
					<div class="any_left clearfix">
						<h4>Почему важен правильный замер проёма</h4>
						<div class="col_l">
							<p>Этап замера помогает определить:</p>
							<p>— параметры проёма;</p>
							<p>— способ открывания двери;</p>
							<p>— стоимость демонтажа старой двери;</p>
							<p>— стоимость доставки и установки новой двери.</p>
						</div>
						<div class="col_r">
							<p>Заключение договора возможно после выполнения замера нашим специалистом. Вы также можете заключить договор, подъехав <br>с данными замера в ближайший салон «Стальная линия».</p>
						</div>
					</div>
					<div class="any_right">
						<p>Понимая необходимость правильного замера, специалисты нашей компании осуществляют его бесплатно <br>в пределах МКАД</p>
						<button class="butt" onclick="yaRequest('Zakaz zamer');" data-open="#popup6">Заказать замер</button>
					</div>
					<div class="popup" id="popup6"> 
						<form action="/request/zamer_full.php" method="post" class="validate" id="new_form">
							<input type="hidden" name="my_address">
							<input type="text" name="login" class="my_login">
							<input type="hidden" name="element" value="<?php echo $arResult["ID"]; ?>">

							<div class="right">
								<h3 class="blue">Заказать замер</h3>
								<input type="text" class="must" name="name" placeholder="Имя">
								<input type="text" class="must" name="phone" placeholder="Номер телефона">
								<input type="text" name="email" placeholder="Адрес электронной почты">
								<textarea name="comment" placeholder="Комментарий"></textarea>
								<button type="submit">Отправить заявку</button>
							</div>
						</form>
					</div>
				</div>
				<? }
				}
				?>
			</div>
		</div>

<?

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
<script>
function whereBye(){
	fbq('track', 'Lead', {
		content_ids:[<?php echo $arResult['ID'] ?>],
		content_type:'product'
	})
}


fbq('track', 'ViewContent', {
	content_ids:[<?php echo $arResult['ID'] ?>],
	content_type:'product'
})
</script>