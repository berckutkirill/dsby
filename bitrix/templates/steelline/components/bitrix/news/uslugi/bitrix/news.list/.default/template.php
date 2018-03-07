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
?>
<div class="services uslugi">
	<div class="wrap clearfix">
		<h1 class="title">Услуги от дилерской сети фирменных магазинов</h1>
		<div class="clear"></div>
		<ul class="clearfix">
		<?foreach($arResult["ITEMS"] as $arItem):
		if($arItem["PROPERTIES"]["KLICKABLE"]["VALUE"] != "Y")
		{
			$NO_KLICKABLE[] = $arItem;
			continue;
		}
		if($arItem["PROPERTIES"]["UNIKUM_URL"]["VALUE"]) $arItem["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["UNIKUM_URL"]["VALUE"];
		?>
		<li>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="block">
					<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["SVG_ICON"]["VALUE"])?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
					<h3><span><?=$arItem["NAME"]?></span></h3>
					<p><?=$arItem["PREVIEW_TEXT"]?></p>
				</a>
			</li>
		<?endforeach;?>
	</ul>
	</div>
</div>
<?if($NO_KLICKABLE) {?>
<div class="uslug_stat">
			<div class="wrap clearfix">
			<?foreach($NO_KLICKABLE as $arItem):
				?>
				<div class="block">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
					<h3><?=$arItem["NAME"]?></h3>
					<p><?=$arItem["PREVIEW_TEXT"]?></p>
				</div>
			<?endforeach;?>
			</div>
		</div>
<? } ?>