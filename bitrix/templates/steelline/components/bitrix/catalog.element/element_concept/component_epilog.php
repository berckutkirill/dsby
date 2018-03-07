<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
?>
<script>
    $(function () {
        row_slider({
            parent_query: $('.js_row_slider'),
            width_element_with_margin: $(".js_li.li").outerWidth(true),
            number_of_visible_elements: 1
        });
<? if ($_GET["offer"]) { ?>
            cart_app(<?= $_GET["offer"] ?>);
<? } else { ?>
            cart_app();
<? } ?>
    })
</script>
<?
/** @var array $templateData */

/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;

global $APPLICATION;
global $MY_SEO;
$MY_SEO = $arResult['MY_SEO'];

if (isset($templateData['TEMPLATE_THEME'])) {
    $APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY'])) {
    $loadCurrency = false;
    if (!empty($templateData['CURRENCIES']))
        $loadCurrency = Loader::includeModule('currency');
    CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
    if ($loadCurrency) {
        ?>
        <script type="text/javascript">
            BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
        </script>
        <?
    }
}
if (isset($templateData['JS_OBJ'])) {
    ?><script type="text/javascript">
        BX.ready(BX.defer(function () {
            if (!!window.<? echo $templateData['JS_OBJ']; ?>)
            {
                window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
            }
        }));
    </script><? }
?>
<?
$arSelectt = array("ID", "IBLOCK_ID");
$arFilterr = array(
    "IBLOCK_ID" => 26,
    "ACTIVE" => "Y",
    "PROPERTY_IN_ELEMENT_VALUE" => "Да",
    "PROPERTY_CML2_LINK" => $arResult["ID"]
);
$arSorts = array(
    "RAND" => "DESC",
);

$res = CIBlockElement::GetList($arSorts, $arFilterr, false, Array("nPageSize" => 3), $arSelectt);
while ($ob = $res->GetNextElement()) {
    $arFields_rev = $ob->GetFields();
    $arProps_rev = $ob->GetProperties();
    $result = [];
    $result["REVIEW"] = $arProps_rev["REVIEW"]["~VALUE"]["TEXT"];
    $result["NAME"] = $arProps_rev["LINK_REVIEW"]["VALUE"] ? $arProps_rev["NAME"]["VALUE"] : $arProps_rev["ADDRESS"]["VALUE"] . ", " . $arProps_rev["NAME"]["VALUE"];
    if (!empty($arProps_rev["LINK_REVIEW"]["VALUE"])) {
        $result["LINK_REVIEW"] = $arProps_rev["LINK_REVIEW"]["VALUE"];
    }
    $reviews[] = $result;
}
if (count($reviews) < 3) {
    $need = 3 - count($reviews);
    $arrFilter_rev = array(
        "IBLOCK_ID" => 26,
        "ACTIVE" => "Y",
        "PROPERTY_IN_ELEMENT_VALUE" => "Да",
        "PROPERTY_CML2_LINK" => false
    );
    $arSort_rev = ["RAND" => "DESC"];
    $arSelect_rev = ["ID", "IBLOCK_ID"];

    $res = CIBlockElement::GetList($arSort, $arrFilter_rev, false, Array("nPageSize" => $need), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields_rev = $ob->GetFields();
        $arProps_rev = $ob->GetProperties();
        $result = [];
        $result["REVIEW"] = $arProps_rev["REVIEW"]["~VALUE"]["TEXT"];
        $result["NAME"] = $arProps_rev["LINK_REVIEW"]["VALUE"] ? $arProps_rev["NAME"]["VALUE"] : $arProps_rev["ADDRESS"]["VALUE"] . ", " . $arProps_rev["NAME"]["VALUE"];
        if (!empty($arProps_rev["LINK_REVIEW"]["VALUE"])) {
            $result["LINK_REVIEW"] = $arProps_rev["LINK_REVIEW"]["VALUE"];
        }
        $reviews[] = $result;
    }
}
$reviews = json_encode($reviews);
?>
<script src="/bitrix/templates/steelline/script/mustache.js"></script>
<script>

        var reviews = {items: <?= $reviews ?>};
        $('.c-doorsl-comments__list').html(Mustache.render($('#review_tpl').html(), reviews));

</script>
<script id="review_tpl" type="x-tmpl-mustache">
    {{#items}}
    <li class="c-doorsl-comments__item">
    <div class="c-p2">{{{REVIEW}}}</div>            
    <div class="c-h4 c-doorsl-comments__item-addres {{#LINK_REVIEW}}">
    <a href="{{LINK_REVIEW}}" class="c-link c-h4" target="_blank">{{NAME}}</a>{{/LINK_REVIEW}}
    {{^LINK_REVIEW}} ">{{NAME}}{{/LINK_REVIEW}}
    </div>
    </li>
    {{/items}}
</script>

<?
CIBlockElement::CounterInc($arResult['ID']);
$q = "SELECT * FROM `b_iblock_section_element` WHERE `IBLOCK_ELEMENT_ID` = {$arResult['ID']}";
$in = false;
$result = $DB->Query($q);
while ($row = $result->Fetch()) {
    if ($row['IBLOCK_SECTION_ID'] == 50) {
        $in = true;
        break;
    }
}

CatalogViewedProductTable::refresh($arResult['ID'], CSaleBasket::GetBasketUserID());
