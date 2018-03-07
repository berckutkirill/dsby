<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(!empty($arResult["ITEMS"]))
{
?>

<div class="new_slider">

	<?foreach($arResult["ITEMS"] as $k => $item):
		$revers = $item["CODE"] == "revers";
	?>
	<div class="slide <?=$item["CODE"]?>" style="background:#6288b2 url(<?=$item["DETAIL_PICTURE"]["SRC"]?>) center center no-repeat">
				<div class="wrap">
					<?if($item["PREVIEW_PICTURE"]["SRC"]) { ?>
					<div class="img"><img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" alt=""></div>
					<? } ?>
					<div class="text">
						<?if($revers) { ?>
							<h3 class="h3"><?=$item["PROPERTIES"]["FIRST_STRING"]["~VALUE"]?></h3>
							<h2 class="h2"><?=$item["PROPERTIES"]["SECOND_STRING"]["~VALUE"]?></h2>
						<? } else { ?>
							<h2 class="h2"><?=$item["PROPERTIES"]["FIRST_STRING"]["~VALUE"]?></h2>
							<h3 class="h3"><?=$item["PROPERTIES"]["SECOND_STRING"]["~VALUE"]?></h3>
						<? } ?>

						<p class="descript"><?=$item["PREVIEW_TEXT"]?></p>
						<a href="<?=$item["PROPERTIES"]["URL"]["VALUE"]?>" class="more"><?=$item["PROPERTIES"]["BUTTON"]["VALUE"] ? $item["PROPERTIES"]["BUTTON"]["VALUE"] : "Посмотреть в каталоге";?></a>
					</div>
				</div>
			</div>
	<?endforeach;?>
	<div class="wrap">
		<div class="control prev"></div>
		<div class="control next"></div>
		<ul class="navigation">
		</ul>
	</div>
	<script>
		$(function() {
			DammSlider({
			 	query: $('.new_slider'),
				start_slide: 0,
				speed: 500
			})
		})
	</script>
</div>

<?
}
?>