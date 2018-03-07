<?php ?>
<div class="tabs_block js_tabs_block dp-furn-wrap">
    <div class="top">
        <div class="wrap new">
            <p class="h2">Фурнитура под заказ</p>
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
