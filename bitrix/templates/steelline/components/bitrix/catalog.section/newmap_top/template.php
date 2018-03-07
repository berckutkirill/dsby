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
<div class="doormap_tops">
	<div class="doormap_topfive flat">
		<p class="topfive_title">Топ 5 дверей<span>для квартиры</span></p>
		<ul class="topfive_items justified_container">
			<?foreach($arResult["ITEMS"]["FLAT"] as $arItem): ?>
				<li class="topfive_item">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<div class="topfive_item_img_container justified_container">
							<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
							<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE2"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
						</div>
						<p class="topfive_item_title"><?=$arItem["NAME"]?></p>
					</a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
	<div class="doormap_topfive home">
		<p class="topfive_title">Топ 5 дверей<span>для дома</span></p>
		<ul class="topfive_items justified_container">
			<?foreach($arResult["ITEMS"]["HOME"] as $arItem): ?>
				<li class="topfive_item">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<div class="topfive_item_img_container justified_container">
							<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
							<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE2"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
						</div>
						<p class="topfive_item_title"><?=$arItem["NAME"]?></p>
					</a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
</div>