<? $sklad = $arParams["SKLAD"] == "Y" ? true : false; ?>
<div class="<?= $sklad ? "c-doorsl-repository__panel-desc" : "c-banner__panel-desc"?> c-p2">
	<div class="c-doorsl-repository__panel-cont active">
	  <p class="c-doorsl-repository__panel-cont-desc"><?= !$sklad?"Менеджер расскажет <br />о двери больше:":"Менеджер расскажет больше:"?></p>
	  <ul class="c-doorsl-repository__panel-cont-list">
	    <li class="c-doorsl-repository__panel-cont-item">
	    	<a href="tel:<?= str_replace("-", " ", VELCOM_PHONE_CARD)?>" class="c-unlink"><?= str_replace("-", " ", VELCOM_PHONE_CARD)?></a>
	    </li>
	    <li class="c-doorsl-repository__panel-cont-item">
	    	<a href="tel:<?= str_replace("-", " ", MTS_PHONE_CARD)?>" class="c-unlink"><?= str_replace("-", " ", MTS_PHONE_CARD)?></a>
	    </li>
	  </ul>
	</div>

	<div class="c-doorsl-repository__panel-cont">
	  <p class="c-doorsl-repository__panel-cont-desc"><?= !$sklad?"Менеджер перезвонит <br />вам в рабочее время":"Перезвоним в рабочее время"?></p><a class="c-doorsl-repository__panel-cont-link" href="#" data-toggle="modal" data-target="#managerCallModal">
	    <button class="c-w-but c-w-but--small c-doorsl-repository__panel-cont-but">Заказать звонок</button></a>
	</div>
</div>