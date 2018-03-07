<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>
<? if (!empty($arResult)): ?>
    <ul class="c-link-list">
        <?
        foreach ($arResult as $arItem):
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            $arItem["LINK"] = str_replace("index.php", "", $arItem["LINK"]);
            ?>
            <? if ($arItem["SELECTED"]): ?>
                <li class="c-link-list__item"><a href="<?= $arItem["LINK"] ?>" class="c-link-list__link pd-link-dis">
                        <span class="c-link-list__text c-link c-link--disabled"><?= $arItem["TEXT"] ?></span><? if ($arItem["PARAMS"]["quotes"] == "yes") { ?><span class="c-link c-link--notdecor c-link--disabled">»</span><? } ?></a></li>
            <? else: ?>
                <li class="c-link-list__item"><a href="<?= $arItem["LINK"] ?>" class="c-link-list__link c-link-block">
                        <span class="c-link-list__text c-link"><?= $arItem["TEXT"] ?></span><? if ($arItem["PARAMS"]["quotes"] == "yes") { ?><span class="c-link c-link--notdecor">»</span><? } ?></a></li>
                        <? endif ?>
                    <? endforeach ?>
    </ul>
    <?


 endif?>