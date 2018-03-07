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
<section class="carts item_c original">
			<div class="wrap">
				<h2>Похожие входные двери</h2>
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
						<li class="<?=$class?>">
							<div class="prop">
								<span <?=in_array(3, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для квартиры</i></span>
								<span <?=in_array(2, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?>><i>для дома</i></span>
								<span <?=in_array(1, $arItem["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"])?'class="active"':''?> ><i>для офиса</i></span>
							</div>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["PROPERTIES"]["NAME_FOR_CATALOG"]["VALUE"]?> <i><?=$arItem["PROPERTIES"]["NAME_EN"]["VALUE"]?></i></a>

							<? if($arItem["PROPERTIES"]["SHOW_PRICE"]["VALUE"] != "N") { ?>
								<? if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
								<span class="price_old js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price"><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> руб.</span>
								</span>
								<? } ?>

							<span class="price js_price_gen">
								<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
								<span class="old_rub js_old_denomination_price"><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> руб.</span>
							</span>
						<? } ?>
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
				mini_slider('.original', 1, 295, 4, 1,250);
			})
		</script>