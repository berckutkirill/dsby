<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$cntBasketItems = CSaleBasket::GetList(
                array(), array(
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
                ), array()
);
?><ul class="fix_menu">
    <!--li><a class="chat">Чат с менеджером</a></li-->
    <li><a href="/cart/" title="Бланк заказа" class="blank_zakaza <?= $cntBasketItems ? "full" : "" ?>">Бланк заказа двери</a></li>
</ul>
<div class="c-requis">
    <div class="c-requis__exit">
        <svg class="c-requis__exit-icon" xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22">
            <path class="c-requis__exit-icon-p" stroke="#006696" fill-rule="nonzero" stroke-width=".6" d="M20.225 1.724l-.8-.8-9.2 9.2-9.2-9.2-.8.8 9.2 9.2-9.2 9.2.8.8 9.2-9.2 9.2 9.2.8-.8-9.2-9.2z"></path>
        </svg>
    </div>
    <div class="c-requis__body">
        <div class="c-requis__head">
            <p class="c-h2 c-requis__title">Реквизиты</p>
        </div>
        <div class="c-requis__main c-p2">
            <p class="c-requis__desc"><span class='c-requis__desc-ls'>OOO</span> «Дверной сезон»</p>
            <p class="c-requis__desc">213105, Республика Беларусь, Могилёвская обл., Могилёвский р-н, Вейнянский с/с, 18, офис 46</p> 
            <p class="c-requis__desc">В Торговом реестре с 26.03.2015 УНП 790823530</p>
            <p class="c-requis__desc">Свидетельство о государственной регистрации выдано Могилёвским облисполком от 12.04.13</p>
        </div>
    </div>
    
    <div class="c-requis__foot">
        <button class="c-requis__copy c-b-but c-b-but--small">Скопировать</button>
        <span class="c-requis__status">Реквизиты скопированы, <br>можно вставить в документ</span>
    </div>
</div>


<footer class="c-footer">
    <div class="c-footer__item">
        <div class="c-footer__top">
            <div class="c-footer__top-body">
                <div class="c-footer__nav">
                    <ul class="c-footer__nav-blocks">
                        <li class="c-footer__nav-block">
                            <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "footer_menu_1",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "footer_menu_1",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                                    ), false
                            );
                            ?>
                        </li>
                        <li class="c-footer__nav-block">
                            <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_1_1",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_1_1",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                        </li>
                        <li class="c-footer__nav-block">
                           <!--  <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:menu", "footer_menu", array(
                                "ROOT_MENU_TYPE" => "footer_menu_2",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "footer_menu_2",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "footer_menu"
                                    ), false
                            );
                            ?> -->
                            <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_1_2",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_1_2",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                        </li>
                        <li class="c-footer__nav-block">
                           <!--  <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:menu", "footer_menu", array(
                                "ROOT_MENU_TYPE" => "footer_menu_3",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "footer_menu_3",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "footer_menu"
                                    ), false
                            );
                            ?> -->
                            <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_1_3",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_1_3",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "DOUBLE_UL"=>"Y",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?> 
                        </li>
                        <li class="c-footer__nav-block">
                            <!-- <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:menu", "footer_menu", array(
                                "ROOT_MENU_TYPE" => "footer_menu_4",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "footer_menu_4",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "footer_menu"
                                    ), false
                            );
                            ?> -->
                        </li>

                    </ul>

                </div>
            </div>
            <div class="c-footer__top-aside">
                <div class="c-footer__phones">
                    <a class="c-footer__phone c-h4" href="tel: <?= VEL_CODE_2 ?> <?= VEL_PHONE ?>"><?= VEL_CODE_2 ?> <?= VEL_PHONE ?></a>
                    <a class="c-footer__phone c-h4" href="tel: <?= MTS_CODE_2 ?> <?= MTS_PHONE ?>"><?= MTS_CODE_2 ?> <?= MTS_PHONE ?></a>
                    <span class="c-footer__phones-caption c-p4 c-p4--small">в будни с 10 до 18</span>
                </div>
                <p class="c-footer__cards c-p4 c-p4--small">Принимаем карты Visa, «Белкарт», MasterCard и&nbsp;по&nbsp;системе «Расчёт»</p> 
            </div>
        </div>
    </div>


    <?
    $APPLICATION->IncludeComponent(
            "bitrix:main.include", "", Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/footer_bottom.php"
            )
    );
    ?>
    <script>
        $(document).keypress(function (e) {
            if (e.which == 13) {
                if (document.activeElement.tagName != "TEXTAREA") {
                    e.preventDefault();
                }
                ;
            }
        })
    </script>
</footer>

<? if ($APPLICATION->GetCurPage() == "/search/" || $APPLICATION->GetCurPage() == "/thanks/") { ?>
    </div>
<? } ?>

<script src="/bitrix/templates/steelline/script/menu.js"></script>
<script src="/bitrix/templates/steelline/script/modal-requis.js"></script>


<? if ($APPLICATION->GetCurPage() == "/test/haski/" || $APPLICATION->GetCurPage() == "/haski/" ) { ?>

    <script src="/bitrix/templates/steelline/script/TweenMax.min.js"></script>
    <script src="/bitrix/templates/steelline/script/ScrollMagic.min.js"></script>
    <script src="/bitrix/templates/steelline/script/animation.gsap.min.js"></script>

    <script src="/bitrix/templates/steelline/script/svg4everybody.min.js"></script>
    <script src="/bitrix/templates/steelline/script/popper.min.js"></script>
    <script src="/bitrix/templates/steelline/script/tooltip.min.js"></script>
    
    <script>
        (function() {
            svg4everybody();

            //* Tooltips with "PopperJS" + "TooltipJS" *
            //==========================================
            Array.prototype.forEach.call(document.querySelectorAll('.tooltipjs'), function(item) {
                new Tooltip(item, {
                    title: '<span class="tooltip-title c-p3 c-p3--small bold">' + item.getAttribute('data-title') + '</span>' +
                                   '<p class="c-p3 c-p3--small">' + item.getAttribute('data-text') + '</p>',
                    delay: { show: 100, hide: 100 },
                    // trigger: 'click',
                    html: true,
                    placement: 'top-start',
                    offset: '10px, 3px',
                })
          
            })
          
            
            //* Animations with "GSAP" + "ScrollMagic" *
            //==========================================
            var controller = new ScrollMagic.Controller();
          
            //* Scene #1
            //==========
            var scene1 = new TimelineMax()
                        .to('.haski-doorsfly', 1, {y: 20, ease: Linear.easeNone});
          
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, duration: 1650})
                        .setPin('.haski-doorsfly')
                        .setTween(scene1)
                        .addTo(controller);

            var sceneWeight = new TimelineLite()
                        .to('.haski-doorsfly__weight', .25, {opacity: 1, ease: Linear.easeNone})
                        .to('.haski-doorsfly__weight', .25, {opacity: 0, ease: Linear.easeNone}, "+=0.5");
          
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 230, duration: 460})
                        .setTween(sceneWeight)
                        .addTo(controller);
                        
          
            //* Scene #2
            //==========
            var scene2 = new TimelineMax().to('.haski-doorsfly', 1, {scale: 1.52, y: "-=20", ease: Linear.easeNone});
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 1560, duration: 450})
                        .setTween(scene2)
                        .addTo(controller);
          
          
            //* Scene #3
            //==========
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 2250, duration: 1010})
                        .setPin('.haski-doorsfly')
                        .addTo(controller);
          
          
            var sceneUndreline = new TimelineLite()
                        .to('.haski-doorsfly__underline', .1, {opacity: 1, ease: Linear.easeNone})
                        .to('.haski-doorsfly__underline', .1, {opacity: 0, ease: Linear.easeNone}, "+=.8");
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 2280, duration: 1350})
                        .setTween(sceneUndreline)
                        .addTo(controller);
          
            //* Scene #4
            //==========
            var scene4 = new TimelineLite().to('.haski-doorsfly', 1, {scale: 1, y: '+=940', ease: Linear.easeNone});
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 3260, duration: 300})
                        .setTween(scene4)
                        .addTo(controller);
          
            //* Scene #5
            //==========
            var scene5 = TweenMax.to('.haski-doorsfly', 1, {y: "+=20", ease: Linear.easeNone});
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 3560, duration: 951})
                        .setTween(scene5)
                        .setPin('.haski-doorsfly')
                        .addTo(controller);
          
            var sceneGlas = new TimelineLite().to('.haski-doorsfly__glas', 1, {opacity: 1, ease: Linear.easeNone});
          
            new ScrollMagic.Scene({triggerElement: '.haski-doorsfly', triggerHook: .03, offset: 3920, duration: 100})
                        .setTween(sceneGlas)
                        .addTo(controller);
          
        })();
    </script>
<? } ?>


<script>
            (function () {
                new Menu({
                    activeBut: document.querySelector('.c-header__menu'),
                    closeBut: document.querySelector('.c-mega-menu__exit'),
                    menu: document.querySelector('.c-mega-menu'),
                    closeBody: true,
                    escBut: 27
                })

                new ModalRequis({
                    openBut: document.querySelector('.c-requis__active'),
                    requis: document.querySelector('.c-requis'),
                    copyBut: document.querySelector('.c-requis__copy'),
                    status: document.querySelector('.c-requis__status'),
                    closeBut: document.querySelector('.c-requis__exit'),
                    copyItem: document.querySelector('.c-requis__main'),
                    escBut: 27
                })

                document.addEventListener('keydown', function(e) {
                    if (e.keyCode === 27) {

                        // setTimeout(function() {
                            var x = document.querySelector('.b24-widget-button-shadow.b24-widget-button-hide');

                            // console.log(x, 'esc');

                            if (x) x.style.display = 'none';
                        // }, 1000);
                        
                    }
                })

                $('.c-nav__link, .c-link-list__link, .c-mega-menu__links-link, .c-logo, .c-header__action-link').on('click', function(e) {
                    if (this.classList.contains('pd-link-dis')) e.preventDefault();
                })

                // var html = document.querySelector('html');
                // if (html.classList.contains('mobile') || html.classList.contains('tablet')) {
                //     html.style.minHeight = window.innerHeight + 'px';
                // }
            })();

            


</script>



<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/954154350/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>
<? include($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . "/mailru.php"); ?>

<script async src="//call-tracking.by/scripts/calltracking.js?36f8bf73-0cfe-47ba-8a0d-cd93295b1f54"></script>

<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 954154350;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script data-skip-moving="true">
    (function (w, d, u, b) {
        s = d.createElement('script');
        r = (Date.now() / 1000 | 0);
        s.async = 1;
        s.src = u + '?' + r;
        h = d.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(s, h);
    })(window, document, 'https://cdn.bitrix24.by/b2818989/crm/site_button/loader_4_blu95b.js');
</script>
</body>
</html>
<?
if (filter_input(INPUT_GET, "TAGS")) {
    $APPLICATION->SetTitle($APPLICATION->GetTitle() . " - " . filter_input(INPUT_GET, "TAGS"));
    $APPLICATION->SetPageProperty("title", $APPLICATION->GetTitle());
    $APPLICATION->SetPageProperty("description", $APPLICATION->GetTitle() . " в Минске. Мы заботимся о наших клиентах - Стальная Линия.");
    $APPLICATION->SetPageProperty("keywords", $APPLICATION->GetTitle());
}
?>
<?
if ($MY_SEO) {
    $replace = ["{MY_PRICE}", "{MY_FOR}", "{MY_THICKNESS}", "{MY_CLASS}"];
    $replacement = [$MY_SEO["MY_PRICE"], $MY_SEO["MY_FOR"], $MY_SEO["MY_THICKNESS"], $MY_SEO["MY_CLASS"]];
    //$title = $APPLICATION->GetTitle();
    $title = str_replace($replace, $replacement, $APPLICATION->getPageProperty("title"));
    $description = str_replace($replace, $replacement, $APPLICATION->getPageProperty("description"));
    $keywords = str_replace($replace, $replacement, $APPLICATION->getPageProperty("keywords"));
    $APPLICATION->SetPageProperty("title", $title);
    $APPLICATION->SetPageProperty("description", $description);
    $APPLICATION->SetPageProperty("keywords", $keywords);
}
?>