<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>
<?

$count_action = 0;
$action = false;
if (!empty($arResult)):
    ?>
    <ul class="c-mega-menu__links <?= $arParams["DOUBLE_UL"]=="Y" ? "c-mega-menu__links-double" : "";?>">
        <?
        foreach ($arResult["ITEMS"] as $arItem) {
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            $arItem["LINK"] = str_replace("index.php", "", $arItem["LINK"]);
            if ($arItem["PARAMS"]["menu"] == "action") {
                $action = true;
            }
            ?>
            <? if ($arItem["SELECTED"]) { ?>
                <li class="c-mega-menu__links-item <?= $arItem["PARAMS"]["class"] ?> <?= $arItem["PARAMS"]["class_2"] ?>">
                    <a href="<?= $arItem["LINK"] ?>" class="c-mega-menu__links-link c-mega-menu__links-link--dis pd-link-dis">
                        <span class="c-link <?= $arItem["PARAMS"]["action"] == "yes" ? "c-link--green" : "" ?> c-link--disabled"><?= $arItem["TEXT"] ?></span><? if ($arItem["PARAMS"]["quotes"] == "yes") { ?><span class="c-link c-link--notdecor c-link--disabled">»</span><? } ?>
                        <? if ($arItem["PARAMS"]["icon"] == "map") { ?>
                            <svg class="c-mega-menu__card-svg" xmlns="http://www.w3.org/2000/svg" width="11" height="15" viewBox="0 0 11 15">
                                <path fill="#006695" fill-rule="evenodd" d="M5.403 15C3.813 12.521 0 8.326 0 5.403A5.398 5.398 0 0 1 5.403 0c3.05 0 5.466 2.415 5.466 5.403 0 2.923-3.814 7.118-5.466 9.597zm0-12.267c1.525 0 2.733 1.208 2.733 2.67a2.713 2.713 0 0 1-2.733 2.733c-1.462 0-2.67-1.208-2.67-2.733a2.686 2.686 0 0 1 2.67-2.67z"></path>
                            </svg>
                        <? } ?>                      
                    </a>
                    <? if (!empty($arItem["CHILD"])) { ?>   
                        <ul class="c-mega-menu__links">
                            <? foreach ($arItem["CHILD"] as $child) {
                                ?>
                                <li><a class="c-link-block <?= $child["SELECTED"] ? "pd-link-dis" : "" ?>" href="<?= $child["LINK"] ?>">
                                        <span class="c-link <?= $child["SELECTED"] ? "c-link--disabled" : "" ?>"><?= $child["TEXT"] ?></span><? if ($child["PARAMS"]["quotes"] == "yes") { ?><span class="c-link c-link--notdecor  <?= $child["SELECTED"] ? "c-link--disabled" : "" ?>">»</span><? } ?>                                                
                                    </a></li>
                            <? } ?>
                        </ul>      
                    <? } ?>
                </li>     
            <? } else { ?>
                <li class="c-mega-menu__links-item  <?= $arItem["PARAMS"]["class"] ?> <?= $arItem["PARAMS"]["class_2"] ?>"><a class="c-link-block c-mega-menu__links-link" href="<?= $arItem["LINK"] ?>">
                        <span class="c-link <?= $arItem["PARAMS"]["action"] == "yes" ? "c-link--green" : "" ?>"><?= $arItem["TEXT"] ?></span><? if ($arItem["PARAMS"]["quotes"] == "yes") { ?><span class="c-link c-link--notdecor">»</span><? } ?>
                        <? if ($arItem["PARAMS"]["icon"] == "map") { ?>
                            <svg class="c-mega-menu__card-svg" xmlns="http://www.w3.org/2000/svg" width="11" height="15" viewBox="0 0 11 15">
                                <path fill="#006695" fill-rule="evenodd" d="M5.403 15C3.813 12.521 0 8.326 0 5.403A5.398 5.398 0 0 1 5.403 0c3.05 0 5.466 2.415 5.466 5.403 0 2.923-3.814 7.118-5.466 9.597zm0-12.267c1.525 0 2.733 1.208 2.733 2.67a2.713 2.713 0 0 1-2.733 2.733c-1.462 0-2.67-1.208-2.67-2.733a2.686 2.686 0 0 1 2.67-2.67z"></path>
                            </svg>
                        <? } ?>                     
                    </a>
                    <? if (!empty($arItem["CHILD"])) { ?>   
                        <ul class="c-mega-menu__links">
                            <? foreach ($arItem["CHILD"] as $child) {
                                ?>
                                <li><a class="c-link-block" href="<?= $child["LINK"] ?>">
                                        <span class="c-link <?= $child["SELECTED"] ? "c-link--disabled" : "" ?>"><?= $child["TEXT"] ?></span><? if ($child["PARAMS"]["quotes"] == "yes") { ?><span class="c-link c-link--notdecor  <?= $child["SELECTED"] ? "c-link--disabled" : "" ?>">»</span><? } ?>                                                
                                    </a></li>
                            <? } ?>
                        </ul>      
                    <? } ?>
                </li>
            <? } ?>
        <? } ?>

        <? if ($action && $arResult["ACTIONS"]) { ?>
            <?
            foreach ($arResult["ACTIONS"] as &$action_Item) {
                if ($action_Item["DETAIL_PAGE_URL"] == $arResult["PAGE"]) {
                    $action_Item["SELECTED"] = 1;
                }
                if (strlen($action_Item["NAME"]) <= 35) {
                    $name = $action_Item["NAME"];
                    $cut = false;
                } else {
                    $name = substr($action_Item["NAME"], 0, 35);
                    $cut = true;
                }
                ?>
                <li class="c-mega-menu__links-item">
                    <a href="<?= $action_Item["DETAIL_PAGE_URL"] ?>" class="c-mega-menu__links-link <?= $action_Item["SELECTED"] ? "c-mega-menu__links-link--dis pd-link-dis" : "" ?>">
                        <span class="c-link c-link--green <?= $action_Item["SELECTED"] ? "c-link--disabled" : "" ?>"><?= $name ?><?= $cut ? "..." : "" ?></span>                        
                        <svg class="c-header__action-svg" xmlns="http://www.w3.org/2000/svg" width="13" height="14" viewBox="0 0 13 14">
                            <defs>
                                <linearGradient id="a" x1="50%" x2="50%" y1="0%" y2="100%">
                                    <stop offset="0%" stop-color="#B4EC51"></stop>
                                    <stop offset="100%" stop-color="#429321"></stop>
                                </linearGradient>
                            </defs>
                            <g fill="none" fill-rule="nonzero">
                                <path fill="url(#a)" d="M12.734 7.647l-1.635-1.635-2.513-2.508-1.697-1.697a.288.288 0 0 0-.185-.088.03.03 0 0 0-.03 0h-3.09a.302.302 0 0 0-.216.088l-.273.272-.493.489v.006L1.537 3.637l-.123.118-.123.119.01.154-.303.144c.036.046.078.087.118.128.072.072.15.129.221.19l.006.099.159 2.303c0 .082.03.159.088.216l4.21 4.21 1.63 1.635a.316.316 0 0 0 .446 0l4.859-4.858v-.006a.311.311 0 0 0-.001-.442z"></path>
                                <path fill="#FFF" d="M12.734 8.09v.005l-4.858 4.858a.316.316 0 0 1-.447 0l-1.63-1.635a.34.34 0 0 0 .083-.061L11.038 6.1v-.006a.325.325 0 0 0 .062-.082l1.635 1.635a.31.31 0 0 1-.001.441z" opacity=".3"></path>
                                <path fill="#3F3F3F" d="M4.617 4.156a.702.702 0 0 0-.704.704c0 .01 0 .02.006.03-1.255.104-2.01-.509-2.503-1.136a4.482 4.482 0 0 1-.242-.339C.844 2.922.176 1.689 1.04.944 1.358.67 1.73.564 2.082.64c.442.098.823.452 1.08.997.041.092.082.174.119.256l.087-.087a.302.302 0 0 1 .215-.088h.288a7.39 7.39 0 0 0-.15-.339C3.384.65 2.85.172 2.217.04 1.666-.08 1.101.074.633.48c-.854.735-.843 1.964.026 3.274.21.319.436.596.683.833.653.617 1.424.93 2.308.93.195 0 .4-.016.612-.051a.648.648 0 0 0 .355.102.707.707 0 1 0 0-1.413z"></path>
                            </g>
                        </svg>                      
                    </a>
                </li>
            <? } ?>     
        <? }?>
    </ul>

    <?
endif
?>
