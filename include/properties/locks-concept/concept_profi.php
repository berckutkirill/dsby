<li class="c-tabs__item <?= !$arParams["DATA_TAB"] ? "c-tabs__item--active" : "" ?>">   
    <div class="c-tab c-tab--trigger">
        <div class="c-tab__main">
            <div class="c-tab__body">
                <div class="c-tab__title c-h4">
                    <? if ($arParams['INCOMPL']) { ?>
                        <h4 class="c-tab__price active">Входит в стоимость</h4>
                    <? } else { ?>
                        <h4 class="c-tab__price active">+165 руб.</h4>
                    <? } ?>
                    <h4 class="c-tab__price">+275 руб.</h4>
                </div>
                <p class="c-tab__text c-tab__toggle c-p2 ">Марганцевые пластины в корпусе защищают механизмы от высверливания и выбивания. Замок оснащён балансирующими сувальдами, которые препятствуют проникновению отмычки.
                    <span class="c-p2"><strong>Цилиндр EVO K22</strong> прошёл испытания по безопасности в&nbsp;Европейском институте Giordano. 11-пиновый механизм защищён от высверливания, вскрытия отмычками, перелома корпуса и дублирования ключа.</span>
                </p>
            </div>
            <div class="c-tab__foot c-p2">
                <div class="c-tab__data">
                    <ul class="c-tab__data-item">
                        <li class="c-tab__data-head">Замки</li>
                        <li class="c-tab__data-title"><a class="c-link" href="/zamki#securemme_2410_2600">Securemme 2061 и 2019</a></li>
                    </ul>
                    <ul class="c-tab__data-item">
                        <li class="c-tab__data-head">Цилиндр</li>
                        <li class="c-tab__data-title">
                            <span class="c-tab__trigger">Securemme</span>
                            или
                            <span class="c-tab__trigger active">EVO K22</span>
                        </li>
                    </ul>
                    <ul class="c-tab__data-item">
                        <li class="c-tab__data-head">Производитель</li>
                        <li class="c-tab__data-title">Италия</li>
                    </ul>
                </div>
            </div>
        </div>
        <img class="c-tab__img" src="<?= SITE_TEMPLATE_PATH ?>/img/concept/2x/loks-profi-new.jpg" srcset="<?= SITE_TEMPLATE_PATH ?>/img/concept/1x/loks-profi-new.jpg 1x, <?= SITE_TEMPLATE_PATH ?>/img/concept/2x/loks-profi-new.jpg 2x"/>
    </div>
</li>