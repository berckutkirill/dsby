<div data-tab="<?php echo $arParams["DATA_TAB"] ?>">
    <div class="dp-setfurn">
        <div class="dp-setfurn__main">
            <?if($arParams['SERIES'] === '80' || $arParams['SERIES'] === '80u') { ?>
                <div class="dp-setfurn__item">
                    <div class="price_wrap">
                        <p class="price dp-setfurn__title">+ <span class="num"><?=$arParams['PRICES'][19]['PRICE']?></span> руб. за комплект</p>
                    </div>
                    <div class="dp-setfurn__item-top">
                        <div class="dp-setfurn__lin"><img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-a.jpg"/><span
                                    class="dp-furn-title">
						Броненакладка<br/> Crit на цилиндр</span></div>
                        <div class="dp-setfurn__lin"><img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-l.jpg"/><span
                                    class="dp-furn-title">
						Накладка Crit<br/> на сувальду</span></div>
                    </div>
                    <div class="dp-setfurn__item-bot">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom.jpg"/>
                        <span class="dp-furn-title">Ручка Apecs</span>
                    </div>
                </div>
            <? } ?>
            <div class="dp-setfurn__item">
                <div class="price_wrap">
                    <?if($arParams['SERIES'] === '80' || $arParams['SERIES'] === '80u') { ?>
                        <p class="price dp-setfurn__title">+ <span class="num"><?=$arParams['PRICES'][15]['PRICE']?></span> руб.</p>
                    <? } else { ?>
                        <p class="price dp-setfurn__title">+ <span class="num"><?=$arParams['PRICES'][15]['PRICE']?></span> руб. за комплект</p>
                    <? } ?>
                </div>
                <div class="dp-setfurn__item-top">
                    <div class="dp-setfurn__lin">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-a.jpg"/>
						<span class="dp-furn-title">Броненакладка<br/> Crit на цилиндр</span>
                    </div>
                    <div class="dp-setfurn__lin">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-l.jpg"/>
						<span class="dp-furn-title">Накладка Crit<br/> на сувальду</span>
                    </div>
                </div>
                <div class="dp-setfurn__item-bot">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom.jpg"/>
                    <span class="dp-furn-title">Ручка Armadillo Pava</span>
                </div>
            </div>
            <div class="dp-setfurn__item">
                <div class="price_wrap">
                    <p class="price dp-setfurn__title">+ <span class="num"><?=$arParams['PRICES'][16]['PRICE']?></span> руб.</p>
                </div>
                <div class="dp-setfurn__item-top">
                    <div class="dp-setfurn__lin"><img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-a.jpg"/><span
                                class="dp-furn-title">
						Броненакладка<br/> Crit на цилиндр</span></div>
                    <div class="dp-setfurn__lin"><img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-l.jpg"/><span
                                class="dp-furn-title">
						Накладка Crit<br/> на сувальду</span></div>
                </div>
                <div class="dp-setfurn__item-bot"><img src="/bitrix/templates/steelline/img/cool/furn-chrom1.jpg"/><span
                            class="dp-furn-title">Ручка Armadillo SQUID</span></div>
            </div>
            <div class="dp-setfurn__item">
                <div class="price_wrap">
                    <p class="price dp-setfurn__title">+ <span class="num"><?=$arParams['PRICES'][17]['PRICE']?></span> руб.</p>
                </div>
                <div class="dp-setfurn__item-top">
                    <div class="dp-setfurn__lin"><img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-a.jpg"/><span
                                class="dp-furn-title">
						Броненакладка<br/> Crit на цилиндр</span></div>
                    <div class="dp-setfurn__lin"><img src="<?= SITE_TEMPLATE_PATH ?>/img/cool/furn-chrom-l.jpg"/><span
                                class="dp-furn-title">
						Накладка Crit<br/> на сувальду</span></div>
                </div>
                <div class="dp-setfurn__item-bot">
                    <img src="/bitrix/templates/steelline/img/cool/furn-17.jpg"/>
                    <span class="dp-furn-title">Ручка Hoppe Vittoria</span>
                </div>
            </div>

        </div>
    </div>
</div>