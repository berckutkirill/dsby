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
<div class="cool_item">
    
    <div class="fix js_fix">
        <div class="wrap new clearfix">
            <div class="imgs fll clearfix">
                <div class="img fll">
                    <div class="td"><img src="" alt="" class="js_front_setter"></div>
                </div>
                <div class="img flr">
                    <div class="td"><img src="" alt="" class="js_back_setter"></div>
                </div>
            </div>
            <div class="name fll">
                <div class="td"><?php echo $arResult["NAME"] ?></div>
            </div>
            <div class="text fll js_info_setter"></div>
            <div class="right flr clearfix">
                <div class="price_wrap js_price_wrap fll">
                    <p class="sale_price js_price_sale"></p>
                    <p class="price"><span class="num js_price"></span> руб.</p>
                    <p class="old_rub js_old_price"></p>
                </div>
                <a href="" class="button js_buy flr"><?php echo getMessage("I_WANT_IT"); ?></a>
            </div>
        </div>
    </div>
    <div class="head wrap new clearfix">
        <div class="galery fll js_galery">
            <div class="td js_flip">
                <div class="js_img js_front"><img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?php echo $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>
                <div class="js_img js_back"><img src="<?php echo $arResult["DETAIL_PICTURE_OUT"]["SRC"] ?>" alt="<?php echo $arResult["DETAIL_PICTURE_OUT"]["ALT"] ?>"></div>
                <span class="turn">
                    <span class="circ"></span><br>
                    <span class="text gg"><?php echo getMessage("LOOK"); ?></span><br>
                    <span class="text js_turn"><?php echo getMessage("inside"); ?></span>
                </span>
            </div>
            <div class="prev js_prev"></div>
            <div class="next js_next"></div>
        </div>
        <div class="main_info flr">
            <h1 class="title"><?php echo $arResult["NAME"] ?></h1>
            <?php if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) { ?>
                <ul class="labels">
                    <?php foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $val) { ?>
                        <li class="<?php echo $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k]; ?>"><?php echo $val; ?></li>
                    <?php } ?>
                </ul>
                <?php
            }
            if ($arResult["PROPS"]["MAIN"]) {
                ?>
                <div class="params">
                    <?php foreach ($arResult["PROPS"]["MAIN"] as $val) { ?>
                        <p><span><?php echo $val["NAME"]; ?></span><b><?php echo $val["VALUE"]; if($val["HINT"]) {echo " {$val['HINT']}";} ?></b></p>
                    <?php } ?>
                </div>
                <?php
            }
            if (!empty($arResult["OFFERS"])) {
                ?>
                <p class="h3"><?php echo getMessage("COLORS"); ?></p>
                <ul class="sets clearfix">
                    <?php foreach ($arResult["OFFERS"] as $k => $arOffer) { ?>
                        <li data-door="<?php echo $k; ?>" class="clearfix fll" data-price="<?php echo $arOffer["MIN_PRICE"]["VALUE"] ?>"
                        <?php if ($arOffer["MIN_PRICE"]["VALUE"] > $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                data-price-sale="<?php echo $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]; ?>"
                            <?php } ?>
                            data-href="<?php echo $arOffer["BUY_URL"] ?>"
                            >
                                <?php if ($arOffer["DETAIL_PICTURES"]) { ?>

                                <div class="img fll">
                                    <div class="td"><img src="<?php echo $arOffer["DETAIL_PICTURES"][0]["SRC"]; ?>" alt="<?php echo $arOffer["DETAIL_PICTURES"][0]["ALT"] ?>" class="js_img"></div>
                                </div>
                                <div class="img flr">
                                    <div class="td"><img src="<?php echo $arOffer["DETAIL_PICTURES"][1]["SRC"]; ?>" alt="<?php echo $arOffer["DETAIL_PICTURES"][1]["ALT"]; ?>" class="js_img"></div>
                                </div>
                                <?php
                            }
                            if ($arOffer["TOOLTIP"]["ARTICLE"] || $arOffer["TOOLTIP"]["OUTSIDE"] || $arOffer["TOOLTIP"]["INSIDE"]) {
                                ?>
                                <div class="tooltip js_info">
                                    <?php if ($arOffer["TOOLTIP"]["ARTICLE"]) { ?>
                                        <p><?php echo $arOffer["TOOLTIP"]["ARTICLE"] ?></p>
                                    <?php } ?>
                                    <?php if ($arOffer["TOOLTIP"]["OUTSIDE"]) { ?>
                                        <p class="js_out"><?php echo getMessage("OUT"); ?><?php echo $arOffer["TOOLTIP"]["OUTSIDE"] ?></p>
                                    <?php } ?>
                                    <?php if ($arOffer["TOOLTIP"]["INSIDE"]) { ?>
                                        <p class="js_in"><?php echo getMessage("IN"); ?><?php echo $arOffer["TOOLTIP"]["INSIDE"] ?></p>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <div class="clearfix">
                <p class="salons fll">
                    <?php echo getMessage("GO_TO_SALOON"); ?>
                    <a href="/gde_kupit/" target="_blank"><span><?php echo getMessage("MAP_OF_SALOONS"); ?></span></a>
                </p>
                <p class="salons fll carts">
                    <?php echo getMessage("CREDIT"); ?><br>
                    <a class="halva js_installments_cards"><span><?php echo getMessage("CREDIT_HALVA"); ?></span></a><br>
                    <a class="karta_pokupok js_installments_cards"><span><?php echo getMessage("CREDIT_MAP_BUY"); ?></span></a><br>
                    <a class="smart_karta js_installments_cards"><span><?php echo getMessage("CREDIT_SMART_CARD"); ?></span></a>
                </p>
            </div>
        </div>
    </div>
    <div class="tabs_block js_tabs_block">
        <div class="top">
            <div class="wrap new">
                <p class="h2"><?php echo getMessage("BASE_COMPLECT"); ?></p>
                <ul class="control js_control clearfix">
                    <?php $first = true; ?>
                    <?php foreach ($arResult["TABS_HEAD"] as $k => $code) { ?>
                        <?php
                        if ($first) {
                            $class = " class='active'";
                            $first = false;
                        } else {
                            $class = "";
                        }
                        ?>
                        <li<?php echo $class; ?> data-tab="<?php echo $k; ?>"><span><?php echo getMessage($code); ?></span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="middle js_screen js_tables wrap new">
            <?php foreach ($arResult["TABS_HEAD"] as $k => $code) { ?>
                <?php
                if (!$arResult["PROPS"][$code]) {
                    continue;
                }
                ?>
                <div data-tab="<?php echo $k; ?>">
                    <?php
                    if (in_array($code, $arResult["FROM_OFFERS"])) {
                        $i = 0;
                        ?>
                        <?php foreach ($arResult["PROPS"][$code] as $offerID => $offerProps) { ?>
                            <table data-num="<?php echo $i++; ?>" class="table">
                                <tr>
                                    <?php foreach ($arResult["THEAD"][$code] as $title) { ?>
                                        <th><?php echo getMessage($title); ?></th>
                                    <?php } ?>
                                </tr>
                                <?php foreach ($offerProps as $property) { ?>
                                    <tr>
                                        <?php foreach ($arResult["THEAD"][$code] as $title) { ?>
                                            <td><?php echo $property[$title] ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>
                    <?php } else { ?>
                        <?php $properties = $arResult["PROPS"][$code]; ?>
                        <table class="table only" data-tab="<?php echo $k; ?>">
                            <tr>
                                <?php foreach ($arResult["THEAD"][$code] as $title) { ?>
                                    <th><?php echo getMessage($title); ?></th>
                                <?php } ?>
                            </tr>
                            <?php foreach ($properties as $property) { ?>
                                <tr>
                                    <?php foreach ($arResult["THEAD"][$code] as $title) { ?>
                                        <td><?php echo $property[$title] ?></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="bottom"></div>
    </div>
    <div class="description wrap new clearfix">
        <p class="h2"><?php echo getMessage("DESCRIPTION"); ?></p>
        <div class="text fll">
            <?php echo $arResult["~DETAIL_TEXT"]; ?>
        </div>
        <div class="imgs flr clearfix">
            <div class="img fll">
                <div class="td"><img src="" alt="" class="js_front_setter"></div>
                <p class="js_front_setter_inf"></p>
            </div>
            <div class="img flr">
                <div class="td"><img src="" alt="" class="js_back_setter"></div>
                <p class="js_back_setter_inf"></p>
            </div>
        </div>
    </div>

    <?php
    if ($arResult["PROPERTIES"]["COLOURS_ON_REQUEST"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "TABS" => $arResult["PROPERTIES"]["COLOURS_ON_REQUEST"],
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_colors.php"
                ), false
        );
    }
    ?>

    <?php
    if ($arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "TABS" => $arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST"],
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_portals.php"
                ), false
        );
    }
    ?>
    <?php
    if ($arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "TABS" => $arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"],
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_locks.php"
                ), false
        );
    }
    ?>
    <?php
    if ($arResult["PROPERTIES"]["SIZE_ON_REQUEST"]["VALUE_ENUM_ID"] == "1491") {
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_sever.php"
                ), false
        );
    }
    ?>
    <?php
    if ($arResult["PROPERTIES"]["INSTALL_TRANSOMS_ON_REQUEST"]["VALUE_XML_ID"] === INSTALL_TRANSOMS_ON_REQUEST_YES) {
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_dobor.php"
                ), false
        );
    }
    ?>

    <div class="head wrap new clearfix">
        <div class="galery fll js_galery">
            <div class="td js_flip">
                <div class="js_img js_front"><img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?php echo $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>
                <div class="js_img js_back"><img src="<?php echo $arResult["DETAIL_PICTURE_OUT"]["SRC"] ?>" alt="<?php echo $arResult["DETAIL_PICTURE_OUT"]["ALT"] ?>"></div>
                <span class="turn">
                    <span class="circ"></span><br>
                    <span class="text gg"><?php echo getMessage("LOOK"); ?></span><br>
                    <span class="text js_turn"><?php echo getMessage("inside"); ?></span>
                </span>
            </div>
            <div class="prev js_prev"></div>
            <div class="next js_next"></div>
        </div>
        <div class="main_info flr">
            <p class="choose"><?php getMessage("YOU_WAS_CHOOSE"); ?></p>
            <p class="title"><?php echo $arResult["NAME"] ?></p>
            <?php if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) { ?>
                <ul class="labels">
                    <?php foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $val) { ?>
                        <li class="<?php echo $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k]; ?>"><?php echo $val; ?></li>
                    <?php } ?>
                </ul>
                <?php
            }
            if (!empty($arResult["OFFERS"])) {
                ?>
                <p class="h3"><?php echo getMessage("COLORS"); ?></p>
                <ul class="sets clearfix">
                    <?php foreach ($arResult["OFFERS"] as $k => $arOffer) { ?>
                        <li data-door="<?php echo $k; ?>" class="clearfix fll" data-price="<?php echo $arOffer["MIN_PRICE"]["VALUE"] ?>"
                        <?php if ($arOffer["MIN_PRICE"]["VALUE"] > $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                data-price-sale="<?php echo $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]; ?>"
                            <?php } ?>
                            data-href="<?php echo $arOffer["BUY_URL"] ?>"
                            >
                                <?php if ($arOffer["DETAIL_PICTURES"]) { ?>

                                <div class="img fll">
                                    <div class="td"><img src="<?php echo $arOffer["DETAIL_PICTURES"][0]["SRC"]; ?>" alt="<?php echo $arOffer["DETAIL_PICTURES"][0]["ALT"] ?>" class="js_img"></div>
                                </div>
                                <div class="img flr">
                                    <div class="td"><img src="<?php echo $arOffer["DETAIL_PICTURES"][1]["SRC"]; ?>" alt="<?php echo $arOffer["DETAIL_PICTURES"][1]["ALT"]; ?>" class="js_img"></div>
                                </div>
                                <?php
                            }
                            if ($arOffer["TOOLTIP"]["ARTICLE"] || $arOffer["TOOLTIP"]["OUTSIDE"] || $arOffer["TOOLTIP"]["INSIDE"]) {
                                ?>
                                <div class="tooltip js_info">
                                    <?php if ($arOffer["TOOLTIP"]["ARTICLE"]) { ?>
                                        <p><?php echo $arOffer["TOOLTIP"]["ARTICLE"] ?></p>
                                    <?php } ?>
                                    <?php if ($arOffer["TOOLTIP"]["OUTSIDE"]) { ?>
                                        <p class="js_out"><?php echo getMessage("OUT"); ?><?php echo $arOffer["TOOLTIP"]["OUTSIDE"] ?></p>
                                    <?php } ?>
                                    <?php if ($arOffer["TOOLTIP"]["INSIDE"]) { ?>
                                        <p class="js_in"><?php echo getMessage("IN"); ?><?php echo $arOffer["TOOLTIP"]["INSIDE"] ?></p>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <div class="clearfix">
                <p class="salons fll"><?php echo getMessage("GO_TO_SALOON"); ?><a href="/gde_kupit/" target="_blank"><span><?php echo getMessage("MAP_OF_SALOONS"); ?></span></a></p>
                <p class="salons fll carts">
                    <?php echo getMessage("CREDIT"); ?><br>
                    <a class="halva js_installments_cards"><span><?php echo getMessage("CREDIT_HALVA"); ?></span></a><br>
                    <a class="karta_pokupok js_installments_cards"><span><?php echo getMessage("CREDIT_MAP_BUY"); ?></span></a><br>
                    <a class="smart_karta js_installments_cards"><span><?php echo getMessage("CREDIT_SMART_CARD"); ?></span></a>
                </p>
            </div>
        </div>
    </div>

    <?php if (count($arResult["SIMILAR_ELEMENTS"])) { ?>
        <div class="cool_clones js_row_slider wrap new">
            <p class="h2"><?php echo getMessage("LOOK_SIMILAR_DOORS"); ?></p>
            <div class="slides_wrap">
                <ul class="js_carret">
                    <?php foreach ($arResult["SIMILAR_ELEMENTS"] as $element) { ?>
                        <li class="js_li li">
                            <a href="<?php echo $element["DETAIL_PAGE_URL"]; ?>">
                                <div class="clearfix">
                                    <div class="img fll">
                                        <img src="<?php echo $element["PICTURE_1"]; ?>" alt="<?php echo $element["NAME"]; ?>">
                                    </div>
                                    <div class="img flr">
                                        <img src="<?php echo $element["PICTURE_2"]; ?>" alt="<?php echo $element["NAME"]; ?>">
                                    </div>
                                </div>
                                <div class="bottom">
                                    <span class="name"><?php echo $element["NAME"]; ?></span>
                                    <?php if ($element["PROPERTIES"]["DESTINATION_ICON"]["VALUE"]) { ?>
                                        <ul class="labels clearfix">
                                            <?php foreach ($element["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $val) { ?>
                                                <li class="<?php echo $element["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k]; ?>"><?php echo $val; ?></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>

                                    <?php
                                    if ( $element["MIN_PRICE"]["DISCOUNT_VALUE"] && $element["MIN_PRICE"]["VALUE"] > $element["MIN_PRICE"]["DISCOUNT_VALUE"]) {
                                        $sale = true;
                                    } else {
                                        $sale = false;
                                    }
                                    ?>
                                    <div class="price_wrap <?php echo $sale ? "sale" : ""; ?> fll">
                                        <?php if ($sale) { ?>
                                            <p class="sale_price"><?php echo $element["MIN_PRICE"]["DISCOUNT_VALUE"]; ?></p>
                                        <?php } ?>
                                        <p class="price"><span class="num"><?php echo $element["MIN_PRICE"]["VALUE"]; ?></span> руб.</p>
                                    </div>

                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <span class="prev control js_prev disabled"></span>
            <span class="next control js_next"></span>
        </div>

    <?php } ?>
    <script>
        $(function () {
            row_slider({
                parent_query: $('.js_row_slider'),
                width_element_with_margin: 335,
                number_of_visible_elements: 3
            });
            cart_app();
        })
    </script>
    <div class="modal_bg">
        <div class="modal installments halva">
            <div class="modal_header">
                <p class="bank_name">МТБанк</p>
                <h2 class="bank_program_name">Рассрочка по «Халва»</h2>
                <span class="modal_close">&#xe900;</span>
            </div>
            <div class="modal_body">
                <p class="bank_program_descr">При покупке двери в фирменном салоне вы самостоятельно определяете сумму платежа по&nbsp;карте — от 30&thinsp;% до&nbsp;100&thinsp;%. Оставшаяся часть вносится равными долями до 15 числа в течение двух последующих месяцев.</p>
                <p class="bank_program_term"><span>2 месяца</span> период рассрочки</p>
                <ul class="installment_adress">
                    <li>ТЦ «Трюм», <br>
                        ул. Кальварийская, 7Б-6 <br>
                       будние дни с 10:00 до 20:00 <br>
                        выходные с 10:00 до 18:00 </li>
                    <li>пр. Дзержинского, 131 <br>
                        будние дни с 10:00 до 20:00 <br>
                        выходные с 10:00 до 18:00 </li>
                </ul>
                <p class="installment_clause"><span class="exclamation modal_exclamation">!</span>Рассрочка действует на все входные двери, кроме акционных</p>
            </div>
            <div class="modal_footer"><a href="/oplata/kartoi-rassrochki/" target="_blank" class="modal_footer_link">Другие карты рассрочек</a></div>
        </div>
        <div class="modal installments karta_pokupok">
            <div class="modal_header">
                <p class="bank_name">Белгазпромбанк</p>
                <h2 class="bank_program_name">Рассрочка по «Карта покупок»</h2>
                <span class="modal_close">&#xe900;</span>
            </div>
            <div class="modal_body">
                <p class="bank_program_descr">При покупке двери в фирменном салоне вы самостоятельно определяете сумму платежа по&nbsp;карте — от 30&thinsp;% до&nbsp;100&thinsp;%. Оставшаяся часть вносится равными долями до 20 числа в течение пяти последующих месяцев.</p>
                <p class="bank_program_term"><span>5 месяцев</span> период рассрочки</p>
                <ul class="installment_adress">
                    <li>ТЦ «Трюм», <br>
                        ул. Кальварийская, 7Б-6 <br>
                        будние дни с 10:00 до 20:00 <br>
                        выходные с 10:00 до 18:00 </li>
                    <li>пр. Дзержинского, 131 <br>
                        будние дни с 10:00 до 20:00 <br>
                        выходные с 10:00 до 18:00 </li>
                </ul>
                <p class="installment_clause"><span class="exclamation modal_exclamation">!</span>Рассрочка действует на все входные двери, кроме акционных</p>
            </div>
            <div class="modal_footer"><a href="/oplata/kartoi-rassrochki/" target="_blank" class="modal_footer_link">Другие карты рассрочек</a></div>
        </div>
        <div class="modal installments smart_karta">
            <div class="modal_header">
                <p class="bank_name">Банк Москва-Минск</p>
                <h2 class="bank_program_name">Рассрочка по «Смарт карте»</h2>
                <span class="modal_close">&#xe900;</span>
            </div>
            <div class="modal_body">
                <p class="bank_program_descr">При покупке двери в фирменном салоне вы самостоятельно определяете сумму платежа по&nbsp;карте— от 30&thinsp;% до&nbsp;100&thinsp;%. Оставшаяся часть вносится равными долями до 20 числа в течение трёх последующих месяцев.</p>
                <p class="bank_program_term"><span>3 месяца</span> период рассрочки</p>
                <ul class="installment_adress">
                    <li>ТЦ «Трюм», <br>
                        ул. Кальварийская, 7Б-6 <br>
                 будние дни с 10:00 до 20:00 <br>
                        выходные с 10:00 до 18:00 </li>
                    <li>пр. Дзержинского, 131 <br>
                        будние дни с 10:00 до 20:00 <br>
                        выходные с 10:00 до 18:00 </li>
                </ul>
                <p class="installment_clause"><span class="exclamation modal_exclamation">!</span>Рассрочка действует на все входные двери, кроме акционных</p>
            </div>
            <div class="modal_footer"><a href="/oplata/kartoi-rassrochki/" target="_blank" class="modal_footer_link">Другие карты рассрочек</a></div>
        </div>
    </div>
    <script>
        $(".js_installments_cards").on("click", function() {
            var itemClass = $(this).attr("class");
            var spaceIndex = itemClass.indexOf(" ");
            var cardType = itemClass.slice(0,spaceIndex);
            $(".modal_bg").fadeIn(300);
            $(".modal.installments").filter("." + cardType).addClass("active");
        })
        $(".modal_bg, .modal_close").on("click", function() {
            $(".modal.installments").removeClass("active");
            $(".modal_bg").fadeOut(300);
        });
        $(document).keydown(function(e) {
            if (e.keyCode === 27) {
                $(".modal.installments").removeClass("active");
                $(".modal_bg").fadeOut(300);
            }
        });
        $(".modal").click(function(event) {
        	event.stopPropagation();
        })
    </script>
</div>