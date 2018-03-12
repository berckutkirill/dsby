<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Политика скидок входных дверей Стальная Линия.");
$APPLICATION->SetPageProperty("keywords", "Политика скидок");
$APPLICATION->SetPageProperty("title", "Политика скидок");
?>
<div class="wrap">
    <?
    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
            ), false
    );
    ?>
</div>
<div class="p-sales">
    <div class="c-wrapper">
        <section class="p-sales__hero">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/politika_skidok/head.php"
                    )
            );
            ?>
        </section>
        <section class="p-sales__soc">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/politika_skidok/social-sales.php"
                    )
            );
            ?>
        </section>
        <section class="p-sales__bl p-sales__compl">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/politika_skidok/complex-sales.php"
                    )
            );
            ?>
        </section>
    </div>
    <section class="p-sales__pile scrollerTo">       
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", "", Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/politika_skidok/work-programm.php"
                )
        );
        ?>
    </section>
    <script>
        $(function () {
            $('.scroller').on('click', function () {
                $('html, body').animate({scrollTop: $(".scrollerTo").offset().top - 50}, 250)
            })
        })
    </script>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>