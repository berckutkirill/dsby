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
if(!empty($arResult["ITEMS"])) { 
?>
<div class="more clearfix">
		<h2>C этим товаром покупают</h2>
	<?foreach($arResult["ITEMS"] as $arItem) {
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
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="cart_f <?=$class?>">
			<span class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></span>
			<span class="name"><?=$arItem["NAME"]?></span>
			<?if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
				<span class="price_old"><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> Br</span>
			<?}?>
				<span class="price"><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> Br</span>
		</a>
	<? } ?>
	</div>
<? } ?>