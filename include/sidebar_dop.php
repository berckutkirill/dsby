<ul class="clearfix dop_sidebar">
	<?foreach($arParams["SIDEBAR_DOP"] as $sb_item):
if($sb_item["PROPERTIES"]["UNIKUM_URL"]["VALUE"]) $sb_item["DETAIL_PAGE_URL"] = $sb_item["PROPERTIES"]["UNIKUM_URL"]["VALUE"];
?>
	<li>
		<a href="<?=$sb_item["DETAIL_PAGE_URL"]?>" class="block">
		 <?
		 $file = array();
		 $id = ($sb_item["PROPERTIES"]["SVG_ICON"]["VALUE"] ? $sb_item["PROPERTIES"]["SVG_ICON"]["VALUE"] : $sb_item["PREVIEW_PICTURE"]);
		 if($id)
			$file = CFile::GetPath($id);
		 ?>
			<img src="<?=$file?>" alt="<?=$sb_item["NAME"]?>">
			<div class="shad">
				<b></b>
			</div>
		</a>
		<a href="<?=$sb_item["DETAIL_PAGE_URL"]?>" class="name">
			<span><?=$sb_item["NAME"]?></span>
		</a>
	</li>
	<?endforeach;?>
</ul>