<section class="c-salon-entry">
    <div class="c-block c-block--reverse">
        <div class="c-block__logo">
            <img class="c-block__logo-img" src="<?= SITE_TEMPLATE_PATH ?>/img/salon_dz/2x/img6.jpg" srcset="<?= SITE_TEMPLATE_PATH ?>/img/salon_dz/1x/img6.jpg 1x, <?= SITE_TEMPLATE_PATH ?>/img/salon_dz/2x/img6.jpg 2x"/>
        </div>

        <div class="c-block__aside">
            <div class="c-block__desc">
                <div class="c-block__desc-item">
                    <p class="c-h4">На пр-те Дзержинского, 131, помещение 624</p>
                    <div class="c-salon-timework c-p2">
                        <?
                        if ($arParams["WORK_TIMES"]) {
                            foreach ($arParams["WORK_TIMES"] as $value) {
                                ?>                            
                                <div class="c-salon-timework__item">
                                    <p><?= $value["DAY"] ?></p>
                                    <p><?= $value["TIME"] ?></p>
                                </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                    <div class="c-salon-phone c-p2">
                        <? foreach ($arParams["PHONES"] as $phone) { ?>
                            <p><?= $phone ?></p>
                        <? } ?>
                    </div>
                </div>
                <div class="c-block__desc-item">
                    <p class="c-p2">Вход в салон со стороны парковки. Ориентируйтесь на большую белую дверь</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="c-salon-map">
    <div class="c-block">
        <div class="c-block__logo">
            <span class="c-salon-map__border c-salon-map__border-left"></span>
            <span class="c-salon-map__border c-salon-map__border-bottom"></span>
            <span class="c-salon-map__border c-salon-map__border-right"></span>
            <span class="c-salon-map__border c-salon-map__border-top"></span>

            <div class="c-salon-map__main" id="salons-map"></div>
        </div>
        <div class="c-block__aside">
            <div class="c-block__desc c-block__desc--mult">
                <div class="c-block__desc-item c-salon-map__desc">
                    <p class="c-h4 c-block__desc-title">Приезжайте на метро</p>
                    <p class="c-p2">В 8 минутах ходьбы от салона расположена ст. м. «Малиновка».</p>
                </div>
                <div class="c-block__desc-item c-salon-map__desc">
                    <p class="c-h4 c-block__desc-title">Общественном транспорте</p>
                    <p class="c-p2">Конечная остановка,<br>возле <span class="c-salon-map__desc--ls">ТЦ «ОМА».</span></p>
                </div>
                <div class="c-block__desc-item c-salon-map__desc">
                    <p class="c-h4 c-block__desc-title">Машине</p>
                    <p class="c-p2">Дорога от <span class="c-salon-map__desc--ls">МКАД</span> до салона занимает 2 минуты.</p>
                </div>
            </div>
        </div>
    </div>
</section>