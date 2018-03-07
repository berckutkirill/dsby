<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
$offer = htmlspecialcharsex($_GET["offer"]);
?>
<script>
    $(function () {
        row_slider({
            parent_query: $('.js_row_slider'),
            width_element_with_margin: $(".js_li.li").outerWidth(true),
            number_of_visible_elements: 1
        });
<? if ($offer) { ?>
            cart_app(<?= $offer ?>);
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
    </script><?
} ?>
<?
$arSelectt = array("ID", "IBLOCK_ID");
$arFilterr = array(
    "IBLOCK_ID" => 26,
    "ACTIVE" => "Y",
    "PROPERTY_IN_ELEMENT_VALUE" => "Да",
    "PROPERTY_CML2_LINK" => $arResult["ID"]
);
$arSorts = array(
    "RAND" => "ASC",
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
    $arSort_rev = ["RAND" => "ASC"];
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

    var reviews ={items: <?= $reviews ?>} ;
    console.log(reviews);
    $('.item_reviews__list').html(Mustache.render($('#review_tpl').html(), reviews));

</script>
<script id="review_tpl" type="x-tmpl-mustache">
    {{#items}}
    <li class="item_reviews__item">
        <div class="postedReviewItem_text">{{{REVIEW}}}</div>
        <div class="postedReviewItem_sign {{#LINK_REVIEW}} postedReviewItem_sign-link"><a href="{{LINK_REVIEW}}" class="link_general" target="_blank">{{NAME}}</a>{{/LINK_REVIEW}}
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
if ($in) {

    if (filter_input(INPUT_COOKIE, "user_denied")) {
        return;
    }
    if (!$_SESSION['updated']) {
        $_SESSION['updated'] = time();
    }
    $_SESSION['in_cart'] = true;
    if (!$_COOKIE['cnt_sess']) {
        setcookie('cnt_sess', 1, time() + 3600 * 24 * 365);
    } else {
        if (time() - $_SESSION['updated'] >= TIME_FOR_POPUP) {
            $cnt = $_COOKIE['cnt_sess'] ? $_COOKIE['cnt_sess'] : 0;
            $cnt++;
            $_SESSION['updated'] = time();
            setcookie('cnt_sess', $cnt, time() + 3600 * 24 * 365);
        }
    }

    if ($_COOKIE['from_utm'] || $_SESSION['in_catalog']) {
        if ($cnt > 5 || $_COOKIE['from_utm']) {
            $showed = true;
            setcookie('user_denied', '1', time() + 3600 * 24 * 365);
            ?>
            <div class="super_offer" id="offer_10">
                <i class="close">×</i>
                <div class="inner">
                    <p class="name">Скидка 10 % на все <br>двери для квартиры <br>из серии 100</p>
                    <p class="text mgb">Повторного предложения<br>не будет.</p>
                    <button class="red_but js_but" data-change=".js_but .js_mini_form">Получить скидку...</button>
                    <form action="/request/skidka.php" class="js_mini_form js-ajax-form form">
                        <input type="text" name="email" class="phantom">
                        <input type="hidden" id="product_name" name="product_name">
                        <input type="hidden" id="product_href" name="product_href">
                        <p class="text">Оставьте номер телефона для<br>согласования модели двери:</p>
                        <input type="text" name="phone" placeholder="Номер телефона" required>
                        <button class="red_but">Получить скидку</button>
                    </form>
                </div>
                <div class="thanks">
                    <p class="name">Скидка ваша!</p>
                    <p class="text">Менеджер свяжется с вами <br>в течение рабочего дня для <br>согласования модели двери <br>со скидкой.</p>
                </div>
            </div>
            <script>
                yaRequest("pokazskidki10");
            <?php if ($_COOKIE['from_utm']) { ?>
                    yaRequest("pokazskidki10utm");
            <? } ?>
                $("#product_name").val("<?= $arResult['NAME'] ?>");
                $("#product_href").val("http://<?= $_SERVER['HTTP_HOST'] ?><?= $_SERVER['REQUEST_URI'] ?>");
                super_offer();
                var started = <?= $_SESSION["started"] ?>;
                $(".js-ajax-form").on("submit", function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr("action"),
                        data: $(this).serialize(),
                        type: 'post',
                        success: function () {
                            yaRequest("otpravkaskidki10");
                            thanks_offer();
                        }
                    });
                })
            </script>
            <?
        }
    }
}

if (1 == 2 && !$_SESSION["user_denied"] && !$showed) {
    ?>
    <div class="super_offer five" id="offer_5">
        <i class="close">×</i>
        <p class="blue">В будние дни</p>
        <p class="name bold">Скидка 5%</p>
        <p class="text mgb">С 11:00 до 15:00  заключите договор в одном из салонов <br>и получите скидку</p>
        <a class="red_but bl" onclick="return yaRequest('klikskidka5');" target="_blank" href="/poleznaya-informaciya/pokupayte_vygodno_zaklyuchite_dogovor_dnyem_i_poluchite_skidku_v_5.html">Узнать условия</a>
    </div>
    <script>
        super_offer();
        var started = <?= $_SESSION["started"] ?>;
        if ((Math.ceil(new Date().getTime() / 1000) - started) > 30) {
            yaRequest("pokazskidki5");
            ctrl_offer('#offer_5', true);
        } else {
            setTimeout(function () {
                yaRequest("pokazskidki5");
                ctrl_offer('#offer_5', true);
            }, 30000 - (Math.ceil(new Date().getTime() / 1000) - started) * 1000);
        }
    </script>

    <?
}



CatalogViewedProductTable::refresh($arResult['ID'], CSaleBasket::GetBasketUserID());
