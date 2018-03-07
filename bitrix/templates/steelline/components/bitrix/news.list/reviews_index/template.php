<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//print_r($arResult);
?>
<div class="index_reviews">
    <div class="wrap">
        <p class="index_reviews_list_title">Отзывы клиентов</p>
        <ul class="index_reviews_list justified_container">
            <? foreach ($arResult["ITEMS"] as $arItem) {
                ?>           
                <li class = "index_reviews_item">
                    <div class = "index_reviews_item_text">
                        <?= $arItem["REVIEW"]; ?>
                    </div>
                    <p class = "index_reviews_item_signature"><?= $arItem["NAME"] ?></p>
                </li>
            <? }
            ?>
        </ul>
        <a href="/otzyvy" class="link_general">Читать все отзывы</a>
    </div>
</div>
