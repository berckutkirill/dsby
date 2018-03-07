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
  content: '✓';
}
</style>
<div class="content">
					<h1 class="title">Складские двери</h1>
					<form id="filter" class="filt filter_check clearfix">
						<label><input type="checkbox" name="so[]" value="Правое" <?if(in_array("Правое", $_GET["so"])) { ?>checked<? } ?>><span>Правое открытие</span></label>
						<label><input type="checkbox" name="so[]" value="Левое" <?if(in_array("Левое", $_GET["so"])) { ?>checked<? } ?> ><span>Левое открытие</span></label>
						<label><input type="checkbox" name="sw[]" value="860 мм" <?if(in_array("860 мм", $_GET["sw"])) { ?>checked<? } ?> ><span>860 мм</span></label>
						<label><input type="checkbox" name="sw[]" value="880 мм" <?if(in_array("880 мм", $_GET["sw"])) { ?>checked<? } ?> ><span>880 мм</span></label>
						<label><input type="checkbox" name="sw[]" value="950 мм" <?if(in_array("950 мм", $_GET["sw"])) { ?>checked<? } ?> ><span>950 мм</span></label>
						<label><input type="checkbox" name="sw[]" value="960 мм" <?if(in_array("960 мм", $_GET["sw"])) { ?>checked<? } ?> ><span>960 мм</span></label>
						<input type="hidden" name="sort" id="sort_getter" value="<?=$sort?>">
						<a href="<?=$sw_sort?>" id="sort_setter" class="sort <?=$sort_class?>">По стоимости</a>
						<script>
							$(function(){
								$("#sort_setter").on("click", function(e){
									e.preventDefault();
									$("#sort_getter").val($(this).attr("href"));
									$("#filter").submit();
								})
							})
						</script>
					</form>
					<table>
						<tr>
							<th>Наименование двери</th>
							<th>Открытие</th>
							<th>Ширина (мм)</th>
							<th>Стоимость (Br)</th>
							<th>Кол-во (шт)</th>
							<th>Общая стоимость (Br)</th>
						</tr>
						<?foreach($arResult["SORTED"] as $arItem) { ?>
						<tr>
							<td><?=$arItem["NAME"]?></td>
							<td><?=$arItem["SKLAD_OPEN"]?></td>
							<td><?=$arItem["SKLAD_WIDTH"]?></td>
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
				</div>