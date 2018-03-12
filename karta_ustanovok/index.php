<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Карта установок входных металлических дверей Стальная Линия в городе Минск.");
$APPLICATION->SetPageProperty("title", "Карта установок входных дверей в Минске | Ds-steelline.by");
 ?>
<div class="wrap new cool_bread clearfix">
	<ul>
		<li><a href="/" title="Главная">Главная</a></li>
		<li>Карта установок</li>
	</ul>
</div>
<div class="wrap doormap_container">
	<p class="title_detail">В 2016-2018 году</p>
	<h1 class="big_title doormap_title">Мы установили <span class="doors_quantity"></span> двер<span class="last_letter">ей</span>:</h1>
	<div class="doormap_map" id="doors_installation_map">
		<div class="doormap_preloader">
			<div class="doormap_preloader_img"></div>
		</div>
	</div>

	<div class="doormap_map_details justified_container">
		<div class="likely">
			<div class="facebook">Поделиться</div>
			<div class="vkontakte">Поделиться</div>
			<div class="twitter">Твитнуть</div>
		</div>
		<p class="doormap_map_details_text">Карта установленных дверей</p>
	</div>
<?
	$TOP_FIVE = GetHBlock(18);
	CModule::IncludeModule('iblock');
	foreach($TOP_FIVE as $door) {
		$IDS[] = $door['UF_ELEMENT_ID'];
		$sort[$door['UF_ELEMENT_ID']] = $door['UF_SORT'];
	}
	if(!empty($IDS)) {
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
		$arFilter = Array("ID"=>$IDS, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, [], $arSelect);
		while($ob = $res->GetNextElement()) {
			$arItem = $ob->GetFields();
			$PROPERTIES = $ob->getProperties();
			$MIN_OFFER = getOffersWithMinPrice($arItem["ID"]);
			$arItem["PREVIEW_PICTURE"] = $MIN_OFFER["DETAIL_PICTURE"];
			$arItem["PREVIEW_PICTURE2"] = $MIN_OFFER["DETAIL_PICTURE_2"];
			if(in_array("flat", $PROPERTIES["APPOINTMENT"]["VALUE_XML_ID"])) {
				$arResult["ITEMS"]["FLAT"][$sort[$arItem["ID"]]] = $arItem;
			} else {
				$arResult["ITEMS"]["HOME"][$sort[$arItem["ID"]]] = $arItem;
			}
		}
		ksort($arResult["ITEMS"]["FLAT"]);
		ksort($arResult["ITEMS"]["HOME"]);
	?>
	<div class="doormap_tops">
		<div class="doormap_topfive flat">
			<p class="topfive_title">Топ 5 дверей<span>для квартиры</span></p>
			<ul class="topfive_items justified_container">
				<?foreach($arResult["ITEMS"]["FLAT"] as $arItem): ?>
					<li class="topfive_item">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<div class="topfive_item_img_container justified_container">
								<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
								<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE2"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
							</div>
							<p class="topfive_item_title"><?=$arItem["NAME"]?></p>
						</a>
					</li>
				<?endforeach;?>
			</ul>
		</div>
		<div class="doormap_topfive home">
			<p class="topfive_title">Топ 5 дверей<span>для дома</span></p>
			<ul class="topfive_items justified_container">
				<?foreach($arResult["ITEMS"]["HOME"] as $arItem): ?>
					<li class="topfive_item">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<div class="topfive_item_img_container justified_container">
								<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
								<p class="topfive_item_img"><img src="<?=$arItem["PREVIEW_PICTURE2"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></p>
							</div>
							<p class="topfive_item_title"><?=$arItem["NAME"]?></p>
						</a>
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
	<?
	}
	?>
	<script>
		$(document).ready(function() {
			$.getJSON("/request/ajax/getAddresses.php", function(result) {
				var doorsQuantity = result.length;
				$(".doors_quantity").text(doorsQuantity);
				var lastNum = doorsQuantity.toString().slice(-1);
				var lastLetter = (lastNum == 1) ? "ь" : (lastNum > 1 && lastNum < 5) ? "и" : "ей";
				$(".last_letter").text(lastLetter);
				var installation_map;

				ymaps.ready(function() {
					installation_map = new ymaps.Map(document.getElementById("doors_installation_map"), {
						center: [53.90, 27.55],
						zoom: 11
					}, {
						restrictMapArea: [[57.42, 22.57], [48.71, 36]]
					});
					installation_map.behaviors.disable(['scrollZoom']);
					installation_map.controls.remove('searchControl');
					installation_map.controls.remove('geolocationControl');
					installation_map.controls.remove('trafficControl');
					installation_map.controls.remove('rulerControl');

					var installation_map_data = {
						"type": "FeatureCollection",
						"features":[]
					};

					objectManager = new ymaps.ObjectManager({
						clusterize: true
					});
					objectManager.clusters.options.set("clusterIconLayout", ymaps.templateLayoutFactory.createClass('<div class="clusterIcon">{{ properties.geoObjects.length }}</div>'));
					objectManager.clusters.options.set("clusterIconShape", {type: 'Rectangle', coordinates: [[0,0],[30,30]]});
					objectManager.clusters.options.set("hasBalloon", false);
					for (var k = 0; k < result.length; k++) {
						if (k < result.length - 1) {
							var coords = result[k].UF_COORDS;
							if (coords) {
								installation_map_data.features.push({
									"type": "Feature",
									"id": k,
									"geometry": {
										"type": "Point", 
										"coordinates": coords},
									"options": {
										iconLayout: 'default#image',
										iconImageHref: '/bitrix/templates/steelline/img/point_image.svg',
										iconImageSize: [20, 20]
									}
								});
								
							}
						} else {
							if(coords){
								installation_map_data.features.push({
									"type": "Feature",
									"id": k,
									"geometry": {
										"type": "Point", 
										"coordinates": coords},
									"options": {
										iconLayout: 'default#image',
										iconImageHref: '/bitrix/templates/steelline/img/point_image.svg',
										iconImageSize: [20, 20]
									}
								});
								
							}
							
							$(document).find(".doormap_preloader").fadeOut();
						}	
					};
					objectManager.add(installation_map_data);
					installation_map.geoObjects.add(objectManager);
				});
			});
		});
		
	</script>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");