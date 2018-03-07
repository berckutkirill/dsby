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
<div class="services">
	<div class="wrap">
		<a href="/uslugi/" class="title">Услуги от дилерской сети фирменных магазинов</a>
		<ul class="clearfix">
		<?foreach($arResult["ITEMS"] as $arItem):
			if($arItem["PROPERTIES"]["UNIKUM_URL"]["VALUE"]) $arItem["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["UNIKUM_URL"]["VALUE"];?>
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
