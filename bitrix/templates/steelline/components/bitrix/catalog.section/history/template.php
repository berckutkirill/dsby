<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

?>
<div class="content">
			<h1 class="title">История заявок</h1>
			<?foreach($arResult["ITEMS"] as $arItem) {
				$ZAKAZ = unserialize($arItem["~DETAIL_TEXT"]);
				?>
			<div class="zakaz">
				<div class="top clearfix">
					<span class="open"></span>
					<span class="number">Номер заказа: <?=$arItem["ID"]?></span>
					<a href="" class="print"></a>
					<span class="date">Дата оформления: <?=$arItem["DATE_CREATE"]?></span>
					<p>Сумма заявки (Br): <i><?=formatter($arItem["PROPERTIES"]["SUMM"]["VALUE"], false)?></i></p>
				</div>
				<div class="slide_down">
					<table>
						<tr>
							<th>Наименование двери</th>
							<th>Статус</th>
							<th>Стоимость (Br)</th>
							<th>Кол-во (шт)</th>
							<th>Общая стоимость (Br)</th>
						</tr>
						<?foreach($ZAKAZ["ITEMS"] as $Zakaz) { ?>
							<tr>
								<td><?=$Zakaz["NAME"]?></td>
								<td><?=$Zakaz["STATUS"]?></td>
								<td><?=formatter($Zakaz["PRICE"], false)?></td>
								
								<td><?=$Zakaz["QUANTITY"]?></td>
								<td><?=formatter($Zakaz["TOTAL_PRICE"], false)?></td>
							</tr>
						<? } ?>
					</table>
				</div>
			</div>
			<? } ?>
			<script>
				$(function() {
					$('.zakaz .top').click(function(e) {
						var zak = $(this).closest('.zakaz');
						zak.hasClass('opened') ?
							zak.removeClass('opened').find('.slide_down').slideUp(200):
							zak.addClass('opened').find('.slide_down').slideDown(200);
					})
				})
			</script>
		</div>