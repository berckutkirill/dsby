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
<section class="p-home-samples">
    <?
    $i = 0;
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        ?>
        <? if ($i == 0 || !$key) { ?>
            <div class="p-home-samples__item">
            <? } ?>

            <div class="p-home-samples__body">
                <a class="c-link-block" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                    <span class="p-home-samples__title <?= !$key ? "c-h2" : "c-h4" ?> c-link"><?= $arItem["NAME"] ?></span>
                    <span class="p-home-samples__date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
                </a>
            </div>

            <? if ($i == 1 || !$key) { ?>
            </div>
        <? } ?>

        <?
        if ($key && $i == 0) {
            $i++;
        } elseif ($key && $i == 1) {
            $i = 0;
        }
    } ?>
</section>