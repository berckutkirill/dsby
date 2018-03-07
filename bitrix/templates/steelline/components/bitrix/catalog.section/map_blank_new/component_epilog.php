<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script src="<?=SITE_TEMPLATE_PATH."/script/scriptMap.js"?>"></script>
<script type="text/javascript">

ymaps.ready(initMap);
function initMap () {

	initIcons(ymaps);

    myMap = new ymaps.Map('map', {
            center: [53.90259906678, 27.605792848521954],
            zoom: 11,
			controls: ["zoomControl"]
        }, {
            searchControlProvider: 'yandex#search'
        }),
        objectManager = new ymaps.ObjectManager({
            clusterize: true,
            clusterIconLayout: MyIconContentLayout,
            geoObjectOpenBalloonOnClick: false,
            clusterOpenBalloonOnClick: false,
			clusterDisableClickZoom: false
        });
		
	objectManager.clusters.options.set('preset', 'cluster#icon');

    myMap.geoObjects.add(objectManager);
	objectManager.add(data);
	
	objectManager.objects.each(function (object) {
		if(object.isSalon){
			objectManager.objects.setObjectOptions(object.id, {
                preset: iconSalon
            });
		} else {
			objectManager.objects.setObjectOptions(object.id, {
                preset: iconBrand
            });
		}
	});
	
	

	
    objectManager.objects.events.add(['click', 'mouseenter', 'mouseleave'], onObjectEvent);
    objectManager.clusters.events.add(['mouseenter', 'mouseleave'], onClusterEvent);
 	objectManager.objects.events.add('balloonclose', onBaloonClose);
	objectManager.objects.events.add('balloonopen', onBaloonOpen);

	

    myMap.events.add('boundschange', onBoundsChange);

	$(".citySelect").on("change", function(){
		if($(this).val())
			cityZoom($(this).val());
	})
	$(".block_arrow").on("click", function(e){
		makeChange($(this).attr("data-id"));
	})
	$(".block_arrow").on("mouseenter", function(e){
		onDomEvent($(this).attr("data-id"), "mouseenter");
	})
	$(".block_arrow").on("mouseleave", function(e){
		onDomEvent($(this).attr("data-id"), "mouseleave");
	})
	$(".citySelect").change();
}


</script>