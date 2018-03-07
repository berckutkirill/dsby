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
<section class="p-home-reviews">
    <ul class="p-home-reviews__list">
        <li class="p-home-reviews__item p-home-col-2">
            <a class="c-h2 c-link" href="/otzyvy/">Отзывы<br>о входных дверях и сервисе</a>
            <p class="p-home-reviews__desc">
                В «Дверном сезоне» ценят мнение покупателей — отзывы&nbsp;помогают нам повысить&nbsp;качество обслуживания.
            </p>
        </li>
        <?
        $i=0;
        foreach ($arResult["ITEMS"] as $arItem) { ?>
            <li class="p-home-reviews__item p-home-col-2 c-doorsl-comments__item">
                <div class="c-p2"><?= $arItem["REVIEW"]; ?></div>
                <div class="c-h4 c-doorsl-comments__item-addres"><?= $arItem["NAME"] ?></div>      
            </li>
        <? 
        $i++;
        if($i == 2){
            break;
        }
        } ?>        
    </ul>
</section>
