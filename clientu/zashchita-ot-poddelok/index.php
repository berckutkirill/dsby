<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Чтобы быть уверенным в том, что вы приобрели оригинальные двери, их подлинность можно проверить по 6 ориентировочным признакам.");
$APPLICATION->SetPageProperty("keywords", "Защита входных  дверей от подделок");
$APPLICATION->SetPageProperty("title", "Защита входных  дверей от подделок");
?>
<div class="wrap">
    <?
    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
            ), false
    );
    ?>
</div>
<div class="p-armor">
    <div class="c-wrapper">
        <section class="p-armor__hero">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/zashchita_ot_poddelok/head.php"
                    )
            );
            ?>
        </section>
        <section class="p-armor__photos">
            <div class="p-armor__photos-main">
                <div class="fotorama" data-nav="thumbs" data-height="630" 
                     data-width="1170" data-fit="cover" data-transition="crossfade" 
                     data-thumbwidth="128" data-thumbheight="69" data-swipe="false">
                    <a href="/bitrix/templates/steelline/img/rama-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama1-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama1-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama2-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama2-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama3-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama3-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama4-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama4-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama5-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama5-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama6-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama6-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama7-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama7-small.jpg"></a>
                    <a href="/bitrix/templates/steelline/img/rama8-2x.jpg" data-thumb="/bitrix/templates/steelline/img/rama8-small.jpg"></a>
                </div>
            </div>

            <div class="p-armor__photos-foot">
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", "", Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/zashchita_ot_poddelok/slider_footer.php"
                        )
                );
                ?>
            </div>
        </section>
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", "", Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/zashchita_ot_poddelok/identification.php"
                )
        );
        ?>
        <section class="p-armor__pass">            
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/zashchita_ot_poddelok/firm_znak.php"
                    )
            );
            ?>
        </section>
    </div>
    <section class="p-armor__map">
        <div class="c-wrapper">
            <h2 class="c-h3">Двери «Стальная линия» продаются в фирменных салонах и бренд-секциях:</h2>
        </div>
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:catalog.section", "only_map", array(
            "COMPONENT_TEMPLATE" => "map-new",
            "IBLOCK_TYPE" => "other",
            "IBLOCK_ID" => "17",
            "SECTION_ID" => $_REQUEST["SECTION_ID"],
            "SECTION_CODE" => "",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_FIELD2" => "sort",
            "ELEMENT_SORT_ORDER2" => "asc",
            "FILTER_NAME" => "arrFilter",
            "INCLUDE_SUBSECTIONS" => "Y",
            "SHOW_ALL_WO_SECTION" => "N",
            "HIDE_NOT_AVAILABLE" => "N",
            "PAGE_ELEMENT_COUNT" => "300",
            "LINE_ELEMENT_COUNT" => "3",
            "PROPERTY_CODE" => array(
                0 => "ADRESS",
                1 => "WORK_TIME",
                2 => "ADRESS_IN_SELECT",
                3 => "COORDINATES",
                4 => "OBLOST",
                5 => "BALOON_CONTENT",
                6 => "PHONES",
                7 => "SITE",
                8 => "",
            ),
            "OFFERS_LIMIT" => "5",
            "TEMPLATE_THEME" => "blue",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "SHOW_CLOSE_POPUP" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_BTN_COMPARE" => "Сравнить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "SET_TITLE" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => "Y",
            "META_DESCRIPTION" => "-",
            "ADD_SECTIONS_CHAIN" => "N",
            "SET_STATUS_404" => "N",
            "CACHE_FILTER" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRICE_CODE" => array(
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/basket.php",
            "USE_PRODUCT_QUANTITY" => "N",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRODUCT_PROPERTIES" => array(
            ),
            "ADD_TO_BASKET_ACTION" => "ADD",
            "DISPLAY_COMPARE" => "N",
            "PAGER_TEMPLATE" => ".default",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => "-",
            "BACKGROUND_IMAGE" => "-",
            "SEF_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "SET_LAST_MODIFIED" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "PRODUCT_QUANTITY_VARIABLE" => "",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N"
                ), false
        );
        ?>
    </section>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>