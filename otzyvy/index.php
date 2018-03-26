<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetPageProperty("description", "Отзывы клиентов о входных металлических дверях Стальная Линия. Возможность увидеть и оставить свой отзыв.");

$APPLICATION->SetPageProperty("keywords", "Отзывы, Стальная Линия, входные двери, металлические двери.");

$APPLICATION->SetPageProperty("title", "Отзывы о входных дверях Стальная Линия | Ds-steelline.by");

$APPLICATION->SetTitle("");

$str_ids = htmlspecialcharsbx($_GET["IDS"]);

//LocalRedirect("/404.php");

?>

<script src="./column.js"></script>



<div class="reviews_wrap wrap">

    <div class="review_wrap_title justified_container">

        <h1 class="review_wrap_title_text">Отзывы</h1>

        <button class="review_wrap_title_btn">Оставить свой…</button>

    </div>

    <div class="posted_reviews_container">



        <!-- <div class="postedReviewItem">

                <div class="postedReviewItem_foto">

                        <img src="/bitrix/templates/steelline/img/review_door.png" alt="Гранд" class="postedReviewItem_fotoImg">

                        <div class="postedReviewItem_fotoTitle">

                                <a href="#" class="link_general postedReviewItem_fotoTitleName" target="_blank">Гранд</a>

                                <span class="postedReviewItem_fotoTitleSeries">серия «100»</span>

                        </div>

                </div>

                <div class="postedReviewItem_rating postedReviewItem_rating_4">

                        <span class="postedReviewItem_ratingSmile"></span>

                        <span class="postedReviewItem_ratingBlock">

                                <span class="postedReviewItem_ratingTitle">менеджер работал:</span>

                                <span class="postedReviewItem_ratingValue">лучше всех</span>

                        </span>

                </div>

                <div class="postedReviewItem_text">

                        <p>Специалист по продажам вежливая, внимательная к покупателям, дает компетентные ответы на все вопросы (Лещинская Екатерина тц «Трюм»).</p>

                        <p class="accent">Планируем обратиться за доборами</p>

                        <p>Были учтены все наши пожелания и мы приобрели желанную надежную, 4-х контурную, безопасну дверь. Спасибо вам от всей нашей семьи!</p>

                        <p>В эксплуатации дверь показала себя отлично: хорошая звукоизоляция</p>

                </div>

                <div class="postedReviewItem_sign">ул. Колесникова 19, Артем</div>

                <div class="postedReviewItem_sign postedReviewItem_sign-link"><a href="" class="link_general">Сергей, 24.09.2015 otzyv.by</a></div>

                <div>

                        <p class="postedReviewItem_businessReply">Замерщики не оставляют человека<br> с вопросами. Рассказывают об правильной эксплуатации, и обсдуживании двери.</p>

                </div>

        </div> -->

        <?

        if (isset($_GET["_escaped_fragment_"])) {

            $APPLICATION->IncludeComponent(

                    "reviews:cat.section", "rest-reviews-no-ajax", array(

                "IBLOCK_TYPE" => "catalog",

                "IBLOCK_ID" => "26",

                "SEF_MODE" => "Y",

                "CACHE_TYPE" => "A",

                "CACHE_TIME" => "360000",

                "CACHE_FILTER" => "N",

                    ), false

            );

        }

        ?>

    </div>



    <div class="wrap happy_client_form_container">

        <form method="post" id="happy_letter" name="happy_letter" class="guarantee_letter_form happy_client_form js_validate">

            <h2 class="happy_letter_title">Отзыв о сервисе и двери</h2>

            <fieldset class="guarantee_letter_group contacts">

                <p class="js_class_valid required">

                    <input type="hidden" name="my_address">

                    <input type="text" name="login" class="hidden_field">

                    <label for="happy_client_name" class="guarantee_letter_field_name">Имя</label>

                    <input id="happy_client_name" type="text" name="happy_client_name" class="guarantee_letter_field" data-valid="name" data-valid-min="2"><!--

                    --><span class="guarantee_letter_field_detail side">Этим именем будет <br class="hidden-sm">подписан отзыв&nbsp;на&nbsp;сайте</span>

                    <span class="error_message side">Мы не сможем разместить отзыв&nbsp;с&nbsp;таким именем</span>



                </p>

                <p class="js_class_valid required">

                    <label for="happy_client_tel" class="guarantee_letter_field_name">Телефон</label>

                    <input id="happy_client_tel" type="tel" name="happy_client_tel" class="guarantee_letter_field" data-valid="phone"><!--

                    --><span class="guarantee_letter_field_detail side">Мы можем уточнить информацию <br>или подробнее узнать о проблеме</span>

                    <span class="error_message side">Менеджер не дозвонится <br>по этому номеру</span>

                    <span class="guarantee_letter_field_detail bottom">+375 (29) 196 47 37</span>

                </p>

            </fieldset>

            <fieldset class="guarantee_letter_group">

                <p class="js_class_valid required">

                    <label for="happy_client_address" class="guarantee_letter_field_name">Адрес установки</label>

                    <input id="happy_client_address" type="text" name="client_address" class="guarantee_letter_field" data-valid="all" data-valid-min="5"><!--

                    --><span class="guarantee_letter_field_detail side">По улице и номеру дома мы сможем проверить наша ли эта дверь</span>

                    <span class="error_message side">Мы&nbsp;не&nbsp;сможем проверить наличие <br>вашей двери в&nbsp;базе компании</span>

                    <span class="guarantee_letter_field_detail bottom">ул. Лопатина, 5</span>

                </p>

                <p class="guarantee_letter_field_photo">

                    <input type="text" class="hidden_field photo_way" id="happy_client_door_photo_way" name="door_photo_way" data-valid="all" data-valid-min="5">

                    <label for="happy_client_door_photo" class="guarantee_letter_field_name">Фото вашей двери</label>

                    <input id="happy_client_door_photo" type="file" name="door_photo" class="guarantee_letter_field" accept="image/jpeg, image/png">

                    <span class="download_imitation">

                        <span class="download_button">Выбрать фото</span>

                        <span class="download_text">Фото не выбрано</span>

                    </span>

                    <span class="guarantee_letter_field_detail bottom">Джипег или пнг, не более 5 Мб. <br>Фото не обязательно, но поможет людям в выборе двери</span>

                </p>

            </fieldset>

            <div class="happy_client_rating_container rating_container justified_container">

                <fieldset class="happy_client_rating manager">

                    <legend>Менеджер работал:</legend>

                    <p class="happy_client_rating_value">

                        <input id="manager_rating_bad" name="manager_rating" value="bad" type="radio" class="rating_value_button">

                        <label for="manager_rating_bad" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">плохо</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="manager_rating_normal" name="manager_rating" value="normal" type="radio" class="rating_value_button">

                        <label for="manager_rating_normal" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">нормально</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="manager_rating_good" name="manager_rating" value="good" type="radio" class="rating_value_button">

                        <label for="manager_rating_good" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">здорово</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="manager_rating_excellent" name="manager_rating" value="excellent" type="radio" class="rating_value_button">

                        <label for="manager_rating_excellent" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">лучше всех</span>

                        </label>

                    </p>

                </fieldset>

                <fieldset class="happy_client_rating delivery">

                    <legend>Доставили и установили:</legend>

                    <p class="happy_client_rating_value">

                        <input id="delivery_rating_bad" name="delivery_rating" value="bad" type="radio" class="rating_value_button">

                        <label for="delivery_rating_bad" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">медленно</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="delivery_rating_normal" name="delivery_rating" value="normal" type="radio" class="rating_value_button">

                        <label for="delivery_rating_normal" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">нормально</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="delivery_rating_good" name="delivery_rating" value="good" type="radio" class="rating_value_button">

                        <label for="delivery_rating_good" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">быстро</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="delivery_rating_excellent" name="delivery_rating" value="excellent" type="radio" class="rating_value_button">

                        <label for="delivery_rating_excellent" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">очень быстро</span>

                        </label>

                    </p>

                </fieldset>

                <fieldset class="happy_client_rating door_quality">

                    <legend>Дверь служит:</legend>

                    <p class="happy_client_rating_value">

                        <input id="door_quality_rating_bad" name="door_quality_rating" value="bad" type="radio" class="rating_value_button">

                        <label for="door_quality_rating_bad" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">плохо</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="door_quality_rating_normal" name="door_quality_rating" value="normal" type="radio" class="rating_value_button">

                        <label for="door_quality_rating_normal" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">нормально</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="door_quality_rating_good" name="door_quality_rating" value="good" type="radio" class="rating_value_button">

                        <label for="door_quality_rating_good" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">достойно</span>

                        </label>

                    </p>

                    <p class="happy_client_rating_value">

                        <input id="door_quality_rating_excellent" name="door_quality_rating" value="excellent" type="radio" class="rating_value_button">

                        <label for="door_quality_rating_excellent" class="rating_value">

                            <span class="rating_value_smile"></span>

                            <span class="rating_value_name">отлично</span>

                        </label>

                    </p>

                </fieldset>

            </div>

            <p class="guarantee_letter_field_wrap textblock js_class_valid required">

                <label for="happy_client_description" class="guarantee_letter_field_name">Описание работы компании&nbsp;и&nbsp;двери</label>

                <textarea name="happy_client_description" id="happy_client_description" class="guarantee_letter_field" data-valid="all" data-valid-min="5"></textarea><!--

                --><span class="guarantee_letter_field_detail side">Вы&nbsp;рекомендовали&nbsp;бы нашу компанию своим&nbsp;знакомым?<br><br>Сразу&nbsp;ли вы&nbsp;поверили что мы&nbsp;все выполним качественно или у&nbsp;вас были сомнения?</span>

                <span class="error_message side">Опишите подробнее ваши <br>впечатления от работы <br>компании и двери</span>

            </p>

            <p class="guarantee_letter_field_wrap">

                <input type="button" value="Отправить" id="send_form" name="send_form" class="send_button disabled"><!--

                --><span class="guarantee_letter_field_detail side big_margin">Имя, телефон, адрес и&nbsp;описание обязательны. <br class="hidden-sm">Отправив форму, вы&nbsp;соглашаетесь на&nbsp;публикацию отзыва&nbsp;на&nbsp;сайте</span>

            </p>

            <div class="sales_manager guarantee_manager">

                <p class="sales_manager_text">Опишите впечатления от&nbsp;работы компании &laquo;Дверной сезон&raquo; и&nbsp;качества входных дверей &laquo;Стальная линия&raquo;. Нам важно ваше мнение!</p>

                <figure class="sales_manager_photo">

                    <img src="../bitrix/templates/steelline/img/sales_manager.png" alt="впечатления от работы компании 'Дверной сезон' и качества входных дверей">

                    <figurecaption><span>Екатерина</span> менеджер по&nbsp;продажам</figurecaption>

                </figure>

            </div>

        </form>

    </div>

    <div class="wrap happy_letter_notification_container hidden">

        <div class="happy_letter_notification">

            <p class="happy_letter_notification_title">Отзыв отправлен</p>

            <p class="happy_letter_notification_text">После модерации он&nbsp;будет опубликован на&nbsp;сайте. <br>Мы&nbsp;свяжемся с&nbsp;вами, если в&nbsp;отзыве были замечания.</p>

        </div>

    </div>

    <script src="/bitrix/templates/steelline/script/mustache.js"></script>

    <script src="/bitrix/templates/steelline/script/blured.js"></script>

    <script>

        $(function () {

            $.ajax({

                url: '/rest-reviews/',

            }).done(function (res) {

                var response = JSON.parse(res);

                showReviews(response);

            });



            function showReviews(response) {

                $.get('/bitrix/templates/steelline/mustache/reviews_tpl.html', function (template) {
					response.REVIEWS.forEach(function(item){
						item.ANSWER_BUSINESS = $('<textarea />').html(item.ANSWER_BUSINESS).val();
					})

                    var rendered = Mustache.render(template, {REVIEWS: response.REVIEWS});

                    $(".posted_reviews_container").html(rendered);

                    fromBlured($(".posted_reviews_container"));

                    // var heights = [];

                    // var heightsSum = 0;

                    // for (var i = 0; i < $(".postedReviewItem").length; i++) {

                    //     heights.push($(".postedReviewItem").eq(i).outerHeight(true));

                    // }

                    // for (var j = 0; j < heights.length; j++) {

                    //     heightsSum += heights[j];

                    // }

                    // heights.sort();

                    // var containerHeight = $(".posted_reviews_container").height() / 3 + heights[heights.length - 1] * 2.5;

                    // $(".posted_reviews_container").css("max-height", containerHeight);

                    // /*determine IE*/

                    // var ua = !!window.MSInputMethodContext && !!document.documentMode || /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

                    // console.log(navigator.userAgent.toLowerCase());

                    // if (ua == true) {

                    //     $(".posted_reviews_container").css("height", containerHeight);

                    // }

                })

            }



            var validator = new Validator();

            $(".download_imitation").on("click", function () {

                $(this).siblings(".guarantee_letter_field").trigger("click");

            })



            /*sends photo to server then gets its url*/

            $('.guarantee_letter_field[type="file"]').on("change", function (e) {

                var photoDataSend = new FormData();

                var photoData = e.target.files[0];

                var reader = new FileReader();

                var photoField = $(this);

                if (photoData.type == "image/jpeg" || photoData.type == "image/png") {

                    if (photoData.size > 5242880) {

                        photoField.siblings(".download_imitation").find(".download_text").text("Размер фото более 5 Мб").addClass("error_message");

                        reader.abort();

                        photoField.siblings(".photo_way").val("").trigger("change");

                    } else {

                        photoField.siblings(".download_imitation").find(".download_text").text("Загрузка...").removeClass("error_message");

                        photoField.siblings(".download_imitation").find(".download_button").text("Заменить фото");

                        photoDataSend.append(photoField.attr('name'), photoData, photoData.name);

                        $.ajax({

                            url: "/request/happy_letter.php",

                            type: "POST",

                            data: photoDataSend,

                            contentType: false,

                            processData: false,

                            beforeSend: function () {

                                photoField.siblings(".download_imitation").find(".download_text").addClass("in_progress");

                            },

                            success: function (result) {

                                photoField.siblings(".photo_way").val(result).trigger("change");

                                if (photoData.name.length <= 28) {

                                    photoField.siblings(".download_imitation").find(".download_text").removeClass("in_progress").text("Фото загружено: " + photoData.name);

                                } else {

                                    photoField.siblings(".download_imitation").find(".download_text").removeClass("in_progress").text("Фото загружено: " + photoData.name.slice(0, 19) + "..." + photoData.name.slice(-8));

                                }



                            }

                        })

                    }

                } else {

                    $(this).siblings(".download_imitation").find(".download_text").text("Добавьте фото в формате джипег или пнг").addClass("error_message");

                    reader.abort();

                    photoField.siblings(".photo_way").val("").trigger("change");

                }

            });



            /*sends form data*/

            $("#send_form").on("click", function () {

                if (!$(this).hasClass("disabled")) {

                    $(this).addClass("pressed");

                    var form = $('#happy_letter')[0];

                    var formData = new FormData(form);

                    if (typeof formData.delete == 'function') {

                        formData.delete('door_photo');

                    }

                    $.ajax({

                        url: "/request/happy_letter.php",

                        type: "POST",

                        data: formData,

                        contentType: false,

                        processData: false,

                        success: function () {

                            $("#send_form").removeClass('pressed');

                            $('.happy_client_form_container').animate({"height": $(".happy_letter_notification_container").height()}, 700, function () {

                                $('.happy_client_form_container').addClass("hidden");

                                $(".happy_letter_notification_container").removeClass("hidden");

                            });



                        }

                    })

                }

            })



            $('.rating_container.js_class_valid input[type="radio"]').on("change", function () {

                if ($('.rating_container.js_class_valid input[type="radio"]:checked').length == $('.rating_container.js_class_valid fieldset').length) {

                    $('.rating_container.js_class_valid').addClass('ok');

                    enableButton()

                }

            });



            if ($(window).width() < 650) {

                $("#happy_client_tel, #happy_client_address").each(function () {

                    $(this).attr("placeholder", $(this).siblings(".guarantee_letter_field_detail.bottom").text())

                })

            }



            $(".review_wrap_title_btn").on("click", function () {

                $("html, body").animate({

                    scrollTop: $("#happy_letter").offset().top

                }, 1000)

            })

        });

    </script>

</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>