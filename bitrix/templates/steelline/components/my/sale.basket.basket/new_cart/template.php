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
/** @var CBitrixBasketComponent $component */
if (!empty($arResult)) {
	if($arResult["PROPERTIES"]["DOUBLE"]["VALUE"]) {
		$class=" dambldoor";
	}
	$sample = in_array("sample", $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"])?" sample_door":false;
    ?>
    <div class="cool_blank new wrap<?=$class?>">
        <div class="rela js_stop">
			<div class="door door_fix js_door_fix<?if($sample) { echo $sample; } ?>">
                <div class="imgs clearfix">
                    <div class="img fll"><img src="<?php echo $arResult["DETAIL_PICTURE"] ?>" alt=""></div>
                    <div class="img flr"><img src="<?php echo $arResult["DETAIL_PICTURE_2"] ?>" alt=""></div>
                </div>
                <p class="name"><?php echo $arResult["NAME"] ?></p>

                <?php if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) { ?>
                    <!--ul class="labels">
                        <?php foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $val) { ?>
                            <li class="<?php echo $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k]; ?>"><?php echo $val; ?></li>
                        <?php } ?>
                    </ul-->
                <?php } ?>

                <?php if ($arResult["TOOLTIP"]["ARTICLE"]) { ?>
                    <p class="prop article"><?php echo $arResult["TOOLTIP"]["ARTICLE"] ?></p>
                <?php } ?>
                <?php if ($arResult["TOOLTIP"]["OUTSIDE"]) { ?>
                    <p class="prop"><?php echo getMessage("OUT"); ?><?php echo $arResult["TOOLTIP"]["OUTSIDE"] ?></p>
                <?php } ?>
                <?php if ($arResult["TOOLTIP"]["INSIDE"]) { ?>
                    <p class="prop"><?php echo getMessage("IN"); ?><?php echo $arResult["TOOLTIP"]["INSIDE"] ?></p>
                <?php } ?>
                <div class="price_wrap <?php if ($arResult["DISCOUNT_PRICE"] != $arResult["PRICE"]) { ?>sale<?php } ?>">
                    <?php if ($arResult["DISCOUNT_PRICE"] != $arResult["PRICE"]) { ?>
                        <p class="sale_price"><?php echo $arResult["DISCOUNT_PRICE"]; ?></p>
                    <?php } ?>
                    <p class="price"><span class="num"><?php echo $arResult["PRICE"]; ?></span> руб.</p>
                </div>
                <button class="button" data-scroll=".js_form">Заказать...</button>
            </div>
            <div class="info">
                <h1 class="title">5 шагов покупки входной двери</h1>
                <p class="step">Шаг 1</p>
                <div class="block">
                    <p class="h3">Закажите бесплатный замер — установите дверь без рисков</p>
                    <p class="text mgb">Замер проёма — обязательный этап покупки. <br>Специалист компании замеряет проём бесплатно <br>и консультирует по дополнительным опциям двери.</p>
                    <p class="text">Правильный замер помогает определить:</p>
                    <p class="text dot">размеры проёма</p>
                    <p class="text dot">способ открывания двери</p>
                    <p class="text dot">стоимость демонтажа старой двери</p>
                    <p class="text dot">стоимость доставки и установки новой двери</p>
                    <span class='dp-zamki-cart'>Обсудите с&nbsp;менеджером варианты замков для дверей серий «100» и «100У»</span>
                </div>

                <!-- dobory-order -->
                <div class="dp-dobory-order">
                    <div class="dp-dobory-order__dobory">
                        <h3 class="dp-dobory-order__dobory-title">Доборы и внутренние наличники</h3>
                        <p class="dp-dobory-order__dobory-desc">Двери «Стальная линия» поставляются с внешними наличниками. Доборы и внутренние наличники в&nbsp;комплект не входят, а заказываются отдельно.</p>
                    </div>
                    <div class="dp-dobory-order__install">
                        <h3 class="dp-dobory-order__install-title">Установить с дверью</h3>
                        <p class="dp-dobory-order__install-desc">Примерную стоимость вы&nbsp;узнаете на&nbsp;замере. Точную назовёт менеджер при заключении договора.</p>
                    </div>
                </div>


                <p class="step">Шаг 2</p>
                <div class="block">
                    <p class="h3">Подпишите договор и внесите оплату:</p>
                    <p class="text dot mgb"> во время замера <br>со специалистом<br>компании
                        <span class="gray">Менеджер подтверждает заказ<br> по указанному номеру телефона<br> на следующий день </span>
                    </p>
                    <p class="text dot mgb">в одном из фирменных <br>салонов «Стальная линия»<br>
						<a href="/saloons/" target="_blank" class="link"><span>Карта салонов</span></a>
                    </p>
                    <p class="text rama mgb">Предоплата за складскую дверь составляет 10&thinsp;% <br>от стоимости, а за заказную — 30&thinsp;%. Копия договора и чек об оплате остаётся у покупателя. </p>
                </div>
                <p class="step">Шаг 3</p>
                <div class="block">
                    <p class="h3">Согласуйте дату установки</p>
                    <p class="text">После установленного срока производства <br>двери, менеджер уточняет удобную дату <br>и время установки.</p>
                </div>
                <p class="step">Шаг 4</p>
                <div class="block">
                    <p class="h3">Оплатите оставшуюся сумму:</p>
                    <p class="text dot mgb">специалисту компании <br>во время установки</p>
                    <p class="text dot mgb">в одном из фирменных <br>салонов «Стальная линия»<br><a href="/saloons/" target="_blank" class="link"><span>Карта салонов</span></a></p>
                    <p class="text">После полной оплаты покупателю <br>выдаётся второй чек</p>
                </div>
                <p class="step">Шаг 5</p>
                <div class="block">
                    <p class="h3">Проконтролируйте установку</p>
					<p class="text">В указанное время доставляем выбранную дверь. Демонтируем старую дверь и устанавливаем новую. Происходит расчёт доставки, демонтажа и монтажа двери — оплата наличными.<br><br>Покупатель получает гарантийный талон, в котором указана дата выполнения монтажных работ.</p>
                    <div class="fact">
                        <b>24</b>
                        <p>месяца гарантии<br>на дверь</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form js_form">
            <div class="door<?if($sample) { echo $sample; } ?>">
                <div class="imgs clearfix">
                    <div class="img fll"><img src="<?php echo $arResult["DETAIL_PICTURE"] ?>" alt=""></div>
                    <div class="img flr"><img src="<?php echo $arResult["DETAIL_PICTURE_2"] ?>" alt=""></div>
                </div>
                <p class="name mgb"><?php echo $arResult["NAME"] ?></p>
                
                <?php if (!empty($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"])) { ?>
                    <ul class="labels">
                        <?php foreach ($arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE"] as $k => $val) { ?>
                            <li class="<?php echo $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"][$k]; ?>"><?php echo $val; ?></li>
                        <?php } ?>
                    </ul>
                <?php }
                ?>
                
               <?php if ($arResult["TOOLTIP"]["ARTICLE"]) { ?>
                    <p class="prop article"><?php echo $arResult["TOOLTIP"]["ARTICLE"] ?></p>
                <?php } ?>
                <?php if ($arResult["TOOLTIP"]["OUTSIDE"]) { ?>
                    <p class="prop"><?php echo getMessage("OUT"); ?><?php echo $arResult["TOOLTIP"]["OUTSIDE"] ?></p>
                <?php } ?>
                <?php if ($arResult["TOOLTIP"]["INSIDE"]) { ?>
                    <p class="prop"><?php echo getMessage("IN"); ?><?php echo $arResult["TOOLTIP"]["INSIDE"] ?></p>
                <?php } ?>
                <div class="price_wrap fil <?php if ($arResult["DISCOUNT_PRICE"] != $arResult["PRICE"]) { ?>sale<?php } ?>">
                    <?php if ($arResult["DISCOUNT_PRICE"] != $arResult["PRICE"]) { ?>
                        <p class="sale_price"><?php echo $arResult["DISCOUNT_PRICE"]; ?></p>
                    <?php } ?>
                    <p class="price"><span class="num"><?php echo $arResult["PRICE"]; ?></span> руб.</p>
                </div>
            </div>
            <form action="/cart/new_order/" method="post" class="js_validate">
                <p class="title">Бесплатный замер</p>
                <p class="text">Заполните форму и менеджер согласует <br>дату и время замера</p>
                <div class="field js_input js_class_valid">
                    <input type="text" name="name" placeholder="Ваше имя" data-valid="name" data-valid-min="2">
                    <span class="example">Василий</span>
                    <span class="error_mess long_mess">Менеджер не сможет<br>обратиться к вам<br>по этому имени</span>
                </div>
                <div class="field js_input js_class_valid">
                    <input type="text" name="phone" data-valid="phone" placeholder="Номер телефона">
                    <input type="hidden" name="my_address">
                    <input type="text" name="login" class="my_login">
                    <span class="example">+375 (29) 000-00-00</span>
                    <span class="error_mess">Менеджер не дозвонится <br>по этому номеру</span>
                </div>
                <div class="field">
                    <textarea name="mess" placeholder="Ваш комментарий"></textarea>
                    <span class="example">Укажите, в какое время вам удобно разговаривать? <br>Хотели бы вы заказать дополнительные опции к двери? <br>Нужна ли установка доборов?</span>
                </div>
                <button type="submit" class="send_button basket_button disabled">Заказать</button>
            </form>
        </div>
        <script>
        /*ecommerce*/
            $(document).on('click', '.send_button.basket_button:not(.disabled)', function(e) {
                dataLayer.push({
                    "ecommerce": {
                        "currencyCode": "BYN",
                        "purchase": {
                            "products": [
                                {
                                    "id": '<?= $arResult["ID"]?>',
                                    "name": '<?= $arResult["NAME"] ?>',
                                    "price": '<?= $arResult["PRICE"]?>'
                                }
                            ]
                        }
                    }
                });
            })

        /*!ecommerce*/
            $(function () {
                $('.cool_blank .sale_price').each(function () {
                    format_price($(this));
                })
                $('.cool_blank .price_wrap .num').each(function () {
                    format_price($(this));
                })
                $(".send_button").on("click", function() {
                    $(this).addClass("pressed");
                })
                var validator = new Validator();

                var start = $('.js_stop').offset().top + 50,
                        fix = $('.js_door_fix'),
                        end = $('.js_stop').height() + start - fix.height() - 90;

                posa2($(document).scrollTop());
                $(document).scroll(function () {
                    var top = $(document).scrollTop();
                    posa2(top);

                })

                function posa2(top) {
                    //if(device.mobile()|| device.ios()|| device.android()) return;
                    if (top > start && top < end) {
                        fix.addClass('fix');
                    } else if (top >= end) {
                        fix.css('top', end - start + 85).removeClass('fix');
                    } else {
                        fix.css('top', '78px').removeClass('fix');
                    }
                }
                ;

            })
        </script>
    </div>
<?php } else { ?>
    Без окон без дверей, полна горница людей.<br><br>
    (Дом человека с пустой корзиной на steelline)
<?php } ?>
