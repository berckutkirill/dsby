<?php
/**
* LOCK_STANDART
* LOCK_OPTIMA
* LOCK_PROFI
* LOCK_PREMIUM
* LOCK_RUCHKI
**/

//$on_share = LOCK_PROFI;
?>
<div class="tabs_block js_tabs_block">
    <div class="top">
        <div class="wrap new">
            <p class="h2">Замки и фурнитура под заказ</p>
            <?php if($arParams["SECTION_ID"] == 45 || $arParams["SECTION_ID"] == 50) {;?>
					<p class="text">Специалисты завода &laquo;Стальная линия&raquo; установят один из&nbsp;шести комплектов замков в&nbsp;вашу входную дверь. Смотрите <a target="_blank" onclick="gaRequest('презентация замков'); return true;" href="http://steelline.by/product/zamki/" class="link">презентацию</a> шести уровней защиты на&nbsp;официальном сайте производителя.</p>
            	<?php };?>
            <ul class="control js_control clearfix">
                <?php foreach ($arParams["TABS"]["VALUE"] as $k => $val) { ?>
                    <li 
                        <?php
                        if (!$k) {
                            echo "class='active'";
                        }
                        ?>
                            data-tab="<?php echo $k; ?>">
                            <span>
                                <?php echo $val; ?>
                                <?php if($arParams["TABS"]["VALUE_XML_ID"][$k] == $on_share) {  ?>
                                    <i class="red">на скидке</i>
                                <?php } ?>
                            </span>
                    </li>
                    <?php } ?>
            </ul>
        </div>
    </div>
    <div class="middle js_screen wrap new clearfix">

        <?php
        foreach ($arParams["TABS"]["VALUE_XML_ID"] as $k => $val) {
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", ".default", array(
                "AREA_FILE_SHOW" => "file",
                "DATA_TAB" => $k,
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "/include/properties/locks/$val.php"
                    ), false
            );
        }
        ?>
    </div>
    <div class="bottom"></div>
</div>