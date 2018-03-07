<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
if ($_POST["auth_email"]) {
    if ($_POST["auth_email"]) {
        $arAuthResult = $USER->Login($_POST["auth_email"], $_POST["auth_pass"], "Y");
        if ($USER->isAuthorized()) {
            LocalRedirect("/");
        }
    }
} else {
    $arAuthResult = false;
}
$page = $APPLICATION->GetCurPage(); 
$search = $page == '/search/' ? true : false;
$thank = $page == '/thanks/' ? true : false;
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
$APPLICATION->SetTitle("");

if (!CModule::IncludeModule("sale"))
    return;

    include_once "canonical.php";
    ?><!DOCTYPE html>
    <html class="<?= $search ? "p-pressfoot" : "" ?>">
    <head lang="ru-RU">
        <link rel="shortcut icon" href="https://ds-steelline.by/favicon.png" type="image/png">
        <link rel="icon" href="https://ds-steelline.by/favicon.png" type="image/png">
        <title><? $APPLICATION->ShowTitle() ?></title>
        <meta name="viewport" content="width=1270">
        <meta name="format-detection" content="telephone=no"/>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

        

        <?
            $APPLICATION->SetAdditionalCSS('//fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,600&amp;subset=latin,cyrillic');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style.css?v=denom');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/modal_bootstrap.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/style.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/likely.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/dobory.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/zamki.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/safery.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/multlock.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/gallery.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/new-style.css');  // new styles
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/jquery-1.11.2.min.js');
            // $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/coverflow.js');
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/jquery.maskedinput.js');
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/html5.js');
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/device.js');
            $APPLICATION->AddHeadScript('//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js');
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/JS.js?v=denom1');
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/likely.js');
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/jquery.iframetracker.js');

            if ($page == '/test/haski/' || $page =="/haski/") {
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/popper.css');
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/haski.css');
            }
        ?>

        <!-- PhotoRama -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js" type="text/javascript"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
        <!-- end -->


        <? if ($canon && !isset($_GET["_escaped_fragment_"])) { ?>
        <link rel="canonical" href="<?= $canon ?>"/>
        <? } ?>
        <?php echo '<script>var SALOONS = ' . json_encode(explode(",", SALOONS)) . '</script>'; ?>
        <? if ($page == '/otzyvy/' && !isset($_GET["_escaped_fragment_"])) { ?>
        <meta name="fragment" content="!">
        <? } ?>
        <?
        echo '<meta http-equiv="Content-Type" content="text/html; charset=' . LANG_CHARSET . '"' . (true ? ' /' : '') . '>' . "\n";
        $APPLICATION->ShowMeta("robots", false, true);
        $APPLICATION->ShowMeta("keywords", false, true);
        $APPLICATION->ShowMeta("description", false, true);
        $APPLICATION->ShowCSS(true, true);
        $APPLICATION->ShowHeadStrings();
        $APPLICATION->ShowHeadScripts();
        $APPLICATION->ShowMeta("fragment");
//include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/google.php");
        ?>

        <!-- Facebook Pixel Code 
        <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        
        fbq('init', '1742242706056467');
        fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1742242706056467&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code 
        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=mFjsFDtVaODmK65bo7lH9gCoJ2FeVL8GDvNPF/nzNs2ZE6yk9ZmSp9fAGFq5qAdBy3uaS1IVmgmnExRzeApdBSlPECnzTLV2G**GKYWiIqn1mDViPNEYCBfC718HU8RajpIb8hY7PD68YyiZuqHqiRhXToVZ4wuqUUtQZbafjIQ-';</script>
    -->
</head>
<body class="<?= $search || $thank ? "p-pressfoot" : "" ?>">
    <? //include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/yandex.php"); ?>
    <? //include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/den.php");?>



    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
        <? /*
          $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
          "COMPONENT_TEMPLATE" => ".default",
          "AREA_FILE_SHOW" => "file", // Показывать включаемую область
          "PATH" => "/include/header_include.php", // Путь к файлу области
          "EDIT_TEMPLATE" => "standard.php", // Шаблон области по умолчанию
          ), false
      ); */
      ?>

      <div class="c-mega-menu">
        <div class="c-mega-menu__wrap">
            <div class="c-mega-menu__content">
                <div class="c-mega-menu__side">
                    <div class="c-mega-menu__item">
                        <a class="c-logo <?= is_main() ? "c-logo--dis pd-link-dis" : "" ?>" href="/">
                            <svg class="c-logo__icon" width="70" height="50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 70 50">
                                <g fill="none" fill-rule="evenodd">
                                    <path fill="#fff" d="M5.053 44.89h61.515V4.676H5.053z"></path>
                                    <g>
                                        <mask id="ccccc" fill="#fff">
                                            <path d="M34.827 50h34.826V0H0v50z"></path>
                                        </mask>
                                        <path class="c-logo__icon-p" fill="#006696" d="M58.488 41.28L41.364 12.673 31.298 29.477c-1.504 2.5-4.108 3.895-6.827 3.895-1.388 0-2.777-.349-4.05-1.163-3.76-2.267-4.975-7.15-2.718-10.93a7.896 7.896 0 0 1 10.876-2.732c.057.058.115.058.173.116l-1.041 1.686c-.058-.058-.116-.058-.174-.116-2.834-1.686-6.479-.756-8.157 2.034-1.677 2.85-.752 6.512 2.025 8.198 2.835 1.686 6.48.756 8.157-2.035L41.306 8.78l19.438 32.5h-2.256zm-3.066 0L41.364 17.79l-7.81 13.024c-3.008 5.058-9.488 6.686-14.52 3.605-4.976-3.024-6.596-9.535-3.588-14.593 3.009-5 9.488-6.628 14.521-3.605.058.058.116.058.174.116l-1.042 1.686c-.058-.058-.115-.058-.173-.116-4.05-2.442-9.314-1.105-11.802 2.965-2.43 4.07-1.1 9.36 2.95 11.86 4.05 2.5 9.315 1.105 11.802-2.965l9.488-15.872 16.372 27.326h-2.314v.058zm-3.067 0L41.422 22.964l-5.496 9.244c-3.76 6.28-11.86 8.314-18.108 4.535-6.248-3.779-8.272-11.918-4.512-18.197 3.76-6.28 11.86-8.314 18.107-4.535.058.058.116.058.174.116l-1.041 1.686c-.058-.058-.116-.058-.174-.116-5.322-3.198-12.207-1.512-15.388 3.837-3.182 5.349-1.447 12.267 3.818 15.465 5.322 3.198 12.206 1.453 15.388-3.837l7.232-12.093L54.67 41.28h-2.315zm-3.123 0L41.364 28.08l-3.24 5.466a15.794 15.794 0 0 1-12.9 7.732h-1.447a15.727 15.727 0 0 1-7.405-2.267c-7.52-4.535-9.95-14.303-5.438-21.86 4.512-7.559 14.231-10 21.752-5.466.058.058.116.058.174.116l-1.042 1.686c-.058-.058-.115-.058-.173-.116-6.537-3.953-15.1-1.86-19.033 4.768-3.934 6.627-1.794 15.174 4.743 19.127 6.538 3.954 15.1 1.86 19.034-4.767l4.975-8.314 10.182 17.035h-2.314v.058zM65.198 0H4.455C1.967 0 0 2.035 0 4.535v40.93C0 47.965 2.025 50 4.455 50h60.743c2.488 0 4.455-2.035 4.455-4.535V4.535c0-2.5-1.967-4.535-4.455-4.535z" mask="url(#ccccc)"></path>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>

                    <div class="c-mega-menu__item">
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
                    </div>
                    <div class="c-mega-menu__item">
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
                    </div>
                    <div class="c-mega-menu__item">
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
                    </div>
                    <!-- <div class="c-mega-menu__item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_1_4",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_1_4",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                    </div>       -->            
                    <div class="c-mega-menu__item">
                        <div class="c-mega-menu__exit">
                            <div class="c-link-square c-link-square--exit">
                                <svg class="c-link-square__icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 21 22">
                                    <path class="c-link-square__icon-p" stroke="#006696" fill="#006696" fill-rule="nonzero" stroke-width=".6" d="M20.225 1.724l-.8-.8-9.2 9.2-9.2-9.2-.8.8 9.2 9.2-9.2 9.2.8.8 9.2-9.2 9.2 9.2.8-.8-9.2-9.2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-mega-menu__side">
                    <div class="c-mega-menu__item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_2_1",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_2_1",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                    </div>
                    <div class="c-mega-menu__item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_2_2",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_2_2",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                    </div>
                    <div class="c-mega-menu__item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_2_3",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_2_3",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                    </div>
                    <div class="c-mega-menu__item">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu", "header_mega", array(
                                "ROOT_MENU_TYPE" => "mega_menu_2_4",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "mega_menu_2_4",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                                "COMPONENT_TEMPLATE" => "header_mega"
                            ), false
                        );
                        ?>
                    </div>        
                    <div class="c-mega-menu__item">
                        <div class="c-mega-menu__phones">
                            <a class="c-h4" href="tel: <?= VEL_CODE_2 ?> <?= VEL_PHONE ?>"><?= VEL_CODE_2 ?> <?= VEL_PHONE ?></a>
                            <a class="c-h4" href="tel: <?= MTS_CODE_2 ?> <?= MTS_PHONE ?>"><?= MTS_CODE_2 ?> <?= MTS_PHONE ?></a>                                
                            <p class="c-mega-menu__phones-desc">менеджеры расскажут о&nbsp;дверях и сервисе в&nbsp;будни с 10 до 18</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? if ($search || $thank) { ?>
    <div class="c-pressfoot">
        <? } ?>
        <div class="c-header">
            <div class="c-header__logo"><a class="c-logo <?= is_main() ? "c-logo--dis pd-link-dis" : "" ?> " href="/">
                <svg class="c-logo__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="50" viewBox="0 0 70 50">

                    <g fill="none" fill-rule="evenodd">
                        <path fill="#FFF" d="M5.053 44.89h61.515V4.676H5.053z"></path>
                        <g>
                            <mask id="cccc" fill="#fff">
                                <path d="M34.827 50h34.826V0H0v50z"></path>
                            </mask>
                            <path class="c-logo__icon-p" fill="#006696" d="M58.488 41.28L41.364 12.673 31.298 29.477c-1.504 2.5-4.108 3.895-6.827 3.895-1.388 0-2.777-.349-4.05-1.163-3.76-2.267-4.975-7.15-2.718-10.93a7.896 7.896 0 0 1 10.876-2.732c.057.058.115.058.173.116l-1.041 1.686c-.058-.058-.116-.058-.174-.116-2.834-1.686-6.479-.756-8.157 2.034-1.677 2.85-.752 6.512 2.025 8.198 2.835 1.686 6.48.756 8.157-2.035L41.306 8.78l19.438 32.5h-2.256zm-3.066 0L41.364 17.79l-7.81 13.024c-3.008 5.058-9.488 6.686-14.52 3.605-4.976-3.024-6.596-9.535-3.588-14.593 3.009-5 9.488-6.628 14.521-3.605.058.058.116.058.174.116l-1.042 1.686c-.058-.058-.115-.058-.173-.116-4.05-2.442-9.314-1.105-11.802 2.965-2.43 4.07-1.1 9.36 2.95 11.86 4.05 2.5 9.315 1.105 11.802-2.965l9.488-15.872 16.372 27.326h-2.314v.058zm-3.067 0L41.422 22.964l-5.496 9.244c-3.76 6.28-11.86 8.314-18.108 4.535-6.248-3.779-8.272-11.918-4.512-18.197 3.76-6.28 11.86-8.314 18.107-4.535.058.058.116.058.174.116l-1.041 1.686c-.058-.058-.116-.058-.174-.116-5.322-3.198-12.207-1.512-15.388 3.837-3.182 5.349-1.447 12.267 3.818 15.465 5.322 3.198 12.206 1.453 15.388-3.837l7.232-12.093L54.67 41.28h-2.315zm-3.123 0L41.364 28.08l-3.24 5.466a15.794 15.794 0 0 1-12.9 7.732h-1.447a15.727 15.727 0 0 1-7.405-2.267c-7.52-4.535-9.95-14.303-5.438-21.86 4.512-7.559 14.231-10 21.752-5.466.058.058.116.058.174.116l-1.042 1.686c-.058-.058-.115-.058-.173-.116-6.537-3.953-15.1-1.86-19.033 4.768-3.934 6.627-1.794 15.174 4.743 19.127 6.538 3.954 15.1 1.86 19.034-4.767l4.975-8.314 10.182 17.035h-2.314v.058zM65.198 0H4.455C1.967 0 0 2.035 0 4.535v40.93C0 47.965 2.025 50 4.455 50h60.743c2.488 0 4.455-2.035 4.455-4.535V4.535c0-2.5-1.967-4.535-4.455-4.535z" mask="url(#cccc)"></path>
                        </g>
                    </g>
                </svg>
                <div class="c-logo__body">
                    <svg class="c-logo__title" width="220px" height="17px" viewBox="0 0 220 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="catalog" transform="translate(-197.000000, -24.000000)">
                                <g id="Page-1" transform="translate(115.000000, 16.000000)">
                                    <g id="Group-9" transform="translate(82.000000, 8.000000)">
                                        <path class="c-logo__icon-p" fill="#006695" d="M213.113958,4.14988354 C213.681873,3.7244053 214.533746,3.65349226 214.888693,3.65349226 L215.953534,3.65349226 L215.953534,7.83736164 L214.888693,7.83736164 C214.391767,7.83736164 213.539894,7.7664486 212.971979,7.27005732 C212.475053,6.77366604 212.404064,6.13544867 212.404064,5.70997043 C212.333075,5.21357915 212.475053,4.64627482 213.113958,4.14988354 M210.984276,9.82292677 L207.292828,16.2051004 L211.836149,16.2051004 L214.533746,10.8157093 L215.882544,10.8157093 L215.882544,16.2051004 L219.999929,16.2051004 L219.999929,0.81697064 L215.101661,0.81697064 C211.69417,0.81697064 210.416361,1.59701408 209.919435,1.95157929 C209.138552,2.51888361 208.21569,3.65349226 208.21569,5.85179651 C208.21569,6.77366604 208.357669,7.83736164 209.209541,8.75923117 C209.635478,9.18470941 210.274382,9.61018765 210.984276,9.82292677" id="Fill-4"></path>
                                        <polygon class="c-logo__icon-p" fill="#006695" id="Fill-6" points="196.218482 16.2051004 191.320214 16.2051004 191.320214 0.81697064 195.36661 0.81697064 195.36661 7.4118834 195.224631 11.1702745 195.36661 11.1702745 200.122899 0.81697064 205.021167 0.81697064 205.021167 16.2051004 200.974772 16.2051004 200.974772 9.61018765 201.045761 5.78088347 200.974772 5.78088347"></polygon>
                                        <polygon class="c-logo__icon-p" fill="#006695" id="Fill-8" points="177.90329 16.2051004 173.785905 16.2051004 173.785905 0.81697064 177.90329 0.81697064 177.90329 6.702753 182.730569 6.702753 182.730569 0.81697064 186.847954 0.81697064 186.847954 16.2051004 182.730569 16.2051004 182.730569 9.61018765 177.90329 9.61018765"></polygon>
                                        <polygon class="c-logo__icon-p" fill="#006695" id="Fill-10" points="160.510889 16.2051004 155.541631 16.2051004 155.541631 0.81697064 159.659016 0.81697064 159.659016 7.4118834 159.517037 11.1702745 159.659016 11.1702745 164.415306 0.81697064 169.313574 0.81697064 169.313574 16.2051004 165.267178 16.2051004 165.267178 9.61018765 165.338168 5.78088347 165.267178 5.78088347"></polygon>
                                        <path class="c-logo__icon-p" fill="#006695" d="M138.14923,16.3469265 C137.652305,16.3469265 137.0134,16.2760135 136.445485,16.2051004 L136.445485,13.0140136 C136.658453,13.0849266 137.0134,13.1558397 137.297358,13.1558397 C137.723294,13.1558397 138.14923,13.0140136 138.504177,12.7303614 C138.930114,12.3757962 139.001103,11.950318 139.143082,11.3830137 C139.35605,10.248405 139.35605,9.32653549 139.427039,8.1210138 C139.498029,5.56814435 139.498029,4.57536178 139.498029,3.58257922 L139.498029,0.81697064 L151.140289,0.81697064 L151.140289,16.2051004 L147.022904,16.2051004 L147.022904,3.7244053 L143.260467,3.7244053 L143.260467,5.56814435 C143.260467,6.77366604 143.189477,9.04288333 143.118488,10.6029702 C142.976509,12.2339701 142.763541,14.0067962 141.769689,15.0704918 C140.988806,15.8505352 139.710997,16.3469265 138.14923,16.3469265" id="Fill-12"></path>
                                        <path class="c-logo__icon-p" fill="#006695" d="M120.472801,4.14988354 C121.040716,3.7244053 121.892588,3.65349226 122.247535,3.65349226 L123.312376,3.65349226 L123.312376,7.83736164 L122.247535,7.83736164 C121.75061,7.83736164 120.898737,7.7664486 120.330822,7.27005732 C119.833896,6.77366604 119.762907,6.13544867 119.762907,5.70997043 C119.691917,5.21357915 119.833896,4.64627482 120.472801,4.14988354 M118.414108,9.82292677 L114.72266,16.2051004 L119.265981,16.2051004 L121.963578,10.8157093 L123.312376,10.8157093 L123.312376,16.2051004 L127.429761,16.2051004 L127.429761,0.81697064 L122.531493,0.81697064 C119.124002,0.81697064 117.846193,1.59701408 117.349267,1.95157929 C116.568384,2.51888361 115.645522,3.65349226 115.645522,5.85179651 C115.645522,6.77366604 115.787501,7.83736164 116.639373,8.75923117 C116.99432,9.18470941 117.633225,9.61018765 118.414108,9.82292677" id="Fill-14"></path>
                                        <path class="c-logo__icon-p" fill="#006695" d="M104.713155,3.93714442 L104.713155,3.93714442 L106.55888,9.96475286 L102.725452,9.96475286 L104.713155,3.93714442 Z M100.524781,16.2051004 L101.731601,12.9431006 L107.481742,12.9431006 L108.617572,16.2051004 L113.089904,16.2051004 L107.197784,0.81697064 L102.157537,0.81697064 L96.336407,16.2051004 L100.524781,16.2051004 Z" id="Fill-16"></path>
                                        <polygon class="c-logo__icon-p" fill="#006695" id="Fill-18" points="85.0490936 16.2051004 81.0026982 16.2051004 81.0026982 0.81697064 85.0490936 0.81697064 85.0490936 6.702753 89.9473617 6.702753 89.9473617 0.81697064 93.993757 0.81697064 93.993757 16.2051004 89.9473617 16.2051004 89.9473617 9.61018765 85.0490936 9.61018765"></polygon>
                                        <path class="c-logo__icon-p" fill="#006695" d="M69.4314272,9.46836157 L70.7802256,9.46836157 C71.2771514,9.46836157 72.1290241,9.46836157 72.6969392,9.82292677 C73.193865,10.177492 73.4778226,10.6738833 73.4778226,11.3121006 C73.4778226,12.1630571 73.1228756,12.5885354 72.838918,12.8012745 C72.2000135,13.2976658 71.1351726,13.2976658 70.5672575,13.2976658 L69.4314272,13.2976658 L69.4314272,9.46836157 Z M71.6320984,16.2051004 C72.6969392,16.2051004 74.4716741,16.1341874 75.8914619,15.0704918 C77.0272922,14.2195353 77.5952073,13.0140136 77.5952073,11.4539267 C77.5952073,9.53927461 76.814324,8.33375293 76.1044301,7.69553556 C74.6846422,6.49001387 72.5549605,6.56092691 71.3481408,6.56092691 L69.5024166,6.56092691 L69.5024166,0.81697064 L65.3850318,0.81697064 L65.3850318,16.2051004 L71.6320984,16.2051004 Z" id="Fill-20"></path>
                                        <path class="c-logo__icon-p" fill="#006695" d="M47.9216412,16.3469265 C47.4247155,16.3469265 46.7858109,16.2760135 46.2178958,16.2051004 L46.2178958,13.0140136 C46.430864,13.0849266 46.7858109,13.1558397 47.0697685,13.1558397 C47.4957048,13.1558397 47.9216412,13.0140136 48.2765882,12.7303614 C48.7025245,12.3757962 48.7735139,11.950318 48.9154927,11.3830137 C49.1284609,10.248405 49.1284609,9.32653549 49.1994503,8.1210138 C49.2704397,5.56814435 49.3414291,4.57536178 49.3414291,3.58257922 L49.3414291,0.81697064 L60.9836895,0.81697064 L60.9836895,16.2051004 L56.8663047,16.2051004 L56.8663047,3.7244053 L53.1038669,3.7244053 L53.1038669,5.56814435 C53.1038669,6.77366604 53.0328775,9.04288333 52.8908987,10.6029702 C52.7489199,12.2339701 52.5359517,14.0067962 51.5421002,15.0704918 C50.7612169,15.8505352 49.4834078,16.3469265 47.9216412,16.3469265" id="Fill-22"></path>
                                        <path class="c-logo__icon-p" fill="#006695" d="M36.137402,3.93714442 L36.137402,3.93714442 L37.9831262,9.96475286 L34.149699,9.96475286 L36.137402,3.93714442 Z M32.0200172,16.2051004 L33.2268369,12.9431006 L38.9769777,12.9431006 L40.112808,16.2051004 L44.5851397,16.2051004 L38.6930202,0.81697064 L33.6527733,0.81697064 L27.8316431,16.2051004 L32.0200172,16.2051004 Z" id="Fill-24"></path>
                                        <polygon class="c-logo__icon-p" fill="#006695" id="Fill-26" points="20.0937993 3.86623138 16.3313615 3.86623138 16.3313615 0.81697064 27.9736219 0.81697064 27.9736219 3.86623138 24.2111841 3.86623138 24.2111841 16.2051004 20.0937993 16.2051004"></polygon>
                                        <path class="c-logo__icon-p" fill="#006695" d="M0.500726908,8.54649205 C0.500726908,5.85179651 1.5655678,3.7244053 3.12733444,2.44797057 C4.61811168,1.24244888 6.81878285,0.604231518 9.3034116,0.604231518 C10.1552843,0.604231518 11.7170509,0.675144559 13.8467327,1.38427496 L13.4917858,4.71718786 C12.5689237,4.22079658 11.0781464,3.65349226 9.51637978,3.65349226 C7.88362374,3.65349226 6.74779346,4.29170962 6.10888893,5.00084003 C5.32800561,5.78088347 4.68910107,7.0573182 4.68910107,8.68831813 C4.68910107,10.177492 5.25701622,11.4539267 6.10888893,12.2339701 C6.96076164,13.0849266 8.45153889,13.5104049 9.87132674,13.5104049 C11.007157,13.5104049 12.4269449,13.2267527 13.7047539,12.7303614 L13.9177221,15.9214483 C12.2849661,16.3469265 11.0781464,16.5596656 9.58736917,16.5596656 C3.26931322,16.4178395 0.500726908,13.0140136 0.500726908,8.54649205" id="Fill-28"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg><span class="c-logo__caption">Входные двери в Минске</span>
                </div></a></div>
                <div class="c-header__nav">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu", "header_up", array(
                            "ROOT_MENU_TYPE" => "main_header_menu",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "main_header_menu",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "COMPONENT_TEMPLATE" => "header_up"
                        ), false
                    );
                    ?>            
                </div>

                <div class="c-header__right">
                    <a class="c-header__search" <?= $search ? "" : 'href = "/search/"' ?>>
                        <span class="c-link-square c-link-square--<?= $search ? "exit" : "search" ?>">
                            <? if ($search) { ?>
                            <svg class="c-link-square__icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 21 22">
                                <path class="c-link-square__icon-p" stroke="#006696" fill="#006696" fill-rule="nonzero" stroke-width=".6" d="M20.225 1.724l-.8-.8-9.2 9.2-9.2-9.2-.8.8 9.2 9.2-9.2 9.2.8.8 9.2-9.2 9.2 9.2.8-.8-9.2-9.2z"></path>
                            </svg>
                            <? } else { ?>
                            <svg class="c-link-square__icon" xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21">
                                <path class="c-link-square__icon-p" fill="#006696" fill-rule="nonzero" d="M19.823 21l-5.649-5.649a8.643 8.643 0 0 1-5.51 1.978 8.607 8.607 0 0 1-6.126-2.538A8.608 8.608 0 0 1 0 8.665c0-2.315.901-4.49 2.538-6.127A8.606 8.606 0 0 1 8.665 0a8.61 8.61 0 0 1 6.127 2.538 8.668 8.668 0 0 1 .56 11.636L21 19.824 19.823 21zM8.664 1.665c-1.869 0-3.627.728-4.949 2.05a6.954 6.954 0 0 0-2.05 4.95c0 1.87.728 3.627 2.05 4.95a6.954 6.954 0 0 0 4.95 2.05c1.869 0 3.627-.728 4.95-2.05a7.009 7.009 0 0 0 0-9.9 6.956 6.956 0 0 0-4.95-2.05z"></path>
                            </svg>
                            <? } ?>
                        </span>
                    </a>
                    <div class="c-header__menu"><span class="c-ps-link c-ps-link--ell">Доставка, установка,<br>гарантия, и прочее…</span></div>
                </div>
            </div>

            <div class="holiday_modal_bg holiday_popup_bg">
                <div class="modal_content holiday_popup">
                    <span class="modal_close">&#xe900;</span>
                    <p class="holiday_popup_term">с 31 декабря по 7 января</p>
                    <h2 class="holiday_popup_title">Скидка&nbsp;10% на&nbsp;входную&nbsp;дверь</h2>
                    <p class="holiday_popup_text">Салоны &laquo;Стальная линия&raquo; уходят на&nbsp;новогодние каникулы. Оформите заказ на&nbsp;сайте и&nbsp;получите скидку на&nbsp;входную дверь.</p>
                    <a href="/poleznaya-informaciya/s_31_dekabrya_po_7_yanvarya_novogodnie_kanikuly_i_skidki.html" class="button holiday_popup_button">Узнать подробности</a>
                </div>
                <script>
                    window.addEventListener("unload", function() {
                        var timeLeft = Date.now();
                        var enter_q = localStorage.getItem("enter_q") || 0;
                        if(enter_q > 0) {
                            enter_q--;
                        }
                        localStorage.setItem("enter_q", enter_q);
                        localStorage.setItem('timeLeft', timeLeft)
                    });
                    window.addEventListener("load", function () {
                        var enter_q = localStorage.getItem("enter_q") || 0;
                        if(enter_q > 0) {
                            enter_q++;
                        }
                        localStorage.setItem("enter_q", enter_q);


                        var today = new Date();
                        var firstDay = new Date(2017, 11, 29, 10, 00, 01, 0);
                        var lastDay = new Date(2018, 0, 7, 23, 59, 59, 0);
                        var time_first_enter = sessionStorage.getItem("time_first_enter") || today.getTime();
                        var time_left = localStorage.getItem("timeLeft") || 0;
                        
                        var time_enter = today.getTime();
                        if (localStorage.getItem("enter_q") == 0 && time_enter - time_left > 30000) {
                            if (today >= firstDay && today <= lastDay) {
                                $(".holiday_modal_bg.holiday_popup_bg").addClass("shown");
                                localStorage.setItem("enter_q", '1');
                            } else {
                                $(".holiday_modal_bg.holiday_popup_bg").removeClass("shown");
                            }
                        }
                    });
                    $(".holiday_modal_bg, .modal_close").on("click", function () {
                        $(".holiday_modal_bg").fadeOut(300);
                    });
                    $(document).keydown(function (e) {
                        if (e.keyCode === 27) {
                            $(".holiday_modal_bg").fadeOut(300);
                        }
                    });
                    $(".modal").click(function (event) {
                        event.stopPropagation();
                    })
                </script>
            </div>

