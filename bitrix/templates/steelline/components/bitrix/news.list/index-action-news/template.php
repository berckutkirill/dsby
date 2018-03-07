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
?>
<section class="p-home__head">
    <h1 class="p-home__title">Входные металлические двери</h1>
    <div class="p-home__info">
        <? if ($arResult["ACTION"]) { ?>
            <div class="p-home__info-item p-home__info-item--action">
                <a class="c-link-block" href="<?= $arResult["ACTION"]["DETAIL_PAGE_URL"] ?>">
                    <div class="p-home__info-title">
                        <span class="c-link"><?= substr( $arResult["ACTION"]["NAME"], 0, 45) ?></span><? if (strlen($arResult["ACTION"]["NAME"]) > 45) { ?><span class="c-link c-link--notdecor">...</span><? } ?>
                    </div>
                    <div class="p-home__info-body">
                        <span class="p-home__info-category">Акция</span><span class="p-home__info-date"><?= $arResult["ACTION"]["~PROPERTY_DATE_FOR_MAIN_VALUE"]?></span>
                    </div>
                </a>
            </div>
        <? } ?>
        <?
        foreach ($arResult["ITEMS"] as $key => $arItem) {
            ?>
            <div class="p-home__info-item">
                <a class="c-link-block" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                    <div class="p-home__info-title">
                        <span class="c-link"><?= substr($arItem["NAME"], 0, 45) ?></span><? if (strlen($arItem["NAME"]) > 45) { ?><span class="c-link c-link--notdecor">...</span><? } ?>
                    </div>
                    <div class="p-home__info-body">
                        <span class="p-home__info-category">Новость</span><span class="p-home__info-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
                    </div>
                </a>
            </div>
        <? } ?>
    </div>
</section>
