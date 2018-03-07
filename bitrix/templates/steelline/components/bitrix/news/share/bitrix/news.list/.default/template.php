<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="action catalog">
	<div class="wrap clearfix">
		<div class="sidebar">
			<h2>Акции</h2>
			<ul class="menu">
				<?foreach($arResult["SIDEBAR"] as $sb_item):

					$date1=  date('Y-m-d');
					$date2=  $sb_item["PROPERTIES"]["ACTIVE_TO"]["VALUE"];
					if(strtotime($date1) < strtotime($date2))
					{
						$cl = "";
					}
					else
					{
						$cl = "not";
					}
					if($sb_item["CODE"] == $arResult["CODE"])
						$class = "active";
					else
						$class = "";
				?>
					<li><a href="<?=$sb_item["DETAIL_PAGE_URL"]?>" class="<?=$class?> <?=$cl?>"><?=$sb_item["NAME"]?></a></li>
				<?endforeach;?>
			</ul>
			<h2>Услуги салона</h2>

			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include", 
				".default", 
				array(
					"COMPONENT_TEMPLATE" => ".default",
					"AREA_FILE_SHOW" => "file",
					"SIDEBAR_DOP" => $arResult["SIDEBAR_TO"],
					"PATH" => "/include/sidebar_dop.php",
					"EDIT_TEMPLATE" => "standard.php"
				),
				false
			);?>
		</div>
		<div class="content">
			<?if(!empty($arResult["ACTIVE_ACTION"])) {
			$ACTIVE_ACTION = $arResult["ACTIVE_ACTION"][0];
			?>
			<a href="<?=$ACTIVE_ACTION["DETAIL_PAGE_URL"]?>">
			<h1 class="title"><?=$ACTIVE_ACTION["NAME"]?></h1>
			<div class="img">

				<img src="<?=$ACTIVE_ACTION["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$ACTIVE_ACTION["NAME"]?>">
			</div>
			<div class="text">
				
			</div>
			</a>
			<?}
			if(!empty($arResult["NOACTIVE_ACTION"])) {
			?>
			<h2 class="title">Остальные акции</h2>
			<?foreach($arResult["NOACTIVE_ACTION"] as $arItem):?>
				<div class="block noactive_action">

					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="img">
						<?if(!$arItem['CONTINUES']) { ?>
						<div class="ended"></div>
						<? } ?>
						<i class="shad"></i><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?$arItem["PREVIEW_PICTURE"]["SRC"]:$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>">
					</a>
					<span class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="name"><?=$arItem["NAME"]?></a>
				</div>
			<?endforeach;?>
			<? } ?>
		</div>
	</div>
</div>