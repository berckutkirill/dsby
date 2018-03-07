<?
$pictures = GetHBlock(22, ["UF_ACTIVE" => 1], ["UF_SORT" => "DESC"], ["UF_PICTURE", "UF_ALT"]);
?> 
<? if (!empty($pictures)) { ?>
    <ul class="p-clientinfo__sert-list">
        <?
        foreach ($pictures as $arPic) {
            $file = CFile::GetPath($arPic["UF_PICTURE"]);
            ?>
            <li class="modal-img-active p-clientinfo__sert-item">
                <img src="<?= $file ?>" 
                     srcset="<?= $file ?> 2x"/>
                <div class="p-clientinfo__sert-svg">
                    <svg>
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite.svg#resize"></use>
                    </svg>
                </div>
            </li>
        <? } ?>
    </ul>
    <?
}?>