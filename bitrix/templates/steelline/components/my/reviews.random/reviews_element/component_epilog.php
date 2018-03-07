<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($arResult["REVIEWS"])) { ?>
    <!-- ОТЗЫВЫ НА ДВЕРЬ -->
    <div class="cool_item_reviews wrap new">
        <div class="item_reviews__title">
            <a href="/otzyvy/" class="item_reviews__titleLink link_general">Отзывы о дверях и сервисе</a>
        </div>
        <ul class="item_reviews__list justified_container">
            <? foreach ($arResult["REVIEWS"] as $arReview) { ?>
                <li class="item_reviews__item">
                    <div class="postedReviewItem_text"><?= $arReview["REVIEW"] ?></div>
                    <div class="postedReviewItem_sign <?= $arReview["LINK_REVIEW"] ? "postedReviewItem_sign-link" : "" ?>">
                        <? if ($arReview["LINK_REVIEW"]) { ?>
                            <a target="_blank" href="<?= $arReview["LINK_REVIEW"] ?>"><?= $arReview["NAME"] ?></a>
                        <? } else { ?>
                            <?= $arReview["NAME"] ?>
                        <? } ?>
                    </div>
                </li>
            <? } ?>       
        </ul>
    </div>
    <!-- /ОТЗЫВЫ НА ДВЕРЬ -->
<? } ?>
<?
//$frame->end();
?>