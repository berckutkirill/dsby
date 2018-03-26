<?php
$MATERIALS = ["9e4096b85691a8d93db2792aebf27040" => 13, "552c54dabe2a5e5c7b99f0fd9060ca42" => 11, "0ae9b1898c81cc7e8ce0b05d25f789d3" => 12, "633e3810e88b966bcee996a37298b26f" => 14];
?>
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
            $MATERIALID = $MATERIALS[$val];
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", ".default", array(
                "AREA_FILE_SHOW" => "file",
                "DATA_TAB" => $k,
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                'PRICES' => $arParams["PRICES"]['LOCKS'][$MATERIALID],
                'HAND_PRICE' => $arParams["PRICES"]['HANDS'],
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "/include/properties/locks/$val.php"
                    ), false
            );
        }
        ?>
    </div>
    <div class="bottom"></div>  
</div>
