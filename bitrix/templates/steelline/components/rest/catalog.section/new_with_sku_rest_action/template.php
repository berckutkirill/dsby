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

//print_r($arResult);

if (!empty($arResult["ITEMS"])) {
    ?>
    <div class="content">

        <div class="clearfix ">
            <h2 class="title">Двери на акции</h2>
            <div class="justified_container">
                <?
                foreach ($arResult["ITEMS"] as $pos => $arItem) {
                    ?>

                    <div class = "catalog_main_content_card justified_container">
                        <div class = "card_current_article_item">
                            <a href = "<?= $arItem["OFFERS"][0]["DETAIL_PAGE_URL"] ?>" >
                                <div class = "card_current_article_item_view justified_container">
                                    <? if ($arItem["OFFERS"][0]["PREVIEW_PICTURES"]) { ?>
                                        <? foreach ($arItem["OFFERS"][0]["PREVIEW_PICTURES"] as $arPicture) { ?>
                                            <p class="card_current_article_item_img blured">
                                                <img src="<?= $arPicture["SRC"] ?>" 
                                                     alt="<?= $arPicture["ALT"] ?>" 
                                                     data-src="<?= $arPicture["BIG_SRC"] ?>">
                                            </p>
                                        <? } ?>
                                    <? } ?>
                                </div>
                            </a>
                            <a href="<?= $arItem["GENERAL_URL"] ?>">
                                <? if ($arItem["OFFERS"][0]["MIN_PRICE"]) { ?>
                                    <p class = "card_current_article_item_descr <?= $arItem["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_VALUE"] ? "discounted" : "" ?> justified_container">
                                        <span class = "card_current_article_item_name"><?= $arItem["NAME"] ?></span>
                                        <span class = "card_current_article_item_price">
                                            <span><?= number_format($arItem["OFFERS"][0]["MIN_PRICE"]["VALUE"], 1, ",", " ") ?></span> руб.</span>
                                        <span class = "card_current_article_item_discount_price"><?= number_format($arItem["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_VALUE"], 1, ",", " ") ?></span>
                                    </p>
                                <? } ?>

                                <? if ($arItem["PROPERTIES"]) { ?>
                                    <ul class = "card_current_article_item_lables lables">
                                        <? if ($arItem["PROPERTIES"]["DESTINATION_ICON"]) { ?>
                                            <? foreach ($arItem["PROPERTIES"]["DESTINATION_ICON"] as $arDectin) { ?>
                                                <li class = "card_current_article_item_label <?= $arDectin["VALUE_XML_ID"] ?>">
                                                    <?= $arDectin["VALUE"] ?>
                                                </li>
                                            <? } ?>
                                        <? } ?>
                                    </ul>
                                <? } ?>

                            </a>
                        </div>
                        <? if ($arItem["OFFERS"]) { ?>
                            <ul class = "card_articles">
                                <? foreach ($arItem["OFFERS"] as $arOffer) {
                                    ?>
                                    <li class = "card_article justified_container blured <?= $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"] ? "discount" : "" ?>"
                                        data-href = "<?= $arOffer["DETAIL_PAGE_URL"] ?>" 
                                        data-price = "<?= $arOffer["MIN_PRICE"]["VALUE"] ?>" 
                                        data-discountPrice = "<?= $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"] ?>">
                                            <? if ($arOffer["PREVIEW_PICTURES"]) { ?>
                                                <? foreach ($arOffer["PREVIEW_PICTURES"] as $arPic) { ?>  
                                                <img src = "<?= $arPic["SRC"] ?>" 
                                                     alt = "<?= $arPic["ALT"] ?>" 
                                                     data-src = "<?= $arPic["BIG_SRC"] ?>">
                                                 <? } ?>
                                             <? } ?>
                                    </li>
                                <? } ?>                          
                            </ul>
                        <? } ?>
                    </div>
                    <?
                }
            }
            ?>
            <? if (!empty($arResult["DOUBLE_DOORS"])) { ?>
                <?
                foreach ($arResult["DOUBLE_DOORS"] as $arDoubleD) {
                    foreach ($arDoubleD as $key => $arDouble) {
                        ?>
                        <div class="catalog_main_content_card double_door <?= $key % 2 == 0 ? "reverse_order" : "" ?>"> 
                            <div class="card_current_article_item justified_container">
                                <a href="<?= $arDouble["OFFERS"][0]["DETAIL_PAGE_URL"] ?>" >
                                    <div class="card_current_article_item_view justified_container">
                                        <? if ($arDouble["OFFERS"][0]["PREVIEW_PICTURES"]) { ?>
                                            <? foreach ($arDouble["OFFERS"][0]["PREVIEW_PICTURES"] as $arPictureD) { ?>
                                                <p class="card_current_article_item_img blured">
                                                    <img src="<?= $arPictureD["SRC"] ?>" 
                                                         alt="<?= $arPictureD["ALT"] ?>" 
                                                         data-src="<?= $arPictureD["BIG_SRC"] ?>">
                                                </p>
                                            <? } ?>
                                        <? } ?>
                                    </div>
                                </a>
                                <a href="<?= $arDouble["GENERAL_URL"] ?>">
                                    <div class="card_current_article_item_descr <?= $arDouble["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_VALUE"] ? "discounted" : "" ?>">
                                        <span class="card_current_article_item_name"><?= $arDouble["NAME"] ?></span>
                                        <? if ($arDouble["PROPERTIES"]) { ?>
                                            <ul class = "card_current_article_item_lables lables">
                                                <? if ($arDouble["PROPERTIES"]["DESTINATION_ICON"]) { ?>
                                                    <? foreach ($arDouble["PROPERTIES"]["DESTINATION_ICON"] as $arDectinD) { ?>
                                                        <li class = "card_current_article_item_label <?= $arDectinD["VALUE_XML_ID"] ?>">
                                                            <?= $arDectinD["VALUE"] ?>
                                                        </li>
                                                    <? } ?>
                                                <? } ?>
                                            </ul>
                                        <? } ?>
                                        <? if ($arDouble["PROPERTIES"]["PARAMETERS"]) { ?>
                                            <div class="card_current_article_item_params">
                                                <? foreach ($arDouble["PROPERTIES"]["PARAMETERS"] as $arDoubleParams) { ?>
                                                    <p class="card_current_article_item_param">
                                                        <span class="param_name"><?= $arDoubleParams["PARAMETER_NAME"] ?></span><span class="param_value"><?= $arDoubleParams["PARAMETER_VALUE"] ?></span>
                                                    </p>
                                                <? } ?>
                                            </div>
                                        <? } ?>   

                                        <? if ($arDouble["OFFERS"][0]["MIN_PRICE"]) { ?>
                                            <p class="card_current_article_item_price">
                                                <span><?= number_format($arDouble["OFFERS"][0]["MIN_PRICE"]["VALUE"], 1, ",", " ") ?></span> руб.</p>
                                            <p class="card_current_article_item_discount_price"><?= number_format($arDouble["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_VALUE"], 1, ",", " ") ?></p>
                                        <? } ?>
                                    </div>
                                </a>                
                            </div>
                            <? if ($arDouble["OFFERS"]) { ?>
                                <ul class = "card_articles">
                                    <? foreach ($arDouble["OFFERS"] as $arOfferD) {
                                        ?>
                                        <li class = "card_article justified_container blured <?= $arOfferD["MIN_PRICE"]["DISCOUNT_VALUE"] ? "discount" : "" ?>"
                                            data-href = "<?= $arOfferD["DETAIL_PAGE_URL"] ?>" 
                                            data-price = "<?= $arOfferD["MIN_PRICE"]["VALUE"] ?>" 
                                            data-discountPrice = "<?= $arOfferD["MIN_PRICE"]["DISCOUNT_VALUE"] ?>">
                                                <? if ($arOfferD["PREVIEW_PICTURES"]) { ?>
                                                    <? foreach ($arOfferD["PREVIEW_PICTURES"] as $arPicD) { ?>  
                                                    <img src = "<?= $arPicD["SRC"] ?>" 
                                                         alt = "<?= $arPicD["ALT"] ?>" 
                                                         data-src = "<?= $arPicD["BIG_SRC"] ?>">
                                                     <? } ?>
                                                 <? } ?>                                  
                                        </li>
                                    <? } ?>
                                </ul>
                            <? } ?>
                        </div>
                    <? } ?>
                <? } ?>
            </div>
        </div>
    </div>
<? } ?>
<script src="/bitrix/templates/steelline/script/blured.js"></script>

<script>

    fromBlured($('.content'));
</script>