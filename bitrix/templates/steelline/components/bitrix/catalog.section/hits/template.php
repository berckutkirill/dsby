<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();/** @var array $arParams */
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
<section class="carts js_row_slider">
    <div class="wrap">
        <a href="<?= $arParams["TITLE_LINK"] ?>" class="title"><?= $arParams["TITLE_LINK_NAME"] ?></a>
        <div class="list">
            <ul class="js_carret">
                <?
                foreach ($arResult["ITEMS"] as $arItem):
                    if ($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") {
                        $cartclass = "double";
                    } else {
                        $cartclass = "";
                    }
                    $cartclass .= " " . implode(" ", $arItem["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"]);
                    ?>
                    <li class="<?= $cartclass ?> js_li">
                        <?php if ($arItem["PROPERTIES"]["APPOINTMENT"]["VALUE"]) { ?>
                            <div class="prop">
                                <?php foreach ($arItem["APPOINTMENTS"] as $k => $v) { ?>
                                    <span <?php echo $v["CLASS"] ?>><i><?php echo $v["VALUE"] ?></i></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="img">
                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
                            <? if ($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y" && $arItem["PROPERTIES"]["DOUBLE_PICTURE"]["VALUE"]) { ?>
                                <img src="<?= CFile::GetPath($arItem["PROPERTIES"]["DOUBLE_PICTURE"]["VALUE"]) ?>">
                            <? } ?>
                        </a>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="name"><?= $arItem["NAME"] ?> <i><?= $arItem["PROPERTIES"]["NAME_EN"]["VALUE"] ?></i></a>
                        <span class="price js_price_gen">
                            <span class="new_rub"><?= $arItem['PROPERTIES']['IN_STOCK']['VALUE'] != "Y" ? "от " : ""; ?><span class="js_denomination_price"><?= toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"]) ?></span> руб.</span>
                        </span>
                        <div class="yarl"></div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <div class="js_prev prev control"></div>
        <div class="js_next next control"></div>
    </div>
</section>
<script>
    $(function () {
        row_slider({
            parent_query: $('.js_row_slider'),
            width_element_with_margin: 295,
            number_of_visible_elements: 4
        })
        //mini_slider('.carts', 1, 295, 4, 1,250);
    })
</script>