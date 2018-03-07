<?php ?>

<div class = "tabs__controls">
    <ul class = "c-tabs__controls-list">
        <?php foreach ($arParams["TABS"]["VALUE"] as $k => $val) { ?>
            <li class = "c-tabs__controls-item <?= !$k ? "c-tabs__controls-item--active" : "" ?> ">
                <span class = "c-tabs__control"><?= $val ?></span>
            </li>
        <?php } ?>
    </ul>
</div>


<div class="c-tabs__body">
    <ul class="c-tabs__list">
        <?php foreach ($arParams["TABS"]["VALUE_XML_ID"] as $k => $val) { ?>          
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", ".default", array(
                "AREA_FILE_SHOW" => "file",
                "DATA_TAB" => $k,
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => "/include/properties/locks-concept/$val.php"
                    ), false
            );
            ?>         
        <? }
        ?>
    </ul>
</div>
