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
if($arResult["ID"] == 20){ ?>
<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=WV7m4pp4cHp/LJbyuX0vl/NkV2Hg7d5QweXNE/bd1QGwyy6AwiibOFMhBDyjLoOi/SzfidYu18KyKE*1*oEVg9JlK/07facb*8HTZchVDM5mfVP20tIy40jwpxzmCSDf*0/Z56jMKl4XtZQ2ilze0d6Hm8X5xj2f8UYJx3xAAmg-';</script>
<? } elseif($arResult["ID"] == 17) { ?>
<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=KL8bMPPHVdbDNdU/m5bbM7Lo6OgQTXHwbc9*mKBHZo7zD3RMqLvxH0ZMenTdao96A*mKIm4Bnlb6dQ1ahzC/UHJ/rEDpsxKO0r9vfPT/ZuiMPmzJpYT2O*HPUILl5Spy9/Q5M6RjQapwxr4vF8le*BQj5NJU3IsCfcO7N7kwsuk-';</script>
<?} elseif($arResult["ID"] == 18) { ?>
<img src="//code.directadvert.ru/track/244039.gif" width="1" height="1" />
<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=s/TqCS9anp2GXOrYI/EffjTJoTM1a7XNr6e62xTLfAUh4SjUN92*lpNEYpQKbOo3W5SyX1XZ4vzh9ePPjH/JE*AOf9yhYoRV*QEH9nB9SPEk8lULEid5rMwZAJCSYwQusHYONA2ZZ//u*X0OTp9k73htv6xeqMBfnYetvMAYp1Q-';</script>
<? }
if (!empty($arResult['ITEMS']))
{
$hblock = GetHBlock(3);
foreach($hblock as $eq)
{
	$BASIC[$eq["UF_XML_ID"]] = $eq;
	$BASIC[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}
?>
<div class="content">
	<!--a href="#" class="pdf">Получить каталог PDF</a>
	<div class="pdf_popup popup">
						<i class="close">X</i>
						<h4>Получить каталог дверей в PDF</h4>
		<form action="/request/getpdf.php">
							<div class="input">
								<p>Имя</p>
								<input type="text" name="name" placeholder="" class="must">
							</div>
							<div class="input">
								<p>E-mail</p>
								<input type="text" name="email" placeholder="" class="must">
							</div>
							<button type="submit">Получить каталог</button>
						</form>
					</div-->
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
<?if(!empty($arResult["TAGS"])) {?>
					<ul class="tags clearfix">
						<?
							foreach($arResult["TAGS"] as $tag) {
							if($tag["PROPERTY_TAGS_VALUE"] == $_GET["TAGS"]) 
							{
								$class="active"; 
								$title = $tag["PROPERTY_TAGS_VALUE"];
							} else 
							{
								$class="";
							}
						?>
						<li><a class="<?=$class?>" href="?TAGS=<?=$tag["PROPERTY_TAGS_VALUE"]?>&section=<?=$arResult["CODE"]?$arResult["CODE"]:$_GET["section"]?>"><?=$tag["PROPERTY_TAGS_VALUE"]?></a></li>
						<? } ?>
					</ul>
	<? } ?>
<div class="filt clearfix">
	<form id="filter">
						<label><input name="STYLE_DVERI[]" value="Современный" type="checkbox" <?=in_array("Современный",$_GET["STYLE_DVERI"])?"checked":"";?>><span>Современный</span></label>
						<label><input name="STYLE_DVERI[]" value="Классический" type="checkbox" <?=in_array("Классический",$_GET["STYLE_DVERI"])?"checked":"";?>><span>Классический</span></label>
						<label><input name="filter[IN_STOCK]" value="В наличии" type="checkbox" <?=in_array("В наличии",$_GET["filter"])?"checked":"";?>><span>На складе</span></label>
						<label><input name="filter[SPECIAL][]" value="Новинка" type="checkbox" <?=in_array("Новинка",$_GET["filter"]["SPECIAL"])?"checked":"";?>><span>Новинки</span></label>
						<label><input name="filter[SPECIAL][]" value="Хит продаж" type="checkbox" <?=in_array("Хит продаж",$_GET["filter"]["SPECIAL"])?"checked":"";?>><span>Хиты продаж</span></label>
	</form>
						<a href="" class="sort">По стоимости</a>
					</div>
<div class="clearfix">
	<?foreach($arResult["ITEMS"] as $pos => $arItem):
		$ids[] = $arItem['ID'];
		$SHOW_PRICE = false;

		if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"])
		{
			$class = "sale"; 
		} else {
			if($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 1)
				$class = "hit";
			elseif($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 2)
				$class = "new";
			elseif($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3)
				$class = "sale_tmp";
			elseif($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 4)
				$class = "spec";
			elseif($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"])
				$class = "other_spec_".$arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"];
			else
				$class = "";
		}
		?>
<script>
ga('ec:addImpression', {
  'id': '<?=$arItem["ID"]?>',                   // Подробная информация о продукте
  'name': '<?=$arItem["NAME"]?>',
  'type': 'view',
  'list': 'Просмотр Каталога',
  'position': <?=$pos?>                     // 'position'- позиция продукта в результате поиска (списка).
}); 
</script>
	<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") { $cartclass="double";} else {$cartclass = "";}?>
						<div class="cart <?=$class." ".$cartclass?> clearfix">
							<div class="left">
								<div class="prop">
									<span <?=in_array(3, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
									<span <?=in_array(2, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
									<span <?=in_array(1, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
								</div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"  onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="img">
									<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]." вид снаружи"?>">
									<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" && $arItem["PROPERTIES"]["DOUBLE_PICTURE"]["VALUE"]) { ?>
										<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["DOUBLE_PICTURE"]["VALUE"])?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
									<? } ?>
								</a>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="name"><?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?> <i><?=$arItem["PROPERTIES"]["NAME_EN"]["VALUE"]?></i></a>
								<?
								if($SHOW_PRICE) {
								if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
									<span class="price_old js_price_gen">
										<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
										<span class="old_rub js_old_denomination_price">
											<? if($arItem['PROPERTIES']['PRICE_FROM']['VALUE']) { ?> от <? } ?><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> руб.</span>
									</span>
								<? } ?>
								<span class="price js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
									<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" || $arItem['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> руб.</span>
								</span>
								<? } ?>
							</div>
							<div class="right">
								<?if($arItem["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) { ?>
								<span class="in_stock">В наличии на складе</span>
								<? } ?>
								<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] != "Y") { ?>
								<p class="img">
									<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]." вид снаружи"?>">
								</p>
								<? } ?>
								<p class="img">
									<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" && $arItem["PROPERTIES"]["DOUBLE_PICTURE_2"]["VALUE"]) { $dobor2 = CFile::GetPath($arItem["PROPERTIES"]["DOUBLE_PICTURE_2"]["VALUE"]); } else {$dobor2 = "";}?>
									<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["VIEW_OUTSIDE_ANONS"]["VALUE"]);?>" <?if($dobor2) { ?>data-dobor="<?=$dobor2?>"<? } ?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]." вид изнутри"?>">
								</p>
								
								<ul class="props clearfix">
									<?foreach($arItem["PROPERTIES"]["BASE_EQUIPMENT"]["VALUE"] as $eq):?>
									<li>
										<img src="<?=$BASIC[$eq]["FILE_SRC"]?>" alt="<?=$BASIC[$eq]["UF_NAME"]?>">
										<p class="tip"><?=$BASIC[$eq]["UF_NAME"]?></p>
									</li>
									<?endforeach;?>
									
								</ul>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="enter">Узнать больше</a>
							</div>
							<div class="yarl"></div>
						</div>
<?endforeach;?>
<script>
ga('send', 'event');
fbq('track', 'ViewContent', {
	content_ids:[<?php echo implode(',', $ids) ?>],
	content_type:'product'
})
</script>
					</div>
<?
if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
?>
</div>
<?
} elseif($arParams["SECTION_CODE"] == "dveri-na-aktsii") { ?>
<div class="content">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<?if(!empty($arResult["TAGS"])) { ?>
		<ul class="tags clearfix">
			<?foreach($arResult["TAGS"] as $tag) {
				if($tag["PROPERTY_TAGS_VALUE"] == $_GET["TAGS"]) {
					$class="active"; 
					$title = $tag["PROPERTY_TAGS_VALUE"];
				} else {
					$class="";
				} ?>
			<li>
				<a class="<?=$class?>" href="?TAGS=<?=$tag["PROPERTY_TAGS_VALUE"]?>&section=<?=$arResult["CODE"]?$arResult["CODE"]:$_GET["section"]?>"><?=$tag["PROPERTY_TAGS_VALUE"]?></a>
			</li>
			<? } ?>
		</ul>
	<? } ?>
	<div class="filt clearfix">
		<form id="filter">
						<label><input name="STYLE_DVERI[]" value="Современный" type="checkbox" <?=in_array("Современный",$_GET["STYLE_DVERI"])?"checked":"";?>><span>Современный</span></label>
						<label><input name="STYLE_DVERI[]" value="Классический" type="checkbox" <?=in_array("Классический",$_GET["STYLE_DVERI"])?"checked":"";?>><span>Классический</span></label>
						<label><input name="filter[IN_STOCK]" value="В наличии" type="checkbox" <?=in_array("В наличии",$_GET["filter"])?"checked":"";?>><span>На складе</span></label>
						<label><input name="filter[SPECIAL][]" value="Новинка" type="checkbox" <?=in_array("Новинка",$_GET["filter"]["SPECIAL"])?"checked":"";?>><span>Новинки</span></label>
						<label><input name="filter[SPECIAL][]" value="Хит продаж" type="checkbox" <?=in_array("Хит продаж",$_GET["filter"]["SPECIAL"])?"checked":"";?>><span>Хиты продаж</span></label>
	</form>
		<a href="" class="sort">По стоимости</a>
	</div>
	<div class="not_sales">
		<div class="block">
			<h4>Акционных товаров нет</h4>
			<a href="/catalog-dverei/">Перейти в каталог</a>
		</div>
	</div>
</div>
<?
	} else {
?>
<div class="content">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<?if(!empty($arResult["TAGS"])) { ?>
		<ul class="tags clearfix">
			<?foreach($arResult["TAGS"] as $tag) {
				if($tag["PROPERTY_TAGS_VALUE"] == $_GET["TAGS"]) {
					$class="active"; 
					$title = $tag["PROPERTY_TAGS_VALUE"];
				} else {
					$class="";
				} ?>
			<li>
				<a class="<?=$class?>" href="?TAGS=<?=$tag["PROPERTY_TAGS_VALUE"]?>&section=<?=$arResult["CODE"]?$arResult["CODE"]:$_GET["section"]?>"><?=$tag["PROPERTY_TAGS_VALUE"]?></a>
			</li>
			<? } ?>
		</ul>
	<? } ?>
	<div class="filt clearfix">
		<form id="filter">
						<label><input name="STYLE_DVERI[]" value="Современный" type="checkbox" <?=in_array("Современный",$_GET["STYLE_DVERI"])?"checked":"";?>><span>Современный</span></label>
						<label><input name="STYLE_DVERI[]" value="Классический" type="checkbox" <?=in_array("Классический",$_GET["STYLE_DVERI"])?"checked":"";?>><span>Классический</span></label>
						<label><input name="filter[IN_STOCK]" value="В наличии" type="checkbox" <?=in_array("В наличии",$_GET["filter"])?"checked":"";?>><span>На складе</span></label>
						<label><input name="filter[SPECIAL][]" value="Новинка" type="checkbox" <?=in_array("Новинка",$_GET["filter"]["SPECIAL"])?"checked":"";?>><span>Новинки</span></label>
						<label><input name="filter[SPECIAL][]" value="Хит продаж" type="checkbox" <?=in_array("Хит продаж",$_GET["filter"]["SPECIAL"])?"checked":"";?>><span>Хиты продаж</span></label>
	</form>
		<a href="" class="sort">По стоимости</a>
	</div>
	<p class="not_found">
		<span>Нет дверей,</span><br/>
		отвечающих Вашему запросу
	</p>
</div>
<? } ?>