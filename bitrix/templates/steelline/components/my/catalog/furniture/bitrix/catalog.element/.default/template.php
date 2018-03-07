<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<script type="text/javascript">
var google_tag_params = {
ecomm_prodid: <?=$arResult["ID"]?>
};
ga('ec:addProduct', {
  'id': '<?=$arResult["ID"]?>',
  'name': '<?=$arResult["NAME"]?>'
});
ga('ec:setAction', 'detail');
ga('send', 'event');
</script>
<div class="content furn">
	<h1 class="title"><?=$arResult["NAME"]?></h1>
	<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]) $class = "sale";?>
	<div class="fix <?=$class?>">
		<?if($arResult["MIN_PRICE"]["VALUE"]){ ?>
		
			<?if($arResult["MIN_PRICE"]["VALUE"] > $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]){?>
			<span class="price_old js_price_gen">
				<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
				<span class="old_rub js_old_denomination_price">
				<?=toPrice($arResult["MIN_PRICE"]["VALUE"])?> руб.</span>
			</span>
			<? } ?>
			<span class="price js_price_gen">
				<span class="new_rub"><span class="js_denomination_price"></span> руб.</span><br>
				<span class="old_rub js_old_denomination_price">
				<?=toPrice($arResult["MIN_PRICE"]["DISCOUNT_VALUE"])?> руб.</span>
			</span>
		<? } else { ?>
			<span class="price">Входит в набор</span>
		<? } ?>
	</div>
	<div class="clearfix">
		<div class="galery clearfix">
			<div class="big">
				<p class="img"><img src="<?=CFile::GetPath($arResult["ITEMS"][0]["DETAIL_PICTURE"])?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"></p>
			</div>
			<ul class="contr clearfix">
				<?foreach($arResult["ITEMS"] as $arItem) { ?>
					<li data-id="<?=$arItem["ID"]?>">
						<p class="img"><img src="<?=CFile::GetPath($arItem["DETAIL_PICTURE"])?>" alt="<?=$arItem["NAME"];?>"></p>
					</li>
				<? } ?>
			</ul>
		</div>
		<div class="list">
			<h2>В набор входят</h2>
			<?foreach($arResult["ITEMS"] as $arItem) { ?>
					<p data-id="<?=$arItem["ID"]?>"><?=$arItem["NAME"]?></p>
			<? } ?>
			<span class="blue">* Стоимость комплекта фурнитуры добавляется к цене двери</span>
		</div>
		<script>
			$(function() {
				var bind = $('[data-id]');
								bind.click(function() {
									var id = $(this).attr('data-id');
									bind.removeClass('curr');
									$('[data-id="'+id+'"]').addClass('curr');
									$('.galery .big img').attr('src',$('[data-id="'+id+'"] img').attr('src'));
								})
			})
		</script>
	</div>
	<h2>Подробное описание</h2>
<?foreach($arResult["ITEMS"] as $k => $arItem) {
if($k % 2){ $to = "second";} else {$to = "first";};
if($arItem["WIDE_CART"]) $to = $wide = "wide_cart"; else $wide = "";
$dp = CFile::GetPath($arItem["DETAIL_PICTURE"]);
$html = '
<div class="elem '.$wide.'">
				<p class="img"><img src="'.$dp.'" alt="'.$arItem["NAME"].'"></p>
				<h3>'.$arItem["NAME"].'</h3>
				'.$arItem["~DETAIL_TEXT"];
				if(is_array($arItem["PROPERTIES"])) {
		$html .= '<table>';
					foreach($arItem["PROPERTIES"] as $code => $val) {
					$html .= '<tr>
						<td>'.$val["NAME"].'</td>
						<td>'.$val["TEXT"].'</td>
					</tr>';
					 } 
		$html .= '</table>';
				} 
$html .= '</div>';


$RES[$to] .= $html;
		} ?>
<div class="clearfix">
		<?=$RES["wide_cart"]?>
		<div class="wrapper">
			<?=$RES["first"]?>
		</div>
		<div class="wrapper">
			<?=$RES["second"]?>
		</div>
	</div>
</div>