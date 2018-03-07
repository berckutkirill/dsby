<?
$pictures = GetHBlock(21, ["UF_ACTIVE" => 1], ["UF_SORT" => "DESC"], ["UF_PICTURE", "UF_ALT"]);
?> 
<? if (!empty($pictures)) { ?>

    <ul class="c-p4 c-p4--small p-clientinfo__doc-list">
        <?
        foreach ($pictures as $arPic) {
            $file = CFile::GetPath($arPic["UF_PICTURE"]);
            ?>
            <li class="p-clientinfo__doc-item">
                <div class="modal-img-active p-clientinfo__doc-img">
                    <img src="<?= $file ?>" 
                         alt="<?= $arPic["UF_ALT"] ?>"
                         srcset="<?= $file ?> 2x"/>
                    <div class="p-clientinfo__doc-svg">
                        <svg>
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/sprite.svg#resize"></use>
                        </svg>
                    </div>
                </div>
                <span><?= $arPic["UF_ALT"] ?></span>
            </li>
            <?
            unset($file);
        }
        ?>
    </ul>
<? } ?>