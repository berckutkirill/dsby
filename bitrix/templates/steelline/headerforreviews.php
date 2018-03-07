<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
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

//IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");

if (!CModule::IncludeModule("sale"))
    return;

include_once "canonical.php";
?>
<!DOCTYPE html>
<html>
<head lang="ru-RU">
    <link rel="shortcut icon" href="//ds-steelline.by/favicon.png" type="image/png">
    <link rel="icon" href="//ds-steelline.by/favicon.png" type="image/png">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <?
    $APPLICATION->SetAdditionalCSS('//fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,600&amp;subset=latin,cyrillic');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style.css?v=denom');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/style.css');
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/style/css/likely.css');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/jquery-1.11.2.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/coverflow.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/jquery.maskedinput.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/html5.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/device.js');
    $APPLICATION->AddHeadScript('//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/JS.js?v=denom1');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/likely.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/script/jquery.iframetracker.js');
    ?>
    <? if ($canon) { ?>
        <link rel="canonical" href="<?= $canon ?>"/>
    <? } ?>
    <?php echo '<script>var SALOONS = ' . json_encode(explode(",", SALOONS)) . '</script>'; ?>
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
<body class="adaptive">
    <? //include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/yandex.php");?>
    <? //include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH."/den.php");?>



    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
				"COMPONENT_TEMPLATE" => ".default",
					"AREA_FILE_SHOW" => "file",	// Показывать включаемую область
					"PATH" => "/include/header_include.php",// Путь к файлу области
					"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
				),
				false
			);?>

    <header id="header">
        <div class="center">
            <div class="wrap">
                <a href="/" class="logo">
                    <p>стальная линия</p>
                    <? if (is_main()) { ?>
                        <h1>Входные двери</h1>
                    <? } else { ?>
                        <span>Входные двери</span>
                    <? } ?>
                </a>
            </div>
        </div>

    </header>
