<section class="c-salon-entry">
    <div class="c-block c-block--reverse">
        <div class="c-block__logo">
            <img class="c-block__logo-img" src="<?= SITE_TEMPLATE_PATH ?>/img/salon_trum/2x/exit.jpg" srcset="<?= SITE_TEMPLATE_PATH ?>/img/salon_trum/1x/exit.jpg 1x, <?= SITE_TEMPLATE_PATH ?>/img/salon_trum/2x/exit.jpg 2x"/>
        </div>
        
        <div class="c-block__aside">
            <div class="c-block__desc">
                <div class="c-block__desc-item">
                    <p class="c-h4">В ТЦ «Трюм»<br>на ул. Кальварийской, 7Б-6</p>
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
                    <p class="c-p2">Вход в салон через подземный<br>переход. Ориентируйтесь<br>на вывеску ТЦ</p>
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
                    <p class="c-p2">В 2 минутах ходьбы от салона расположена ст. м. «Фрунзенская».</p>
                </div>
                <div class="c-block__desc-item c-salon-map__desc">
                    <p class="c-h4 c-block__desc-title">Общественном транспорте</p>
                    <p class="c-p2">Остановка троллейбусов и&nbsp;автобусов через дорогу.</p>
                </div>
                <div class="c-block__desc-item c-salon-map__desc">
                    <p class="c-h4 c-block__desc-title">Машине</p>
                    <p class="c-p2">Дорога с 1-го кольца до салона занимает 3 минуты.</p>
                </div>
            </div>
        </div>
    </div>
</section>