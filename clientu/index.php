<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Информация для клиента компании ООО “Дверной сезон”, что важно знать при покупки двери Стальная Линия.");
$APPLICATION->SetPageProperty("keywords", "Входные двери, металлические двери, двери в Минске, цена, Стальная Линия");
$APPLICATION->SetPageProperty("title", "Клиенту");
$APPLICATION->SetTitle("Клиенту компании ООО “Дверной сезон”");
?>
<div class="wrap">
    <?
    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
            ), false
    );
    ?>
</div>

<div class="p-clientinfo">
    <div class="c-wrapper">

        <section class="p-clientinfo__hero p-clientinfo__sect">          
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/clientu/info.php"
                    )
            );
            ?>
        </section>

        <section class="p-clientinfo__ser p-clientinfo__sect">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/clientu/services.php"
                    )
            );
            ?>
        </section>

        <section class="p-clientinfo__sale p-clientinfo__sect">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/clientu/sales.php"
                    )
            );
            ?>
        </section>

        <section class="p-clientinfo__gar p-clientinfo__sect">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/clientu/garanty.php"
                    )
            );
            ?>
        </section>

        <section class="p-clientinfo__serv">
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/clientu/servi-.php"
                    )
            );
            ?>
        </section>

        <section class="p-clientinfo__doc">
            <h2 class="c-h2 p-clientinfo__doc-title">Документация</h2>         
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/documentation.php"
                    )
            );
            ?>
        </section>

        <section class="p-clientinfo__sert">
            <h3 class="c-h4 p-clientinfo__sert-title">Сертификаты соответствия:</h3>          
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/sertifications_sootvetstviya.php"
                    )
            );
            ?>
        </section>    

    </div>
</div>

<div class="modal-img">
    <svg width="20px" height="19px" viewBox="0 0 20 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <polygon points="17.7927902 0.000119994604 12.5385693 5.27371141 12.5385693 1.54942175 10.6529399 1.54942175 10.6529399 6.54633989 10.6529399 8.23483539 12.5126848 8.23483539 17.5097744 8.23483539 17.5097744 6.52062676 13.7853133 6.52062676 19.0525621 1.26623449"></polygon>
        <polygon points="6.53987733 10.6595224 1.54278776 10.6595224 1.54278776 12.373731 5.26707742 12.373731 0 17.6327517 1.25977192 18.9016089 6.51399278 13.6304174 6.51399278 17.5163569 8.39962227 17.5163569 8.39962227 12.3576175 8.39962227 10.6595224"></polygon>
    </svg>
</div>

<script src="<?= SITE_TEMPLATE_PATH ?>/script/menu.js" type="text/javascript"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/script/modal-img.js" type="text/javascript"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/script/svg4everybody.min.js" type="text/javascript"></script>
<script>
    (function () {
        svg4everybody();

        new ModalImg({
            activeBut: document.querySelectorAll('.modal-img-active'),
            closeBut: document.querySelector('.modal-img svg'),
            imgPopup: document.querySelector('.modal-img'),
            closeBody: true,
            escBut: 27
        })

    })()
</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>