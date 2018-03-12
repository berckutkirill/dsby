<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Компания «Дверной сезон» предоставляет гарантийное обслуживание входных дверей «Стальная линия».");
$APPLICATION->SetPageProperty("keywords", "Гарантийное обслуживание, входные двери, в Минске.");
$APPLICATION->SetPageProperty("title", "Гарантийное обслуживание входных дверей - Ds-steelline.by");

$APPLICATION->SetTitle("");
$str_ids = htmlspecialcharsbx($_GET["IDS"]);
$APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(), false
);
?><div class="p-gar">
    <div class="c-wrapper">
        <section class="p-gar__hero">
            <h1 class="c-h1">Гарантия</h1>
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/garantya-block1.php"
                    )
            );
            ?> </section> <section class="p-gar__ev p-gar-bl">
            <div class="p-gar-bl__body">
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", "", Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/garantya-block2.php"
                        )
                );
                ?>
            </div>
            <div class="p-gar-bl__aside p-gar__ev-aside">
                <div>
                    <a class="c-h4" href="tel: <?= RECLAMATION_PHONE_V ?>"><?= RECLAMATION_PHONE_V ?></a><br>
                    <a class="c-h4" href="tel: <?= RECLAMATION_PHONE_M ?>"><?= RECLAMATION_PHONE_M ?></a> <span class="c-p3">Менеджер пояснит, является <br>
                        ли ваш случай гарантийным</span>
                </div>
                <div class="c-p3">
                    <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/garantya-block3.php"
                            )
                    );
                    ?>
                </div>
            </div>
        </section> <section class="p-gar__send scrollerTo">
            <form class="p-gar__form c-form js_validate" action="" method="post" name="guarantee_letter" id="guarantee_letter">
                <div class="c-form__bottom">
                </div>
                <div class="c-form__main">
                    <div class="c-form__head">
                        <h2 class="c-h2 c-h2--small c-form__title">Заявка на гарантийное обслуживание</h2>
                        <p class="c-p1">
                            Менеджер рассмотрит заявку и перезвонит в течении одного рабочего дня.
                        </p>
                    </div>
                    <div class="c-form__body">
                        <div class="c-form__field">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="client_name">Имя</label>
                            </div>
                            <div class="c-form__field-main js_class_valid required">
                                <input type="hidden" name="my_address"> <input class="c-form__input c-p2" id="client_name" name="client_name" type="text" data-valid="name" data-valid-min="2">
                                <p class="c-form__field-desc c-form__field-desc--error c-p4 c-p4--small error_message">
                                    Менеджер не сможет <br>
                                    обратиться к вам по этому имени
                                </p>
                            </div>
                        </div>
                        <div class="c-form__field">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="client_tel">Телефон</label>
                            </div>
                            <div class="c-form__field-main js_class_valid required">
                                <input class="c-form__input c-p2" id="client_tel" name="client_tel" type="tel" data-valid="phone">
                                <p class="c-form__field-desc c-form__field-desc--error c-p4 c-p4--small error_message">
                                    Менеджер&nbsp;не&nbsp;дозвонится <br>
                                    по&nbsp;этому&nbsp;номеру
                                </p>
                            </div>
                        </div>
                        <div class="c-form__fieldset">
                        </div>
                        <div class="c-form__field">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="agreement_n">Номер договора</label>
                            </div>
                            <div class="c-form__field-main">
                                <input class="c-form__input c-p2" id="agreement_n" name="agreement_n" type="text">
                                <p class="c-form__field-desc c-p4 c-p4--small">
                                    Необязательно, но менеджер <br>
                                    быстрее найдёт дверь в базе
                                </p>
                            </div>
                        </div>
                        <div class="c-form__field c-form__field-addr">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="client_address">Адрес установки</label>
                            </div>
                            <div class="c-form__field-main js_class_valid required">
                                <input class="c-form__input c-p2" id="client_address" name="client_address" type="text" data-valid="all" data-valid-min="5">
                                <p class="c-form__field-desc c-form__field-desc--error c-p4 c-p4--small error_message">
                                    Менеджер не найдет вашу <br>
                                    дверь&nbsp;в&nbsp;базе данных
                                </p>
                                <p class="c-form__field-desc c-p4 c-p4--small c-form__field-desc--bot">
                                    Улица, номер дома и квартиры
                                </p>
                            </div>
                        </div>
                        <div class="c-form__fieldset">
                        </div>
                        <div class="c-form__field c-form__field--file">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="door_photo">Общее фото двери</label>
                            </div>
                            <div class="c-form__field-main">
                                <input class="hidden_field photo_way" type="text" name="door_photo_way" id="door_photo_way">
                                <input class="c-form__field--file-f" type="file" name="door_photo" id="door_photo" accept="image/jpeg, image/png"> 
                                <span class="download_imitation"> <span class="c-form__field--file-b c-w-but c-w-but--small">Выбрать</span>
                                    <span class="download_text c-form__field-desc c-p4 c-p4--small"></span> </span>
                                <p class="c-form__field-desc c-p4 c-p4--small c-form__field-desc--bot">
                                    .jpeg или .png не более 5 Мб
                                </p>
                            </div>
                        </div>
                        <div class="c-form__field c-form__field--file">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="defect_photo">Фото дефекта</label>
                            </div>
                            <div class="c-form__field-main">
                                <input class="hidden_field photo_way" type="text" name="defect_photo_way" id="defect_photo_way"> 
                                <input class="c-form__field--file-f" type="file" name="defect_photo" id="defect_photo" accept="image/jpeg, image/png">
                                <span class="download_imitation"> <span class="c-form__field--file-b c-w-but c-w-but--small">Выбрать</span> 
                                    <span class="download_text c-form__field-desc c-p4 c-p4--small"></span> </span>
                                <p class="c-form__field-desc c-p4 c-p4--small c-form__field-desc--bot">
                                    .jpeg или .png не более 5 Мб <br>

                                </p>
                            </div>
                        </div>
                        <div class="c-form__field c-form__field--area">
                            <div class="c-form__field-title">
                                <label class="c-form__label c-p2" for="defect_name">Опишите дефект</label>
                            </div>
                            <div class="c-form__field-main">
                                <textarea class="c-form__input c-p2" id="defect_name" name="defect_name" type="text"></textarea>
                                <p class="c-form__field-desc c-p4 c-p4--small">
                                    По фото и описанию инженер определит причину дефекта и&nbsp;подготовится к выезду
                                </p>
                            </div>
                        </div>
                        <div class="c-form__field c-form__field--submit">
                            <div class="c-form__field-title">
                            </div>
                            <div class="c-form__field-main">
                                <button class="c-form__submit c-b-but c-b-but--disabled disabled" id="send_form" name="send_form" type="submit">Отправить заявку</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-gar__form-man">
                    <img src="/bitrix/templates/steelline/img/clientu-manager.png" class="p-gar__form-man-img" 
                         srcset="/bitrix/templates/steelline/img/clientu-manager2x.png 2x">
                    <div class="p-gar__form-man-desc">
                        <p class="c-h4">
                            Регина
                        </p>
                        <span class="c-p4 c-p4--small">менеджер по гарантийному обслуживанию</span>
                    </div>
                </div>
            </form>
            <div class="p-gar__form-send hidden" id="guarantee_letter_notification">
                <div class="p-gar__form-send-body">
                    <p class="c-h2 p-gar__form-send-title">
                        Заявка отправлена
                    </p>
                    <p class="c-p1">
                        Ваше обращение поступило менеджеру Регине. Мы заботимся о наших клиентах, поэтому рассматриваем заявки на гарантийное обслуживание в течение одного рабочего дня.
                    </p>
                </div>
                <div class="p-gar__form-send-svg">
                    <svg class="c-th__svg" xmlns="http://www.w3.org/2000/svg" width="183" height="225" viewBox="0 0 183 225">
                        <path stroke-width="1" fill="#009D4C" d="M0,109.022104 C22.5860526,143.814787 39.9586692,179.769512 57.9133083,225 L67.756782,225 C87.4464812,164.112805 134.935669,72.4884146 183,7.53887195 L176.051504,0 C141.884165,33.6347561 91.5,99.7422256 61.3861805,164.112805 L60.2276391,164.112805 C44.5914586,136.85625 23.1653233,114.242378 8.10841353,101.483232 L0,109.020732 L0,109.022104 Z"></path>
                    </svg>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(function () {
        $('.scroller').on('click', function () {
            $('html, body').animate({scrollTop: $(".scrollerTo").offset().top - 50}, 250)
        })

        var validator = new Validator();
        $(".download_imitation").on("click", function () {
            $(this).siblings("[type='file']").trigger("click");
        })

        /*sends photo to server then gets its url*/
        $('[type="file"]').on("change", function (e) {
            var photoDataSend = new FormData();
            var photoData = e.target.files[0];
            var reader = new FileReader();
            var photoField = $(this);
            if (photoData.type == "image/jpeg" || photoData.type == "image/png") {
                if (photoData.size > 5242880) {
                    photoField.siblings(".download_imitation").find(".download_text").text("Размер фото более 5 Мб").addClass("error_message c-form__field-desc--error");
                    reader.abort();
                    photoField.siblings(".photo_way").val("");
                } else {
                    photoField.siblings(".download_imitation").find(".download_text").text("Загрузка...").removeClass("error_message c-form__field-desc--error");
                    photoField.siblings(".download_imitation").find(".c-form__field--file-b").text("Заменить фото");
                    photoDataSend.append(photoField.attr('name'), photoData, photoData.name);
                    $.ajax({
                        url: "/request/reclamation_form.php",
                        type: "POST",
                        data: photoDataSend,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            photoField.siblings(".download_imitation").find(".download_text").addClass("in_progress");
                        },
                        success: function (result) {
                            photoField.siblings(".photo_way").val(result);

                            if (photoData.name.length > 30) {
                                var str = photoData.name,
                                        newStr = str.substr(0, 20) + '...' + str.substr(str.length - 7, 7);

                                photoField.siblings(".download_imitation").find(".download_text").removeClass("in_progress").text(newStr);
                            } else {
                                photoField.siblings(".download_imitation").find(".download_text").removeClass("in_progress").text(photoData.name);
                            }
                        }
                    })
                }
            } else {
                $(this).siblings(".download_imitation").find(".download_text").text("Добавьте фото в формате джипег или пнг").addClass("error_message c-form__field-desc--error");
                reader.abort();
                photoField.siblings(".photo_way").val("");
            }
        });

        /*sends form data*/
        /*sends form data*/
        $("#send_form").on("click", function (e) {
            if (!$(this).hasClass("disabled")) {
                e.preventDefault();

                $(this).addClass("pressed");
                var form = $('#guarantee_letter')[0];
                var formData = new FormData(form);
                if (typeof formData.delete == 'function') {
                    formData.delete('door_photo');
                    formData.delete('defect_photo');
                }
                $.ajax({
                    url: "/request/reclamation_form.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function () {
                        $("#send_form").removeClass("pressed");
                        $('#guarantee_letter').addClass("hidden");
                        $("#guarantee_letter_notification").removeClass("hidden");
                        $('html, body').animate({scrollTop: $("#guarantee_letter_notification").offset().top - ($(window).height() / 2 - $("#guarantee_letter_notification").height())}, 250)
                    }
                })
            }
        })
    });
</script><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>