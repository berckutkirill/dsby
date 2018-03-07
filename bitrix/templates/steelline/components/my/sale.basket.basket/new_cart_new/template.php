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
//if (!empty($arResult)) {
if ($arResult["PROPERTIES"]["DOUBLE"]["VALUE"]) {
    $class = " dambldoor";
}
$sample = in_array("sample", $arResult["PROPERTIES"]["DESTINATION_ICON"]["VALUE_XML_ID"]) ? " sample_door" : false;
//print_r($arResult);
?>
<div class="c-basket">
    <div class="c-wrapper">
        <div class="c-basket__wrap">
            <div class="c-basket__main">
                <section class="c-basket__head">
                    <h1 class="c-h1">5 шагов покупки</h1>
                </section>
                <section class="c-basket__body">
                    <section class="c-basket__stage c-basket__stage--one"><span class="c-basket__stage-num">шаг 1</span>
                        <div class="c-basket__stage-head">
                            <h3 class="c-h3">Закажите бесплатный замер — установите дверь без рисков</h3>
                        </div>
                        <div class="c-basket__stage-body">
                            <div class="c-basket__stage-main">
                                <div class="c-basket__stage-wrap">
                                    <p class="c-p2">Замер проёма — обязательный этап покупки. Специалист&nbsp;компании замеряет проём бесплатно и&nbsp;консультирует по дополнительным опциям двери.</p>
                                </div>
                                <div class="c-basket__stage-wrap">
                                    <h4 class="c-h4">Правильный замер помогает определить:</h4>
                                    <ul class="c-basket__stage-desc-list">
                                        <li class="c-p2">размеры проёма двери,</li>
                                        <li class="c-p2">способ и сторону открывания,</li>
                                        <li class="c-p2">стоимость демонтажа старой,</li>
                                        <li class="c-p2">стоимость доставки и установки новой.</li>
                                    </ul>
                                </div>
                                <div class="c-basket__stage-wrap">
                                    <h4 class="c-h4">Доборы и внутренние наличники</h4>
                                    <p class="c-p2">Двери «Стальная линия» поставляются с внешними наличниками. Доборы и внутренние наличники в&nbsp;комплект&nbsp;не входят, а заказываются отдельно.</p>
                                </div>
                            </div>
                            <div class="c-basket__stage-aside">
                                <div class="c-basket__note">
                                    <h5 class="c-basket__note-title c-h5">Комплекты <br>замков под заказ</h5>
                                    <p class="c-p3 c-p3--small">Обсудите с менеджером монтаж усиленных замков в&nbsp;двери серий «100» и «100У».</p>
                                </div>
                                <div class="c-basket__note">
                                    <h5 class="c-basket__note-title c-h5">Стоимость доборов и&nbsp;наличников</h5>
                                    <p class="c-p3 c-p3--small">Примерную стоимость узнаете&nbsp;на замере. Точную рассчитает менеджер при заключении договора.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="c-basket__stage c-basket__stage--two"><span class="c-basket__stage-num">шаг 2</span>
                        <div class="c-basket__stage-head">
                            <h3 class="c-h3">Подпишите договор <br>и внесите оплату</h3>
                        </div>
                        <div class="c-basket__stage-body">
                            <div class="c-basket__stage-main">
                                <div class="c-basket__stage-wrap">
                                    <ul class="c-basket__stage-desc-list">
                                        <li class="c-p2">во время замера проёма <br>со специалистом компании</li>
                                    </ul>
                                </div>
                                <div class="c-basket__stage-wrap">
                                    <ul class="c-basket__stage-desc-list">
                                        <li class="c-p2">в одном из фирменных <br>салонов «Стальная линия» <br>
                                            <a class="c-link" href="/saloons/" target="_blank">Карта салонов</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="c-basket__stage-aside">
                                <div class="c-basket__note">
                                    <h5 class="c-basket__note-title c-h5">Звонок от менеджера</h5>
                                    <p class="c-p3 c-p3--small">Менеджер подтвердит заказ по указанному номеру телефона на следующий день.</p>
                                </div>
                            </div>
                        </div>
                        <div class="c-basket__panel">
                            <p class="c-basket__panel-desc c-p2"><span class="c-basket__panel-title">Предоплата </span>за складскую дверь составляет 10%&nbsp;от стоимости, за модель под заказ — 30%. Копия договора и чек остаётся у покупателя.</p><span class="c-basket__panel-fct">10…30%</span>
                        </div>
                    </section>
                    <section class="c-basket__stage"><span class="c-basket__stage-num">шаг 3</span>
                        <div class="c-basket__stage-head">
                            <h3 class="c-h3">Согласуйте дату установки</h3>
                        </div>
                        <div class="c-basket__stage-body">
                            <div class="c-basket__stage-main">
                                <div class="c-basket__stage-wrap">
                                    <p class="c-p2">После установленного срока производства двери, менеджер&nbsp;уточняет удобную дату и время установки.</p>
                                </div>
                            </div>
                            <div class="c-basket__stage-aside"></div>
                        </div>
                    </section>
                    <section class="c-basket__stage"><span class="c-basket__stage-num">шаг 4</span>
                        <div class="c-basket__stage-head">
                            <h3 class="c-h3">Оплатите остаток стоимости</h3>
                        </div>
                        <div class="c-basket__stage-body">
                            <div class="c-basket__stage-main">
                                <div class="c-basket__stage-wrap">
                                    <ul class="c-basket__stage-desc-list">
                                        <li class="c-p2">специалисту компании <br>во время установки</li>
                                    </ul>
                                </div>
                                <div class="c-basket__stage-wrap">
                                    <ul class="c-basket__stage-desc-list">
                                        <li class="c-p2">в одном из фирменных <br>салонов «Стальная линия» <br>
                                            <a class="c-link" href="/saloons/" target="_blank">Карта салонов</a></li>
                                    </ul>
                                </div>
                                <div class="c-basket__stage-wrap">
                                    <p class="c-p2">После полной оплаты покупателю выдаётся второй чек.</p>
                                </div>
                            </div>
                            <div class="c-basket__stage-aside"></div>
                        </div>
                    </section>
                    <section class="c-basket__stage c-basket__stage--five"><span class="c-basket__stage-num">шаг 5</span>
                        <div class="c-basket__stage-head">
                            <h3 class="c-h3">Проконтролируйте установку</h3>
                        </div>
                        <div class="c-basket__stage-body">
                            <div class="c-basket__stage-main">
                                <div class="c-basket__stage-wrap">
                                    <p class="c-p2">В указанное время доставляем выбранную дверь. Демонтируем старую дверь и устанавливаем новую. Происходит расчёт доставки, демонтажа и монтажа двери.&nbsp;Оплата наличными.</p>
                                </div>
                                <div class="c-basket__stage-wrap">
                                    <p class="c-p2">Покупатель получает технический паспорт, в котором указана&nbsp;дата выполнения монтажных работ.</p>
                                </div>
                            </div>
                            <div class="c-basket__stage-aside">
                                <div class="c-fct">
                                    <p class="c-fct__title c-h-fct">24</p><span class="c-fct__caption c-p3 c-p3--small">месяца гарантии</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>

            <?
//            print_r($arResult);
            ?>
            <? if (!empty($arResult)) { ?>
                <div class="c-basket__aside">
                    <div class="c-basket__demo"><span class="c-basket__demo-art"><?= $arResult["TOOLTIP"]["ARTICLE"] ?></span>
                        <div class="c-basket__demo-door">
                            <div class="c-basket__demo-side">
                                <img class="c-basket__demo-side-img" src="<?= $arResult["DETAIL_PICTURE"] ?>" srcset="<?= $arResult["DETAIL_PICTURE"] ?> 1x, <?= $arResult["DETAIL_PICTURE"] ?> 2x"/>
                                <h4 class="c-h4"><?= $arResult["NAME"] ?></h4>
                            </div>
                            <div class="c-basket__demo-side c-basket__demo-side--right">
                                <img class="c-basket__demo-side-img" src="<?= $arResult["DETAIL_PICTURE_2"] ?>" srcset="<?= $arResult["DETAIL_PICTURE_2"] ?> 1x, <?= $arResult["DETAIL_PICTURE_2"] ?> 2x"/>

                                <?
                                $sale = ($arResult["DISCOUNT_PRICE"] != $arResult["PRICE"]) ? true : false;
                                ?>
                                <h4 class="c-h4 c-price <?= $sale ? "c-price--old" : "" ?>"><?= $sale ? $arResult["PRICE"] : $arResult["DISCOUNT_PRICE"] . " руб." ?></h4>

                                <? if ($sale) { ?>
                                    <h4 class="c-h4 c-price c-price--new"><?= $arResult["DISCOUNT_PRICE"] . " руб." ?></h4>
                                <? } ?>
                            </div>
                        </div>
                        <div class="c-basket__demo-desc">
                            <? if ($arResult["TOOLTIP"]["OUTSIDE"]) { ?>
                                <div class="c-basket__demo-side">
                                    <p class="c-basket__demo-side-title c-p4">Снаружи</p>
                                    <p class="c-p4"><?= $arResult["TOOLTIP"]["OUTSIDE"] ?></p>
                                </div>
                            <? } ?>
                            <? if ($arResult["TOOLTIP"]["INSIDE"]) { ?>
                                <div class="c-basket__demo-side">
                                    <p class="c-basket__demo-side-title c-p4">Внутри </p>
                                    <p class="c-p4"><?= $arResult["TOOLTIP"]["INSIDE"] ?></p>
                                </div>
                            <? } ?>
                        </div>
                        <button class="c-basket__demo-order c-w-but">Перейти к заявке…</button>
                    </div>
                </div>
            <? } ?>
        </div>
        <? if (!empty($arResult)) { ?>
            <section class="c-form__wrap js_form">
                <form class="c-form c-form-order js_validate" method="post" name="form-request" action="/cart/new_order/">
                    <div class="c-form__bottom"></div>
                    <div class="c-form__main">
                        <div class="c-form__head">
                            <h2 class="c-form__title c-h2 c-h2--small">Заявка на бесплатный замер</h2>
                            <p class="c-p1 c-p1--small">Заполните форму. Менеджер перезвонит вам, согласует дату и время замера, <br />расскажет про опции двери под заказ.</p>
                        </div>
                        <div class="c-form__body">
                            <div class="c-form__field">
                                <div class="c-form__field-title">
                                    <label class="c-form__label c-p2">Имя</label>
                                </div>
                                <div class="c-form__field-main js_input js_class_valid">
                                    <input class="c-form__input c-p2" type="text" data-valid="name" data-valid-min="2" name="form-request-client-name"/>
                                    <p class="c-form__field-desc c-form__field-desc--error c-p4 c-p4--small error_message">Менеджер не сможет обратиться <br>к вам по этому имени</p>
                                </div>
                            </div>
                            <div class="c-form__field">
                                <div class="c-form__field-title">
                                    <label class="c-form__label c-p2">Номер телефона</label>
                                </div>
                                <div class="c-form__field-main js_input js_class_valid">
                                    <input class="c-form__input c-p2" type="tel" data-valid="phone" name="form-request-client-phone"/>
                                    <p class="c-form__field-desc c-form__field-desc--error c-p4 c-p4--small error_message">Менеджер не дозвонится <br>по этому номеру</p>
                                </div>
                            </div>
                            <div class="c-form__field c-form__field--area">
                                <div class="c-form__field-title">
                                    <label class="c-form__label c-p2">Комментарий</label>
                                </div>
                                <div class="c-form__field-main field">
                                    <textarea class="c-form__input c-p2" type="text" name="form-request-client-comment"></textarea>
                                    <p class="c-form__field-desc c-p4 c-p4--small">В какое время вам удобно разговаривать? Заполнять необязательно. Если время не указано — менеджер перезвонит в будни с 10 до 18</p>
                                </div>
                            </div>
                            <div class="c-form__field c-form__field--box">
                                <div class="c-form__field-title">
                                    <label class="c-form__label c-p2">Хочу узнать больше</label>
                                </div>
                                <div class="c-form__field-main">
                                    <label class="c-form__checkbox-label c-p2">
                                        <input class="c-form__checkbox" type="checkbox" name="form-request-info_dobory"/>
                                        <span class='c-form__checkbox-text'>про доборы и внутренние наличники</span>
                                    </label>
                                </div>
                                <div class="c-form__field-main">
                                    <label class="c-form__checkbox-label c-p2">
                                        <input class="c-form__checkbox" type="checkbox" name="form-request-info_zamki"/>
                                        <span class='c-form__checkbox-text'>о дополнительных комплектах замков</span>
                                    </label>
                                </div>
                            </div>
                            <div class="c-form__field c-form__field--submit">
                                <div class="c-form__field-title"></div>
                                <div class="c-form__field-main">
                                    <button class="c-form__submit c-b-but c-b-but--disabled disabled" type="submit">Отправить заявку</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-form-order__man">
                        <figure class="c-form__man c-form__man--nataliy">
                            <img class="c-form__man-img" src="<?= SITE_TEMPLATE_PATH ?>/img/basket/1x/manager.png" srcset="<?= SITE_TEMPLATE_PATH ?>/img/basket/2x/manager.png 2x"/>
                            <figcaption class="c-form__man-desc">
                                <p class="c-h4 c-form__man-name">Елизавета</p>
                                <p class="c-p4 c-p4--small c-form__man-pos">менеджер <br>по продажам</p>
                            </figcaption>
                        </figure>
                    </div>
                </form>
                <div class="c-thank">
                    <div class="c-thank__main">
                        <h2 class="c-thank__title c-h2"> <span id="thank-form-name">Заявка на замер</span> отправлена</h2>
                        <p class="c-p1 c-p1--small">Менеджер позвонит по телефону <span id="thank-client-phone">+375 29 196 47 37.</span></p>
                        <p class="c-p1 c-p1--small">Мы работаем с 10 до 18 в будни.</p>
                    </div>
                    <svg class="c-thank__svg" xmlns="http://www.w3.org/2000/svg" width="133" height="164" viewBox="0 0 133 164">
                    <path fill="#009D4C" fill-rule="evenodd" d="M0 79.465c16.415 25.36 29.041 51.567 42.09 84.535h7.154C63.554 119.62 98.068 52.836 133 5.495L127.95 0C103.118 24.516 66.5 72.701 44.614 119.62h-.842C32.408 99.753 16.836 83.27 5.893 73.97L0 79.464z"></path>
                    </svg>
                </div>
            </section>
        <? } ?>
    </div>
</div>


<script>
    // плавающий элемент по скроллу
    var floatElement = document.querySelector('.c-basket__demo'),
            floatTrack = document.querySelector('.c-basket__aside');

    function getCoordsOnPage(elem) {
        var box = elem.getBoundingClientRect();

        return {
            top: box.top + pageYOffset,
            left: box.left + pageXOffset,

            bot: box.top + pageYOffset + elem.offsetHeight
        };
    }
    ;

    function floating(off) {
        var coordsTrack = getCoordsOnPage(floatTrack),
                offset = off ? off : 0;

        if (pageYOffset < coordsTrack.top - offset) {
            floatElement.style.position = 'static';
        } else if (pageYOffset > coordsTrack.bot - floatElement.offsetHeight - offset) {
            floatElement.style.position = 'absolute';
            floatElement.style.top = coordsTrack.bot - coordsTrack.top - floatElement.offsetHeight + 'px';
        } else if (pageYOffset > coordsTrack.top - offset) {
            floatElement.style.position = 'fixed';
            floatElement.style.top = offset + 'px';
        }

    }

    floating(50);
    window.addEventListener('scroll', function () {
        floating(50);
    })


    $(".c-basket__demo-order").on("click", function () {
        $('html, body').animate({scrollTop: $(".c-form").offset().top - 60}, 1000)
    })


    var validator = new Validator();
    var thank = document.querySelector('.c-thank');


    function getData(form) {
        var formName = form.querySelector('.c-form__title').innerHTML,
                clientPhone = form['form-request-client-phone'].value,
                thankName = document.getElementById('thank-form-name');
        thankPhone = document.getElementById('thank-client-phone');

        thankName.innerHTML = formName;
        thankPhone.innerHTML = clientPhone;
    }

    /* sends form */
    /*
     $(".c-form__submit").on("click", function (e) {
     e.preventDefault();
     
     $(this).not('.disabled').addClass("pressed");
     if (!$(this).hasClass("disabled")) {
     var form = document.querySelector('.c-form');
     var formData = new FormData(form);
     
     // data for notification
     getData(form);
     
     $.ajax({
     url: "/cart/new_order/index.php",
     type: "POST",
     data: formData,
     contentType: false,
     processData: false,
     success: function () {
     
     form.reset();
     form.querySelector('input[type="tel"]').focus();
     
     form.style.visibility = 'hidden';
     thank.style.display = 'block';
     
     }
     })
     }
     })
     */
    /*ecommerce*/
    $(document).on('click', '.c-form__submit.c-b-but:not(.c-b-but--disabled)', function (e) {
        dataLayer.push({
            "ecommerce": {
                "currencyCode": "BYN",
                "purchase": {
                    "products": [
                        {
                            "id": '<?= $arResult["ID"] ?>',
                            "name": '<?= $arResult["NAME"] ?>',
                            "price": '<?= $arResult["PRICE"] ?>'
                        }
                    ]
                }
            }
        });
    })

    /*!ecommerce*/
</script>