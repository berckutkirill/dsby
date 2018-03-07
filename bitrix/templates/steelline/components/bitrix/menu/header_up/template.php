<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<? if (!empty($arResult)): ?>
    <div class="c-nav">
        <ul class="c-nav__list">
            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                if ($arItem["PARAMS"]["action"] == "yes") {
                    $action = $arItem;
                    continue;
                }
                $arItem["LINK"] = str_replace("index.php", "", $arItem["LINK"]);
                ?>
                <? if ($arItem["SELECTED"]): ?>
                    <li class="c-nav__item c-nav__item--dis"><a href="<?= $arItem["LINK"] ?>" class="c-nav__link pd-link-dis"><?= $arItem["TEXT"] ?></a></li>
                <? else: ?>
                    <li  class="c-nav__item"><a class="c-nav__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <? endif ?>
            <? endforeach ?>
        </ul>
    </div>


    <?
    if (!empty($action)) {
        ?>
        <div class="c-header__action">
            <a class="c-header__action-link <?= $action["SELECTED"] ? "pd-link-dis" : "c-link-block" ?>" href="<?= $action["LINK"] ?>">
                <span class="c-link <?= $action["SELECTED"] ? "c-link--disabled" : "c-link--green" ?>"><?= $action["TEXT"] ?></span>
                <? if ($action["PARAMS"]["label"] != "no") { ?>
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
                <? } ?>
            </a>
        </div>
    <? } ?>

    <?







 endif ?>
