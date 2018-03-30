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
//print_r($arResult);
$this->setFrameMode(true);
$doubles = $arResult["PROPERTIES"]["DOUBLE"]["VALUE"] ? true : false;

$sklad = $arResult["PROPERTIES"]["CONCEPT_IN_STOCK"]["VALUE"] == "yes" ? true : false;
?>
<? if ($arResult["ID"] == 3803) { ?>
    <style>
        @font-face {
            font-family: 'Helvetica';
            src: url('<?= SITE_TEMPLATE_PATH ?>/fonts/HelveticaNeue.woff2') format('woff2'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/HelveticaNeue.woff') format('woff'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/HelveticaNeue.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Helvetica-Bold';
            src: url('<?= SITE_TEMPLATE_PATH ?>/fonts/HelveticaNeue-CondensedBold.woff2') format('woff2'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/HelveticaNeue-CondensedBold.woff') format('woff'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/HelveticaNeue-CondensedBold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
    </style>
    <?
}
?>
<? if ($arResult["ID"] == 3794) { ?>
    <style>
        @font-face {
            font-family: 'Raleway';
            src: url('<?= SITE_TEMPLATE_PATH ?>/fonts/Raleway-Medium.woff2') format('woff2'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/Raleway-Medium.woff') format('woff'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/Raleway-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'Raleway';
            src: url('<?= SITE_TEMPLATE_PATH ?>/fonts/Raleway-Bold.woff2') format('woff2'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/Raleway-Bold.woff') format('woff'),
                url('<?= SITE_TEMPLATE_PATH ?>/fonts/Raleway-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
    </style>
<? } ?>

<div class="<?= $sklad ? "p-doorsl" : "" ?> c-concept <?= $doubles ? "c-concept--fields" : "" ?>">

    <? if (!$sklad) {
        ?>
        <section class="c-concept-section">
            <div class="c-banner"><img class="c-banner__img" src="<?= $arResult["CONCEPT_PICTURE_INTERIOR_BIG"] ?>" srcset='<?= $arResult["CONCEPT_PICTURE_INTERIOR_SMALL"] ?> 1x, <?= $arResult["CONCEPT_PICTURE_INTERIOR_BIG"] ?> 2x'/>
                <div class="c-banner__panel">
                    <div class="c-banner__panel-main">
                        <div class="c-banner__panel-head">
                            <h1 class="c-banner__panel-title c-h1 c-h1--small"><?= $arResult["NAME"] ?></h1>
                            <div class="c-banner__panel-price">
                                <?
                                $sale = ($arResult["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_DIFF"] != 0) ? true : false;
                                ?>
                                <h3 class="c-h3 c-price <?= $sale ? "c-price--old" : "" ?> "><?= $sale ? $arResult["OFFERS"][0]["MIN_PRICE"]["VALUE"] : $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></h3>
                                <? if ($sale) { ?>
                                    <h3 class="c-h3 c-price c-price--new"><?= $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></h3>
                                <? } ?>
                            </div>
                            <p class = "c-p1 c-p1--small"><?= $arResult["DESTINATION_ICON"] ?></p>
                        </div>
                        <? if ($arResult["ALL_SALONS"]) { ?>                 
                            <div class="c-banner__panel-desc">
                                <h4 class="c-h4 c-h4--small c-banner__panel-desc-title">Посмотрите образец в салоне:</h4>
                                <p class="c-p2"><?= $arResult["ALL_SALONS"] ?></p>
                            </div>
                        <? } ?>
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/element-concept-banner-phone.php"
                                )
                        );
                        ?>
                        <div class="c-banner__panel-desc">
                            <p class="c-p2">
                                <a class="c-link" href="/uslugi/zamer/">Бесплатный замер</a> проёма, условия <a class="c-link" href="/dostavka-i-ustanovka/">доставки двери</a>, гарантия 2 года. Возможна  
								<a class="c-link" href="/oplata/kartoi-rassrochki/">рассрочка</a> под 0%. Действует постоянная <a class="c-link" href="/clientu/politika-skidok/">система скидок.</a></p>
                        </div>
                        <div class="c-banner__panel-foot"><a class="c-banner__panel-foot-link" href="<?= $arResult["OFFERS"][0]["BUY_URL"] ?>">
                                <button class="c-banner__panel-foot-but c-king-but" type="button">Заказать замер</button></a></div>
                    </div>
                </div>
            </div>
        </section>
    <? }
    ?>

    <div class="c-wrapper">
        <? if ($sklad) { ?>
            <section class="p-doorsl-section">
                <div class="c-doorsl-repository">
                    <div class="c-doorsl-repository__head">
                        <h1 class="c-doorsl-repository__title"><?= $arResult["NAME"] ?> <span class="c-gold">на складе</span></h1>
                        <p class="c-p3 c-doorsl-repository__caption"><?= $arResult["DESTINATION_ICON"] ?></p>
                    </div>
                    <div class="c-doorsl-repository__main c-flip-wrap c-gallery-wrap">
                        <div class="c-doorsl-repository__body">
                            <div class="c-doorsl-repository__content">

                                <div class="c-doorsl-repository__char-wrap">
                                    <div class="c-doorsl-repository__char">
                                        <p class="c-doorsl-repository__char-head c-h4">Характеристики,&nbsp;мм</p>
                                        <div class="c-doorsl-repository__char-item">
                                            <p class="c-doorsl-repository__char-title c-doorsl-repository__char-title--bold">Толщина</p>
                                            <p class="c-doorsl-repository__char-value"></p>
                                        </div>
                                        <?
                                        $need_thin = ["CHARAKTER_CONST_THICKNESS_METAL_MAIN", "CHARAKTER_CONST_THICKNESS_CLOTH", "CHARAKTER_CONST_THICKNESS_BOX"];
                                        $need_opt = ["CHARAKTER_CONST_HEIGHT_MAIN", "CHARAKTER_CONST_WIDTH_MAIN"];
                                        $replace = ["Толщина", "толщина"];
                                        foreach ($arResult["PROPERTIES"] as $key => $prop) {
                                            if (in_array($key, $need_opt)) {
                                                $proops[] = $prop;
                                            } elseif (!in_array($key, $need_thin)) {
                                                continue;
                                            } else {
                                                ?>
                                                <div class="c-doorsl-repository__char-item">
                                                    <p class="c-doorsl-repository__char-title"><?= str_replace($replace, "", $prop["NAME"]) ?></p>
                                                    <p class="c-doorsl-repository__char-value"><?= $prop["VALUE"] ?></p>
                                                </div>
                                                <?
                                            }
                                        }
                                        if ($proops) {
                                            foreach ($proops as $val) {
                                                ?>
                                                <div class="c-doorsl-repository__char-item">
                                                    <p class="c-doorsl-repository__char-title c-doorsl-repository__char-title--bold"><?= $val["NAME"] ?></p>
                                                    <p class="c-doorsl-repository__char-value"><?= $val["VALUE"] ?></p>
                                                </div>
                                                <?
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="c-doorsl-repository__desc-wrap">
                                    <div class="c-doorsl-repository__desc">
                                        <p class="c-p3 c-p3--small">Снаружи</p>
                                        <h3 class="c-h4 c-doorsl-repository__desc-title"><?= $arResult["PROPERTIES"]["CONCEPT_TITLE_EXTERIOR"]["~VALUE"] ?>
                                            <div class="c-doorsl-repository__arrow c-flip__title c-flip__title--active">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="19" viewBox="0 0 14 19">
                                                <defs>
                                                <path id="q" d="M0 19V0h14v19z"></path>
                                                </defs>
                                                <g fill="none" fill-rule="evenodd">
                                                <mask id="w" fill="#fff">
                                                    <use xlink:href="#q"></use>
                                                </mask>
                                                <path fill="#009D4C" d="M0 10.298C.737 13.182 1.895 16.322 3.79 19h1.105C7.579 12.41 10.474 6.436 14 .772L13.053 0C9.947 3.862 6.316 9.99 4.158 14.88c-.947-1.39-2.105-3.552-2.947-5.2L0 10.298" mask="url(#w)"></path>
                                                </g>
                                                </svg>
                                            </div>
                                        </h3>
                                        <p class="c-p3"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_EXTERIOR"]["~VALUE"] ?></p>
                                    </div>
                                    <div class="c-doorsl-repository__desc">
                                        <p class="c-p3 c-p3--small">Внутри</p>
                                        <h3 class="c-h4 c-doorsl-repository__desc-title"><?= $arResult["PROPERTIES"]["CONCEPT_TITLE_INTERIOR"]["~VALUE"] ?>
                                            <div class="c-doorsl-repository__arrow c-flip__title">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="19" viewBox="0 0 14 19">
                                                <defs>
                                                <path id="qq" d="M0 19V0h14v19z"></path>
                                                </defs>
                                                <g fill="none" fill-rule="evenodd">
                                                <mask id="ww" fill="#fff">
                                                    <use xlink:href="#qq"></use>
                                                </mask>
                                                <path fill="#009D4C" d="M0 10.298C.737 13.182 1.895 16.322 3.79 19h1.105C7.579 12.41 10.474 6.436 14 .772L13.053 0C9.947 3.862 6.316 9.99 4.158 14.88c-.947-1.39-2.105-3.552-2.947-5.2L0 10.298" mask="url(#ww)"></path>
                                                </g>
                                                </svg>
                                            </div>
                                        </h3>
                                        <p class="c-p3"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_INTERIOR"]["~VALUE"] ?></p>
                                    </div>
                                    <p class="c-doorsl-repository__dtitle c-gallery__title"><?= $arResult["OFFERS"][0]["PROPERTIES"]["DECOR_ARTICLE"]["~VALUE"] ?></p>
                                </div>
                            </div>
                            <div class="c-doorsl-repository__gallery">
                                <div class="c-gallery">
                                    <div class="c-gallery__view">
                                        <div class="c-flip">
                                            <div class="c-flip__main">
                                                <img class="c-flip__side c-gallery__view-img" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>"/>
                                                <img class="c-flip__side c-gallery__view-img" src="<?= CFile::GetPath($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]) ?>"/>                                      
                                            </div>
                                            <div class="c-gallery__prev">
                                                <div class="c-gallery__arrow c-gallery__arrow--prev"></div>

                                            </div>
                                            <div class="c-gallery__next">
                                                <div class="c-gallery__arrow c-gallery__arrow--next"></div>

                                            </div>
                                            <div class="c-trigger">
                                                <div class="c-trigger__main">
                                                    <div class="c-trigger__body">
                                                        <svg class="c-trigger__svg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                        <path class="c-trigger__svg-path" fill="#006695" fill-rule="nonzero" d="M25.608 4.397a14.995 14.995 0 0 1 3.25 16.342A15.007 15.007 0 0 1 15 30v-3.75c4.56.011 8.677-2.73 10.424-6.941a11.246 11.246 0 0 0-2.452-12.278l-3.076 3.075a.661.661 0 0 1-1.13-.468v-8.7c0-.518.42-.938.938-.938h8.708a.661.661 0 0 1 .469 1.13l-3.273 3.267zM15 3.75V0A15.007 15.007 0 0 0 1.142 9.26a14.995 14.995 0 0 0 3.25 16.343l-3.24 3.24A.68.68 0 0 0 1.62 30h8.69c.517 0 .937-.42.937-.938v-8.671a.68.68 0 0 0-1.158-.47L7.028 22.97A11.246 11.246 0 0 1 4.576 10.69 11.255 11.255 0 0 1 15 3.75z"></path>
                                                        </svg><span class="c-trigger__caption">Отделка 
                                                            <p class="c-trigger__caption-variable">внутри</p>
                                                            <p class="c-trigger__caption-variable">снаружи</p></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="c-doorsl-repository__info">
                                <div class="c-doorsl-repository__info-head">
                                    <div class="c-doorsl-repository__panel">
                                        <?
                                        $sale = ($arResult["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_DIFF"] != 0) ? true : false;
                                        ?>
                                        <div class="c-doorsl-repository__panel-price">
                                            <p class="c-h3 c-price <?= $sale ? "c-price--old c-gallery__price-old" : "c-gallery__price" ?>"><?= $sale ? $arResult["OFFERS"][0]["MIN_PRICE"]["VALUE"] : $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></p>
                                            <? if ($sale) { ?>
                                                <p class="c-h3 c-price c-gallery__price-new c-price--new"><?= $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></p>
                                            <? } ?>
                                        </div>                                    

                                        <?
                                        $APPLICATION->IncludeComponent(
                                                "bitrix:main.include", "", Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "SKLAD" => "Y",
                                            "PATH" => "/include/element-concept-banner-phone.php"
                                                )
                                        );
                                        ?>
                                        <div class="c-doorsl-repository__panel-desc">
                                            <p class="c-p2">
                                                <a class="c-link" href="/uslugi/zamer/">Бесплатный замер</a>
                                                проёма, условия <a class="c-link" href="/dostavka-i-ustanovka/">доставки двери</a>, гарантия 2 года. Возможна <a class="c-link" href="/oplata/kartoi-rassrochki/">рассрочка</a> под 0%. Действует постоянная <a class="c-link" href="/clientu/politika-skidok/">система скидок.</a></p>
                                        </div>
                                        <a href="<?= $arResult["OFFERS"][0]["BUY_URL"] ?>" class="c-doorsl-repository__link c-gallery__link">
                                            <button class="c-king-but c-doorsl-repository__but">Заказать замер</button>
                                        </a>              
                                    </div>
                                    <? if (!empty($arResult["SALONS"])) { ?>
                                        <div class="c-doorsl-repository__links">
                                            <p class="c-h4 c-h4--small">Дверь установлена в салоне:</p>
                                            <div class="c-doorsl-repository__links-body">
                                                <ul class="c-link-list">
                                                    <? foreach ($arResult["SALONS"] as $salon) { ?>
                                                        <li class="c-link-list__item">
                                                            <a class="c-link-list__link c-link-block" href="<?= $salon["LINK"] ?>">
                                                                <span class="c-link-list__text c-link"><?= $salon["NAME"] ?></span>
                                                            </a>
                                                        </li>
                                                    <? } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                                <div class="c-doorsl-repository__info-foot">                                                                 
                                    <?
                                    $APPLICATION->IncludeComponent(
                                            "bitrix:main.include", "", Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/include/element-sklad-banner-factoid.php"
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="c-doorsl-repository__foot">
                            <div class="c-gallery__preview">
                                <ul class="c-gallery__preview-list">
                                    <?
                                    foreach ($arResult["OFFERS"] as $key => $arOffer) {
                                        $saleOff = ($arOffer["MIN_PRICE"]["DISCOUNT_DIFF"] != 0) ? true : false;
                                        ?>
                                        <li class="c-gallery__preview-item <?= !$key ? "c-gallery__preview-item--active" : "" ?>" 
                                            data-href="<?= $arOffer["BUY_URL"] ?>"
                                            data-src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>, <?= CFile::GetPath($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]) ?>"
                                            data-title="<?= $arOffer["PROPERTIES"]["DECOR_ARTICLE"]["~VALUE"] ?>"
                                            data-price="<?= $saleOff ? $arOffer["MIN_PRICE"]["VALUE"] : $arOffer["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>"
                                            <? if ($saleOff) { ?>
                                                data-discount="<?= $arOffer["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>"
                                            <? } ?>
                                            >
                                            <img class="c-gallery__preview-img" src="<?= $arOffer["PICTURE_WITHIN_SMALL"] ?>"/>
                                            <img class="c-gallery__preview-img" src="<?= $arOffer["PICTURE_OUTSIDE_SMALL"] ?>"/>
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="c-concept-section">
                <div class="c-block-section">
                    <img class="c-block-section__img" src="<?= $arResult["CONCEPT_PICTURE_INTERIOR_BIG"] ?>" srcset="<?= $arResult["CONCEPT_PICTURE_INTERIOR_SMALL"] ?> 1x, <?= $arResult["CONCEPT_PICTURE_INTERIOR_BIG"] ?> 2x"/>
                    <div class="c-block-section__main-wrap">
                        <div class="c-block-section__main">
                            <? if ($arResult["PROPERTIES"]["CONCEPT_TEXT_1_INTERIOR"]["VALUE"] || $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_1_INTERIOR"]["VALUE"]) { ?>
                                <div class="c-block-section__head">
                                    <h2 class="c-block-section__head-title c-h2 c-h2--small"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_1_INTERIOR"]["VALUE"] ?></h2>
                                    <p class="c-p2"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_1_INTERIOR"]["VALUE"] ?></p>
                                </div>
                            <? } ?>
                            <? if ($arResult["PROPERTIES"]["CONCEPT_TEXT_2_INTERIOR"]["VALUE"] || $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_2_INTERIOR"]["VALUE"]) { ?>
                                <div class="c-block-section__desc">
                                    <h4 class="c-block-section__desc-title c-h4"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_2_INTERIOR"]["VALUE"] ?></h4>
                                    <p class="c-p2"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_2_INTERIOR"]["VALUE"] ?></p>
                                </div>
                            <? } ?>
                            <? if ($arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_3_INTERIOR"]["VALUE"] || $arResult["PROPERTIES"]["CONCEPT_TEXT_3_INTERIOR"]["VALUE"]) { ?>
                                <div class="c-block-section__desc">
                                    <h4 class="c-block-section__desc-title c-h4"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_TITLE_3_INTERIOR"]["VALUE"] ?></h4>
                                    <p class="c-p2"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_3_INTERIOR"]["VALUE"] ?></p>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </section>
        <? } else { ?>

            <section class="c-concept-section">
                <div class="c-block-description">
                    <div class="c-block-description__aside">
                        <div class="c-trigger c-flip">
                            <div class="c-flip__main">
                                <img class="c-flip__side <?= $doubles ? "flip-fields-big" : "" ?>" src="<?= $arResult["DOORS"]["WITHIN"]["BIG"] ?>" srcset="<?= $arResult["DOORS"]["WITHIN"]["SMALL"] ?> 1x, <?= $arResult["DOORS"]["WITHIN"]["BIG"] ?> 2x"/>
                                <img class="c-flip__side <?= $doubles ? "flip-fields" : "" ?>" src="<?= $arResult["DOORS"]["OUTSIDE"]["BIG"] ?>" srcset="<?= $arResult["DOORS"]["OUTSIDE"]["SMALL"] ?> 1x, <?= $arResult["DOORS"]["OUTSIDE"]["BIG"] ?> 2x"/>
                            </div>
                            <div class="c-trigger__main">
                                <div class="c-trigger__body">
                                    <svg class="c-trigger__svg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                    <path class="c-trigger__svg-path" fill="#006695" fill-rule="nonzero" d="M25.608 4.397a14.995 14.995 0 0 1 3.25 16.342A15.007 15.007 0 0 1 15 30v-3.75c4.56.011 8.677-2.73 10.424-6.941a11.246 11.246 0 0 0-2.452-12.278l-3.076 3.075a.661.661 0 0 1-1.13-.468v-8.7c0-.518.42-.938.938-.938h8.708a.661.661 0 0 1 .469 1.13l-3.273 3.267zM15 3.75V0A15.007 15.007 0 0 0 1.142 9.26a14.995 14.995 0 0 0 3.25 16.343l-3.24 3.24A.68.68 0 0 0 1.62 30h8.69c.517 0 .937-.42.937-.938v-8.671a.68.68 0 0 0-1.158-.47L7.028 22.97A11.246 11.246 0 0 1 4.576 10.69 11.255 11.255 0 0 1 15 3.75z"></path>
                                    </svg>
                                    <span class="c-trigger__caption">Отделка 
                                        <p class="c-trigger__caption-variable">внутри</p>
                                        <p class="c-trigger__caption-variable">снаружи</p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-block-description__main">
                        <div class="c-block-description__body">
                            <div class="c-block-description__desc">
                                <p class="c-p3 c-p3--small">Снаружи</p>
                                <h3 class="c-h3 c-block-description__desc-title"><?= $arResult["PROPERTIES"]["CONCEPT_TITLE_EXTERIOR"]["~VALUE"] ?>
                                    <div class="c-block-description__arrow c-block-description__arrow--active">
                                        <svg class="c-block-description__arrow-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="28" viewBox="0 0 20 28">
                                        <defs>
                                        <path id="aaa" d="M0 27.635V0h19.929v27.635z"></path>
                                        </defs>
                                        <g fill="none" fill-rule="evenodd" transform="translate(0 .234)">
                                        <mask id="bbb" fill="#fff">
                                            <use xlink:href="#aaa"></use>
                                        </mask>
                                        <path fill="#009d4c" d="M0 14.984c1.049 4.196 2.697 8.766 5.394 12.662h1.574c3.82-9.59 7.941-18.28 12.961-26.522L18.58 0C14.16 5.62 8.99 14.534 5.92 21.652c-1.349-2.023-2.997-5.17-4.196-7.567l-1.723.9" mask="url(#bbb)"></path>
                                        </g>
                                        </svg>
                                    </div>
                                </h3>
                                <p class="c-p1"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_EXTERIOR"]["~VALUE"] ?></p>
                            </div>
                            <div class="c-block-description__desc">
                                <p class="c-p3 c-p3--small">Внутри</p>
                                <h3 class="c-h3 c-block-description__desc-title"><?= $arResult["PROPERTIES"]["CONCEPT_TITLE_INTERIOR"]["~VALUE"] ?>
                                    <div class="c-block-description__arrow">
                                        <svg class="c-block-description__arrow-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="28" viewBox="0 0 20 28">
                                        <defs>
                                        <path id="aa" d="M0 27.635V0h19.929v27.635z"></path>
                                        </defs>
                                        <g fill="none" fill-rule="evenodd" transform="translate(0 .234)">
                                        <mask id="bb" fill="#fff">
                                            <use xlink:href="#aa"></use>
                                        </mask>
                                        <path fill="#009d4c" d="M0 14.984c1.049 4.196 2.697 8.766 5.394 12.662h1.574c3.82-9.59 7.941-18.28 12.961-26.522L18.58 0C14.16 5.62 8.99 14.534 5.92 21.652c-1.349-2.023-2.997-5.17-4.196-7.567l-1.723.9" mask="url(#bb)"></path>
                                        </g>
                                        </svg>
                                    </div>
                                </h3>
                                <p class="c-p1"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_INTERIOR"]["~VALUE"] ?></p>
                            </div>
                        </div>

                        <div class="c-block-description__foot">
                            <div class="c-block-description__char">
                                <h3 class="c-h3 c-block-description__char-head">Характеристики,&nbsp;мм</h3>

                                <ul class="c-block-description__char-item">
                                    <li class="c-h4 c-block-description__char-title c-block-description__char-title--bold">Толщина</li>
                                    <li></li>
                                </ul>
                                <?
                                $need_thin = ["CHARAKTER_CONST_THICKNESS_METAL_MAIN", "CHARAKTER_CONST_THICKNESS_CLOTH", "CHARAKTER_CONST_THICKNESS_BOX"];
                                $need_opt = ["CHARAKTER_CONST_HEIGHT_MAIN", "CHARAKTER_CONST_WIDTH_MAIN"];
                                $replace = ["Толщина", "толщина"];
                                foreach ($arResult["PROPERTIES"] as $key => $prop) {
                                    if (in_array($key, $need_opt)) {
                                        $proops[] = $prop;
                                    } elseif (!in_array($key, $need_thin)) {
                                        continue;
                                    } else {
                                        ?>
                                        <ul class="c-block-description__char-item">
                                            <li class="c-p2 c-block-description__char-title"><?= str_replace($replace, "", $prop["NAME"]) ?></li>
                                            <li class="c-p2 c-block-description__char-value"><?= $prop["VALUE"] ?></li>
                                        </ul>
                                        <?
                                    }
                                }
                                if ($proops) {
                                    foreach ($proops as $val) {
                                        ?>

                                        <ul class="c-block-description__char-item">
                                            <li class="c-h4 c-block-description__char-title c-block-description__char-title--bold"><?= $val["NAME"] ?></li>
                                            <li class="c-p2 c-block-description__char-value"><?= $val["VALUE"] ?></li>
                                        </ul>

                                        <?
                                    }
                                }
                                ?>

                            </div>
                            <? if ($arResult["PROPERTIES"]["CONCEPT_SORTING_DESING_HTML"]["VALUE"]) { ?>
                                <div class="c-block-description__designer">
                                    <img class="c-block-description__designer-img" src="<?= $arResult["CONCEPT_PHOTO_PROFESSIONAL"]["BIG"] ?>" srcset="<?= $arResult["CONCEPT_PHOTO_PROFESSIONAL"]["SMALL"] ?> 1x, <?= $arResult["CONCEPT_PHOTO_PROFESSIONAL"]["BIG"] ?> 2x"/>

                                    <div class="c-block-description__designer-body c-p2"><p class="c-ps-link c-block-description__designer-link">Мнение профессионала ↓</p>
                                        <p><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_PROFESSIONAL"]["VALUE"] ?></p>
                                    </div>

                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </section>
        <? } ?>
        <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>

            <section class="c-concept-section <?= $arItem["CODE"] == "CONCEPT_SORTING_DESING_HTML" ? "c-concept-engstyle__wrap" : "" ?>">
                <?
                if ($arItem["CODE"]) {
                    if ($arItem["CODE"] == "CONCEPT_SORTING_DESING_HTML") {
                        echo $arItem["TEXT"];
                    } elseif ($arItem["CODE"] == "CONCEPT_MANAGER_HAND") {
                        ?>                   
                        <div class="c-block-section">
                            <img class="c-block-section__img" src="<?= $arItem["PICTURE_BIG"] ?>" srcset="<?= $arItem["PICTURE_SMALL"] ?> 1x, <?= $arItem["PICTURE_BIG"] ?> 2x"/>
                            <div class="c-block-section__main-wrap">
                                <div class="c-block-section__main">
                                    <?
                                    for ($i = 1; $i < 4; $i++) {
                                        ?>
                                        <div class="c-block-section__<?= $i == 1 ? "head" : "desc" ?>">
                                            <? if ($i == 1) { ?>
                                                <h2 class="c-block-section__head-title c-h2 c-h2--small"><?= $arItem["TITLE_TEXT_" . $i] ?></h2>
                                            <? } else { ?>
                                                <h4 class="c-block-section__desc-title c-h4"><?= $arItem["TITLE_TEXT_" . $i] ?></h4>
                                            <? }
                                            ?>
                                            <p class="c-p2"><?= $arItem["TEXT_" . $i] ?></p>
                                        </div>
                                    <? } ?>                                 
                                </div>
                            </div>
                        </div>
                        <?
                    } elseif ($arItem["CODE"] == "CONCEPT_SORTING_ENTR") {
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/element-entr.php"
                                )
                        );
                    } elseif ($arItem["CODE"] == "CONCEPT_SORTING_CONSULTATNT") {
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "SKLAD" => $sklad ? "Y" : "N",
                            "PATH" => "/include/element-consultant.php"
                                )
                        );
                    }
                } else {
                    ?>
                    <div class="c-block c-block<?= $arItem["CONCEPT_MIRROR"] == "yes" ? "--reverse" : "" ?>">
                        <div class="c-block__logo">
                            <img class="c-block__logo-img" src="<?= $arItem["CONCEPT_PICTURE_BIG"] ?>" srcset="<?= $arItem["CONCEPT_PICTURE_SMALL"] ?> 1x, <?= $arItem["CONCEPT_PICTURE_BIG"] ?> 2x"/>
                        </div>

                        <div class="c-block__aside">
                            <div class="c-block__desc">
                                <? if ($arItem["CONCEPT_TITLE_TEXT_1"]) { ?>
                                    <div class="c-block__desc-item">
                                        <h2 class="c-block__desc-bigtitle c-h2 c-h2--small"><?= $arItem["CONCEPT_TITLE_TEXT_1"] ?></h2>
                                        <p class="c-p2"><?= $arItem["CONCEPT_TEXT_TITLE_TEXT_1"] ?></p>
                                    </div>
                                <? } ?>
                                <? if ($arItem["CONCEPT_TITLE_FACTOID"]) { ?>
                                    <div class="c-block__desc-item">
                                        <div class="c-fct">
                                            <p class="c-fct__title c-h-fct"><?= $arItem["CONCEPT_TITLE_FACTOID"] ?></p>
                                            <span class="c-fct__caption c-p3 c-p3--small"><?= $arItem["CONCEPT_TEXT_FACTOID"] ?></span>
                                        </div>
                                    </div>
                                <? } ?>
                                <? if ($arItem["CONCEPT_TITLE_TEXT_2"]) { ?>
                                    <div class="c-block__desc-item">
                                        <h4 class="c-block__desc-title c-h4"><?= $arItem["CONCEPT_TITLE_TEXT_2"] ?></h4>
                                        <p class="c-p2"><?= $arItem["CONCEPT_TEXT_TITLE_TEXT_2"] ?></p>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                <? } ?> 
            </section>
        <? } ?>
        <? if (!$sklad) { ?>
            <? if ($arResult["ID"] != 3764 && $arResult["ID"] != 3939) { ?>
                <section class="c-concept-section">
                    <div class="c-block-locks">
                        <h2 class="c-block-locks__title"><span>Под заказ</span> замки и доборы</h2>
                        <div class="c-block-locks__main">
                            <? if ($arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"]["VALUE"]) {

                                ?>
                                <div class="c-block-locks__tabs">
                                    <section class="c-tabs">
                                        <?
                                        $APPLICATION->IncludeComponent(
                                                "bitrix:main.include", ".default", array(
                                            "AREA_FILE_SHOW" => "file",
                                            "SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
                                            "AREA_FILE_SUFFIX" => "inc",
											"COMPLECT" => $arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST_IN_COMPLECT"]['VALUE_XML_ID'],
                                            "TABS" => $arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"],
                                            "EDIT_TEMPLATE" => "",
                                            "COMPONENT_TEMPLATE" => ".default",
                                            "PATH" => "/include/element_locks_concept.php"
                                                ), false
                                        );
                                        ?>
                                    </section>
                                </div>
                            <? } ?>
                            <div class="c-block-locks__dob">
                                <ul class="c-block-locks__dob-list">
                                    <li class="c-block-locks__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="166" height="54" viewBox="0 0 166 54">
                                        <g fill="none" fill-rule="nonzero">
                                        <path fill="#000" d="M136.764 29.683h12.433V6.296h15.985v41.376h-20.425v-3.598h-2.665v-3.598h-2.664v-8.095h-2.664z" opacity=".15"></path>
                                        <path fill="#292E31" d="M165.182 0v3.598h-18.65v23.386h-3.551V0h22.201zM.888 0v3.598h18.65v23.386h3.552V0H.888z"></path>
                                        <path fill="#000" d="M16.873 6.296v23.387h12.434v2.698h-2.665v8.095h-2.664v3.598h-3.552v3.598H.888V6.296z" opacity=".15"></path>
                                        <path fill="#000" d="M25.78 45.873v-3.598h2.685V35.08h109.148v7.196h2.684v3.598h2.684v1.799H35.62v2.698h10.737c.854.069 1.389.648 1.79.9-.401 1.22-.936 1.799-1.79 1.799h-11.63c-1.162 0-1.94-.79-1.79-1.8v-3.597H22.202v-1.799h3.579z" opacity=".15"></path>
                                        </g>
                                        <p class="c-h4">Прямой добор</p>
                                        </svg>
                                    </li>
                                    <li class="c-block-locks__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="166" height="54" viewBox="0 0 166 54">
                                        <g fill="none" fill-rule="nonzero">
                                        <path fill="#292E31" d="M.706 0h22.196v23.37h6.222v2.715h-9.751l-.024-22.496H.706V0zM165 0h-22.197v23.37h-6.221v2.715h9.75l.025-22.496H165V0z"></path>
                                        <path fill="#000" d="M16.691 6.296v22.487h12.433v2.698H26.46v8.995h-2.664v3.598h-3.553v3.598H.706V6.296H16.69zm132.324 0v22.487h-12.433v2.698h2.664v8.995h2.664v3.598h3.552v3.598H165V6.296h-15.985z" opacity=".15"></path>
                                        <path fill="#000" d="M25.598 43.175h2.684V34.18h109.149v8.095h2.683v3.598h2.684v1.799H35.44v1.799h10.736c.64.06 1.174.641.894 1.799.28.32-.254.9-.894.9h-11.63c-1.267 0-1.996-.792-1.79-1.8v-2.698H22.02v-1.799h3.58v-2.698z" opacity=".15"></path>
                                        </g>
                                        <p class="c-h4">Г-образный</p>
                                        </svg>
                                    </li>
                                    <li class="c-block-locks__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="166" height="54" viewBox="0 0 166 54">
                                        <g fill="none" fill-rule="nonzero">
                                        <g fill="#D9D9D9">
                                        <path d="M15.965 6.883v22.592h12.417v2.711h-2.66v9.037H23.06v3.615h-3.547v3.614H0V6.883zM148.12 6.883v22.592h-12.418v2.711h2.66v9.037h2.662v3.615h3.547v3.614H164.084V6.883z"></path>
                                        <path d="M24.86 43.934h2.681v-9.037H136.55v8.133h2.68v3.615h2.681v1.807H34.69v1.808H45.41c.64.06 1.173.644.894 1.807.28.32-.254.904-.894.904H33.796c-1.266 0-1.993-.795-1.787-1.808V48.452H21.287v-1.807h3.574v-2.711z"></path>
                                        </g>
                                        <g fill="#292E31">
                                        <path d="M23.06 10.498h-1.773V4.172H0V.557h23.06z"></path>
                                        <path d="M25.721 26.764h-7.095V6.884H20.4v5.364h3.547V6.883h1.774z"></path>
                                        </g>
                                        <g fill="#292E31">
                                        <path d="M141.024 10.498h1.773V4.172h21.287V.557h-23.06z"></path>
                                        <path d="M138.363 26.764h7.095V6.884h-1.774v5.364h-3.547V6.883h-1.774z"></path>
                                        </g>
                                        </g>
                                        <p class="c-h4">Телескопический</p>
                                        </svg>
                                    </li>
                                    <li class="c-block-locks__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="166" height="54" viewBox="0 0 166 54">
                                        <g fill="none" fill-rule="nonzero">
                                        <path fill="#292E31" d="M21.644.143v3.836L.818 3.869V.143h20.826zM18.173 5.13H21.9l7.456 22.248h-3.729L18.173 5.13z"></path>
                                        <path fill="#000" d="M16.244 5.54l7.714 23.4h5.399v3.068h-2.314v7.672h-3.471v3.836H20.1v3.452H.818V5.54z" opacity=".15"></path>
                                        <path fill="#292E31" d="M164.847.143v3.726l-20.826.11V.143h20.826zm-24.342 27.235h-3.812L143.68 5.13h3.812l-6.987 22.248z"></path>
                                        <path fill="#000" d="M165.233 5.54v41.428h-19.284v-3.452h-3.47V39.68h-3.472v-7.672h-2.314v-3.069h5.4l7.713-23.4z" opacity=".15"></path>
                                        <path fill="#000" d="M25.72 45.315v-3.836h3.47v-8.056h107.987v8.056h3.471v3.836h2.314v1.534H36.132v2.685h10.799c.693-.135 1.223.486 1.157 1.151.066.914-.464 1.535-1.157 1.535H34.975c-.785 0-1.507-.847-1.543-1.918v-3.453H23.02v-1.534h2.7z" opacity=".15"></path>
                                        </g>
                                        <p class="c-h4">Под углом</p>
                                        </svg>
                                    </li>
                                </ul>
                                <p class="c-block-locks__dob-desc c-p2">
                                    <a class="c-link" href="/uslugi/ustanovka_doborov/">Доборы</a> — это специальные накладки из&nbsp;MDF, покрытые плёнкой или краской под&nbsp;цвет внутренней отделки двери.</p>
                                <p class="c-block-locks__dob-desc c-p2">Доборы и внутренние наличники не входят в&nbsp;комплект, а заказываются отдельно, потому что размеры дверных проёмов отличаются.</p>
                            </div>
                        </div>
                    </div>
                </section>
            <? } ?>
        <? } else { ?>

            <section class="p-doorsl-section">
                <div class="c-doorsl-salon">
                    <div class="c-doorsl-salon__main">                       
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/element-sklad-economi.php"
                                )
                        );
                        ?>
                        <div class="c-doorsl-salon__body">
                            <p class="c-h2 c-doorsl-salon__title">Доборы <span class="c-gold">под заказ</span></p>
                            <p class="c-p1 c-doorsl-salon__desc">
                                <a class="c-link" href="/uslugi/ustanovka_doborov/">Доборы</a> — это специальные накладки из MDF, покрытые плёнкой или краской под цвет внутренней отделки двери.</p>
                            <p class="c-p1 c-doorsl-salon__desc">Доборы и внутренние наличники не входят в&nbsp;комплект, а заказываются отдельно, потому что&nbsp;размеры дверных проёмов отличаются.</p>
                            <div class="c-doorsl-salon__dob">
                                <ul class="c-doorsl-salon__dob-list">
                                    <li class="c-doorsl-salon__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="196" height="63" viewBox="0 0 196 63">
                                        <g fill="none" fill-rule="nonzero">
                                        <path fill="#000" d="M160.304 35.01h14.755V7.426h18.97v48.802h-24.24v-4.243h-3.161V47.74h-3.162v-9.548h-3.162z" opacity=".15"></path>
                                        <path fill="#292E31" d="M194.03 0v4.244h-22.133v27.583h-4.215V0h26.348zM-.946 0v4.244h22.132v27.583h4.216V0H-.946z"></path>
                                        <path fill="#000" d="M18.025 7.426V35.01h14.754v3.183h-3.161v9.548h-3.162v4.244H22.24v4.243H-.946V7.426z" opacity=".15"></path>
                                        <path fill="#000" d="M28.595 54.107v-4.244h3.185v-8.487h129.532v8.487h3.185v4.244h3.185v2.121H40.274v3.183h12.74c1.015.08 1.65.764 2.124 1.061-.475 1.44-1.11 2.122-2.123 2.122H39.213c-1.379 0-2.301-.93-2.124-2.122v-4.244h-12.74v-2.121h4.246z" opacity=".15"></path>
                                        </g>
                                        </svg>
                                        <p class="c-h4">Прямой добор</p>
                                    </li>
                                    <li class="c-doorsl-salon__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="195" height="62" viewBox="0 0 195 62">
                                        <g fill="none" fill-rule="nonzero">
                                        <path fill="#292E31" d="M.834 0h26.232v27.565h7.353v3.202H22.895l-.028-26.534H.834V0zM195 0h-26.232v27.565h-7.353v3.202h11.524l.028-26.534H195V0z"></path>
                                        <path fill="#000" d="M19.726 7.426V33.95h14.693v3.183h-3.148v10.61h-3.149v4.243h-4.198v4.243H.834V7.426h18.892zm156.382 0V33.95h-14.693v3.183h3.148v10.61h3.149v4.243h4.198v4.243H195V7.426h-18.892z" opacity=".15"></path>
                                        <path fill="#000" d="M30.253 50.924h3.171v-10.61h128.994v9.549h3.172v4.244h3.171v2.121H41.883v2.122H54.57c.756.071 1.387.757 1.057 2.122.33.377-.3 1.061-1.057 1.061H40.826c-1.498 0-2.359-.934-2.115-2.122v-3.183H26.023v-2.121h4.23v-3.183z" opacity=".15"></path>
                                        </g>
                                        </svg>
                                        <p class="c-h4">Г-образный</p>
                                    </li>
                                    <li class="c-doorsl-salon__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="195" height="63" viewBox="0 0 195 63">
                                        <g fill="none" fill-rule="nonzero">
                                        <g fill="#D9D9D9">
                                        <path d="M19.103 8.119v26.646h14.714v3.198h-3.153v10.659H27.51v4.263h-4.204v4.264H.185V8.119zM175.702 8.119v26.646h-14.714v3.198h3.153v10.659h3.153v4.263h4.204v4.264h23.122V8.119z"></path>
                                        <path d="M29.644 51.82h3.176V41.16h129.172v9.594h3.176v4.263h3.177v2.132H41.29v2.132h12.705c.758.071 1.39.76 1.059 2.131.33.378-.3 1.066-1.059 1.066H40.232c-1.5 0-2.361-.938-2.118-2.132V57.15H25.41v-2.132h4.235v-3.198z"></path>
                                        </g>
                                        <g fill="#292E31">
                                        <path d="M27.51 12.382H25.41V4.92H.185V.658h27.326z"></path>
                                        <path d="M30.664 31.568h-8.408V8.118h2.102v6.328h4.204V8.119h2.102z"></path>
                                        </g>
                                        <g fill="#292E31">
                                        <path d="M167.294 12.382h2.102V4.92h25.224V.658h-27.326z"></path>
                                        <path d="M164.14 31.568h8.409V8.118h-2.102v6.328h-4.204V8.119h-2.102z"></path>
                                        </g>
                                        </g>
                                        </svg>
                                        <p class="c-h4">Телескопический</p>
                                    </li>
                                    <li class="c-doorsl-salon__dob-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="197" height="62" viewBox="0 0 197 62">
                                        <g fill="none" fill-rule="nonzero">
                                        <path fill="#292E31" d="M25.685.168v4.525L.97 4.563V.169h24.715zM21.566 6.05h4.425l8.848 26.242h-4.425L21.566 6.05z"></path>
                                        <path fill="#000" d="M19.278 6.534l9.154 27.6h6.407v3.619h-2.746v9.049h-4.12v4.524h-4.118v4.072H.97V6.534z" opacity=".15"></path>
                                        <path fill="#292E31" d="M195.632.168v4.396l-24.715.129V.168h24.715zm-28.888 32.124h-4.523l8.291-26.242h4.524l-8.292 26.242z"></path>
                                        <path fill="#000" d="M196.09 6.534v48.864h-22.885v-4.072h-4.12v-4.524h-4.118v-9.049h-2.746v-3.62h6.407l9.154-27.599z" opacity=".15"></path>
                                        <path fill="#000" d="M30.522 53.448v-4.524h4.12v-9.502h128.152v9.502h4.12v4.524h2.746v1.81H42.88v3.167h12.815c.823-.16 1.451.573 1.373 1.358.078 1.077-.55 1.81-1.373 1.81H41.507c-.932 0-1.789-.999-1.831-2.263v-4.072H27.318v-1.81h3.204z" opacity=".15"></path>
                                        </g>
                                        </svg>
                                        <p class="c-h4">Под углом</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>                  
                    <? if ($arResult["MANAGER_PHOTO"]) { ?>
                        <div class="c-block-salon__aside">
                            <img class="c-block-salon__img" src="<?= $arResult["MANAGER_PHOTO"]["BIG"] ?>" srcset="<?= $arResult["MANAGER_PHOTO"]["SMALL"] ?> 1x, <?= $arResult["MANAGER_PHOTO"]["BIG"] ?> 2x"/>
                            <p class="c-block-salon__img-desc c-p5 c-p5--small"><?= $arResult["PROPERTIES"]["CONCEPT_PHOTO_MANAGER_TEXT"]["VALUE"] ?></p>
                        </div>
                    <? } ?>
                </div>
            </section>
        <? } ?>
        <? if ($sklad) { ?>       
            <section class="p-doorsl-section">
                <div class="c-doorsl-comments">
                    <div class="c-doorsl-comments__head"><a class="c-link c-doorsl-comments__title" href="/otzyvy/">Покупатели о дверях и сервисе</a></div>                    
                    <div class="c-doorsl-comments__main">
                        <ul class="c-doorsl-comments__list">                          
                            <li class="c-doorsl-comments__item">
                                <div>
                                    <p class="c-p2 c-doorsl-comments__item-desc">Очень рады приобретению, дверь не подводит ни в -25⁰С, ни в +30⁰С. Отлично выполняет своё предназначение. Надёжная и очень стильная,</p>
                                    <p class="c-h3 c-doorsl-comments__item-title">замечательно вписалась в наш архитектурный ансамбль.</p>
                                    <p class="c-p2 c-doorsl-comments__item-desc">Отличная оценка и самые положительные рекомендации. Всем советуем.</p>
                                    <p class="c-h4 c-doorsl-comments__item-addres">ул. Чюрлениса, 8, Макович Вера Николаевна</p>
                                </div>
                            </li>
                            <li class="c-doorsl-comments__item">
                                <div>
                                    <p class="c-p2 c-doorsl-comments__item-desc">Заказывал 2 двери в 2-х уровневую квартиру, привезли, установили в срок. Время изготовления заказа было несколько большим, т.к. производилась установка дополнительных замков.</p>
                                    <p class="c-h3 c-doorsl-comments__item-title">В целом двери служат отлично.</p>
                                    <p class="c-p2 c-doorsl-comments__item-desc">Однозначно можно обращаться, одна из немногих компаний Беларуси, делающих качественный товар.</p>
                                    <p class="c-h4 c-doorsl-comments__item-addres">ул. Чюрлениса, 8, Макович Вера Николаевна</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        <? } ?>

        <? if ($sklad) { ?>
        </div>
        <section class="p-doorsl-section">
            <div class="c-doorsl-repository">
                <div class="c-doorsl-repository__head">
                    <div class="c-doorsl-repository__head-content">
                        <h2 class="c-doorsl-repository__title"><?= $arResult["NAME"] ?> <span class="c-gold">на складе</span></h2>
                        <p class="c-p3 c-doorsl-repository__caption"><?= $arResult["DESTINATION_ICON"] ?></p>
                    </div>
                </div>
                <div class="c-doorsl-repository__main c-flip-wrap c-gallery-wrap">
                    <div class="c-wrapper">
                        <div class="c-doorsl-repository__body">
                            <div class="c-doorsl-repository__content">
                                <div class="c-doorsl-repository__char-wrap">
                                    <div class="c-doorsl-repository__char">
                                        <p class="c-doorsl-repository__char-head c-h4">Характеристики,&nbsp;мм</p>
                                        <div class="c-doorsl-repository__char-item">
                                            <p class="c-doorsl-repository__char-title c-doorsl-repository__char-title--bold">Толщина</p>
                                            <p class="c-doorsl-repository__char-value"></p>
                                        </div>
                                        <?
                                        $need_thin = ["CHARAKTER_CONST_THICKNESS_METAL_MAIN", "CHARAKTER_CONST_THICKNESS_CLOTH", "CHARAKTER_CONST_THICKNESS_BOX"];
                                        $need_opt = ["CHARAKTER_CONST_HEIGHT_MAIN", "CHARAKTER_CONST_WIDTH_MAIN"];
                                        $replace = ["Толщина", "толщина"];
                                        foreach ($arResult["PROPERTIES"] as $key => $prop) {
                                            if (in_array($key, $need_opt) && !$proops) {
                                                $proops[] = $prop;
                                            } elseif (!in_array($key, $need_thin)) {
                                                continue;
                                            } else {
                                                ?>
                                                <div class="c-doorsl-repository__char-item">
                                                    <p class="c-doorsl-repository__char-title"><?= str_replace($replace, "", $prop["NAME"]) ?></p>
                                                    <p class="c-doorsl-repository__char-value"><?= $prop["VALUE"] ?></p>
                                                </div>
                                                <?
                                            }
                                        }
                                        if ($proops) {
                                            foreach ($proops as $val) {
                                                ?>
                                                <div class="c-doorsl-repository__char-item">
                                                    <p class="c-doorsl-repository__char-title c-doorsl-repository__char-title--bold"><?= $val["NAME"] ?></p>
                                                    <p class="c-doorsl-repository__char-value"><?= $val["VALUE"] ?></p>
                                                </div>
                                                <?
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="c-doorsl-repository__desc-wrap">
                                    <div class="c-doorsl-repository__desc">
                                        <p class="c-p3 c-p3--small">Снаружи</p>
                                        <h3 class="c-h4 c-doorsl-repository__desc-title"><?= $arResult["PROPERTIES"]["CONCEPT_TITLE_EXTERIOR"]["~VALUE"] ?>
                                            <div class="c-doorsl-repository__arrow c-flip__title c-flip__title--active">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="19" viewBox="0 0 14 19">
                                                <defs>
                                                <path id="q" d="M0 19V0h14v19z"></path>
                                                </defs>
                                                <g fill="none" fill-rule="evenodd">
                                                <mask id="w" fill="#fff">
                                                    <use xlink:href="#q"></use>
                                                </mask>
                                                <path fill="#009D4C" d="M0 10.298C.737 13.182 1.895 16.322 3.79 19h1.105C7.579 12.41 10.474 6.436 14 .772L13.053 0C9.947 3.862 6.316 9.99 4.158 14.88c-.947-1.39-2.105-3.552-2.947-5.2L0 10.298" mask="url(#w)"></path>
                                                </g>
                                                </svg>
                                            </div>
                                        </h3>
                                        <p class="c-p3"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_EXTERIOR"]["~VALUE"] ?></p>
                                    </div>
                                    <div class="c-doorsl-repository__desc">
                                        <p class="c-p3 c-p3--small">Внутри</p>
                                        <h3 class="c-h4 c-doorsl-repository__desc-title"><?= $arResult["PROPERTIES"]["CONCEPT_TITLE_INTERIOR"]["~VALUE"] ?>
                                            <div class="c-doorsl-repository__arrow c-flip__title">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="19" viewBox="0 0 14 19">
                                                <defs>
                                                <path id="qq" d="M0 19V0h14v19z"></path>
                                                </defs>
                                                <g fill="none" fill-rule="evenodd">
                                                <mask id="ww" fill="#fff">
                                                    <use xlink:href="#qq"></use>
                                                </mask>
                                                <path fill="#009D4C" d="M0 10.298C.737 13.182 1.895 16.322 3.79 19h1.105C7.579 12.41 10.474 6.436 14 .772L13.053 0C9.947 3.862 6.316 9.99 4.158 14.88c-.947-1.39-2.105-3.552-2.947-5.2L0 10.298" mask="url(#ww)"></path>
                                                </g>
                                                </svg>
                                            </div>
                                        </h3>
                                        <p class="c-p3"><?= $arResult["PROPERTIES"]["CONCEPT_TEXT_INTERIOR"]["~VALUE"] ?></p>
                                    </div>
                                    <p class="c-doorsl-repository__dtitle c-gallery__title"><?= $arResult["OFFERS"][0]["PROPERTIES"]["DECOR_ARTICLE"]["~VALUE"] ?></p>
                                </div>
                            </div>
                            <div class="c-doorsl-repository__gallery">
                                <div class="c-gallery">
                                    <div class="c-gallery__view">
                                        <div class="c-flip">
                                            <div class="c-flip__main">
                                                <img class="c-flip__side c-gallery__view-img" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>"/>
                                                <img class="c-flip__side c-gallery__view-img" src="<?= CFile::GetPath($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]) ?>"/>    
                                            </div>
                                            <div class="c-gallery__prev">
                                                <div class="c-gallery__arrow c-gallery__arrow--prev"></div>
                                            </div>
                                            <div class="c-gallery__next">
                                                <div class="c-gallery__arrow c-gallery__arrow--next"></div>
                                            </div>
                                            <div class="c-trigger">
                                                <div class="c-trigger__main">
                                                    <div class="c-trigger__body">
                                                        <svg class="c-trigger__svg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                        <path class="c-trigger__svg-path" fill="#006695" fill-rule="nonzero" d="M25.608 4.397a14.995 14.995 0 0 1 3.25 16.342A15.007 15.007 0 0 1 15 30v-3.75c4.56.011 8.677-2.73 10.424-6.941a11.246 11.246 0 0 0-2.452-12.278l-3.076 3.075a.661.661 0 0 1-1.13-.468v-8.7c0-.518.42-.938.938-.938h8.708a.661.661 0 0 1 .469 1.13l-3.273 3.267zM15 3.75V0A15.007 15.007 0 0 0 1.142 9.26a14.995 14.995 0 0 0 3.25 16.343l-3.24 3.24A.68.68 0 0 0 1.62 30h8.69c.517 0 .937-.42.937-.938v-8.671a.68.68 0 0 0-1.158-.47L7.028 22.97A11.246 11.246 0 0 1 4.576 10.69 11.255 11.255 0 0 1 15 3.75z"></path>
                                                        </svg><span class="c-trigger__caption">Отделка 
                                                            <p class="c-trigger__caption-variable">внутри</p>
                                                            <p class="c-trigger__caption-variable">снаружи</p></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-doorsl-repository__info">
                                <div class="c-doorsl-repository__info-head">
                                    <div class="c-doorsl-repository__panel">
                                        <?
                                        $sale = ($arResult["OFFERS"][0]["MIN_PRICE"]["DISCOUNT_DIFF"] != 0) ? true : false;
                                        ?>
                                        <div class="c-doorsl-repository__panel-price">
                                            <p class="c-h3 c-price <?= $sale ? "c-price--old c-gallery__price-old" : "c-gallery__price" ?>"><?= $sale ? $arResult["OFFERS"][0]["MIN_PRICE"]["VALUE"] : $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></p>
                                            <? if ($sale) { ?>
                                                <p class="c-h3 c-price c-gallery__price-new c-price--new"><?= $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></p>
                                            <? } ?>
                                        </div> 
                                        <?
                                        $APPLICATION->IncludeComponent(
                                                "bitrix:main.include", "", Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "SKLAD" => "Y",
                                            "PATH" => "/include/element-concept-banner-phone.php"
                                                )
                                        );
                                        ?>
                                        <div class="c-doorsl-repository__panel-desc">
                                            <p class="c-p2">
                                              <a class="c-link" href="/uslugi/zamer/">Бесплатный замер</a> проёма, условия <a class="c-link" href="/dostavka-i-ustanovka/">доставки двери</a>, гарантия 2 года. Возможна 
                                              <a class="c-link" href="/oplata/kartoi-rassrochki/">рассрочка</a> под 0%. Действует постоянная
                            									<a class="c-link" href="/clientu/politika-skidok/">система скидок.
                                             </p>
                                        </div>
                                        <a href="<?= $arResult["OFFERS"][0]["BUY_URL"] ?>" class="c-doorsl-repository__link c-gallery__link">
                                            <button class="c-king-but c-doorsl-repository__but">Заказать замер</button>
                                        </a>                  

                                    </div>
                                    <? if (!empty($arResult["SALONS"])) { ?>
                                        <div class="c-doorsl-repository__links">
                                            <p class="c-h4 c-h4--small">Дверь установлена в салоне:</p>
                                            <div class="c-doorsl-repository__links-body">
                                                <ul class="c-link-list">
                                                    <? foreach ($arResult["SALONS"] as $salon) { ?>
                                                        <li class="c-link-list__item">
                                                            <a class="c-link-list__link c-link-block" href="<?= $salon["LINK"] ?>">
                                                                <span class="c-link-list__text c-link"><?= $salon["NAME"] ?></span>
                                                            </a>
                                                        </li>
                                                    <? } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                                <div class="c-doorsl-repository__info-foot">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                            "bitrix:main.include", "", Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/include/element-sklad-banner-factoid.php"
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="c-doorsl-repository__foot">
                            <div class="c-gallery__preview">
                                <ul class="c-gallery__preview-list">
                                    <?
                                    foreach ($arResult["OFFERS"] as $key => $arOffer) {
                                        $saleOff = ($arOffer["MIN_PRICE"]["DISCOUNT_DIFF"] != 0) ? true : false;
                                        ?>
                                        <li class="c-gallery__preview-item <?= !$key ? "c-gallery__preview-item--active" : "" ?>" 
                                            data-href="<?= $arOffer["BUY_URL"] ?>"
                                            data-src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>, <?= CFile::GetPath($arResult["PROPERTIES"]["PREVIEW_PHOTO_IN"]["VALUE"]) ?>"
                                            data-title="<?= $arOffer["PROPERTIES"]["DECOR_ARTICLE"]["~VALUE"] ?>"
                                            data-price="<?= $saleOff ? $arOffer["MIN_PRICE"]["VALUE"] : $arOffer["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>"
                                            <? if ($saleOff) { ?>
                                                data-discount="<?= $arOffer["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>"
                                            <? } ?>
                                            >
                                            <img class="c-gallery__preview-img" src="<?= $arOffer["PICTURE_WITHIN_SMALL"] ?>"/>
                                            <img class="c-gallery__preview-img" src="<?= $arOffer["PICTURE_OUTSIDE_SMALL"] ?>"/>
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>       
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="c-wrapper">
        <? } else { ?>
            <section class="c-concept-section c-concept-salon">
                <div class="c-block-salon">
                    <div class="c-block-salon__main">
                        <div class="c-block-salon__head">
                            <div class="c-block-salon__sides">
                                <img class="c-block-salon__side <?= $doubles ? "block-salon-fields-big" : "" ?>" src="<?= $arResult["DOORS"]["WITHIN"]["SMALL_BOTTOM"]["BIG"] ?>" srcset="<?= $arResult["DOORS"]["WITHIN"]["SMALL_BOTTOM"]["SMALL"] ?> 1x, <?= $arResult["DOORS"]["WITHIN"]["SMALL_BOTTOM"]["BIG"] ?> 2x"/>
                                <img class="c-block-salon__side <?= $doubles ? "block-salon-fields" : "" ?>" src="<?= $arResult["DOORS"]["OUTSIDE"]["SMALL_BOTTOM"]["BIG"] ?>" srcset="<?= $arResult["DOORS"]["OUTSIDE"]["SMALL_BOTTOM"]["SMALL"] ?> 1x, <?= $arResult["DOORS"]["OUTSIDE"]["SMALL_BOTTOM"]["BIG"] ?> 2x"/>
                            </div>                          
                            <div class="c-block-salon__body">
                                <h2 class="c-h2 c-h2--small c-block-salon__title"><?= $arResult["NAME"] ?> <?= $arResult["ALL_SALONS"] ? "в салоне:" : "" ?></h2>
                                <div class="c-block-salon__link-list">
                                    <ul class="c-link-list">
                                        <? foreach ($arResult["SALONS"] as $salon) { ?>
                                            <li class="c-link-list__item">
                                                <a class="c-link-list__link c-link-block" href="<?= $salon["LINK"] ?>">
                                                    <span class="c-link-list__text c-link"><?= $salon["NAME"] ?></span> 
                                                </a>
                                            </li>                                  
                                        <? } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="c-block-salon__body">
                            <div class="c-block-salon__desc">
                                <div class="c-block-salon__price">                               
                                    <span class="c-block-salon__price-old c-h3 c-price <?= $sale ? "c-price--old" : "" ?> "><?= $sale ? $arResult["OFFERS"][0]["MIN_PRICE"]["VALUE"] : $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></span>
                                    <? if ($sale) { ?>
                                        <span class="c-h3 c-price c-price--new"><?= $arResult["OFFERS"][0]["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?></span>
                                    <? } ?>
                                </div>
                                <p class="c-p2"><?= $arResult["DESTINATION_ICON"] ?></p>
                            </div>
                            <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/element-concept-banner-phone.php"
                                    )
                            );
                            ?>
                            <div class="c-block-salon__desc">
                                <p class="c-p2">
                                    <a class="c-link" href="/uslugi/zamer/">Бесплатный замер</a> проёма, условия <a class="c-link" href="/dostavka-i-ustanovka/">доставки двери</a>, гарантия 2 года. Возможна 
                                    <a class="c-link" href="/oplata/kartoi-rassrochki/">рассрочка</a> под 0%. Действует постоянная <a class="c-link" href="/clientu/politika-skidok/">система скидок.</a></p>
                            </div>
                            <div class="c-block-salon__foot"><a href="<?= $arResult["OFFERS"][0]["BUY_URL"] ?>" class="c-block-salon__foot-link">
                                    <button class="c-king-but" type="button">Заказать замер</button></a></div>
                        </div>
                    </div>
                    <? if ($arResult["MANAGER_PHOTO"]) { ?>
                        <div class="c-block-salon__aside">
                            <img class="c-block-salon__img" src="<?= $arResult["MANAGER_PHOTO"]["BIG"] ?>" srcset="<?= $arResult["MANAGER_PHOTO"]["SMALL"] ?> 1x, <?= $arResult["MANAGER_PHOTO"]["BIG"] ?> 2x"/>
                            <p class="c-block-salon__img-desc c-p5 c-p5--small"><?= $arResult["PROPERTIES"]["CONCEPT_PHOTO_MANAGER_TEXT"]["VALUE"] ?></p>
                        </div>
                    <? } ?>
                </div>
            </section>
        <? } ?>

        <section class="<?= $sklad ? "p-doorsl-section" : "c-concept-section c-concept-likely" ?>">
            <? if ($sklad) { ?>
                <div class="c-doorsl-likely">
                <? } ?>
                <div class="c-block-likely">
                    <span class="c-p2 c-block-likely__desc">Расскажите про дверь друзьям:</span>
                    <div class="c-block-likely__main">
                        <div class="likely">
                            <div class="twitter">Твитнуть</div>
                            <div class="facebook">Поделиться</div>
                            <div class="vkontakte">Запостить</div>
                            <div class="telegram">Отправить</div>
                            <div class="odnoklassniki">Класснуть</div>
                            <div class="gplus">Плюсануть</div>
                        </div>
                    </div>
                </div>
                <? if ($sklad) { ?>
                </div>
            <? } ?>
        </section>

        <? if ($arResult["PROPERTIES"]["CONCEPT_SIMILAR_CONCEPT"]["VALUE"] && ($arResult["OTHER_CONCEPT"]["PICTURE_BIG"] || $arResult["OTHER_CONCEPT"]["PICTURE_SMALL"])) { ?>

            <? //if ($arResult["PROPERTIES"]["CONCEPT_SIMILAR_CONCEPT"]["VALUE"]) {           ?>
            <section class="c-concept-section">
                <a class="c-block-link c-link-block" href="<?= $arResult["OTHER_CONCEPT"]["DETAIL_PAGE_URL"] ?>">
                    <svg class="c-block-link__svg" xmlns="http://www.w3.org/2000/svg" width="234" height="453" viewBox="0 0 234 453">
                    <defs>
                    <linearGradient id="a1" x1="50%" x2="50%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="#FFE6A8"></stop>
                    <stop offset="100%" stop-color="#FFC970"></stop>
                    </linearGradient>
                    </defs>
                    <path fill="url(#a1)" fill-rule="nonzero" d="M73.588 304.632C121.8 256.42 200.03 226.46 234.339 226.46c-34.308 0-112.54-29.96-160.751-78.172-30.47-30.471-52.062-61.23-59.881-89.156C3.654 23.226 11.872-2.82 31.698 1.549a9.054 9.054 0 0 0-1.87.284c-.478.13-.938.295-1.372.495-4.734 2.18-7.14 8.538-5.42 14.991 1.876 7.053 7.956 11.56 13.584 10.058a8.41 8.41 0 0 0 1.486-.547c1.554-.747 2.857-1.937 3.83-3.44 1.945-3.005 2.614-7.226 1.476-11.49a17.087 17.087 0 0 0-.608-1.85c-.955-3.631-3.335-6.384-7.634-8.217C8.305-9.62-5.78 34.506 2.243 81.037c4.606 26.716 20.517 60.757 48.358 88.599 45.755 45.755 122.114 56.824 171.144 56.824-49.03 0-125.389 11.068-171.144 56.823-27.841 27.843-43.752 61.884-48.358 88.6-8.023 46.53 6.062 90.657 32.927 79.204 4.3-1.833 6.679-4.586 7.634-8.217.235-.59.435-1.207.608-1.85 1.138-4.264.47-8.485-1.476-11.49-.973-1.503-2.276-2.693-3.83-3.44a8.41 8.41 0 0 0-1.486-.547c-5.628-1.503-11.708 3.005-13.584 10.058-1.72 6.453.686 12.81 5.42 14.99.434.2.894.366 1.372.496a8.532 8.532 0 0 0 1.881.276c-19.837 4.376-28.055-21.67-18.002-57.575 7.82-27.926 29.41-58.685 59.88-89.156z"></path>
                    </svg>
                    <div class="c-block-link__main">
                        <div class="c-block-link__head">
                            <div class="c-block-link__title">
                                <span class="c-p2 c-link c-link--notdecor">Похожая дверь <?= $arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"] ? "на акции" : "" ?></span>
                            </div>
                            <div class="c-block-link__title">
                                <span class="c-h2 c-link"><?= $arResult["OTHER_CONCEPT"]["NAME"] ?></span>
                            </div>
                        </div>
                        <p class="c-block-link__desc c-p2">Смотрите следующий концепт, <br><?= $arResult["OTHER_CONCEPT"]["DESTINATION_ICON_BOTTOM"] ?>.</p>

                        <span class="c-block-link__price c-h3 c-price <?= $arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"] ? "c-price--old" : "" ?>"><?= $arResult["OTHER_CONCEPT"]["PRICE"] ?><?= $arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"] ? "" : " руб." ?></span>
                        <? if ($arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"]) { ?>
                            <span class="c-block-link__price c-h3 c-price c-price--new"><?= $arResult["OTHER_CONCEPT"]["DISCOUNT_PRICE"] ?> руб.</span>
                        <? } ?>  
                    </div>
                    <img class="c-block-link__img c-link-image" src="<?= $arResult["OTHER_CONCEPT"]["PICTURE_BIG"] ?>" srcset="<?= $arResult["OTHER_CONCEPT"]["PICTURE_SMALL"] ?> 1x, <?= $arResult["OTHER_CONCEPT"]["PICTURE_BIG"] ?> 2x"/>
                </a>
            </section>
        <? } ?>

        <div class="modal fade" id="managerCallModal" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content managerCall__content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <form method="post" class="js_validate managerCall__contentForm" id="manager_call_form">
                        <p class="modal__title">Заявка на звонок</p>
                        <p class="modal__text">Рабочий день в&nbsp;салоне закончился или выходной.<br> Оставьте заявку и&nbsp;менеджер перезвонит в&nbsp;рабочее время.</p>
                        <p class="field js_input js_class_valid">
                            <input id="client_name_call" type="text" name="name" data-valid="name" data-valid-min="2" class="guarantee_letter_field" placeholder="Имя">
                            <span class="error_message side">Менеджер не сможет&nbsp;обратиться<br>к&nbsp;вам&nbsp;по&nbsp;этому имени</span>
                        </p>
                        <p class="field js_input js_class_valid">
                            <input id="client_tel_call" type="tel" name="phone" data-valid="phone" class="guarantee_letter_field" placeholder="Номер телефона">
                            <input type="hidden" name="name_door" value="<?= $arResult["NAME"] ?>">
                            <input type="hidden" name="my_address">
                            <input type="text" name="login" class="my_login">
                            <span class="error_message side">Менеджер не дозвонится <br>по этому номеру</span>
                            <span class="guarantee_letter_field_detail bottom">+375 (29) 000-00-00</span>
                        </p>
                        <p class="field textblock">
                            <textarea id="client_comment_zamer" name="message" class="guarantee_letter_field" placeholder="Сообщение"></textarea>
                            <span class="guarantee_letter_field_detail bottom">В&nbsp;какое время вам удобно разговаривать? Задайте вопросы, чтобы менеджер подготовился к&nbsp;разговору.</span>
                        </p>
                        <div class="modal__bottom">
                            <p class="guarantee_letter_field_wrap">
                                <input type="button" value="Отправить" id="send_form" name="send_form" class="send_button disabled"><!--
                                --><span class="guarantee_letter_field_detail side big_margin">Чтобы отправить форму&nbsp;— напишите имя&nbsp;и&nbsp;номер телефона</span>
                            </p>
                        </div>
                        <div class="modal_manager_photo">
                            <img src="/bitrix/templates/steelline/img/manager_modal.png" alt="Заявка на звонок">
                        </div>
                    </form>
                    <div class="send_notification hidden">
                        <p class="modal__title">Заявка отправлена</p>
                        <p class="modal__text">Менеджер перезвонит вам в&nbsp;рабочее время: с&nbsp;10&nbsp;до&nbsp;18&nbsp;в будни.</p>
                        <svg class="dp-dodings-send__svg" xmlns="http://www.w3.org/2000/svg" width="201" height="212" viewBox="0 0 201 212">
                        <path fill="#13CE5E" fill-rule="evenodd" d="M70.424 212l130.1-194.808L183.261.386 68.595 174.616l-53.734-60.819L0 133.003 70.424 212"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="/bitrix/templates/steelline/script/modal_bootstrap.js"></script>
<script>
    //- Night time
    var blocks = document.querySelectorAll('.c-doorsl-repository__panel-cont'),
            time = new Date().getHours();

    if (time >= 18 || time < 10) {
        for (var i = 0; i < blocks.length; i++) {
            blocks[i].classList.toggle('active');
        }
    }

    var validator = new Validator();
    $("#send_form").on("click", function () {
        if (!$(this).hasClass("disabled")) {
            $(this).addClass("pressed");
            var form = $('#manager_call_form')[0];
            var formData = new FormData(form);
            $.ajax({
                url: "/request/zamer_full.php", //заменить урл
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function () {
                    $("#send_form").removeClass("pressed");
                    $('#manager_call_form').animate({'height': $('.send_notification').height()}, 200, function () {
                        $('#manager_call_form').addClass("hidden send");
                        $(".send_notification").removeClass("hidden");
                    })

                }
            })
        }
    })

    $('[data-target="#managerCallModal"]').on('click', function () {
        console.log(this);
        if ($('#manager_call_form').hasClass('send')) {
            $('#manager_call_form').find('.guarantee_letter_field').val("");
            $('#manager_call_form').find('.field').removeClass('ok');
            $('#manager_call_form').css('height', 'auto').removeClass('hidden send');
            $(".send_notification").addClass("hidden");
        }
    })
</script>
<? if (!$sklad) { ?>
    <script src="/bitrix/templates/steelline/script/tabs.js"></script>
    <script>
    (function () {


        new Tabs(document.querySelector('.c-tabs'));

        var flip = document.querySelector('.c-flip'),
                trigger = document.querySelector('.c-trigger'),
                arrows = document.querySelectorAll('.c-block-description__arrow');

        trigger.addEventListener('click', function () {
            this.classList.toggle('c-trigger--active');
        })

        flip.addEventListener('click', function () {
            this.classList.toggle('c-flip--active');

            Array.prototype.forEach.call(arrows, function (item, index, arr) {
                item.classList.toggle('c-block-description__arrow--active');
            })
        })

        $(".c-block-description__designer-link").on("click", function () {
            $('html, body').animate({scrollTop: $(".c-concept-engstyle").offset().top - 30}, 600)
        })

    })();



    </script> 
<? } else { ?>
    <script src="/bitrix/templates/steelline/script/gallery.js"></script>
    <script src="/bitrix/templates/steelline/script/flip.js"></script>
    <script>
    (function () {

        var gallerys = document.querySelectorAll('.c-gallery-wrap'),
                flips = document.querySelectorAll('.c-flip-wrap');

        for (var i = 0; i < gallerys.length; i++) {
            new Gallery({
                views: gallerys[i].querySelectorAll('.c-gallery__view-img'),
                previews: gallerys[i].querySelectorAll('.c-gallery__preview-item'),
                next: gallerys[i].querySelector('.c-gallery__next'),
                prev: gallerys[i].querySelector('.c-gallery__prev'),
                title: gallerys[i].querySelector('.c-gallery__title'),
                price: gallerys[i].querySelector('.c-gallery__price'),
                priceOld: gallerys[i].querySelector('.c-gallery__price-old'),
                priceNew: gallerys[i].querySelector('.c-gallery__price-new'),
                link: gallerys[i].querySelector('.c-gallery__link'),

                wrap: gallerys[i],
                keyCodeNext: 39,
                keyCodePrev: 37,

                activePreviewClass: 'c-gallery__preview-item--active',
                start: 0
            })
        }

        for (var i = 0; i < flips.length; i++) {
            new Flip({
                flip: flips[i].querySelector('.c-flip'),
                desc: flips[i].querySelectorAll('.c-flip__title'),
                trigger: flips[i].querySelector('.c-trigger'),
                activeFlipClass: 'c-flip--active',
                activeFlipTitleClass: 'c-flip__title--active',
                activeTriggerClass: 'c-trigger--active'

            })
        }

    })();
    </script>
    <?
}?>