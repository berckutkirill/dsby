<?php
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
<div class="catalog_main">
    <div class="catalog_main_header justified_container">
        <h1 class="big_title catalog_main_title"><?= $arResult["NAME"] ? $arResult["NAME"] : "Каталог входных дверей"; ?></h1>

    </div>
    <div class="catalog_main_content justified_container">
        <?
        if (!empty($arResult['ITEMS'])) {
            foreach ($arResult["ITEMS"] as $arItem) {
                $offer = $arItem["OFFERS"]["0"];
                ?>
                <div class="catalog_main_content_card justified_container">

                    <a href="<?= $offer["DETAIL_PAGE_URL"] ?>" class="card_current_article_item">
                        <div class="card_current_article_item_view justified_container">
                            <? foreach ($offer["PREVIEW_PICTURES"] as $picture) { ?>
                                <p class="card_current_article_item_img">
                                    <img src="<?= $picture["BIG_SRC"] ?>" alt="<?= $picture["ALT"] ?>">
                                </p>
                            <? } ?>
                        </div>
                        <p class="card_current_article_item_descr <? if ($offer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>discounted<? } ?> justified_container">
                            <span class="card_current_article_item_name"><?= $arItem["NAME"] ?></span>
                            <span class="card_current_article_item_price">
                                <span><?= toPrice($offer["MIN_PRICE"]["VALUE"]) ?></span><?= GetMessage("BYN"); ?>
                            </span>
                            <? if ($offer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                <span class="card_current_article_item_discount_price"><?= toPrice($offer["MIN_PRICE"]["DISCOUNT_VALUE"]) ?></span>
                            <? } ?>
                        </p>
                        <ul class="card_current_article_item_lables lables">
                            <? foreach ($arItem["PROPERTIES"]["DESTINATION_ICON"] as $icon) { ?>
                                <li class="card_current_article_item_label <?= $icon["VALUE_XML_ID"] ?>"><?= $icon["VALUE"] ?></li>
                            <? } ?>
                        </ul>
                    </a>
                    <ul class="card_articles">
                        <? foreach ($arItem["OFFERS"] as $k => $offer) { ?>
                            <li class="card_article <?= $k ? "" : "active" ?><?= $offer["MIN_PRICE"]["DISCOUNT_VALUE"] ? "discounted" : ""; ?> active justified_container">
                                <? foreach ($offer["PREVIEW_PICTURES"] as $picture) { ?>
                                    <img src="<?= $picture["SRC"] ?>" alt="<?= $picture["ALT"] ?>">
                                <? } ?>
                            </li>
                        <? } ?>

                    </ul>
                </div>
                <?
            }
        }
        ?>
    </div>
</div>