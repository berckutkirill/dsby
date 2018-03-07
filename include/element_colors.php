<div class="tabs_block js_tabs_block">
        <div class="top">
            <div class="wrap new">
                <p class="h2">Цветовые исполнения под заказ</p>
                <ul class="control js_control clearfix">
                    <?php foreach($arParams["TABS"]["VALUE"] as $k => $val) { ?>
                    <li 
                        <?php 
                        if(!$k) {
                            echo "class='active'";
                        }
                        ?>
                         data-tab="<?php echo $k; ?>"><span><?php echo $val; ?></span></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="middle js_screen wrap new">
            <?php foreach($arParams["TABS"]["VALUE_XML_ID"] as $k => $val) { 
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", ".default", array(
                    "AREA_FILE_SHOW" => "file",
                    "DATA_TAB" => $k,
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/properties/colors/$val.php"
                    ), false
                );
            } ?>
            
        </div>
        <div class="bottom"></div>
    </div>