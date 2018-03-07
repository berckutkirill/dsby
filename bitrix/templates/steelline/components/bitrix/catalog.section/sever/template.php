<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */
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
$hblock = GetHBlock(3);
foreach($hblock as $eq)
{
	$BASIC[$eq["UF_XML_ID"]] = $eq;
	$BASIC[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}
?>
<div class="content">
				<div class="list">
					<div class="clearfix">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$SHOW_PRICE = $arItem['PROPERTIES']['SHOW_PRICE']['VALUE'] != 'N';
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
			else
				$class = "";
		}
		?>
						<div class="cart <?=$class?> clearfix">
							<div class="left">
								<div class="prop">
									<span <?=in_array(3, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
									<span <?=in_array(2, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
									<span <?=in_array(1, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
								</div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?> <i><?=$arItem["PROPERTIES"]["NAME_EN"]["VALUE"]?></i></a>
								<?if($SHOW_PRICE) { ?>
									<?if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
									<span class="price_old denom"><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> Br</span>
									<? } ?>
									<span class="price denom"><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> Br</span>
								<? } ?>
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
									
								</ul>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="enter">Узнать больше</a>
							</div>
							<div class="yarl"></div>
						</div>
<?endforeach;?>
					</div>
				</div>
			</div>
<script>
	$(function() {
	$('.denom').each(function() {
		denominator($(this));
	})
})
</script>