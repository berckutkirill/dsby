<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$this->setFrameMode(true);
?>

<?php if (!empty($arResult)) { ?>
    <div class="sidebar">
        <div class="nav">
            <ul class="first">
                <?php
                $previousLevel = 0;
                foreach ($arResult as $arItem) {
                    $class = " " . $arItem["PARAMS"]["UF_CLASS"] . " ";
                    ?>

                    <?php if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) { ?>
                        <?php echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
                    <?php } ?>

                    <?php if ($arItem["IS_PARENT"]) { ?>

                        <?php
                        if ($arItem["DEPTH_LEVEL"] == 1) {
                            if ($arItem["LINK"] == "/catalog-dverei/kollektsii/") {
                                $not = "not";
                                $nofollow = 'rel="nofollow"';
                            } else {
                                $not = "";
                                $nofollow = "";
                            }
                            ?>
                            <li><a <?php echo $nofollow ?> href="<?php echo $arItem["LINK"] ?>" class="<?php echo $not ?> 
                                <?php
                                echo $class;
                                if ($arItem["SELECTED"]) {
                                    ?>active<?php } ?>"><?php echo $arItem["TEXT"] ?></a>
                                                           <?php
                                                           if ($arItem["SELECTED"]) {
                                                               $open = "open";
                                                           } else {
                                                               $open = "";
                                                           }
                                                           ?>
                                <ul class="second <?php echo $open ?>">
                                <?php } else { ?>
                                    <li><a href="<?php echo $arItem["LINK"] ?>" class="<?php
                                        echo $class;
                                        if ($arItem["SELECTED"]) {
                                            ?>not<?php } ?>"><?php echo $arItem["TEXT"] ?></a>
                                        <ul>
                                            <?php
                                        }
                                        ?>

                                    <?php } else { ?>

                                        <?php if ($arItem["PERMISSION"] > "D") { ?>

                                            <?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
                                                <li><a href="<?php echo $arItem["LINK"] ?>" class="<?php
                                                    echo $class;
                                                    if ($arItem["SELECTED"]) {
                                                        ?>active<?php } else { ?>root-item<?php } ?>"><?php echo $arItem["TEXT"] ?></a></li>
                                                   <?php } else { ?>
                                                <li><a href="<?php echo $arItem["LINK"] ?>" <?php if ($arItem["SELECTED"]) { ?> class="<?php echo $class; ?> active"<?php } else { ?> class="<?php echo $class; ?>"<?php } ?>><?php echo $arItem["TEXT"] ?></a></li>
                                            <?php } ?>

                                        <?php } else { ?>

                                            <?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
                                                <li><a href="" class="<?php
                                                    echo $class;
                                                    if ($arItem["SELECTED"]) {
                                                        ?>not<?php } else { ?>not<?php } ?>" title="<?php echo GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?php echo $arItem["TEXT"] ?></a></li>
                                                   <?php } else { ?>
                                                <li><a href="" class="denied" title="<?php echo GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?php echo $arItem["TEXT"] ?></a></li>
                                                <?php } ?>

                                        <?php } ?>

                                    <?php } ?>

                                    <?php $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                                <?php } ?>

                                <?php if ($previousLevel > 1) {//close last item tags    ?>
                                    <?php echo str_repeat("</ul></li>", ($previousLevel - 1)); ?>
                                <?php } ?>
                            </ul>
                            </div>
                            <?php $APPLICATION->ShowViewContent("DOP_SIDEBAR"); ?>
                            </div>
                        <?php }