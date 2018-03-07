<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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
$templateLibrary = array('popup');
$currencyList = '';
?>

<a href="<?= $arResult["DETAIL_PAGE_URL"] ?>" class="c-link-block p-home__banner">
    <div class="c-img__wrap">
        
        <img class="p-home__banner-img c-img blur" src="<?= $arResult["CONCEPT_PICTURE_INTERIOR_SMALL_RESIZE"] ?>" data-src-1x="<?= $arResult["CONCEPT_PICTURE_INTERIOR_SMALL"] ?>" data-src-2x="<?= $arResult["CONCEPT_PICTURE_INTERIOR_BIG"] ?>"/>

        <div class="p-home__banner-tile">
            <svg class="p-home__banner-tile-edge" width="18" height="18" viewBox="0 0 18 18" version="1.1" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink">
                <path fill="#ffedc8" d="M 0 18L 18 18L 18 17C 8.61116 17 1 9.38884 1 0L 0 0L 0 18Z"></path>
            </svg>
            <svg class="p-home__banner-tile-edge" width="18" height="18" viewBox="0 0 18 18" version="1.1" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink">
                <path fill="#ffedc8" d="M 0 18L 18 18L 18 17C 8.61116 17 1 9.38884 1 0L 0 0L 0 18Z"></path>
            </svg>
            <svg class="p-home__banner-tile-edge" width="18" height="18" viewBox="0 0 18 18" version="1.1" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink">
                <path fill="#ffedc8" d="M 0 18L 18 18L 18 17C 8.61116 17 1 9.38884 1 0L 0 0L 0 18Z"></path>
            </svg>
            <svg class="p-home__banner-tile-edge" width="18" height="18" viewBox="0 0 18 18" version="1.1" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink">
                <path fill="#ffedc8" d="M 0 18L 18 18L 18 17C 8.61116 17 1 9.38884 1 0L 0 0L 0 18Z"></path>
            </svg>
            <div class="p-home__banner-tile-wrap">
                <div class="p-home__banner-tile-main">
                    <div class="p-home__banner-tile-body">
                        <span class="c-h3 c-h3--small c-link"><?= $arResult["NAME"] ?></span>
                        <p class="c-p3 c-p3--small p-home__banner-tile-desc"><?= $arResult["DESTINATION_ICON"] ?></p>
                    </div>
                    <? if ($arResult["PRICE"]) { ?>
                        <div class="p-home__banner-tile-foot c-h4">
                            <?
                            $sale = ($arResult["DISCOUNT_DIFF"] != 0) ? true : false;
                            ?>
                            <p class="c-price <?= $sale ? "c-price--old" : "" ?>"><?= $sale ? $arResult["PRICE"] : $arResult["DISCOUNT_PRICE"] ?> руб.</p>
                            <? if ($sale) { ?>
                                <p class="c-price c-price--new"><?= $arResult["DISCOUNT_PRICE"] ?> руб.</p>
                            <? } ?>
                        </div>
                    <? } ?>
                </div>
                <div class="p-home__banner-tile-aside">
                    <div class="p-home__banner-tile-door">
                        <img class="p-home__banner-tile-img" src="<?= $arResult["PICTURE_WITHIN_BIG"] ?>" srcset="<?= $arResult["PICTURE_WITHIN_SMALL"] ?> 1x, <?= $arResult["PICTURE_WITHIN_BIG"] ?> 2x"/>
                    </div>
                    <div class="p-home__banner-tile-door">
                        <img class="p-home__banner-tile-img" src="<?= $arResult["PICTURE_OUTSIDE_BIG"] ?>" srcset="<?= $arResult["PICTURE_OUTSIDE_SMALL"] ?> 1x, <?= $arResult["PICTURE_OUTSIDE_BIG"] ?> 2x"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>