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

<div class="content furn">
					<div class="clearfix">
					<?foreach($arResult["ITEMS"] as $arItem):
					if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"])
						$class = "sale";
					else
						$class = "";
					?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="cart_f <?=$class?>">
							<span class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></span>
							<span class="name"><?=$arItem["NAME"]?></span>
							<?if($arItem["MIN_PRICE"]["VALUE"]) { ?>
							<?if($arItem["MIN_PRICE"]["VALUE"] > $arItem["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
							<span class="price_old"><?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> Br</span>
							<? } ?>
							<span class="price"><?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> Br</span>
							<? } else { ?><span class="price">Входит в набор</span><? } ?>
						</a>
					<?endforeach;?>
					</div>
					<?
					if ($arParams["DISPLAY_BOTTOM_PAGER"])
						{
							?><? echo $arResult["NAV_STRING"]; ?><?
						}
					?>
				</div>