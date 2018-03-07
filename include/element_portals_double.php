<div class="portals wrap new clearfix">
    <div class="fll info">
        <p class="h2">Порталы<br> и наличники<br> под заказ</p>
        <p class="text">Декоративное обрамление проёма создаёт завершённый образ двери. Наличники и&nbsp;порталы сочетаются с&nbsp;оформлением панелей, созданных по&nbsp;технологиям SteelTex или SteelLak</p>
        <div class="fact">
            <p>Цвет элементов <br>подбирается <br>в соответствии <br>с отделкой <br>двери</p>
        </div>
    </div>
    <div class="flr clearfix ports">
        <div class="left fll">
            <?php
            if (!in_array(PORTAL_LOGO, $arParams["TABS"]["VALUE_XML_ID"])) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }
            ?>
            <div class="port <?php echo $disabled ?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/portal1.jpg" alt="">
                <p class="name">Портал «Лого»</p>

            </div>

            <?php
            if (!in_array(PORTAL_NICE, $arParams["TABS"]["VALUE_XML_ID"])) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }
            ?>
            <div class="port <?php echo $disabled ?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/portal2.jpg" alt="">
                <p class="name">Портал «Найс»</p>
    
            </div>

            <?php
            if (!in_array(PORTAL_VISANTIYA, $arParams["TABS"]["VALUE_XML_ID"])) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }
            ?>
            <div class="port <?php echo $disabled ?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/portal3.jpg" alt="">
                <p class="name">Портал «Византия»</p>

            </div>
            <?php
            if (!in_array(PORTAL_ARKA, $arParams["TABS"]["VALUE_XML_ID"])) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }
            ?>
            <div class="port <?php echo $disabled ?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/portal4.jpg" alt="">
                <p class="name">Портал «Арка»</p>

            </div>

        </div>
        <div class="right flr">
            <?php
            if (!in_array(PORTAL_KATRIN, $arParams["TABS"]["VALUE_XML_ID"])) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }
            ?>
            <div class="port <?php echo $disabled ?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/portal5.jpg" alt="">
                <p class="name">Наличник «Катрин»</p>

            </div>

            <?php
            if (!in_array(PORTAL_POLO, $arParams["TABS"]["VALUE_XML_ID"])) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }
            ?>
            <div class="port <?php echo $disabled ?>">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/portal6.jpg" alt="">
                <p class="name">Наличник «Поло»</p>

            </div>

        </div>
    </div>
</div>