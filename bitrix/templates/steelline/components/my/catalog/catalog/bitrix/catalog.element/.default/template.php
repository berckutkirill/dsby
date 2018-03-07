<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") {
	include(__DIR__."/template_old.php");
} else {
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
$FURNISH_INSIDE = CFile::GetPath($arResult["PROPERTIES"]["VIEW_INSIDE"]["VALUE"]);
$FURNISH_OUTSIDE = CFile::GetPath($arResult["PROPERTIES"]["VIEW_OUTSIDE"]["VALUE"]);
$DETAIL_2 = CFile::GetPath($arResult["PROPERTIES"]["VIEW_OUTSIDE_DETAIL"]["VALUE"]);

$hblock = GetHBlock(3);
foreach ($hblock as $eq) {
    $BASIC[$eq["UF_XML_ID"]] = $eq;
    $BASIC[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

$FILE_TTH = $arResult["FURN_FILE_TTH"];

$hblock = GetHBlock(6);
foreach ($hblock as $eq) {
    $VARIANTS[$eq["UF_XML_ID"]] = $eq;
    $VARIANTS[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
    $VARIANTS[$eq["UF_XML_ID"]]["UF_DOBOR_SRC"] = CFile::GetPath($eq["UF_DOBOR"]);
}

$SNAR = $VARIANTS[$arResult["PROPERTIES"]["FURNISH_OUTSIDE"]["VALUE"]];
$VNUTR = $VARIANTS[$arResult["PROPERTIES"]["FURNISH_INSIDE"]["VALUE"]];

$hblock = GetHBlock(4);
foreach ($hblock as $eq) {
    $NAD_KARTOI[$eq["UF_XML_ID"]] = $eq;
    $NAD_KARTOI[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}

$hblock = GetHBlock(8);
foreach ($hblock as $eq) {
    $PICCHAR[$eq["UF_XML_ID"]] = $eq;
    $PICCHAR[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}
if ($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") {
    foreach ($PICCHAR as $code => $file) {
        $FILE_TTH[$code]["FILE"] = $file["FILE_SRC"];
        $FILE_TTH[$code]["TEXT"] = $file["UF_DESCRIPTION"];
        $FILE_TTH[$code]["NAME"] = $file["UF_NAME"];
        $FILE_TTH[$code]["TOOLTIP"] = $file["UF_TOOLTIP"];
    }
}
$TEXT_TTH = $arResult["SOSTAV_TTH"];
foreach ($arResult["PROPERTIES"] as $code => $val) {
    if (strpos($code, "CHARAKTER_") === 0) {
        if ($val["VALUE"]) {
            if ($val["PROPERTY_TYPE"] == "S" || $val["PROPERTY_TYPE"] == "L") {
                $TEXT_TTH[$code]["TEXT"] = $val["VALUE"];
                if ($arResult["PROPERTIES"]["TOOLTIP_" . $code] !== "0") {
                    $TEXT_TTH[$code]["TOOLTIP"] = $arResult["PROPERTIES"]["TOOLTIP_" . $code]["VALUE"] ? $arResult["PROPERTIES"]["TOOLTIP_" . $code]["VALUE"] : $val["HINT"];
                    ;
                }

                $TEXT_TTH[$code]["NAME"] = $val["NAME"];
            } elseif ($val["PROPERTY_TYPE"] == "F") {
                $FILE_TTH[$code]["FILE"] = CFile::GetPath($val["VALUE"]);
                $FILE_TTH[$code]["TEXT"] = $val["DESCRIPTION"];
                if ($arResult["PROPERTIES"]["TOOLTIP_" . $code] !== "0") {
                    $FILE_TTH[$code]["TOOLTIP"] = $arResult["PROPERTIES"]["TOOLTIP_" . $code]["VALUE"] ? $arResult["PROPERTIES"]["TOOLTIP_" . $code]["VALUE"] : $val["HINT"];
                }
                $FILE_TTH[$code]["NAME"] = $val["NAME"];
            }
        }
    } elseif (strpos($code, "DOPCHARAKTER_") === 0) {
        if ($val["VALUE"]) {
            if ($code == "DOPCHARAKTER_FURNISH_OUTSIDE") {
                $FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["FILE"] = $SNAR["FILE_SRC"];
                $FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["TOOLTIP"] = $SNAR["UF_TOOLTIP"];
                $FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["TEXT"] = $val["VALUE"];
                $FILE_TTH["CHARAKTER_FURNISH_OUTSIDE"]["NAME"] = $val["NAME"];
            } elseif ($code == "DOPCHARAKTER_FURNISH_INSIDE") {
                $FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["FILE"] = $VNUTR["FILE_SRC"];
                $FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["TOOLTIP"] = $VNUTR["UF_TOOLTIP"];
                $FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["TEXT"] = $val["VALUE"];
                $FILE_TTH["CHARAKTER_FURNISH_INSIDE"]["NAME"] = $val["NAME"];
            }
        }
    }
}
if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") {
    $FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH . "/img/storona_otkryvania.jpg";
    $FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"] ? $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"] : "Левая или правая";
    $FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
    $FILE_TTH["STORONA"]["NAME"] = "Сторона открывания";
} else {
    $FILE_TTH["STORONA"]["FILE"] = SITE_TEMPLATE_PATH . "/img/storona_otkryvania.jpg";
    $FILE_TTH["STORONA"]["TEXT"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"] ? $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["VALUE"] : "Левая или правая";
    $FILE_TTH["STORONA"]["NAME"] = "Сторона открывания";
    $FILE_TTH["STORONA"]["TOOLTIP"] = $arResult["PROPERTIES"]["CHARAKTERS_SIDE_OPEN"]["HINT"];
}
$hblock = GetHBlock(7);
foreach ($hblock as $eq) {
    $NAME_FURNISH[$eq["UF_XML_ID"]]["NAME"] = $eq["UF_NAME"];
    $NAME_FURNISH[$eq["UF_XML_ID"]]["PRICE"] = intVal($eq["UF_DESCRIPTION"]);
}

$hblock = GetHBlock(13);
foreach ($hblock as $eq) {
    $UF_JAMBEAU[$eq["UF_XML_ID"]] = $eq;
    $UF_JAMBEAU[$eq["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($eq["UF_FILE"]);
}


foreach ($arResult["PROPERTIES"]["ACTIVE_JAMBEAU"]["VALUE"] as $xml_id) {
    if ($UF_JAMBEAU[$xml_id])
        $JAMBEAU[$xml_id] = $UF_JAMBEAU[$xml_id];
}
$SHOW_PRICE = false;
?>
<script type="text/javascript">
    var google_tag_params = {
        ecomm_prodid: <?= $arResult["ID"] ?>
    };
    ga('ec:addProduct', {
        'id': '<?= $arResult["ID"] ?>',
        'name': '<?= $arResult["NAME"] ?>'
    });
    ga('ec:setAction', 'detail');
    ga('send', 'event');


    (function (d, w) {
        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
        s.type = "text/javascript";
        s.async = true;
        s.src = "http://track.recreativ.ru/trck.php?shop=1743&ttl=30&offer=<?= $arResult["ID"] ?>&rnd=" + Math.floor(Math.random() * 999);
        if (window.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window);

    var _tmr = _tmr || [];
    _tmr.push({
        type: 'itemView',
        productid: <?= $arResult["ID"] ?>,
        pagetype: 'product',
        list: '1',
    });

</script>
<?
if ($arResult["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3) {
    $class = "sale_tmp";
}
?>
<div class="item <?= $class ?>">
    <div class="wrap">
        <div class="top clearfix">
            <div class="left">
                <h1><?= $arResult["NAME"] ?></h1>

                <div class="galery">
                    <? if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] != "Y") { ?>
                        <div class="ls">
                            <h5>Вид снаружи</h5>
                            <p class="img big"><img src="<?= $FURNISH_OUTSIDE ?>" alt="<?= htmlentities($arResult["DETAIL_PICTURE"]['ALT']) . ", вид в интерьере"; ?>" data-src="<?= $FURNISH_OUTSIDE ?>"></p>
                        </div>
                    <? } ?>
                    <?
                    if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] == "Y") {
                        $classMid = "double";
                    } else {
                        $classMid = "";
                    }
                    ?>

                    <div class="mid <?= $classMid ?>">
                        <span class="fuckup">Снято с производства</span>
                        <div class="prop">
                            <span <?= in_array(3, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"]) ? 'class="active"' : '' ?>><i>для квартиры</i></span>
                            <span <?= in_array(2, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"]) ? 'class="active"' : '' ?>><i>для дома</i></span>
                            <span <?= in_array(1, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"]) ? 'class="active"' : '' ?> ><i>для офиса</i></span>
                        </div>
                        <p class="img big"><img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] . ", вид снаружи" ?>" data-src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"></p>
                        <p class="img big"><img src="<?= $DETAIL_2 ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] . ", вид изнутри" ?>" data-src="<?= $DETAIL_2 ?>"></p>
                        <? if ($arResult["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3) { ?><span class="yarl"></span><? } ?>
                    </div>

                    <? if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"] != "Y") { ?>
                        <div class="rs">
                            <h5>Вид внутри</h5>
                            <p class="img big"><img src="<?= $FURNISH_INSIDE ?>" alt="<?= htmlentities($arResult["DETAIL_PICTURE"]['ALT']) . ", вид в интерьере" ?>" data-src="<?= $FURNISH_INSIDE ?>"></p>
                        </div>
                    <? } ?>

                    <div class="popup_img">
                        <i class="close">x</i>
                        <b class="prev"></b>
                        <b class="next"></b>
                        <img src="" alt="Двери Стальная линия">
                    </div>
                    <script>
                        $(function () {
                            var opt = [
                                '.galery', // main block
                                '.contr li', // wrappers mini pictures
                                '.big', // wrapper big picture
                                '.popup_img', //wrapper popup window
                                '.prev', // previous button in popup
                                '.next', // next button in popup
                                '.close', // close button in popup
                                '.fade', // fade layer
                                '.curr img', // selected mini picture
                                'data-src', // data-attribute with src big pictures
                            ]
                            var galery = new Galery(opt);
                        });
                    </script>
                </div>
                <? if ($arResult["PROPERTIES"]["SPECIAL"]["VALUE_XML_ID"] == 3) { ?>
                    <div class="sale_tmp_link_wrapper">
                        <span class="sale_tmp_text">На данную модель распространяется скидка 5–10%, условия в разделе </span><a class="sale_tmp_link" href="/aktsii/skidki_k_8_marta.html">«Акции»</a>
                    </div>
                <? } ?>
                <div class="text">
                    <h3>Описание</h3>
                    <?= $arResult["~DETAIL_TEXT"] ?>
                    <div class="likely">
                        <div class="facebook">Поделиться</div>
                        <div class="vkontakte">Поделиться</div>
                        <div class="twitter">Твитнуть</div>
                        <div class="odnoklassniki">Одноклассники</div>
                    </div>
                </div>
            </div>
            <? if ($arResult["SOME_NEW_MODEL"]) { ?>
                <div class="cool_not_right">
                    <a href="<?= $arResult["SOME_NEW_MODEL"]["DETAIL_PAGE_URL"] ?>" class="link">
                        <p class="title"><span>Похожая новая модель</span></p>
                        <div class="imgs clearfix">
                            <div class="img fll"><img src="<?= $arResult["SOME_NEW_MODEL"]["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arResult["SOME_NEW_MODEL"]["NAME"] ?>"></div>
                            <div class="img flr"><img src="<?= $arResult["SOME_NEW_MODEL"]["PREVIEW_PICTURE2"]["SRC"] ?>" alt="<?= $arResult["SOME_NEW_MODEL"]["NAME"] ?>"></div>
                        </div>
                        <p class="name"><span><?= $arResult["SOME_NEW_MODEL"]["NAME"] ?></span></p>
                        <? if ($arResult["SOME_NEW_MODEL"]["PROPERTIES"]["DESTINATION_ICON"]["VALUE"]) { ?>
                            <ul class="labels">
                                <? foreach ($arResult["SOME_NEW_MODEL"]["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $v) { ?>
                                    <li class="<?= $arResult["SOME_NEW_MODEL"]["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k] ?>"><?= $v ?></li>
                                <? } ?>
                            </ul>
                        <? } ?>
                        <div class="price_wrap <?
                        if ($arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] > $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["DISCOUNT_VALUE"]) {
                            echo "sale";
                        }
                        ?>">
                                 <? if ($arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] > $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                                <p class="sale_price"><?= $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["DISCOUNT_VALUE"] ?></p>
                            <? } ?>
                            <p class="price"><span class="num"><?= $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] ?></span> руб.</p>
                            <p class="old_price"><?= $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] ?></p>
                        </div>
                    </a>
                </div>
            <? } ?>

        </div>



        <!--div class="fix_area">
            <div class="wrap">
                <div class="img">
                    <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= htmlentities($arResult["NAME"]) ?>">
                    <img src="<?= $DETAIL_2 ?>" alt="<?= $arResult["NAME"] ?>">
                </div>
                <p class="name"><?= $arResult["NAME"] ?></p>
                <div class="prop">
                    <span <?= in_array(3, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"]) ? 'class="active"' : '' ?>><i>для квартиры</i></span>
                    <span <?= in_array(2, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"]) ? 'class="active"' : '' ?>><i>для дома</i></span>
                    <span <?= in_array(1, $arResult["PROPERTIES"]["FOR_WHAT"]["VALUE_XML_ID"]) ? 'class="active"' : '' ?> ><i>для офиса</i></span>
                </div>
                <div class="status">



                    <? if ($arResult["PROPERTIES"]["IN_STOCK"]["VALUE_XML_ID"] == 2) { ?>
                        <span >На складе в Минске</span>
                    <? } else { ?>
                        <span class="not">На складе в Минске</span>
                    <? } ?>
                    <? if ($arResult["PROPERTIES"]["MODEL_IN"]["VALUE_XML_ID"] == 1) { ?>
                        <span>Модель в салоне</span>
                    <? } else { ?>
                        <span  class="not">Модель в салоне</span>
                    <? } ?>
                </div>
                <? if ($SHOW_PRICE) { ?>
                    <a  class="zakaz" onclick="addToCart('<?= $arResult["ID"] ?>', '<?= $arResult["NAME"] ?>', '<?= $arResult["BUY_URL"] ?>'); return !ga.loaded;" href="<?= $arResult["BUY_URL"] ?>">Заказать дверь</a>

                    <? if ($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class2 = "sale"; ?>

                    <div class="cost <?= $class2 ?>">
                        <? if ($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                            <span class="price_old js_price_gen">
                                <span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
                                <span class="old_rub js_old_denomination_price">
                                    <? if ($arResult['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?= toPrice($arResult["MIN_PRICE"]["VALUE"]); ?> руб.
                                </span>
                            </span>
                        <? } ?>
                        <span class="price js_price_gen">
                            <span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
                            <span class="old_rub js_old_denomination_price">

                                <? if ($arResult['PROPERTIES']['PRICE_FROM']['VALUE']) { ?>от <? } ?><?= toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]); ?> руб.
                            </span>
                        </span>
                    </div>
                <? } ?>
            </div>
        </div-->
        <script>
            $(function () {
                var top = $(document).scrollTop(),
                        fix = $('.fix_area'),
                        point = $('.item .tech').offset().top;
                top >= point ? fix.fadeIn(150) : fix.fadeOut(150);
                $(document).scroll(function () {
                    top = $(document).scrollTop();
                    top >= point ? fix.fadeIn(150) : fix.fadeOut(150);
                })
            })
        </script>
        <? if ($arResult["PROPERTIES"]["DESIGNED"]["VALUE"] == "Y") { ?>
            <div class="ral_palitra clearfix">
                <h3>Варианты отделки двери под заказ</h3>
                <div class="left">
                    <div class="sider js_sider">
                        <div class="picker js_piker"></div>
                        <div class="front js_front side">
                            <img src="">
                        </div>
                        <div class="back js_back side">
                            <img src="">
                        </div>
                    </div>
                    <p class="text">При заказе двери с&nbsp;внутренней и&nbsp;внешней отделкой разных цветов, коробку рекомендуем также окрашивать в&nbsp;два цвета.</p>
                </div>

                <div class="right">
                    <h3>Основные цветовые решения</h3>
                    <p>Двери из новой коллекции имеют четыре основных цвета. Производство такой двери занимает минимальное количество дней.</p>
                    <? if ($arResult['COLOR_DESIGIONS']) { ?>
                        <div class="colors_doors js_cool_line clearfix">
                            <? foreach ($arResult['COLOR_DESIGIONS'] as $color) { ?>
                                <span class="js_cool_line_el box js_palitra_door" data-front="<?= $color['PIC_1'] ?>" data-back="<?= $color['PIC_2'] ?>">
                                    <img src="<?= $color['PIC_1'] ?>" alt="">
                                    <span class="desc"><?= $color['COLOR'] ?></span>
                                </span>
                            <? } ?>
                            <i class="js_line line"></i>
                        </div>
                    <? } ?>
                    <p>Дверь в 6-ти дополнительных цветах незначительно увеличивает свою стоимость.<br>Срок производства остаётся без изменений.</p>
                    <ul class="clearfix colors_square">
                        <li>
                            <span class="square"></span>
                            <p>«Марсала»<br>RAL 3032</p>
                        </li>
                        <li>
                            <span class="square"></span>
                            <p>«Серебро»<br>RAL 9023</p>
                        </li>
                        <li>
                            <span class="square"></span>
                            <p>«Капучино»<br>RAL 1019</p>
                        </li>
                        <li>
                            <span class="square"></span>
                            <p>«Небесный»<br>RAL 5024</p>
                        </li>
                        <li>
                            <span class="square"></span>
                            <p>«Фисташковый»<br>RAL 6019</p>
                        </li>
                        <li>
                            <span class="square"></span>
                            <p>«Серый»<br>RAL 7044</p>
                        </li>
                    </ul>
                    <h3>Мы не ограничиваем вас в выборе цвета</h3>
                    <p class="palitra">Окраска в любой другой цвет RAL осуществляется по предварительному согласованию с менеджерами нашей компании. Всего таблица RAL включает 2 328 оттенков.</p>
                </div>
            </div>
            <script>
                $(function () {
                    function cool_line(tgt) {
                        var el = tgt.find('.js_cool_line_el'),
                                line = tgt.find('.js_line');

                        line.css({
                            'width': el.eq(0).innerWidth() + 'px',
                            'left': el.eq(0).offset().left - tgt.offset().left + 'px',
                        });

                        el.on('click', function () {
                            var w = $(this).innerWidth(),
                                    l = $(this).offset().left;

                            line.css({
                                'width': w + 'px',
                                'left': l - tgt.offset().left + 'px',
                            });
                        })
                    }
                    ;

                    cool_line($('.js_cool_line'));

                    $('.js_palitra_door').eq(0).addClass('active');
                    $('.js_sider').find('img').eq(0).attr('src',
                            $('.js_palitra_door').eq(0).attr('data-front'));
                    $('.js_sider').find('img').eq(1).attr('src',
                            $('.js_palitra_door').eq(0).attr('data-back'));

                    $('.js_palitra_door').on('click', function () {
                        var sides = $('.js_sider').find('img');

                        $('.js_palitra_door').removeClass('active');
                        $(this).addClass('active');
                        sides.eq(0).attr('src', $(this).attr('data-front'));
                        sides.eq(1).attr('src', $(this).attr('data-back'));
                    })

                    $('.js_piker').on('mousedown', function () {
                        var door = $('.js_sider'),
                                max = 360;

                        door.on('mousemove', function (e) {
                            var centerCoord = e.clientX - door.offset().left,
                                    pickerCoord = e.clientX - door.offset().left;

                            if (pickerCoord >= 0 && pickerCoord <= max) {
                                coord(centerCoord, pickerCoord);
                            } else if (pickerCoord < 0) {
                                coord(0, 0);
                            } else if (pickerCoord > max) {
                                coord(max, max);
                            }
                        });

                    });
                    function coord(w, l) {
                        $('.js_front').css('width', w);
                        $('.js_piker').css('left', l);
                    }
                    ;
                    $(document).on('mouseup', function () {
                        $('.js_sider').off('mousemove');
                    });
                    $('.js_piker').on('touchstart', function () {
                        var door = $('.js_sider'),
                                max = 446;

                        door.on('touchmove', function (e) {
                            e.preventDefault();
                            var delta = door.offset().left - $(document).scrollLeft();
                            var centerCoord = e.originalEvent.touches[0].clientX - delta,
                                    pickerCoord = e.originalEvent.touches[0].clientX - delta;

                            if (pickerCoord >= 0 && pickerCoord <= max) {
                                coord(centerCoord, pickerCoord);
                            } else if (pickerCoord < 0) {
                                coord(0, 0);
                            } else if (pickerCoord > max) {
                                coord(max, max);
                            }
                        });

                    });
                    $(document).on('touchend', function () {
                        $('.js_sider').off('touchmove');
                    });
                })
            </script>
        <? } ?>
        <div class="tech clearfix">
            <div class="left">
                <h3>Технические характеристики</h3>
                <table>
                    <? foreach ($FILE_TTH as $code => $TTH) { ?>
                        <tr class="tab" data-tab="<?= $code ?>">
                            <td><?= $TTH["NAME"]; ?></td>
                            <td><?=
                                $TTH["TEXT"];
                                if ($TTH["TOOLTIP"]) {
                                    echo "<i class=' inf'><span class='tooltip'>" . $TTH["TOOLTIP"] . "</span></i>";
                                }
                                ?></td>
                        </tr>
                    <? } ?>
                    <? foreach ($TEXT_TTH as $code => $TTH) { ?>
                        <tr>
                            <td><?= $TTH["NAME"] ?></td>
                            <td><?=
                                $TTH["TEXT"];
                                if ($TTH["TOOLTIP"]) {
                                    echo "<i class ='inf'><span class='tooltip'>" . $TTH["TOOLTIP"] . "</span></i>";
                                }
                                ?></td>
                        </tr>
                    <? } ?>
                </table>
            </div>
            <div class="right">
                <h3>В базовую комплектацию входят</h3>
                <ul class="tabs clearfix">
                    <? foreach ($FILE_TTH as $code => $TTH) { ?>
                        <li data-tab="<?= $code ?>" class="<?= $code ?>">
                            <p class="img"><img src="<?= $TTH["FILE"] ?>" alt="<?= htmlentities($TTH["NAME"]) ?>"></p>
                            <span><?= $TTH["NAME"] ?></span>
                        </li>
                    <? } ?>
                </ul>
            </div>

        </div>

        <? if ($arResult["SOME_NEW_MODEL"]) { ?>

            <div class="cool_not_bottom cool_not_right">
                <a href="<?= $arResult["SOME_NEW_MODEL"]["DETAIL_PAGE_URL"] ?>" class="link">
                    <p class="title"><span>Похожая новая модель</span></p>
                    <div class="imgs clearfix">
                        <div class="img fll"><img src="<?= $arResult["SOME_NEW_MODEL"]["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arResult["SOME_NEW_MODEL"]["NAME"] ?>"></div>
                        <div class="img flr"><img src="<?= $arResult["SOME_NEW_MODEL"]["PREVIEW_PICTURE2"]["SRC"] ?>" alt="<?= $arResult["SOME_NEW_MODEL"]["NAME"] ?>"></div>
                    </div>
                    <p class="name"><span><?= $arResult["SOME_NEW_MODEL"]["NAME"] ?></span></p>
                    <div class="price_wrap <?
                    if ($arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] > $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["DISCOUNT_VALUE"]) {
                        echo "sale";
                    }
                    ?>">
                             <? if ($arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] > $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["DISCOUNT_VALUE"]) { ?>
                            <p class="sale_price"><?= $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["DISCOUNT_VALUE"] ?></p>
                        <? } ?>
                        <p class="price"><span class="num"><?= $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] ?></span> руб.</p>
                        <p class="old_price"><?= $arResult["SOME_NEW_MODEL"]["MIN_PRICE"]["VALUE"] ?></p>
                    </div>
                </a>
            </div>
        <? } ?>
        <?
        if ($arResult["PROPERTIES"]["SEVER"]["VALUE"] != "Y") {

            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", ".default", Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "/important_for_cost.php",
                "EDIT_TEMPLATE" => ""
                    )
            );
        }
        ?>
        <script               >
            $(function () {
                $('.main_foto button').on('click', function () {
                    var src = $(this).attr('data-src');
                    $(this).closest('.main_foto').find('button').removeClass('active');
                    $(this).addClass('active');
                    $(this).closest('.main_foto').find('img').attr('src', src);
                })
            })
        </script>
    </div>
</div>
<? } ?>