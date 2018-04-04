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
if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"]) {
    $class = " dambldoor";
}
$sample = in_array("sample", $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"]) ? true : false;
$halva = 4;
$card_pokupok = 8;
$card_smart = 5;
$furns = GetHBlock(23, ["UF_SECTIONS" => $arResult["IBLOCK_SECTION_ID"]], []);
$FURNS = ["LOCKS" => [], "HANDS" => []];
foreach ($furns as $furn) {
    if(count($furn['UF_MATERIAL'])) {
        foreach($furn['UF_MATERIAL'] as $materialId) {
            if(!$FURNS["LOCKS"][$materialId]){
                $item = [];
            } else {
                $item = $FURNS["LOCKS"][$materialId];
            }
            foreach($furn['UF_HANDS'] as $handId) {
                $item[$handId] = ['PRICE' => $furn['UF_PRICE']];
            }
            $FURNS["LOCKS"][$materialId] = $item;
        }
    } else {
        if(count($furn['UF_HANDS']) === 1) {
            $FURNS['HANDS'][$furn['UF_HANDS'][0]] = ['PRICE' => $furn['UF_PRICE']];
        }
    }
}

?>

<div class="cool_item<? if ($sample) { ?> sample_card<? } ?><?= $class ?>" itemscope
     itemtype="http://schema.org/Product">

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
                </div>
                <a href="" class="button js_buy flr"><?php echo getMessage("I_WANT_IT"); ?></a>
            </div>
        </div>
    </div>
    <div class="head wrap new clearfix">
        <div class="galery fll js_galery">
            <div class="td js_flip">
                <div class="js_img js_front"><img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                                                  alt="<?php echo $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>
                <div class="js_img js_back"><img src="<?php echo $arResult["DETAIL_PICTURE_OUT"]["SRC"] ?>"
                                                 alt="<?php echo $arResult["DETAIL_PICTURE_OUT"]["ALT"] ?>"></div>
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
            <h1 class="title" itemprop="name"><?php echo $arResult["NAME"] ?></h1>
            <?php if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) { ?>
                <ul class="labels">
                    <?php foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $val) { ?>
                        <li class="<?php echo $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k]; ?>"><?php echo $val; ?></li>
                    <?php } ?>
                </ul>
                <?php
            }
            if (!$sample && $arResult["PROPS"]["MAIN"]) {
                ?>
                <div class="params">
                    <?php foreach ($arResult["PROPS"]["MAIN"] as $val) { ?>
                        <p itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue"><span
                                    itemprop="name"><?php echo $val["NAME"]; ?></span><b itemprop="value"><?php
                                ?>
                                <i class="<?= $val["CODE"] == "CHARAKTER_CONST_WIDTH_MAIN" ? "js_width" : "" ?>"><? echo $val["VALUE"]; ?></i><?
                                if ($val["HINT"]) {
                                    echo " {$val['HINT']}";
                                }
                                ?></b></p>
                    <?php } ?>
                </div>
                <?php
            }
            if (!empty($arResult["OFFERS"])) {
                ?>
                <p class="h3"><?php echo getMessage("COLORS"); ?></p>
                <ul class="sets clearfix">
                    <? // print_r($arResult["OFFERS"]);?>
                    <?php foreach ($arResult["OFFERS"] as $k => $arOffer) { ?>
                        <li data-offerId="<?= $arOffer["ID"] ?>" data-door="<?php echo $k; ?>" class="clearfix fll"
                            data-price="<?php echo $arOffer["MIN_PRICE"]["VALUE"] ?>"
                            <?php if ($arOffer["MIN_PRICE"]["VALUE"] > $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                data-price-sale="<?php echo $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]; ?>"
                            <?php } ?>
                            data-href="<?php echo $arOffer["BUY_URL"] ?>"
                            itemprop="model" itemscope itemtype="http://schema.org/ProductModel"
                            data-width="<?= !empty($arOffer["PROPERTIES"]["CHARAKTER_CONST_WIDTH_MAIN_TP"]["VALUE"]) ? $arOffer["PROPERTIES"]["CHARAKTER_CONST_WIDTH_MAIN_TP"]["VALUE"] : $arResult["PROPERTIES"]["CHARAKTER_CONST_WIDTH_MAIN"]["VALUE"] ?>"
                        >
                            <?php if ($arOffer["DETAIL_PICTURES"]) { ?>
                                <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <span itemprop="priceSpecification" itemscope
                                          itemtype="http://schema.org/UnitPriceSpecification">
                                        <meta itemprop="priceCurrency" content="BYN">
                                        <meta itemprop="price" content="<?php echo $arOffer["MIN_PRICE"]["VALUE"] ?>">
                                        <?php if ($arOffer["MIN_PRICE"]["VALUE"] > $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                            <meta itemprop="minPrice"
                                                  content="<?php echo $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]; ?>">
                                        <?php } ?>
                                    </span>
                                </span>
                                <div class="img fll">
                                    <div class="td" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                        <img src="<?php echo $arOffer["DETAIL_PICTURES"][0]["SRC"]; ?>"
                                             alt="<?php echo $arOffer["DETAIL_PICTURES"][0]["ALT"] ?>" class="js_img"
                                             itemprop="contentUrl">
                                        <meta itemprop="caption"
                                              content="<?php echo $arOffer["DETAIL_PICTURES"][0]["ALT"] ?>">
                                    </div>
                                </div>
                                <div class="img flr">
                                    <div class="td" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                        <img src="<?php echo $arOffer["DETAIL_PICTURES"][1]["SRC"]; ?>"
                                             alt="<?php echo $arOffer["DETAIL_PICTURES"][1]["ALT"]; ?>" class="js_img"
                                             itemprop="contentUrl">
                                        <meta itemprop="caption"
                                              content="<?php echo $arOffer["DETAIL_PICTURES"][1]["ALT"]; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if ($arOffer["TOOLTIP"]["ARTICLE"] || $arOffer["TOOLTIP"]["OUTSIDE"] || $arOffer["TOOLTIP"]["INSIDE"]) {
                                ?>
                                <div class="tooltip js_info">
                                    <?php if ($arOffer["TOOLTIP"]["ARTICLE"]) { ?>
                                        <p <? if ($sample == false) { ?> itemprop="productID"<? } ?>><?php echo $arOffer["TOOLTIP"]["ARTICLE"] ?></p>
                                    <?php } ?>
                                    <?php if ($arOffer["TOOLTIP"]["OUTSIDE"]) { ?>
                                        <p class="js_out"
                                           itemprop="color"><?php echo getMessage("OUT"); ?><?php echo $arOffer["TOOLTIP"]["OUTSIDE"] ?></p>
                                    <?php } ?>
                                    <?php if ($arOffer["TOOLTIP"]["INSIDE"]) { ?>
                                        <p class="js_in"
                                           itemprop="color"><?php echo getMessage("IN"); ?><?php echo $arOffer["TOOLTIP"]["INSIDE"] ?></p>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <? if (!$sample) { ?>
                <div class="clearfix">
                    <p class="salons fll">
                        <?php echo getMessage("GO_TO_SALOON"); ?>
                        <a href="/gde_kupit/" onclick="gaRequest('Где купить, карточка'); return true;" target="_blank"><span><?php echo getMessage("MAP_OF_SALOONS"); ?></span></a>
                    </p>
                    <p class="salons fll carts credit-wrap">
                        <?php echo getMessage("CREDIT"); ?><br>
                        <a class="halva js_installments_cards"><span class="credit"
                                                                     data-card="<?php echo getMessage("CREDIT_HALVA"); ?>"
                                                                     data-credit="<?= $halva ?>"><?php echo getMessage("CREDIT_HALVA"); ?></span></a><br>
                        <a class="karta_pokupok js_installments_cards"><span class="credit"
                                                                             data-card="<?php echo getMessage("CREDIT_MAP_BUY"); ?>"
                                                                             data-credit="<?= $card_pokupok ?>"><?php echo getMessage("CREDIT_MAP_BUY"); ?></span></a><br>
                        <a class="smart_karta js_installments_cards"><span class="credit"
                                                                           data-card="<?php echo getMessage("CREDIT_SMART_CARD"); ?>"
                                                                           data-credit="<?= $card_smart ?>"><?php echo getMessage("CREDIT_SMART_CARD"); ?></span></a>

                        <span class="carts-sales-wrap">
                            <span class="carts-sales">Действует постоянная <br/><a href="/clientu/politika-skidok/">система скидок</a></span>
                        </span>

                    </p>

                    <p class="salons fll carts_message hidden">Рассрочка <br>не распростаняется <br>на акционные двери.
                    </p>

                    <p class="salons fll carts_delivery">
                        <?php echo getMessage("DELIV"); ?>
                        <a href="/dostavka-i-ustanovka/"
                           target="_blank"><span><?php echo getMessage("DELIV_TEXT"); ?></span></a>
                    </p>

                </div>
                <div class="clearfix">
                    <p class="salons fll manager_contact_info">
                        <b><a href="tel:<?= VELCOM_PHONE_CARD ?>"><?= VELCOM_PHONE_CARD ?></a></b>
                        <b><a href="tel:<?= MTS_PHONE_CARD ?>"><?= MTS_PHONE_CARD ?></a></b>
                        <span>Менеджер расскажет <br>о двери больше.</span>
                    </p>
                    <div class="manager_call hidden">
                        <a href="#" class="button_white" data-toggle="modal" data-target="#managerCallModal">Заказать
                            звонок</a>
                        <p>Оставьте свой номер — менеджер перезвонит в&nbsp;рабочее время.</p>
                    </div>
                </div>
            <? } else { ?>
                <div class="sample_description">
                    <p class="sample_description_title"><?php echo getMessage("FEATURES_SAMPLE"); ?></p>
                    <div class="sample_description_text"><?php echo $arResult['~DETAIL_TEXT'] ?></div>
                    <? if ($arResult["MAP"]["ID"]) { ?>
                        <p class="sample_description_address">
                            <span><?php echo getMessage("MEET_WITH_DOOR_ADDRESS"); ?></span>
                            <a href="/gde_kupit/?salon=<?php echo $arResult["MAP"]["ID"] ?>"
                               target="_blank"><?php echo $arResult["MAP"]["ADDRESS"] ?></a>
                        </p>
                    <? } ?>
                </div>
            <? } ?>

            <script>
                function removeErr() {
                    $(".one_click_phone_input").removeClass('error');
                }
                function oneClickOrder(id, name) {
					yaRequest("fast_request");
                    var data = {};
                    data['phone'] = $(".one_click_phone_input").val();
                    if(!regulars.phone.test(data['phone'])) {
                        $(".one_click_phone_input").addClass('error');
                        $(".one_click_phone_input").on('keyup', function () {
                            if($(this).hasClass('error')) {
                                $(this).removeClass('error');
                            }
                        });
                        return false;
                    }
                    data['id'] = id;
                    data['name'] = name;
                    console.log(data);
                    $.ajax({
                       url:'/request/one_click_order.php',
                       data:data,
                        method: "POST",
                       success:function(res) {
                            $(".one_click_order_form").hide();
                            $(".one_click_order_success_message").show();
                       }
                    });
                }
            </script>
            <div class="one_click_order">
                <form method="post" class="one_click_order_form" onsubmit="oneClickOrder('<?=$arResult['ID']."','".$arResult['NAME']?>');return false;">
                    <p class="give_me_phone">Оставьте номер телефона для быстрого заказа</p>
                    <div class="inpbut">
                        <input type="tel" name="phone" data-valid="phone" class="one_click_phone_input" placeholder="+375">
                        <button type="submit" class="one_click_button_submit">Отправить</button>
                    </div>
                </form>
                <p class="one_click_order_success_message">Менеджер позвонит для подтверждения
                    заказа, согласует детали и время замера.
                    Ожидайте звонка с 10 до 18 в будние дни.</p>
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
                        <li<?php echo $class; ?> data-tab="<?php echo $k; ?>">
                            <span><?php echo getMessage($code); ?></span></li>
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
                                    <tr itemprop="additionalProperty" itemscope
                                        itemtype="http://schema.org/PropertyValue">
                                        <?php foreach ($arResult["THEAD"][$code] as $l => $title) { ?>
                                            <td <?php if ($l == 0) { ?>itemprop="name"
                                                <?php } else { ?>itemprop="value"<?php } ?> ><?php echo $property[$title] ?></td>
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
    <? if (!$sample) { ?>
        <div class="description wrap new clearfix">
            <p class="h2"><?php echo getMessage("DESCRIPTION"); ?></p>
            <div class="text fll" itemprop="description">
                <?php echo $arResult["~DETAIL_TEXT"]; ?>
                <div class="dp-safery-plahka"><a class="dp-safery-plahka__body dp-block-link" href="/bezopasnost"><span
                                class="dp-safery-plahka__title">Безопасность</span><span class="dp-safery-plahka__desc">Расскажем, как дверь защищает <br/> от разных видов взлома.</span></a>
                </div>
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
    <? } ?>
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
    if ($arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST_100"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "TABS" => $arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST_100"],
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_portals_100.php"
        ), false
        );
    }
 if ($arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST_80"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "TABS" => $arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST_80"],
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_portals_80.php"
        ), false
        );
    }
    if ($arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST"]["VALUE"]) {
        if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"]) {
            $APPLICATION->IncludeComponent(
                "bitrix:main.include", ".default", array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "TABS" => $arResult["PROPERTIES"]["PARTALS_JAMB_ON_REQUEST"],
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "/include/element_portals_double.php"
            ), false
            );
        } else {
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
    }

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

    if ($arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
            "NAME_TITLE" => $arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"]["VALUE"] && $arResult["PROPERTIES"]["FURNITURES_ON_REQUEST"]["VALUE"] ? "Y" : "N",
            "AREA_FILE_SUFFIX" => "inc",
            "TABS" => $arResult["PROPERTIES"]["LOCKS_FURNITURES_ON_REQUEST"],
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/element_locks.php"
        ), false
        );
    }
 if ($arResult["IBLOCK_SECTION_ID"] == 48) {
        $name = "70";
    } elseif ($arResult["IBLOCK_SECTION_ID"] == 49) {
        $name = "80";
    } elseif ($arResult["IBLOCK_SECTION_ID"] == 50) {
        $name = "100";
    } elseif ($arResult["IBLOCK_SECTION_ID"] == 44) {
        $name = "80u";
    } elseif ($arResult["IBLOCK_SECTION_ID"] == 45) {
        $name = "100u";
    }
    if ($arResult["PROPERTIES"]["FURNITURES_ON_REQUEST"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
            "AREA_FILE_SUFFIX" => "inc",
            "TABS" => $arResult["PROPERTIES"]["FURNITURES_ON_REQUEST"],
            "EDIT_TEMPLATE" => "",
            "SERIES" => $name,
            "COMPONENT_TEMPLATE" => ".default",
            "PRICES" => $FURNS,
            "PATH" => "/include/element_fur_100.php"
        ), false
        );
    }
    ?>


    <?php


    if (!$arResult["PROPERTIES"]["DOUBLE"]["VALUE"]) {
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", ".default", array(
            "AREA_FILE_SHOW" => "file",
            "SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
            "AREA_FILE_SUFFIX" => "inc",
            "TABS" => $arResult["PROPERTIES"]["FURNITURES_ON_REQUEST"],
            "EDIT_TEMPLATE" => "",
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "/include/properties/options/options-$name.php"
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
                <div class="js_img js_front"><img src="<?php echo $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                                                  alt="<?php echo $arResult["DETAIL_PICTURE"]["ALT"] ?>"></div>
                <div class="js_img js_back"><img src="<?php echo $arResult["DETAIL_PICTURE_OUT"]["SRC"] ?>"
                                                 alt="<?php echo $arResult["DETAIL_PICTURE_OUT"]["ALT"] ?>"></div>
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
                        <li data-door="<?php echo $k; ?>" class="clearfix fll"
                            data-price="<?php echo $arOffer["MIN_PRICE"]["VALUE"] ?>"
                            <?php if ($arOffer["MIN_PRICE"]["VALUE"] > $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                data-price-sale="<?php echo $arOffer["MIN_PRICE"]["DISCOUNT_VALUE"]; ?>"
                            <?php } ?>
                            data-href="<?php echo $arOffer["BUY_URL"] ?>"
                        >
                            <?php if ($arOffer["DETAIL_PICTURES"]) { ?>

                                <div class="img fll">
                                    <div class="td"><img src="<?php echo $arOffer["DETAIL_PICTURES"][0]["SRC"]; ?>"
                                                         alt="<?php echo $arOffer["DETAIL_PICTURES"][0]["ALT"] ?>"
                                                         class="js_img"></div>
                                </div>
                                <div class="img flr">
                                    <div class="td"><img src="<?php echo $arOffer["DETAIL_PICTURES"][1]["SRC"]; ?>"
                                                         alt="<?php echo $arOffer["DETAIL_PICTURES"][1]["ALT"]; ?>"
                                                         class="js_img"></div>
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
            <? if (!$sample) { ?>
                <div class="clearfix">
                    <p class="salons fll"><?php echo getMessage("GO_TO_SALOON"); ?><a href="/gde_kupit/"
                                                                                      target="_blank"><span><?php echo getMessage("MAP_OF_SALOONS"); ?></span></a>
                    </p>
                    <p class="salons fll carts credit-wrap">
                        <?php echo getMessage("CREDIT"); ?><br>
                        <a class="halva js_installments_cards"><span class="credit"
                                                                     data-card="<?php echo getMessage("CREDIT_HALVA"); ?>"
                                                                     data-credit="<?= $halva ?>"><?php echo getMessage("CREDIT_HALVA"); ?></span></a><br>
                        <a class="karta_pokupok js_installments_cards"><span class="credit"
                                                                             data-card="<?php echo getMessage("CREDIT_MAP_BUY"); ?>"
                                                                             data-credit="<?= $card_pokupok ?>"><?php echo getMessage("CREDIT_MAP_BUY"); ?> </span></a><br>
                        <a class="smart_karta js_installments_cards"><span class="credit"
                                                                           data-card="<?php echo getMessage("CREDIT_SMART_CARD"); ?>"
                                                                           data-credit="<?= $card_smart ?>"><?php echo getMessage("CREDIT_SMART_CARD"); ?> </span></a>
                    </p>
                    <p class="salons fll carts_message hidden">Рассрочка <br>не распростаняется <br>на акционные двери.
                    </p>
                </div>
            <? } else { ?>
                <div class="sample_description">
                    <p class="sample_description_title"><?php echo getMessage("FEATURES_SAMPLE"); ?></p>
                    <div class="sample_description_text"><?php echo $arResult['~DETAIL_TEXT'] ?></div>
                    <? if ($arResult["MAP"]["ID"]) { ?>
                        <p class="sample_description_address">
                            <span><?php echo getMessage("MEET_WITH_DOOR_ADDRESS"); ?></span>
                            <a href="/gde_kupit/?salon=<?php echo $arResult["MAP"]["ID"] ?>"
                               target="_blank"><?php echo $arResult["MAP"]["ADDRESS"] ?></a>
                        </p>
                    <? } ?>
                </div>
            <? } ?>
        </div>
    </div>

    <!-- ОТЗЫВЫ НА ДВЕРЬ -->
    <div class="cool_item_reviews wrap new">
        <div class="item_reviews__title">
            <a href="/otzyvy/" class="item_reviews__titleLink link_general">Отзывы о дверях и сервисе</a>
        </div>
        <ul class="item_reviews__list justified_container">

        </ul>
    </div>
    <!-- /ОТЗЫВЫ НА ДВЕРЬ -->

    <?php if (count($arResult["SIMILAR_ELEMENTS"])) { ?>
        <div class="cool_clones_container">
            <div class="cool_clones js_row_slider wrap new">
                <p class="h2"><?php echo getMessage("LOOK_SIMILAR_DOORS"); ?></p>
                <div class="slides_wrap">
                    <ul class="js_carret">
                        <?php foreach ($arResult["SIMILAR_ELEMENTS"] as $element) { ?>
                            <li class="js_li li<?= $element["PROPERTIES"]["DOUBLE"]["VALUE"] ? " double" : ""; ?>">
                                <a href="<?php echo $element["DETAIL_PAGE_URL"]; ?>">
                                    <div class="clearfix">
                                        <div class="img fll">
                                            <img src="<?php echo $element["PICTURE_1"]; ?>"
                                                 alt="<?php echo $element["NAME"]; ?>">
                                        </div>
                                        <div class="img flr">
                                            <img src="<?php echo $element["PICTURE_2"]; ?>"
                                                 alt="<?php echo $element["NAME"]; ?>">
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
                                        if ($element["MIN_PRICE"]["DISCOUNT_VALUE"] && $element["MIN_PRICE"]["VALUE"] > $element["MIN_PRICE"]["DISCOUNT_VALUE"]) {
                                            $sale = true;
                                        } else {
                                            $sale = false;
                                        }
                                        ?>
                                        <div class="price_wrap <?php echo $sale ? "sale" : ""; ?> fll">
                                            <?php if ($sale) { ?>
                                                <p class="sale_price"><?php echo $element["MIN_PRICE"]["DISCOUNT_VALUE"]; ?></p>
                                            <?php } ?>
                                            <p class="price"><span
                                                        class="num"><?php echo $element["MIN_PRICE"]["VALUE"]; ?></span>
                                                руб.</p>
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
        </div>
    <?php } ?>

    <div class="modal_bg">
        <div class="modal_content installments halva">
            <div class="modal_header">
                <p class="bank_name">МТБанк</p>
                <h2 class="bank_program_name">Рассрочка по «Халва»</h2>
                <span class="modal_close">&#xe900;</span>
            </div>
            <div class="modal_body">
                <p class="bank_program_descr">При покупке двери в фирменном салоне вы самостоятельно определяете сумму
                    платежа по&nbsp;карте — от 30&thinsp;% до&nbsp;100&thinsp;%. Оставшаяся часть вносится равными
                    долями до 15 числа в течение двух последующих месяцев.</p>
                <p class="bank_program_term"><span><?= $halva ?> месяца</span> период рассрочки</p>
                <ul class="installment_adress">
                    <li>ТЦ «Трюм», <br>
                        ул. Кальварийская, 7Б-6 <br>
                        Пн–Сб: 10:00–20:00 <br>
                        Вс: 10:00–18:00
                    </li>
                    <li>пр. Дзержинского, 131 <br>
                        Пн–Сб: 10:00–20:00 <br>
                        Вс: 10:00–18:00
                    </li>
                </ul>
                <p class="installment_clause"><span class="exclamation modal_exclamation">!</span>Рассрочка действует на
                    все входные двери, кроме образцов и&nbsp;акционных моделей</p>
            </div>
            <div class="modal_footer"><a href="/oplata/kartoi-rassrochki/" target="_blank" class="modal_footer_link">Другие
                    карты рассрочек</a></div>
        </div>
        <div class="modal_content installments karta_pokupok">
            <div class="modal_header">
                <p class="bank_name">Белгазпромбанк</p>
                <h2 class="bank_program_name">Рассрочка по «Карта покупок»</h2>
                <span class="modal_close">&#xe900;</span>
            </div>
            <div class="modal_body">
                <p class="bank_program_descr">При покупке двери в фирменном салоне вы самостоятельно определяете сумму
                    платежа по&nbsp;карте — от 30&thinsp;% до&nbsp;100&thinsp;%. Оставшаяся часть вносится равными
                    долями до 20 числа в течение 12 последующих месяцев.</p>
                <p class="bank_program_term"><span><?= $card_pokupok ?> месяцев</span> период рассрочки</p>
                <ul class="installment_adress">
                    <li>ТЦ «Трюм», <br>
                        ул. Кальварийская, 7Б-6 <br>
                        Пн–Сб: 10:00–20:00 <br>
                        Вс: 10:00–18:00
                    </li>
                    <li>пр. Дзержинского, 131 <br>
                        Пн–Сб: 10:00–20:00 <br>
                        Вс: 10:00–18:00
                    </li>
                </ul>
                <p class="installment_clause"><span class="exclamation modal_exclamation">!</span>Рассрочка действует на
                    все входные двери, кроме образцов и&nbsp;акционных моделей</p>
            </div>
            <div class="modal_footer"><a href="/oplata/kartoi-rassrochki/" target="_blank" class="modal_footer_link">Другие
                    карты рассрочек</a></div>
        </div>
        <div class="modal_content installments smart_karta">
            <div class="modal_header">
                <p class="bank_name">Банк Москва-Минск</p>
                <h2 class="bank_program_name">Рассрочка по «Смарт карта»</h2>
                <span class="modal_close">&#xe900;</span>
            </div>
            <div class="modal_body">
                <p class="bank_program_descr">При покупке двери в фирменном салоне вы самостоятельно определяете сумму
                    платежа по&nbsp;карте— от 30&thinsp;% до&nbsp;100&thinsp;%. Оставшаяся часть вносится равными долями
                    до 20 числа в течение трёх последующих месяцев.</p>
                <p class="bank_program_term"><span><?= $card_smart ?> месяцев</span> период рассрочки</p>
                <ul class="installment_adress">
                    <li>ТЦ «Трюм», <br>
                        ул. Кальварийская, 7Б-6 <br>
                        Пн–Сб: 10:00–20:00 <br>
                        Вс: 10:00–18:00
                    </li>
                    <li>пр. Дзержинского, 131 <br>
                        Пн–Сб: 10:00–20:00 <br>
                        Вс: 10:00–18:00
                    </li>
                </ul>
                <p class="installment_clause"><span class="exclamation modal_exclamation">!</span>Рассрочка действует на
                    все входные двери, кроме образцов и&nbsp;акционных моделей</p>
            </div>
            <div class="modal_footer"><a href="/oplata/kartoi-rassrochki/" target="_blank" class="modal_footer_link">Другие
                    карты рассрочек</a></div>
        </div>
    </div>
    <script>

        /*ecommerce*/
        $(window).load(function () {
            var item = {
                id: '<?php echo $arResult["ID"] ?>',
                name: '<?php echo $arResult["NAME"] ?>',
                price: '<?php echo $arResult["PROPERTIES"]["MINIMUM_PRICE"]["VALUE"] ?>'
            };
            dataLayer.push({
                "ecommerce": {
                    "currencyCode": "BYN",
                    "detail": {
                        "products": [
                            {
                                "id": item.id,
                                "name": item.name,
                                "price": item.price
                            }
                        ]
                    }
                }
            });

            $(document).on('click', '.js_buy', function (e) {
                dataLayer.pop();
                dataLayer.push({
                    "ecommerce": {
                        "currencyCode": "BYN",
                        "add": {
                            "products": [
                                {
                                    "id": item.id,
                                    "name": item.name,
                                    "price": item.price
                                }
                            ]
                        }
                    }
                });
            });

        });

        /*!ecommerce*/

        $(".js_installments_cards").on("click", function () {
            var itemClass = $(this).attr("class");
            var spaceIndex = itemClass.indexOf(" ");
            var cardType = itemClass.slice(0, spaceIndex);
            $(".modal_bg").fadeIn(300);
            $(".modal_content.installments").filter("." + cardType).addClass("active");
        })
        $(".modal_bg, .modal_close").on("click", function () {
            $(".modal_content.installments").removeClass("active");
            $(".modal_bg").fadeOut(300);
        });
        $(document).keydown(function (e) {
            if (e.keyCode === 27) {
                $(".modal_content.installments").removeClass("active");
                $(".modal_bg").fadeOut(300);
            }
        });
        $(".modal_content").click(function (event) {
            event.stopPropagation();
        })
        $(document).ready(function () {
            var date = new Date();
            var endHour = 18;
            if (date.getDay == 0 || date.getDay == 6) {
                endHour = 10;
            }
            if (date.getHours() >= 10 && date.getHours() < endHour) {
                $('.manager_contact_info').removeClass('hidden');
                $('.manager_call').addClass('hidden');
            } else {
                $('.manager_contact_info').addClass('hidden');
                $('.manager_call').removeClass('hidden');
            }
        })
    </script>
    <script src="/bitrix/templates/steelline/script/modal_bootstrap.js"></script>
</div>
<!-- modal manader call -->
<div class="modal fade" id="managerCallModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content managerCall__content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <form method="post" class="js_validate managerCall__contentForm" id="manager_call_form">
                <p class="modal__title">Заявка на звонок</p>
                <p class="modal__text">Рабочий день в&nbsp;салоне закончился или выходной.<br> Оставьте заявку и&nbsp;менеджер
                    перезвонит в&nbsp;рабочее время.</p>
                <p class="field js_input js_class_valid">
                    <input id="client_name_call" type="text" name="name" data-valid="name" data-valid-min="2"
                           class="guarantee_letter_field" placeholder="Имя">
                    <span class="error_message side">Менеджер не сможет&nbsp;обратиться<br>к&nbsp;вам&nbsp;по&nbsp;этому имени</span>
                </p>
                <p class="field js_input js_class_valid">
                    <input id="client_tel_call" type="tel" name="phone" data-valid="phone"
                           class="guarantee_letter_field" placeholder="Номер телефона">
                    <input type="hidden" name="name_door" value="<?= $arResult["NAME"] ?>">
                    <input type="hidden" name="my_address">
                    <input type="text" name="login" class="my_login">
                    <span class="error_message side">Менеджер не дозвонится <br>по этому номеру</span>
                    <span class="guarantee_letter_field_detail bottom">+375 (29) 000-00-00</span>
                </p>
                <p class="field textblock">
                    <textarea id="client_comment_zamer" name="message" class="guarantee_letter_field"
                              placeholder="Сообщение"></textarea>
                    <span class="guarantee_letter_field_detail bottom">В&nbsp;какое время вам удобно разговаривать? Задайте вопросы, чтобы менеджер подготовился к&nbsp;разговору.</span>
                </p>
                <div class="modal__bottom">
                    <p class="guarantee_letter_field_wrap">
                        <input type="button" value="Отправить" id="send_form" name="send_form"
                               class="send_button disabled"><!--
                        --><span class="guarantee_letter_field_detail side big_margin">Чтобы отправить форму&nbsp;&mdash; напишите имя&nbsp;и&nbsp;номер телефона</span>
                    </p>
                </div>
                <div class="modal_manager_photo">
                    <img src="/bitrix/templates/steelline/img/manager_modal.png" alt="Заявка на звонок">
                </div>
            </form>
            <div class="send_notification hidden">
                <p class="modal__title">Заявка отправлена</p>
                <p class="modal__text">Менеджер перезвонит вам в&nbsp;рабочее время: с&nbsp;10&nbsp;до&nbsp;18&nbsp;в
                    будни.</p>
                <svg class="dp-dodings-send__svg" xmlns="http://www.w3.org/2000/svg" width="201" height="212"
                     viewBox="0 0 201 212">
                    <path fill="#13CE5E" fill-rule="evenodd"
                          d="M70.424 212l130.1-194.808L183.261.386 68.595 174.616l-53.734-60.819L0 133.003 70.424 212"></path>
                </svg>
            </div>
            <script>
                $(function () {
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
                        if ($('#manager_call_form').hasClass('send')) {
                            $('#manager_call_form').find('.guarantee_letter_field').val("");
                            $('#manager_call_form').find('.field').removeClass('ok');
                            $('#manager_call_form').css('height', 'auto').removeClass('hidden send');
                            $(".send_notification").addClass("hidden");
                        }
                    })

                    // console.log($('li[data-price]'));

                });
            </script>
        </div>
    </div>
</div>




