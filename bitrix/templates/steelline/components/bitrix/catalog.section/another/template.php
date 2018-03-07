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
?>
<section class="carts item_c another">
			<div class="wrap">
				<h2>Двери в другой комплектации</h2>
				<div class="list">
					<ul>
						<?foreach($arResult["ITEMS"] as $arItem):

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
						<li class="<?=$class?>">
							<div class="prop">
								<span <?=in_array(3, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
								<span <?=in_array(2, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
								<span <?=in_array(1, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
							</div>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?> <i><?=$arItem["PROPERTIES"]["NAME_EN"]["VALUE"]?></i></a>
							<?if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
							<span class="price_old"><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> Br</span>
							<?}?>
							<span class="price"><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> Br</span>
							<div class="yarl"></div>
						</li>
						<?endforeach;?>
					</ul>
				</div>
				<div class="prev control"></div>
				<div class="next control"></div>
			</div>
		</section>
<script>
			$(function() {
				mini_slider('.another', 1, 295, 4, 1,250);
			})
		</script>