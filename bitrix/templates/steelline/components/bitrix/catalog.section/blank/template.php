<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */
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
if($_GET["sort"] == "asc"){
	$sort = "asc";
	$sort_class = "down";
	$sw_sort = "desc";
} elseif($_GET["sort"] == "desc") {
	$sort = "desc";
	$sort_class = "up";
	$sw_sort = "asc";
} else {
	$sw_sort = "asc";
	$sort_class = "up";
}
$CART = $arParams["CART"]["ITEMS"];

?>
<style>
.filter_check input:checked + span::before {
  content: '?';
}
</style>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();/** @var array $arParams */
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
if($_GET["sort"] == "asc"){
	$sort = "asc";
	$sort_class = "down";
	$sw_sort = "desc";
} elseif($_GET["sort"] == "desc") {
	$sort = "desc";
	$sort_class = "up";
	$sw_sort = "asc";
} else {
	$sw_sort = "asc";
	$sort_class = "up";
}
$CART = $arParams["CART"]["ITEMS"];
$RESULT = $arParams["CART"]["RESULT"];

?>
<style>
.filter_check input:checked + span::before {
  content: '';
}
</style>
<div class="content">
	<h1 class="title">Бланк заявки</h1>
	
	<table>
		<tr>
			<th>Наименование двери</th>
			<th>Статус</th>
			<th>Стоимость (Br)</th>
			<th>Кол-во (шт)</th>
			<th>Общая стоимость (Br)</th>
		</tr>
		<?foreach($arResult["SORTED"] as $arItem) { ?>
		<tr>
			<td><?=$arItem["NAME"]?></td>
			<td><?=$arItem["STATUS"]?></td>
			<td><?=formatter($arItem["PRICE"], false)?></td>
			<td>
				<div class="quantity">
					<b class="down" onclick="changeQuantSklad('down','<?=$arItem["ID"]?>')">-</b>
					<input type="text" onchange="changeQuantSklad('inp','<?=$arItem["ID"]?>')" id="input_<?=$arItem["ID"]?>" value="<?=$CART[$arItem["ID"]]?$CART[$arItem["ID"]]:0?>" name="number">
					<b onclick="changeQuantSklad('up','<?=$arItem["ID"]?>')" class="up">+</b>
				</div>
			</td>
			<td data-num="<?=$arItem["PRICE"]?>" id="sum_<?=$arItem["ID"]?>"><?=formatter($arItem["PRICE"] * $CART[$arItem["ID"]], false)?></td>
		</tr>
		<? } ?>
	</table>
	<div class="foot_sum">
			<p>Итого <i  class="change_getter" data-id="TOTAL_PRICE"><?=$RESULT["TOTAL_PRICE"]?></i></p>
			<a href="/request/make_order.php" class="final">Отправить заявку</a>

			<input class="change_setter" type="hidden" value="<?=$RESULT["TOTAL_COUNT_POS"]?>" id="TOTAL_COUNT_POS">
			<input class="change_setter" type="hidden" value="<?=$RESULT["TOTAL_PRICE"]?>" id="TOTAL_PRICE">
			
	</div>
</div>