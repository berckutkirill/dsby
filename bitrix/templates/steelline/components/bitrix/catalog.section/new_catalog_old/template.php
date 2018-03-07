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
if (!empty($arResult['ITEMS']))
{

?>
<div class="content">
	<h1><?=$arResult["NAME"]?$arResult["NAME"]:"Каталог входных дверей";?></h1>
	<div class="filt clearfix">
		<form id="filter">
			<label><input name="filter[ON_SHARE]" value="Y" type="checkbox" <?=$_GET["filter"]["ON_SHARE"]?"checked":"";?>><span>На акции</span></label>
			<label><input name="filter[IN_STOCK]" value="Y" type="checkbox" <?=$_GET["filter"]["IN_STOCK"]?"checked":"";?>><span>На складе</span></label>
			<label><input name="filter[NEW]" value="Y" type="checkbox" <?=$_GET["filter"]["NEW"]?"checked":"";?>><span>Новинки</span></label>
			<label><input name="filter[HIT]" value="Y" type="checkbox" <?=$_GET["filter"]["HIT"]?"checked":"";?>><span>Хиты продаж</span></label>
		</form>
		<a href="" class="sort">По стоимости</a>
	</div>
	<div class="clearfix">

	<?foreach($arResult["ITEMS"] as $pos => $arItem):
		$ids[] = $arItem['ID'];
		?>
						<div class="cart <?=implode(" ", $arItem["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"]);?> clearfix">
							<div class="left">
								<?php if($arItem["PROPERTIES"]["APPOINTMENT"]["VALUE"]) { ?>
									<div class="prop">
										<?php foreach($arItem["APPOINTMENTS"] as $k => $v) { ?>
											<span <?php echo $v["CLASS"]?>><i><?php echo $v["VALUE"]?></i></span>
										<?php } ?>
									</div>
								<?php } ?>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"  onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="img">
									<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]." вид снаружи"?>">
									<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" && $arItem["PROPERTIES"]["DOUBLE_PICTURE"]["VALUE"]) { ?>
										<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["DOUBLE_PICTURE"]["VALUE"])?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
									<? } ?>
								</a>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="name">
									<?=$arItem["NAME"]?>
								</a>
								<span class="price <?= $arItem["MIN_PRICE"]["DISCOUNT_VALUE"] == $arItem["MIN_PRICE"]["VALUE"] ? "blue_color" : "";?> js_price_gen">
									<span class="new_rub"><?=$arItem['PROPERTIES']['IN_STOCK']['VALUE'] != "Y"?"от ":"";?>
									<span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
										<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" || $arItem['PROPERTIES']['IN_STOCK']['VALUE'] != "Y") {
											 ?>от <? } ?><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> руб.
									</span>
								</span>
							</div>
							<div class="right">
								<?if($arItem["PROPERTIES"]["IN_STOCK"]["VALUE"] == "Y") { ?>
								<span class="in_stock">В наличии на складе</span>
								<? } ?>
								<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] != "Y") { ?>
									<p class="img">
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]." вид снаружи"?>">
									</p>
								<? } ?>
								<p class="img">
									<?if($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" && $arItem["PROPERTIES"]["DOUBLE_PICTURE_2"]["VALUE"]) { $dobor2 = CFile::GetPath($arItem["PROPERTIES"]["DOUBLE_PICTURE_2"]["VALUE"]); } else {$dobor2 = "";}?>
									<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]);?>" <?if($dobor2) { ?>data-dobor="<?=$dobor2?>"<? } ?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]." вид изнутри"?>">
								</p>
								
								<ul class="props clearfix">
									<?foreach($arItem["PROPERTIES"]["BASE_EQUIPMENT"]["VALUE"] as $eq):?>
									<li>
										<img src="<?=$arResult["BASIC"][$eq]["FILE_SRC"]?>" alt="<?=$arResult["BASIC"][$eq]["UF_NAME"]?>">
										<p class="tip"><?=$arResult["BASIC"][$eq]["UF_NAME"]?></p>
									</li>
									<?endforeach;?>
								</ul>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="enter">Узнать больше</a>
							</div>
							<div class="yarl"></div>
						</div>

<script>
ga('ec:addImpression', {
  'id': '<?=$arItem["ID"]?>',                   
  'name': '<?=$arItem["NAME"]?>',
  'type': 'view',
  'list': 'Просмотр Каталога',
  'position': <?=$pos?>
}); 
</script>

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
			<label><input name="filter[ON_SHARE]" value="Y" type="checkbox" <?=$_GET["filter"]["ON_SHARE"]?"checked":"";?>><span>На акции</span></label>
			<label><input name="filter[IN_STOCK]" value="Y" type="checkbox" <?=$_GET["filter"]["IN_STOCK"]?"checked":"";?>><span>На складе</span></label>
			<label><input name="filter[NEW]" value="Y" type="checkbox" <?=$_GET["filter"]["NEW"]?"checked":"";?>><span>Новинки</span></label>
			<label><input name="filter[HIT]" value="Y" type="checkbox" <?=$_GET["filter"]["HIT"]?"checked":"";?>><span>Хиты продаж</span></label>
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
			<label><input name="filter[ON_SHARE]" value="Y" type="checkbox" <?=$_GET["filter"]["ON_SHARE"]?"checked":"";?>><span>На акции</span></label>
			<label><input name="filter[IN_STOCK]" value="Y" type="checkbox" <?=$_GET["filter"]["IN_STOCK"]?"checked":"";?>><span>На складе</span></label>
			<label><input name="filter[NEW]" value="Y" type="checkbox" <?=$_GET["filter"]["NEW"]?"checked":"";?>><span>Новинки</span></label>
			<label><input name="filter[HIT]" value="Y" type="checkbox" <?=$_GET["filter"]["HIT"]?"checked":"";?>><span>Хиты продаж</span></label>
		</form>
		<a href="" class="sort">По стоимости</a>
	</div>
	<p class="not_found">
		<span>Нет дверей,</span><br/>
		отвечающих Вашему запросу
	</p>
</div>
<? } ?>