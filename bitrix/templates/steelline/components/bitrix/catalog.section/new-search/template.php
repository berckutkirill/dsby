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
<section class="carts res">
    <div class="wrap">     
        <div class="list">
            <ul>
                <?
                foreach ($arResult["ITEMS"] as $arItem):
                    if ($arItem["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") {
                        $cartclass = "double";
                    } else {
                        $cartclass = "";
                    }
                    $cartclass .= " " . implode(" ", $arItem["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"]);
                    ?>
                    <li class="<?= $cartclass ?>">
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
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="name"><?= $arItem["NAME"] ?></a>
                        <span class="price <?= $arItem["MIN_PRICE"]["DISCOUNT_VALUE"] == $arItem["MIN_PRICE"]["VALUE"] ? "blue_color" : ""; ?> js_price_gen">
                            <span class="new_rub"><?= $arItem['PROPERTIES']['IN_STOCK']['VALUE'] != "Y" ? "от " : ""; ?><span class="js_denomination_price"><?= toPrice($arItem["MIN_PRICE"]["DISCOUNT_VALUE"]) ?></span> руб.</span>
                        </span>
                        <div class="yarl"></div>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?
if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
    ?><? echo $arResult["NAV_STRING"]; ?><?
}
?>
