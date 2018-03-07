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
						<label><input name="FOR_WHAT[]" value="Для квартиры" type="checkbox" <?=in_array("Для квартиры",$_GET["FOR_WHAT"])?"checked":"";?>><span>Для квартиры</span></label>
						<label><input name="FOR_WHAT[]" value="Для дома" type="checkbox" <?=in_array("Для дома",$_GET["FOR_WHAT"])?"checked":"";?>><span>Для дома</span></label>
						<label><input name="FOR_WHAT[]" value="Для офиса" type="checkbox" <?=in_array("Для офиса",$_GET["FOR_WHAT"])?"checked":"";?>><span>Для офиса</span></label>
						<label><input name="filter[IN_STOCK]" value="В наличии" type="checkbox" <?=in_array("В наличии",$_GET["filter"])?"checked":"";?>><span>В наличии</span></label>
						<label><input name="filter[SPECIAL]" value="Хит продаж" type="checkbox" <?=in_array("Хит продаж",$_GET["filter"])?"checked":"";?>><span>Хиты продаж</span></label>
	</form>
						<a href="" class="sort">По стоимости</a>
					</div>
<div class="clearfix">
	<?foreach($arResult["ITEMS"] as $pos => $arItem):?>
		<?
		if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"])
		{
			$class = "sale"; 
		} else {
			if($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 1)
				$class = "hit";
			elseif($arItem["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 2)
				$class = "new";
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
						<div class="cart <?=$class?> clearfix">
							<div class="left">
								<div class="prop">
									<span <?=in_array(3, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
									<span <?=in_array(2, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
									<span <?=in_array(1, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
								</div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"  onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="name"><?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?> <i><?=$arItem["PROPERTIES"]["NAME_EN"]["VALUE"]?></i></a>
								<?if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
								<span class="price_old"><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> <i>000</i> Br</span>
								<? } ?>
								<span class="price"><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> <i>000</i> Br</span>
							</div>
							<div class="right">
								<?if($arItem["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) { ?>
								<span class="in_stock">На складе в Минске</span>
								<? } ?>
								<p class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
								<p class="img"><img src="<?=CFile::GetPath($arItem["PROPERTIES"]["VIEW_OUTSIDE_ANONS"]["VALUE"]);?>" alt="<?=$arItem["NAME"]?>"></p>
								<ul class="props clearfix">
									<?foreach($arItem["PROPERTIES"]["BASE_EQUIPMENT"]["VALUE"] as $eq):?>
									<li>
										<img src="<?=$BASIC[$eq]["FILE_SRC"]?>" alt="<?=$BASIC[$eq]["UF_NAME"]?>">
										<p class="tip"><?=$BASIC[$eq]["UF_NAME"]?></p>
									</li>
									<?endforeach;?>
									<li>
										<img src="<?=$BASIC[20]["FILE_SRC"]?>" alt="<?=$BASIC[20]["UF_NAME"]?>">
										<p class="tip"><?=$BASIC[20]["UF_NAME"]?></p>
									</li>
								</ul>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" onclick="onProductClick('<?=$arItem["ID"]?>','<?=$arItem["NAME"]?>','<?=$pos?>','<?=$arItem["DETAIL_PAGE_URL"]?>'); return !ga.loaded;" class="enter">Узнать больше</a>
							</div>
							<div class="yarl"></div>
						</div>
<?endforeach;?>
<script>
ga('send', 'event');
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
} else {
?>
<div class="content"><p class="not_found">Дверей с выбранными параметрами не найдено.</p></div>
<?}?>