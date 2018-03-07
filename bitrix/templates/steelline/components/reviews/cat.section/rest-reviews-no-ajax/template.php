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
//echo json_encode($arResult);
//print_r($arResult);
//die();

if (!empty($arResult["REVIEWS"])) {
    foreach ($arResult["REVIEWS"] as $arReview) {
        ?>
        <div class = "postedReviewItem">
            <? if (isset($arReview["PREVIEW_PICTURES"])) { ?>
                <div class = "postedReviewItem_foto">
                    <img src = "<?= $arReview["PREVIEW_PICTURES"]["SRC"] ?>" alt = "<?= $arReview["PREVIEW_PICTURES"]["ALT"] ?>"  class = "postedReviewItem_fotoImg">
                    <div class = "postedReviewItem_fotoTitle">
                        <a href = "<?= $arReview["LINK_DOOR"] ?>" class = "link_general postedReviewItem_fotoTitleName"><?= $arReview["NAME_DOOR"] ?></a>
                        <span class = "postedReviewItem_fotoTitleSeries">серия «<?= $arReview["SERIES"] ?>»</span>
                    </div>
                </div>
            <? } ?>
            <? if (isset($arReview["MANAGER"])) { ?>
                <div class = "postedReviewItem_rating postedReviewItem_rating_<?= $arReview["MANAGER"] ?>">
                    <span class = "postedReviewItem_ratingSmile"></span>
                    <span class = "postedReviewItem_ratingBlock">
                        <span class = "postedReviewItem_ratingTitle">менеджер работал:</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_excellent">лучше всех</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_good">здорово</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_normal">нормально</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_bad">плохо</span>
                    </span>
                </div>
            <? } ?>
            <? if (isset($arReview["DELIVERY"])) { ?>
                <div class = "postedReviewItem_rating postedReviewItem_rating_<?= $arReview["DELIVERY"] ?>">
                    <span class = "postedReviewItem_ratingSmile"></span>
                    <span class = "postedReviewItem_ratingBlock">
                        <span class = "postedReviewItem_ratingTitle">доставили и установили:</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_excellent">очень быстро</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_good">быстро</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_normal">нормально</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_bad">медленно</span>
                    </span>
                </div>
            <? } ?>
            <? if (isset($arReview["DOOR"])) { ?>
                <div class = "postedReviewItem_rating postedReviewItem_rating_<?= $arReview["DOOR"] ?>">
                    <span class = "postedReviewItem_ratingSmile"></span>
                    <span class = "postedReviewItem_ratingBlock">
                        <span class = "postedReviewItem_ratingTitle">дверь служит:</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_excellent">отлично</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_good">достойно</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_normal">нормально</span>
                        <span class = "postedReviewItem_ratingValue ratingValue_bad">плохо</span>
                    </span>
                </div>
            <? } ?>
            <div class = "postedReviewItem_text">
                <?
                if (isset($arReview["REVIEW"])) {
                    echo $arReview["REVIEW"];
                }
                ?>
            </div>
            <div class = "postedReviewItem_sign <?= $arReview["LINK_REVIEW"] ? "postedReviewItem_sign-link" : "" ?>">
                <? if (isset($arReview["LINK_REVIEW"])) { ?>
                    <a href = "<?= $arReview["LINK_REVIEW"] ?>" class = "link_general" target = "_blank"><?= $arReview["NAME"] ?></a>                               
                    <?
                } else {
                    echo $arReview["NAME"];
                }
                ?>
            </div>
            <? if (isset($arReview["ANSWER_BUSINESS"])) { ?>
                <div>
                    <p class="postedReviewItem_businessReply"><?= $arReview["ANSWER_BUSINESS"] ?></p>
                </div>
            <? } ?>
        </div>
        <?
    }
}
?>