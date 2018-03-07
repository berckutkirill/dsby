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
					<h1 class="title">Фурнитура и замки</h1>
				<?if(!empty($arResult["TAGS"])) {?>
					<div class="tags clearfix">
					<ul class="clearfix">
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
						<a href="" class="sort">По стоимости</a>
					</div>
	<?}?>
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
								<span class="price_old js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
									<?=toPrice($arItem["MIN_PRICE"]["VALUE"])?> руб.</span>
								</span>
								<? } ?>
								<span class="price js_price_gen">
									<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
									<span class="old_rub js_old_denomination_price">
									<?=toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"])?> руб.</span>
								</span>
								
							<? } else {  ?>
								<span class="price"> Входит в комплект </span>
							<? } ?>
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