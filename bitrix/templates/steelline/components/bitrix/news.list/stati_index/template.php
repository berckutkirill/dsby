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
<section class="articles">
			<div class="wrap">
				<a href="/poleznaya-informaciya/" class="title">Полезная информация о входных дверях</a>
				<div class="clear"></div>
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<div class="block">

					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img">
						<i class="shad"></i><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
					</a>
					<span class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["NAME"]?></a>
					<p><?=$arItem["PREVIEW_TEXT"]?></p>
				</div>
				<?endforeach;?>
			</div>
		</section>