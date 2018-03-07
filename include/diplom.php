<?
$pictures = GetHBlock(20, ["UF_ACTIVE" => 1], ["UF_SORT" => "DESC"], ["UF_PICTURE", "UF_ALT"]);
?> 
<? if (!empty($pictures)) { ?>

    <div class="client">
        <div class="wrap">
            <section class="sertif one">
                <h3>Сертификаты и награды</h3>
                <p>Дипломы за достигнутые высокие показатели</p>
                <div class="list">
                    <ul>
                        <?
                        foreach ($pictures as $arPicture) {
                            $file = CFile::GetPath($arPicture["UF_PICTURE"]);
                            ?>
                            <li class="big">
                                <img class="uncl" src="<?= CFile::GetPath($arPicture["UF_PICTURE"]) ?>" 
                                     alt="<?= $arPicture["UF_ALT"] ?>" 
                                     data-src="<?= CFile::GetPath($arPicture["UF_PICTURE"]) ?>">
                            </li>
                        <? } ?>
                    </ul>
                </div>
                <div class="prev control"></div>
                <div class="next control"></div>
                <div class="popup_img">
                    <i class="close">x</i>
                    <b class="prev uncl"></b>
                    <b class="next uncl"></b>
                    <img src="" alt="" class="uncl">
                </div>
            </section> 
        </div>
    </div>

    <script>
        $(function () {
            mini_slider('.sertif.one', 1, 199, 6, 1, 250);
            var galery1 = new Galery([
                '.sertif.one', // main block
                '.contr li', // wrappers mini pictures
                '.big', // wrapper big picture
                '.popup_img', //wrapper popup window
                '.prev', // previous button in popup
                '.next', // next button in popup
                '.close', // close button in popup
                '.fade', // fade layer
                '.curr img', // selected mini picture
                'data-src', // data-attribute with src big pictures
            ]);
        })
    </script>
<? } ?>