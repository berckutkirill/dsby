<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>
<div class="action catalog">
    <div class="wrap clearfix">
        <div class="sidebar">
            <h1 class="h2">Акции</h1>
            <ul class="menu">
                <?
                $date1 = date('Y-m-d');
                foreach ($arResult["SIDEBAR"] as $sb_item):


                    $date2 = $sb_item["PROPERTIES"]["ACTIVE_TO"]["VALUE"];
                    if (strtotime($date1) < strtotime($date2)) {
                        $cl = "";
                    } else {
                        $cl = "not";
                    }
                    if ($sb_item["CODE"] == $arResult["CODE"])
                        $class = "active";
                    else
                        $class = "";
                    ?>
                    <li><a href="<?= $sb_item["DETAIL_PAGE_URL"] ?>" class="<?= $class ?> <?= $cl ?>"><?= $sb_item["NAME"] ?></a></li>
                <? endforeach; ?>
            </ul>
            <h2>Услуги салона</h2>
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", ".default", array(
                "COMPONENT_TEMPLATE" => ".default",
                "AREA_FILE_SHOW" => "file",
                "SIDEBAR_DOP" => $arResult["SIDEBAR_TO"],
                "PATH" => "/include/sidebar_dop.php",
                "EDIT_TEMPLATE" => "standard.php"
                    ), false
            );
            ?>
        </div>
        <?
        $date = explode(".", $arResult["PROPERTIES"]["ACTIVE_TO"]["VALUE"]);
        $date2 = $arResult["PROPERTIES"]["ACTIVE_TO"]["VALUE"];
        if (strtotime($date1) < strtotime($date2)) {
            $cl = "";
        } else {
            $cl = "end";
        }
        ?>
        <div class="content <?= $cl ?>">
            <h1 class="title"><?= $arResult["NAME"] ?></h1>
            <? if ($arResult["PROPERTIES"]["SHOW_HEAD"]["VALUE"] != "Y") { ?>
                <div class="head">
                    <p class="date"><i>Акция действует</i> <?= $arResult["PROPERTIES"]["ACTIVE_FROM_TO"]["VALUE"] ?></p>
                    <span>Время окончания</span>
                    <ul class="timer" id="digital_watch"></ul>
                    <script>
                        $(function () {
                            var Month = <?= intVal($date[1]); ?>

                            function digitalWatch() {
                                var BD = <?= intVal($date[0]); ?>;
                                var today = new Date();
                                var BigDay = new Date(<?= intVal($date[2]); ?>, Month - 1, BD);
                                var timeLeft = (BigDay.getTime() - today.getTime());
                                var e_daysLeft = timeLeft / 86400000;
                                var daysLeft = Math.floor(e_daysLeft);
                                var e_hrsLeft = (e_daysLeft - daysLeft) * 24;
                                var hrsLeft = Math.floor(e_hrsLeft);
                                var e_minsLeft = (e_hrsLeft - hrsLeft) * 60;
                                var minsLeft = Math.floor(e_minsLeft);
                                var seksLeft = Math.floor((e_minsLeft - minsLeft) * 60);
                                if (daysLeft < 0) {
                                    daysLeft = '00';
                                    hrsLeft = '00';
                                    minsLeft = '00';
                                    seksLeft = '00';
                                    clearInterval(timer);
                                } else {
                                    if (daysLeft < 10)
                                        daysLeft = '0' + daysLeft;
                                    if (hrsLeft < 10)
                                        hrsLeft = '0' + hrsLeft;
                                    if (minsLeft < 10)
                                        minsLeft = '0' + minsLeft;
                                    if (seksLeft < 10)
                                        seksLeft = '0' + seksLeft;
                                }
                                document.getElementById("digital_watch").innerHTML = '<li><b class="num">' + daysLeft + '</b><i>дни</i></li><li><b class="num">' + hrsLeft + '</b><i>часы</i></li><li><b class="num">' + minsLeft + '</b><i>минуты</i></li> <li><b class="num">' + seksLeft + '</b><i>секунды</i></li>';

                                console.log(BD);
                                console.log(BigDay);
//                                console.log();
//                                console.log();

                            }
                            ;
                            var timer = setInterval(function () {
                                digitalWatch();
                            }, 1000)
                        })
                    </script>
                </div>
            <? } ?>
            <div class="img">
                <div class="ended"></div>
                <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>">
            </div>
            <div class="text">
                <?= $arResult["~DETAIL_TEXT"] ?>
            </div>
            <? if ($arResult["ID"] == 773) { ?>
                <div class="gen_code clearfix">
                    <h3>Форма генерации кода</h3>
                    <form class="get_code_form validate" action="/request/getCode.php">
                        <p>Введите номер телефона</p>
                        <input type="text" class="phone_value must" name="phone">
                        <button>Получить код</button>
                        <span class="blue">* Не для рекламных целей</span>
                    </form>
                    <div class="show_code">
                        <p>Ваш код скидки</p>
                        <span class="action_code">000000</span>
                    </div>
                    <div class="inf">
                        <p>Уточнить информацию</p>
                        <p>Вы можете по телефону</p>
                        <span>+375 (44) 769-78-50</span>
                    </div>
                </div>
            <? } ?>
            <?
            global $filter;
            if ($arResult["PROPERTIES"]["PRODS"]["VALUE"]) {

                $arParams["ELEMENT_SORT_FIELD"] = "SORT";
                $arParams["ELEMENT_SORT_ORDER"] = "ASC";
                if (filter_input(INPUT_GET, "sort") == "price") {
                    $arParams["ELEMENT_SORT_FIELD"] = "PROPERTY_MINIMUM_PRICE";
                    if (filter_input(INPUT_GET, "order") == "up") {
                        $arParams["ELEMENT_SORT_ORDER"] = "ASC";
                    } elseif (filter_input(INPUT_GET, "order") == "down") {
                        $arParams["ELEMENT_SORT_ORDER"] = "DESC";
                    } else {
                        $arParams["ELEMENT_SORT_ORDER"] = "ASC";
                    }
                }

//                $filter = array("ID" => $arResult["PROPERTIES"]["PRODS"]["VALUE"]);
//                print_r( $arResult["PROPERTIES"]["PRODS"]["VALUE"]);

                $APPLICATION->IncludeComponent(
                        "rest:catalog.section", "new_with_sku_rest_action", array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "22",
                    "SEF_MODE" => "Y",
                    "NO_TPL" => true,
                    "ELEMENT_SORT_FIELD" => "shows",
                    "ELEMENT_SORT_ORDER" => "DESC",
                    "SEF_FOLDER" => "/rest/",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "PAGE_ELEMENT_COUNT" => 12,
                    "DEFAULT_H1" => "Входные двери",
                    "FOR_PATH" => $_SERVER['REQUEST_URI'],
                    "CACHE_FILTER" => "N",
                    "SECTION_URL" => "/catalog-dverei/#SECTION_CODE#/",
                    "DETAIL_URL" => "/catalog-dverei/stalnaya-liniya/#ELEMENT_CODE#.html",
                    "FILTER_ID" => $arResult["PROPERTIES"]["PRODS"]["VALUE"],
                    "SEARCH" => "YES"
                        ), false
                );


                /*
                  $APPLICATION->IncludeComponent(
                  "bitrix:catalog.section", "new_shares_new", array(
                  "IBLOCK_TYPE" => "catalog",
                  "IBLOCK_ID" => "22",
                  "SECTION_ID" => "",
                  "SECTION_CODE" => "",
                  "SECTION_USER_FIELDS" => array(
                  0 => "",
                  1 => "",
                  ),
                  "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                  "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                  "ELEMENT_SORT_FIELD2" => "id",
                  "ELEMENT_SORT_ORDER2" => "desc",
                  "FILTER_NAME" => "filter",
                  "INCLUDE_SUBSECTIONS" => "Y",
                  "SHOW_ALL_WO_SECTION" => "Y",
                  "HIDE_NOT_AVAILABLE" => "N",
                  "PAGE_ELEMENT_COUNT" => "22",
                  "LINE_ELEMENT_COUNT" => "3",
                  "PROPERTY_CODE" => array(
                  0 => "",
                  1 => "URL",
                  2 => "",
                  ),
                  "OFFERS_LIMIT" => "5",
                  "TEMPLATE_THEME" => "blue",
                  "ADD_PICT_PROP" => "-",
                  "LABEL_PROP" => "-",
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
                  "CACHE_TYPE" => "N",
                  "CACHE_TIME" => "36000000",
                  "CACHE_GROUPS" => "Y",
                  "SET_TITLE" => "N",
                  "SET_BROWSER_TITLE" => "N",
                  "BROWSER_TITLE" => "-",
                  "SET_META_KEYWORDS" => "Y",
                  "META_KEYWORDS" => "-",
                  "SET_META_DESCRIPTION" => "N",
                  "META_DESCRIPTION" => "-",
                  "ADD_SECTIONS_CHAIN" => "N",
                  "SET_STATUS_404" => "N",
                  "CACHE_FILTER" => "N",
                  "ACTION_VARIABLE" => "action",
                  "PRODUCT_ID_VARIABLE" => "id",
                  "PRICE_CODE" => array(
                  0 => "BASE",
                  ),
                  "USE_PRICE_COUNT" => "N",
                  "SHOW_PRICE_COUNT" => "1",
                  "PRICE_VAT_INCLUDE" => "Y",
                  "CONVERT_CURRENCY" => "N",
                  "BASKET_URL" => "/cart/",
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
                  "AJAX_OPTION_ADDITIONAL" => "",
                  "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                  "COMPONENT_TEMPLATE" => "new_shares_new",
                  "OFFERS_FIELD_CODE" => array(
                  0 => "ID",
                  1 => "CODE",
                  2 => "XML_ID",
                  3 => "NAME",
                  4 => "TAGS",
                  5 => "SORT",
                  6 => "PREVIEW_TEXT",
                  7 => "PREVIEW_PICTURE",
                  8 => "DETAIL_TEXT",
                  9 => "DETAIL_PICTURE",
                  10 => "DATE_ACTIVE_FROM",
                  11 => "ACTIVE_FROM",
                  12 => "DATE_ACTIVE_TO",
                  13 => "ACTIVE_TO",
                  14 => "SHOW_COUNTER",
                  15 => "SHOW_COUNTER_START",
                  16 => "IBLOCK_TYPE_ID",
                  17 => "IBLOCK_ID",
                  18 => "IBLOCK_CODE",
                  19 => "IBLOCK_NAME",
                  20 => "IBLOCK_EXTERNAL_ID",
                  21 => "DATE_CREATE",
                  22 => "CREATED_BY",
                  23 => "CREATED_USER_NAME",
                  24 => "TIMESTAMP_X",
                  25 => "MODIFIED_BY",
                  26 => "USER_NAME",
                  27 => "",
                  ),
                  "OFFERS_PROPERTY_CODE" => array(
                  0 => "DECOR_ARTICLE",
                  1 => "DECOR_PHOTO_IN",
                  2 => "CHARAKTER_DECOR_BASE_OUT",
                  3 => "CHARAKTER_DECOR_BASE_IN",
                  4 => "CHARAKTER_DECOR_THICKNESS_BASE_OUT",
                  5 => "CHARAKTER_DECOR_THICKNESS_BASE_IN",
                  6 => "CHARAKTER_DECOR_TECH_OUT",
                  7 => "CHARAKTER_DECOR_TECH_IN",
                  8 => "CHARAKTER_DECOR_COVER_OUT",
                  9 => "CHARAKTER_DECOR_COVER_IN",
                  10 => "CHARAKTER_DECOR_COLOR_OUT",
                  11 => "CHARAKTER_DECOR_COLOR_IN",
                  12 => "CHARAKTER_DECOR_OPTIONS_PAINTING_BOX_IN",
                  13 => "CHARAKTER_DECOR_OPTIONS_PAINTING_BOX_OUT",
                  14 => "",
                  ),
                  "OFFERS_SORT_FIELD" => "sort",
                  "OFFERS_SORT_ORDER" => "asc",
                  "OFFERS_SORT_FIELD2" => "id",
                  "OFFERS_SORT_ORDER2" => "desc",
                  "BACKGROUND_IMAGE" => "-",
                  "PRODUCT_DISPLAY_MODE" => "N",
                  "SEF_MODE" => "N",
                  "SET_LAST_MODIFIED" => "N",
                  "USE_MAIN_ELEMENT_SECTION" => "N",
                  "OFFERS_CART_PROPERTIES" => array(
                  ),
                  "PAGER_BASE_LINK_ENABLE" => "N",
                  "SHOW_404" => "N",
                  "MESSAGE_404" => "",
                  "DISABLE_INIT_JS_IN_COMPONENT" => "N"
                  ), false
                  ); */
            }
            ?>
            <? if ($arResult["ID"] == 773) { ?>
                <!--div class="gen_code clearfix">
                        <h3>Форма генерации кода</h3>
                        <form class="get_code_form validate" action="/request/getCode.php">
                                <p>Введите номер телефона</p>
                                <input type="text" class="phone_value must" name="phone">
                                <button>Получить код</button>
                                <span class="blue">* Не для рекламных целей</span>
                        </form>
                        <div class="show_code">
                                <p>Ваш код скидки</p>
                                <span class="action_code">000000</span>
                        </div>
                        <div class="inf">
                                <p>Уточнить информацию</p>
                                <p>Вы можете по телефону</p>
                                <span>+375 (44) 769-78-50</span>
                        </div>
                </div-->
                <script>
                    function dataOpen() {
                        gaRequest("Открыл карту на акции");
                        $(".mapPopup2").removeClass("mapPopup2");
                    }
                    $(function () {
                        $(".fade2, close").on("click", function () {
                            $(".mapPopup").addClass("mapPopup2");
                        })
                    })
                    $(".get_code_form").on("submit", function (e) {
                        e.preventDefault();
                        var this_form = $(this);
                        gaRequest("Получить код");
                        if (!this_form.find(".phone_value").val())
                            return false;
                        $.ajax({
                            url: $(this).attr("action"),
                            data: {"phone": this_form.find(".phone_value").val()},
                            type: "post",
                            success: function (res) {
                                $(".action_code").text(res);
                            }
                        })
                    })
                </script>
            <? } ?>
        </div>
    </div>
</div>
<? if ($arResult["ID"] == 773 || $arResult["ID"] == 1615) { ?>
    <div class="mapPopup2" id="mapPopup">
        <?
        $APPLICATION->IncludeComponent("bitrix:catalog.section", "map_detail", Array(
            "COMPONENT_TEMPLATE" => "map",
            "IBLOCK_TYPE" => "other", // Тип инфоблока
            "IBLOCK_ID" => "17", // Инфоблок
            "SECTION_ID" => "", // ID раздела
            "SECTION_CODE" => "", // Код раздела
            "SECTION_USER_FIELDS" => array(// Свойства раздела
                0 => "",
                1 => "undefined",
                2 => "",
            ),
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_FIELD2" => "sort",
            "ELEMENT_SORT_ORDER2" => "asc",
            "FILTER_NAME" => "arrFilter", // Имя массива со значениями фильтра для фильтрации элементов
            "INCLUDE_SUBSECTIONS" => "Y", // Показывать элементы подразделов раздела
            "SHOW_ALL_WO_SECTION" => "N", // Показывать все элементы, если не указан раздел
            "HIDE_NOT_AVAILABLE" => "N", // Не отображать товары, которых нет на складах
            "PAGE_ELEMENT_COUNT" => "300", // Количество элементов на странице
            "LINE_ELEMENT_COUNT" => "3", // Количество элементов выводимых в одной строке таблицы
            "PROPERTY_CODE" => array(// Свойства
                0 => "ADRESS",
                1 => "WORK_TIME",
                2 => "ADRESS_IN_SELECT",
                3 => "COORDINATES",
                4 => "OBLOST",
                5 => "SITE",
                6 => "BALOON_CONTENT",
                7 => "PHONES",
                8 => "undefined",
                9 => "",
            ),
            "OFFERS_LIMIT" => "5", // Максимальное количество предложений для показа (0 - все)
            "TEMPLATE_THEME" => "blue", // Цветовая тема
            "PRODUCT_SUBSCRIPTION" => "N", // Разрешить оповещения для отсутствующих товаров
            "SHOW_DISCOUNT_PERCENT" => "N", // Показывать процент скидки
            "SHOW_OLD_PRICE" => "N", // Показывать старую цену
            "SHOW_CLOSE_POPUP" => "N", // Показывать кнопку продолжения покупок во всплывающих окнах
            "MESS_BTN_BUY" => "Купить", // Текст кнопки "Купить"
            "MESS_BTN_ADD_TO_BASKET" => "В корзину", // Текст кнопки "Добавить в корзину"
            "MESS_BTN_SUBSCRIBE" => "Подписаться", // Текст кнопки "Уведомить о поступлении"
            "MESS_BTN_COMPARE" => "Сравнить", // Текст кнопки "Сравнить"
            "MESS_BTN_DETAIL" => "Подробнее", // Текст кнопки "Подробнее"
            "MESS_NOT_AVAILABLE" => "Нет в наличии", // Сообщение об отсутствии товара
            "SECTION_URL" => "", // URL, ведущий на страницу с содержимым раздела
            "DETAIL_URL" => "", // URL, ведущий на страницу с содержимым элемента раздела
            "SECTION_ID_VARIABLE" => "SECTION_ID", // Название переменной, в которой передается код группы
            "AJAX_MODE" => "N", // Включить режим AJAX
            "AJAX_OPTION_JUMP" => "N", // Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y", // Включить подгрузку стилей
            "AJAX_OPTION_HISTORY" => "N", // Включить эмуляцию навигации браузера
            "CACHE_TYPE" => "A", // Тип кеширования
            "CACHE_TIME" => "36000000", // Время кеширования (сек.)
            "CACHE_GROUPS" => "Y", // Учитывать права доступа
            "SET_TITLE" => "Y", // Устанавливать заголовок страницы
            "SET_BROWSER_TITLE" => "Y", // Устанавливать заголовок окна браузера
            "BROWSER_TITLE" => "-", // Установить заголовок окна браузера из свойства
            "SET_META_KEYWORDS" => "Y", // Устанавливать ключевые слова страницы
            "META_KEYWORDS" => "-", // Установить ключевые слова страницы из свойства
            "SET_META_DESCRIPTION" => "Y", // Устанавливать описание страницы
            "META_DESCRIPTION" => "-", // Установить описание страницы из свойства
            "ADD_SECTIONS_CHAIN" => "N", // Включать раздел в цепочку навигации
            "SET_STATUS_404" => "N", // Устанавливать статус 404, если не найдены элемент или раздел
            "CACHE_FILTER" => "N", // Кешировать при установленном фильтре
            "ACTION_VARIABLE" => "action", // Название переменной, в которой передается действие
            "PRODUCT_ID_VARIABLE" => "id", // Название переменной, в которой передается код товара для покупки
            "PRICE_CODE" => "", // Тип цены
            "USE_PRICE_COUNT" => "N", // Использовать вывод цен с диапазонами
            "SHOW_PRICE_COUNT" => "1", // Выводить цены для количества
            "PRICE_VAT_INCLUDE" => "Y", // Включать НДС в цену
            "CONVERT_CURRENCY" => "N", // Показывать цены в одной валюте
            "BASKET_URL" => "/personal/basket.php", // URL, ведущий на страницу с корзиной покупателя
            "USE_PRODUCT_QUANTITY" => "N", // Разрешить указание количества товара
            "ADD_PROPERTIES_TO_BASKET" => "Y", // Добавлять в корзину свойства товаров и предложений
            "PRODUCT_PROPS_VARIABLE" => "prop", // Название переменной, в которой передаются характеристики товара
            "PARTIAL_PRODUCT_PROPERTIES" => "N", // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
            "PRODUCT_PROPERTIES" => "", // Характеристики товара
            "ADD_TO_BASKET_ACTION" => "ADD", // Показывать кнопку добавления в корзину или покупки
            "DISPLAY_COMPARE" => "N", // Разрешить сравнение товаров
            "PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
            "DISPLAY_TOP_PAGER" => "N", // Выводить над списком
            "DISPLAY_BOTTOM_PAGER" => "Y", // Выводить под списком
            "PAGER_TITLE" => "Товары", // Название категорий
            "PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
            "PAGER_DESC_NUMBERING" => "N", // Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", // Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N", // Показывать ссылку "Все"
            "ADD_PICT_PROP" => "-", // Дополнительная картинка основного товара
            "LABEL_PROP" => "-", // Свойство меток товара
                ), false
        );
        ?>

    </div>

    <div class="fade2"><i class="close"></i></div>
    <div id="popup_place" class="popup"></div>
    <style>
        .mapPopup2 {
            display: block !important;
            position: static;
            width: inherit;
            transform: translate(0,0);
            -moz-transform: translate(0,0);
            -ms-transform: translate(0,0);
            -webkit-transform: translate(0,0);
            -o-transform: translate(0,0);
        }
    </style>
<? } ?>