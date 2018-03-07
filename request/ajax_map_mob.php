<?
if($_REQUEST["ID"]) {

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	if(!CModule::IncludeModule("iblock")) return;

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE");
	$arFilter = Array("ID" => $_REQUEST["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
	
	  $arFields = $ob->GetFields();
	  $Properties = $ob->GetProperties();
		if($Properties["MODELS"]["VALUE"]) {
			$filter["ID"] = $Properties["MODELS"]["VALUE"];
		}

	}
}

if($filter["ID"]) {

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_NAME_FOR_CATALOG");
	$arFilter = Array("ID" => $filter["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
	  $doors[] = $ob->GetFields();
	}
}

?>
<div>
	<div class="menu_popup list_detail">
		<div class="top clearfix">
			<b class="prev"></b>
			<b class="close"></b>
		</div>
		<div id="popup_place">
			<div class="fotos">
				<ul class="carret">
					<?if($arFields["PREVIEW_PICTURE"]) { ?>
					<li class="slide"><p class="img"><img src="<?=CFile::GetPath($arFields["PREVIEW_PICTURE"])?>" alt=""></p></li>
					<? } foreach($Properties["MORE_PHOTOS"]["VALUE"] as $val) { ?>
						<li class="slide"><p class="img"><img src="<?=CFile::GetPath($val);?>"></p></li>
					<? } ?>
		
				</ul>
				<div class="prev"></div>
				<div class="next"></div>
			</div>
			<h3><?=$arFields["NAME"]?></h3>
			<?foreach($Properties["ADRESS"]["VALUE"] as $val) { ?>
				<p class="address"><?=$val?></p>
			<? } ?>
			<p class="time">
				<?foreach($Properties["WORK_TIME"]["VALUE"] as $val) { ?>
					<?=$val?><br/>
				<? } ?>
			</p>
			<?foreach($Properties["PHONES"]["VALUE"] as $val) { ?>
				<p class="phone"><?=$val?></p>
			<? } ?>
		</div>
	</div>
</div>