var myMap;
var MyIconContentLayout;
var MyIconContentLayoutHover;
var iconCluster = "cluster#icon";
var iconClusterHover = "cluster#iconHover";
var iconSalon = "point#iconSalon";
var iconSalonHover = "point#iconSalonHover";
var iconBrand = "point#iconBrand";
var iconBrandHover = "point#iconBrandHover";
var sh;

$(function() {
	sh = $(".saloon[data-open]").length > 0;
	if(window.location.hash) {
		var saloon = window.location.hash.match(/salon=([^\&]*)/i);
        if (saloon) {
			requestSalon(saloon[1]);
        }
	}
});

function requestSalon(data_id) {
	window.location.hash="#salon="+data_id;
	var data = {"ID":data_id};

	$.ajax({
		url:"/request/ajax_map.php",
		data:data,
		type:"post",
		success:function(res){

			$("#popup_place").html($(res).find("#popup_place").html());
			mini_slider('.door_list', 1, 185, 6, 1,250);
			showModal("#popup_place");
		}
	})
}
$('.fade2 .close,.fade2').unbind('click');
$('.fade2 .close,.fade2').on('click', function() {
	history.pushState('', document.title, window.location.pathname);
	$('.popup,.fade2').fadeOut(150);
});

function makeChange(id) {
	var block = $("#block_"+id);
	var name = block.find("h3").text();
	var adr = block.find(".adr").text();
	$(".name_salon").remove();
	$(".adr_salon").remove();
	$(".salon_select").removeClass('err').removeClass('or').html("<span class='name_salon'>"+name+"</span><span class='adr_salon'>"+adr+"</span>");
	$("#full_adress").val(name + " " + adr);
	$("#salon_id").val(id);

	if($(".salon_select").hasClass("dont_hide_fade")) {
		var phone = block.find(".phone").html();
		var email = block.find(".email").text();
		var work_time = block.find(".time").html();
		$(".blue_data").html(phone+"<span class='email'>"+email+"</span><span>"+adr+"</span><span>"+work_time+"</span>");
		if((".mapPopup").hasClass("mapPopup2")) return;
		$(".mapPopup").fadeOut(150);
	} else {
		$(".popup, .fade2").fadeOut(150);
		$("body").css("overflow", "auto");
	}
}

function showModal(id) {
    $(id+',.fade2').fadeIn(150);
}

function doAction (objectId, type) {

	var obj = objectManager.objects.getById(objectId);
	var preset, presetHover;
	
	if(obj.isSalon) {
		preset = iconSalon;
		presetHover = iconSalonHover;
	} else {
		preset = iconBrand;
		presetHover = iconBrandHover;
	}



	if (type == 'mouseenter') {
		$(".block").removeClass("mouseenter");
		$("#block_"+objectId).addClass("mouseenter");
		objectManager.objects.setObjectOptions(objectId, {
            preset: presetHover
        });
    } else if (type == 'mouseleave') {
		$(".block").removeClass("mouseenter");
        objectManager.objects.setObjectOptions(objectId, {
            preset: preset
        });
    } else if (type == 'click') {
		if($("#block_"+objectId).hasClass("click")) {
			requestSalon(objectId);
		} else {
			$(".block").removeClass("mouseenter click");
			$("#block_"+objectId).addClass("click");
			if(!myMap.balloon.isOpen())
			{
				objectManager.objects.balloon.open(objectId);
			} else {
				objectManager.objects.balloon.close();
				objectManager.objects.balloon.open(objectId);
			}
		}
    }

}
	


	
	
function onObjectEvent(e) {
	if($("#saloons").length && e.get('type') == "click") {
		$("#saloons").val(e.get('objectId'));
		$("#saloons").removeClass("err");
	}
    doAction(e.get('objectId'), e.get('type'));
}

function onDomEvent(objectId, type) {
    doAction(objectId, type);
}
var clcl = false;
function onClusterEvent (e) {
    var objectId = e.get('objectId');
    if (e.get('type') == 'mouseenter') {
		objectManager.clusters.setClusterOptions(objectId, {
            preset:iconClusterHover
        });
    } else if(e.get('type') == 'mouseleave') {
		objectManager.clusters.setClusterOptions(objectId, {
            preset:iconCluster
        });
	} else {
		clcl = true;
	}
}

function onBaloonClose(e) {
	var objectId = e.get('objectId');
	
	var obj = objectManager.objects.getById(objectId);
	var preset, presetHover;
	
	if(obj.isSalon) {
		preset = iconSalon;
	} else {
		preset = iconBrand;
	}
	
	objectManager.objects.setObjectOptions(objectId, {
		preset: preset
	});

}


function onBaloonOpen (e) {
	var objectId = e.get('objectId');
	var block_id = "block_"+objectId;
	var obj = objectManager.objects.getById(objectId);
	var coords = obj.geometry.coordinates;
	coords = [parseFloat(coords[0]),parseFloat(coords[1])];
	var projection = myMap.options.get('projection');
	var position = myMap.converter.globalToPage(projection.toGlobalPixels(coords,myMap.getZoom()));
	var positionSec = projection.fromGlobalPixels(myMap.converter.pageToGlobal([position[0] + 200, position[1]]), myMap.getZoom());

	myMap.panTo(
		positionSec
	);
	
	var preset, presetHover;
	
	if(obj.isSalon) {
		preset = iconSalon;
	} else {
		preset = iconBrand;
	}
	
	objectManager.objects.setObjectOptions(objectId, {
		preset: preset
	});
	
}
function inArray(needle, haystack) {
	for(var i in haystack) {
		if(haystack[i] == needle) {
			return true;
		}
	}
	return false;
}
var filtered = false;
function filter_map(enabl, ids) {
	if(ids) {
		filtered = ids;
		var boolval = false;
		objectManager.setFilter(function (obj) {
			return true;
		})
		objectManager.setFilter(function (obj) {
			boolval = inArray(obj.id, ids);
			if(!boolval)
			{
				$("#block_"+obj.id).hide();
			} else {
				$("#block_"+obj.id).show();
			}
			return boolval;
		})
	} else {
		filtered = false;
		objectManager.setFilter(function (obj) {
			return true;
		})
		objectManager.setFilter(function (obj) {
			if(!enabl) {
				$("#block_"+obj.id).show();
				return true;
			}

			if($("#block_"+obj.id).hasClass("if_hidden"))
			{
				$("#block_"+obj.id).hide();
			} else {
				$("#block_"+obj.id).show();
			}
	
			return !$("#block_"+obj.id).hasClass("if_hidden");
		})
	}
}
function onBoundsChange() {

	if(filtered) {
		objectManager.setFilter(function (obj) {
			return true;
		})
		objectManager.setFilter(function (obj) {
			boolval = inArray(obj.id, filtered);
			if(!boolval)
			{
				$("#block_"+obj.id).hide();
			} else {
				$("#block_"+obj.id).show();
			}
			return boolval;
		})
	} else if(sh) {
		objectManager.setFilter(function (obj) {
			return true;
		})
		objectManager.setFilter(function (obj) {
			var objectState = objectManager.getObjectState(obj.id);
			if(objectState.isShown)
			{
				if(!$("#block_"+obj.id).hasClass("if_hidden")){
					$("#block_"+obj.id).show();
				}
			} else {
				$("#block_"+obj.id).hide();
			}
			return objectState.isShown && !$("#block_"+obj.id).hasClass("if_hidden");
		})

	} else {
		objectManager.setFilter(function (obj) {
			return true;
		})
		objectManager.setFilter(function (obj) {
			var objectState = objectManager.getObjectState(obj.id);
			if(objectState.isShown)
			{
				$("#block_"+obj.id).show();
			} else {
				$("#block_"+obj.id).hide();
			}
			return objectState.isShown;
		})
	}
	if(clcl) {
		clcl = false;
		ymaps.util.requireCenterAndZoom(
			myMap.getType(),
			myMap.getBounds(),
			[780, 700]
		).then(function (result) {
			var projection = myMap.options.get('projection');
			var position = myMap.converter.globalToPage(projection.toGlobalPixels(result.center,result.zoom));
			var positionSec = projection.fromGlobalPixels(myMap.converter.pageToGlobal([position[0] + 200, position[1]]), result.zoom);
			myMap.setCenter(positionSec, result.zoom);
		});
	}
	if($(".block.click").length) {
		var newp = $(".block.click").position().top + $(".wrap_obj").scrollTop() - 10;
		$(".wrap_obj").animate({scrollTop:newp},200);
	}

}

function cityZoom(city) {

	var zm = 0;
	if(city.indexOf("Беларусь") < 0) 
	{
		city = "Беларусь, "+city;
	}
	ymaps.geocode(city, {
		results: 1 
	}).then(function (res) {
		var firstGeoObject = res.geoObjects.get(0),
			coords = firstGeoObject.geometry.getCoordinates(),
			bounds = firstGeoObject.properties.get('boundedBy');

		myMap.setBounds(bounds, {
			checkZoomRange: true,
			zoomMargin:zm,
			preciseZoom:true
		});
	});
}

function initIcons(ymaps) {

	MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
'<div class="myCluster" style="background-image: url(/bitrix/templates/steelline/img/map/cluster.png); position: absolute; top:-20px; left:-20px; width: 40px; height: 40px; opacity: 1; background-size: 40px 40px; background-position: 0px 0px;">{{ properties.geoObjects.length }}</div>');

	MyIconContentLayoutHover = ymaps.templateLayoutFactory.createClass(
'<div class="myCluster hover" style="background-image: url(/bitrix/templates/steelline/img/map/clusterHover.png); position: absolute; top:-20px; left:-20px; width: 40px; height: 40px; opacity: 1;  background-size: 40px 40px; background-position: 0px 0px;">{{ properties.geoObjects.length }}</div>'); 
	
	ymaps.option.presetStorage.add('cluster#icon', {
		iconShape: {
				type: 'Rectangle',
				coordinates: [[-20, -20], [20, 20]]
			},
		iconLayout: MyIconContentLayout
    });
	ymaps.option.presetStorage.add('cluster#iconHover', {
        iconShape: {
				type: 'Rectangle',
				coordinates: [[-20, -20], [20, 20]]
			},
		iconLayout: MyIconContentLayoutHover
    });

	
	ymaps.option.presetStorage.add('point#iconBrand', {
		iconImageHref: '/bitrix/templates/steelline/img/map/brand.png',
        iconImageSize: [26, 40],
        iconImageOffset: [-13, -40],
		iconLayout: 'default#image'
    });
	ymaps.option.presetStorage.add('point#iconBrandHover', {
		iconImageHref: '/bitrix/templates/steelline/img/map/brandHover.png',
        iconImageSize: [26, 40],
        iconImageOffset: [-13, -40],
		iconLayout: 'default#image'
    });
	
	ymaps.option.presetStorage.add('point#iconSalon', {
        iconImageHref: '/bitrix/templates/steelline/img/map/salon.png',
        iconImageSize: [26, 40],
        iconImageOffset: [-13, -40],
		iconLayout: 'default#image'
    });
	ymaps.option.presetStorage.add('point#iconSalonHover', {
        iconImageHref: '/bitrix/templates/steelline/img/map/salonHover.png',
        iconImageSize: [26, 40],
        iconImageOffset: [-13, -40],
		iconLayout: 'default#image'
    });

}
