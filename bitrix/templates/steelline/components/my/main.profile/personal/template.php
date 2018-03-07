<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<form class="form"  method="post">
<?foreach($arResult["HIDDEN"] as $v) { ?>
	<input type="hidden" name="<?=$v?>" value="<?=$arResult["arUser"][$v];?>">
<? } ?>
	<h2 class="title">Профиль пользователя <i><?=$USER->GetLogin()?></i></h2>
	<div class="block">
		<h3>Данные организации</h3>
		<table>
			<tr>
				<td>Название</td>
				<td><input type="text" name="UF_NAME_ORG" class="field" value="<?=htmlspecialcharsbx($arResult["arUser"]["UF_NAME_ORG"])?>"></td>
			</tr>
			<tr>
				<td>УНП</td>
				<td><input type="text" name="UF_UNP" class="field" value="<?=htmlspecialcharsbx($arResult["arUser"]["UF_UNP"])?>"></td>
			</tr>
			<tr>
				<td>Юридический адрес</td>
				<td><input type="text" name="UF_UR_ADRES" class="field" value="<?=htmlspecialcharsbx($arResult["arUser"]["UF_UR_ADRES"]);?>"></td>
			</tr>
			<tr class="textarea">
				<td>Банковские реквизиты</td>
				<td ><textarea type="text" name="UF_BANK_INFO" class="field" ><?=htmlspecialcharsbx($arResult["arUser"]["UF_BANK_INFO"]);?></textarea></td>
			</tr>
		</table>
	</div>
	<?
	$last = count($arResult["USER_MAGS"]) - 1;
	foreach($arResult["USER_MAGS"] as $k => $MAG) { ?>
	<div class="block border">
		<? if($k == $last) { ?>
		<i class="add" onclick="add_block(this)">+</i>
		<? } ?>
		<h3>Данные магазина</h3>
		<table>
			<tr>
				<td>Название</td>
				<td><input type="text" name="MAG[<?=$MAG["ID"]?>][NAME]" class="field" value="<?=htmlspecialcharsbx($MAG["NAME"]);?>"></td>
			</tr>
			<tr>
				<td>Адрес</td>
				<td><input type="text" name="MAG[<?=$MAG["ID"]?>][ADRESS]" class="field" value="<?=htmlspecialcharsbx($MAG["ADRESS"]);?>"></td>
			</tr>
			<tr>
				<td>Контактное лицо</td>
				<td><input type="text" name="MAG[<?=$MAG["ID"]?>][FACE]" class="field" value="<?=htmlspecialcharsbx($MAG["FACE"]);?>"></td>
			</tr>
			<tr>
				<td>Контактные телефоны</td>
				<td>
					<?foreach($MAG["PHONES"] as $phone) { ?>
						<input type="text" name="MAG[<?=$MAG["ID"]?>][PHONES][]" class="field phone" value="<?=$phone?>"> 
					<? } ?>
				</td>
			</tr>
		</table>
	</div>
	<? } ?>
	<div class="foot"><button type="submit" class="confirm">Изменить профиль</button></div>
</form>
<script>
	var blocks = <?=$k+1?>;
	$(function() {
		$('.form').on('submit', function() {
			if($(this).hasClass('true')) {
				return true;
			} else {
				$(this).addClass('true');
				return false;
			}
		});
		$('.confirm').on('click', function() {
			if(!$(this).hasClass('save')) {
				$(this).addClass('save').text('Сохранить профиль');
				$('.profile .block').addClass('editable');
			}
		});
	});
	function init_field() {
		$('.field').change(function() {
			$('.form').addClass('true');
			$('.confirm').addClass('save').text('Сохранить профиль');
		});
	};
	init_field();
	function add_block(tgt) {
		$('.field').unbind('change');
		var block = $(tgt).closest('.block');
		var tmpl = '<div class="block editable border"><i class="add" onclick="add_block(this)">+</i><h3>Данные магазина</h3><table><tr><td>Название</td><td><input type="text" name="MAG[new_'+blocks+'][NAME]" class="field"></td></tr><tr><td>Адрес</td><td><input type="text" name="MAG[new_'+blocks+'][ADRESS]" class="field"></td></tr><tr><td>Контактное лицо</td><td><input type="text" name="MAG[new_'+blocks+'][FACE]" class="field"></td></tr><tr><td>Контактные телефоны</td><td><input type="text" name="MAG[new_'+blocks+'][PHONES][]" class="field phone"> <input type="text" name="MAG[new_'+blocks+'][PHONES][]" class="field phone"></td></tr></table></div>';
		block.after(tmpl);
		blocks++;
		tgt.remove();
		init_field();
	};
</script>