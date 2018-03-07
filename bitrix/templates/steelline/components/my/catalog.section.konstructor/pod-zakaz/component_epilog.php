<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.hidden{
		display:none;
}
</style>
<script>

function changeList(value, funct) {
		var FILTER = {};
		var modrel = true;
			$(".reloader.check").each(function() {
				var name = $(this).attr("data-f");
				var value = $(this).attr("data-value");
				FILTER[name] = value;
			})
			$(".select_list .selected").each(function() {
				var name = $(this).closest(".select_list").attr("data-f");
					var value = $(this).attr("data-value");
					FILTER[name] = value;
			})


		var data = {};
		data["FILTER"] = FILTER;
		if(data["FILTER"]["MODELD"]){
			if($("#collection").attr("data-value") != data["FILTER"]["KOL"] || $(".homeCheck .check").attr("data-value") != data["FILTER"]["HOME"]) {
				data["FILTER"]["MODELD"] = "";
			}
		}
		$.ajax({
			url:"/konstructor/ajax.php",
			type:"post",
			data:data,
			success:function(res){
				$('.constructor *').unbind();
				$(".ajax").each(function() {
					var id = $(this).attr("id");
					$(this).html($(res).find("#"+id).html());
					$(this).attr("data-value", $(res).find("#"+id).attr("data-value"));
					if($(this).attr("data-excel-val")){
						$(this).attr("data-excel-val", $(res).find("#"+id).attr("data-excel-val"));
					}
					if(modrel) modelsReload();
				});
				initializeK();
			}
		})
		
	}
function modelsReload(){
	var colid = $("#collection").attr("data-value");
	var cumod = $("#currMODELD").attr("data-value");
	var home = $(".homeCheck .check").attr("data-value");
	var inHtml = "";
	var haveCurr = false;
	var classVal = "";
	var can = false;
	for(var i in models){
		can = false;
		if(models[i]["KOL"] == colid)
		{
			for(var j in models[i]["HOME"]){
				if(models[i]["HOME"][j] == home){
					can = true;
				}
			}
			
			if(can) { 
				if(cumod == models[i]["VALUE_ID"]) 
				{
					classVal="selected"; 
				} else {
					classVal=""
				};
				inHtml += "<li data-text='"+models[i]["VALUE"]+"' class='"+classVal+"' data-price='"+models[i]["BASE_PRICE"]+"' data-value='"+models[i]["VALUE_ID"]+"'>"+models[i]["VALUE"]+"<span>"+toPrice(models[i]["BASE_PRICE"], true)+"</span></li>";
			}
		}
	}
	$("#modelList").html(inHtml);
}

function checkAllPrice(){
$(".closest_pricer").each(function(){
	checkPrice($(this));
	Proschot();
});
				
				
}
function checkPrice(pricer){
		var price = 0;
		var sum = 0;
		pricer.find(".check[data-price]:visible").each(function() {
			if($(this).attr("data-price")) {
				price = parseInt($(this).attr("data-price"));
				sum += price;
			}
		})
		if(!sum){
			resultPrice = "Входит в стоимость";
			pricer.find(".price_up").removeClass("stoimost");
			pricer.find(".price_up").addClass("zero");
		} else {
			pricer.find(".price_up").removeClass("zero");
			pricer.find(".price_up").addClass("stoimost");
			resultPrice = toPrice(sum);
		}
		pricer.find(".price_up").text(resultPrice);
		
		if(pricer.hasClass("furn_detail")){
			price = 0;
			sum = 0;
			pricer.closest(".block.padd.closest_pricer").find(".check[data-price]:visible").each(function() {
				if($(this).attr("data-price")) {
					price = parseInt($(this).attr("data-price"));
					sum += price;
				}
			})
			
			if(!sum){
				resultPrice = "Входит в стоимость";
				pricer.find(".price_up").removeClass("stoimost");
				pricer.find(".price_up").addClass("zero");
			} else {
				pricer.find(".price_up").removeClass("zero");
				pricer.find(".price_up").addClass("stoimost");
				resultPrice = toPrice(sum);
			}
			
			pricer.closest(".block.padd.closest_pricer").find(".price_up").first().text(resultPrice);
		}
		
		
		
		Proschot();
}



function hideInv() {
	if($("#collection").attr("data-value") == "72")
	{
		$(".texture_list li").addClass("disabled");
		$(".texture_list li[data-choise='6']").removeClass("disabled");
	} else {
		$(".texture_list li[data-choise='6']").addClass("disabled");
		
		if($(".check[data-input='HOME']").attr("data-value") == "63"){
			$(".texture_list li[data-choise='1']").removeClass("disabled");
			$(".texture_list li[data-choise='2']").removeClass("disabled");
			$(".texture_list li[data-choise='3']").removeClass("disabled");
			$(".texture_list li[data-choise='4']").removeClass("disabled");
			$(".texture_list li[data-choise='5']").removeClass("disabled");
		} else {
			$(".texture_list li[data-choise='1']").removeClass("disabled");
			$(".texture_list li[data-choise='2']").addClass("disabled");
			$(".texture_list li[data-choise='3']").addClass("disabled");
			$(".texture_list li[data-choise='4']").removeClass("disabled");
			$(".texture_list li[data-choise='5']").addClass("disabled");
		}
	}
}
function Proschot() {
	var price = 0;
	var priceRes = 0;
	var sum = 0;
	var html = "";
	var name  = "";
	$(".check[data-price]:visible").each(function() {
			if(parseInt($(this).attr("data-price")) > 0) {
			
				if($(this).attr("data-excel") == "OUTSIDE" || $(this).attr("data-excel") == "INSIDE" || $(this).attr("data-excel") == "BLOCK_COLOR" || $(this).attr("data-excel") == "SHIR" || $(this).attr("data-excel") == "VIS" || $(this).attr("data-excel") == "KONTUR"){
					name = $(this).closest(".closest_name_wrap").find(".closest_name").text() + " " +$(this).attr("data-excel-val");
					
				} else if($(this).attr("data-excel") == "HAND_COLOR" || $(this).attr("data-excel") == "HAND") {
					var wrap = $(this).closest(".closest_name_wrap");
					name = wrap.find(".closest_name").text()+" "+wrap.find(".check[data-excel='HAND']:visible").text() + " " + wrap.find(".check[data-excel='HAND_COLOR']:visible").attr("data-excel-val");
				} else {
					name = $(this).closest(".closest_name_wrap").find(".closest_name").text();
				}
				price = parseInt($(this).attr("data-price"));
				priceRes = toPrice(price, true);
				
				sum += price;
				html += '<tr><td>+ '+name+'</td><td>'+priceRes+'</td></tr>'
			}
		})
		sum+=basePrice;
		
		var ResSum = toPrice(sum, true);
		var baseP = toPrice(basePrice, true)
		var detTableHead = '<tr class="head"><td>Базовая стоимость двери </td><td class="base_price_value">'+baseP+'</td></tr>';
		html += '<tr class="foot"><td>Итоговая стоимость</td><td>'+ResSum+'</td></tr>';
		
		$("#detailed table").html(detTableHead+html);
		$("#itog_price_door").text(ResSum);
}

function toPrice(price, plus){
	
	price = String(price).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ')+' Br'
	if(!plus)
		return "+ "+price;
	else
		return price;
}
function reloadForm(){
	for(var i in objChanger){
		var value = "";
		var exc = objChanger[i];
		if(exc == "SHIR X VIS") {
			var SHIR = $(".excel[data-excel='SHIR']").attr("data-excel-val");
			var VIS = $(".excel[data-excel='VIS']").attr("data-excel-val");
			value = SHIR+" X "+VIS;
		} else if(exc == "INSIDE" || exc == "OUTSIDE") {
			var SEC = $(".excel[data-excel='"+exc+"']").attr("data-excel-val");
			var TOL = $(".excel[data-excel='TOL']").attr("data-excel-val");
			var COLOR = $(".excel[data-excel='"+exc+"_COLOR']").attr("data-excel-val");
			value = TOL+" "+SEC+" "+COLOR;
		} else if(exc == "GERK + NAKL + KONTUR + NABOR + NOCHNAYA") {
			value = "";
			var zpt = false;
			if($(".excel[data-excel='GERK']").attr("data-excel-val")){
				value += $(".excel[data-excel='GERK']").attr("data-excel-val");
				zpt = true;
			}
			
			if( $(".excel[data-excel='NAKL']").attr("data-excel-val")){
				if(zpt) value += ", "; else zpt = true;
				value += $(".excel[data-excel='NAKL']").attr("data-excel-val");
			}
			
			if($(".excel[data-excel='KONTUR']").attr("data-excel-val")){
				if(zpt) value += ", "; else zpt = true;
				value += $(".excel[data-excel='KONTUR']").attr("data-excel-val")+" контура";
			}
			
			if($(".excel[data-excel='NABOR']").attr("data-excel-val")){
				if(zpt) value += ", "; else zpt = true;
				value += "Набор фурнитуры "+$(".excel[data-excel='NABOR']").attr("data-excel-val");
			}
			
			if($(".excel[data-excel='NOCHNAYA']").attr("data-excel-val")){
				if(zpt) value += ", "; else zpt = true;
				value += "Ночная задвижка "+$(".excel[data-excel='NOCHNAYA']").attr("data-excel-val");
			}
		} else if(exc == "HAND"){
			var HAND = $(".excel[data-excel='"+exc+"']:visible").attr("data-excel-val")
				var HAND_COLOR = $(".excel[data-excel='HAND_COLOR']:visible").attr("data-excel-val");
			if(typeof HAND_COLOR == "undefined"){
				$(".furn_color:visible [data-excel='HAND_COLOR']").first().click();
				HAND_COLOR = $(".excel[data-excel='HAND_COLOR']:visible").attr("data-excel-val");
			}
			value = HAND+" "+HAND_COLOR;
		}else {
			value = $(".excel[data-excel='"+exc+"']:visible").attr("data-excel-val")
		}
		if(typeof value == "undefined"){
			value = "";
		}
		console.log(exc);
		console.log(i);
		var filt = i;

		if($(".exel_table input."+i).length) {
			$(".exel_table input."+i).val(value);
			$(".exel_table input."+i).attr("value", value);
		}
	}
}
function addZayavka(){
	$(".addZayavka").addClass("loading");
	var data = {};
	data["HOME"] = $(".check[data-input='HOME']").text();
	data["KOL"] = $(".curr[data-input='KOL']").text();
	data["MODELD"] = $(".curr[data-input='MODELD']").text();
	data["TOL"] = $(".check[data-input='TOL']").text();
	data["OUTSIDE"] = $(".check[data-input='OUTSIDE']").text();
	data["OUTSIDE_COLOR"] = $(".check[data-input='OUTSIDE_COLOR']:visible").attr("data-value");
	data["INSIDE"] = $(".check[data-input='INSIDE']").text();
	data["INSIDE_COLOR"] = $(".check[data-input='INSIDE_COLOR']:visible").attr("data-value");
	data["BLOCK_COLOR"] = $(".check[data-input='BLOCK_COLOR']").attr("data-value");
	data["SHIR"] = $(".check[data-input='SHIR']").text();
	data["VIS"] = $(".check[data-input='VIS']").text();
	data["KONTUR"] = $(".check[data-input='KONTUR']").text();
	data["FURN"] = $(".check[data-input='FURN']").text();
	data["HAND"] = $(".check[data-input='HAND']:visible").text();
	data["HAND_COLOR"] = $(".check[data-input='HAND_COLOR']:visible").attr("data-excel-val");
	data["CILYNDER"] = $(".furn_detail:visible [data-input='CILYNDER']").text();
	data["ZAMOKL"] = $(".furn_detail:visible [data-input='ZAMOKL']").attr("data-excel-val");
	data["NIGG"] = $(".furn_detail:visible [data-input='NIGG']").attr("data-excel-val");
	data["NOCHNAYA"] = $(".furn_detail:visible [data-input='NOCHNAYA']").attr("data-excel-val");
	data["ZAMM"] = $(".furn_detail:visible [data-input='ZAMM']").attr("data-excel-val");
	data["DEVIATOR"] = $(".furn_detail:visible [data-input='DEVIATOR']").attr("data-excel-val");


	data["GERK"] = $(".check[data-input='GERK']").text();
	data["DOVOD"] = $(".check[data-input='DOVOD']").text();
	data["NAKL"] = $(".check[data-input='NAKL']").text();
	data["STOR"] = $(".check[data-input='STOR']").text();
	data["GLAZZ"] = $(".check[data-input='GLAZZ']").text();

	data["base_price_door"] = $("#base_price_door").text();
	data["itog_price_door"] = $("#itog_price_door").text();
	data["detailed"] = $("#detailed table").html();
	$.ajax({
		url:'/konstructor/addZayavka.php',
		type:'post',
		data:data,
		success:function(res){
			$(".addZayavka").removeClass("loading");
			window.location="/thank/";
		}
	});
}
		
function DownloadExcel() {
		$(".exelDownload").addClass("loading");
		var url = "/konstructor/send.php";
		var data = $(".resultForm").serialize();
		$.ajax({
			url:url,
			data:data,
			type:"post",
			success:function(res){
				$(".exelDownload").removeClass("loading");
				window.location = 'http://testcat.by/form/'+res;
			}
		})
}
function initializeK() {
	
	$(".check .switch_setter_img").each(function(){
		var data_id = $(this).attr("data-id");
		$(".switch_getter_img[data-id='"+data_id+"']").attr("src", $(this).attr("src"));
		reloadForm();
	})
	var regExp = /^\d+$/;
	$(".excel_setter_input").on("keyup", function(){
		if(!regExp.test($(this).val())) {
			$(this).val("");
			$(this).closest(".line").find(".check").addClass("check excel");
			$(this).removeClass("check excel");
		} else {
			$(this).attr("data-excel", $(this).closest(".line").find(".check").attr("data-excel"));
			$(this).attr("data-excel-val", $(this).val()+ " мм");
			$(this).closest(".line").find(".check").removeClass("check excel");
			$(this).addClass("check excel");
			reloadForm();
		}
		checkPrice($(this).closest(".closest_pricer"));
	})
	
	basePrice = parseInt($("#base_price_door").text());
	itogPrice = parseInt($("#itog_price_door").text());
	$("#base_price_door").text(toPrice(basePrice, true));
	$("#itog_price_door").text(toPrice(itogPrice, true));

	mini_slider('.colors_door.one', 1, 120, 5, 1,250);
	mini_slider('.colors_door.three', 1, 120, 5, 1,250);
	
	
		$('.slide_down').on('click', function() {
			var parent = $(this).closest('.furn_type');
			parent.find('.table').slideToggle(150);
			parent.toggleClass('open');
		});
		$('[data-galery]').click(function() {
			var id = $(this).attr('data-galery'),
				parent = $(this).closest('.popup');
			parent.find('[data-galery]').removeClass('curr');
			parent.find('[data-galery="'+id+'"]').addClass('curr');
			parent.find('.big img').attr('src',parent.find('[data-galery="'+id+'"] img').attr('src'));
		})


		// функционал select_list(выпадающих списков)
		$('.select_list .curr').on('click', function() {
			var parent = $(this).closest('.select_list');
			if(parent.hasClass('open')) {
				$(this).next().slideUp(150);
				parent.removeClass('open');
				return;
			}
			$('.select_list').removeClass('open').find('ul').hide();
			$(this).next().slideToggle(150);
			parent.addClass('open');
		});
		$('.select_list li').on('click', function() {
			var parent = $(this).closest('.select_list');
			var funct = parent.attr("data-f");
			parent.find('li').removeClass('selected');
			$(this).addClass('selected');
			parent.find('.curr').text($(this).attr('data-text'));

			parent.removeClass('open').find('ul').slideUp(150);
			if($(this).attr('data-value')) {
				changeList($(this).attr('data-value'), funct)
			}
			parent.find('.curr').attr("data-value", $(this).attr('data-value'));
			parent.find('.curr').attr("data-excel-val", $(this).attr('data-text'));

		});
		$(document).click(function(e){
			if($(e.target).closest(".select_list").length) return;
			$(".select_list ul").slideUp(150).closest('.select_list').removeClass('open');
		});

		// обработка переключения data-radio
		$('[data-radio]').on('click', function() {
			if($(this).closest(".disabled").length) return false;
			if($(this).find(".switch_setter_img").length) {
				var data_id = $(this).find(".switch_setter_img").attr("data-id");

				$(".switch_getter_img[data-id='"+data_id+"']").attr("src", $(this).find(".switch_setter_img").attr("src"));
			}
			if($(this).hasClass('check')) return;
			$('[data-radio="'+$(this).attr('data-radio')+'"]').removeClass('check');
			$('[data-radio="'+$(this).attr('data-radio')+'"]').removeClass('excel');
			$(this).addClass('check');
			$(this).addClass('excel');
			
			if($(this).hasClass("reloader")){
				if($(this).attr('data-value')) {
					var funct = $(this).attr("data-f");
					changeList($(this).attr('data-value'), funct)
				}
			}
			
			if($(this).closest(".switcher_set").length) {
				var sws = $(this).closest(".switcher_set");
				var closest = sws.closest(".closest_switcher");
				var id = sws.attr("data-id");
				closest.find(".switcher_get").hide();
				closest.find('.switcher_get[data-id="'+id+'"]').show();
				closest.find('.switcher_get [data-radio]').removeClass("excel");
				closest.find('.switcher_get[data-id="'+id+'"] [data-radio]').first().trigger("click");
				reloadForm();
			} 

			if($(this).attr("data-excel")){
				reloadForm();
			}
			
			if($(this).closest(".furn_type").length){
				var ft = $(this).closest(".furn_type");
				var id = ft.attr("data-toggle");
				$(".furn_detail").addClass("hidden");
				$(".furn_detail [data-excel]").removeClass("excel");
				$(id+" .check[data-excel]").addClass("excel");
				$(id).removeClass("hidden");
				reloadForm();
			}
			var pricer = $(this).closest(".closest_pricer");
			checkPrice(pricer);

		})

		// Открытия,закрытия поппапов и их биндинг
		$('[data-open]').on('click', function() {
			$($(this).attr('data-open')+',.fade2').fadeIn(0);
			$('body').css('overflow','hidden');
		});
		$('.popup .return,.fade2 .close,.fade2').on('click', function() {
			$('.popup,.fade2').fadeOut(150);
			$('body').css('overflow','auto');
		});

		//Позиционирование левого блока
		var start,end;
		function posa(top) {
			start = $('.content').offset().top - 40,
			end = $('.content').height() + start - $('.sidebar').height();
			if(top > start && top < end)  {
				 $('.sidebar').css('margin-top',top-start+'px')
			} else if(top >= end) {
				 $('.sidebar').css('margin-top',end-start+'px')
			} else {
				 $('.sidebar').css('margin-top','0px')
			}
		};
		posa($(document).scrollTop());
		$(document).scroll(function(){
			var top = $(document).scrollTop();
			posa(top);
		});
		reloadForm();
		checkAllPrice();
		hideInv();
}



var objChanger = {"MODEL":"MODELD","DOVODCHIK":"DOVOD","SIDE":"STOR","SIZE":"SHIR X VIS","COLOR":"HAND_COLOR","TOP_LOCK":"ZAMOKL","BOTTOM_LOCK":"NIGG","HANDS":"HAND","GLASS":"GLAZZ","OUTSIDE":"OUTSIDE","INSIDE":"INSIDE","DOOR_BLOCK":"BLOCK_COLOR"};
objChanger["PRIMECH"] = "GERK + NAKL + KONTUR + NABOR + NOCHNAYA";

	$(function() {
		var basePrice = 0;
		var itogPrice = 0;
		initializeK();

		 $('.print').click(function(e){
			e.preventDefault();
			var styleCss = $("#styleCss").text();
			var printing_css='<style>'+styleCss+'</style>';
			 var html_to_print=printing_css+"<div class='resultForm'>"+$('#formTableRes').html()+"</div>";
			var iframe=$('<iframe id="print_frame"></iframe>');
			$('body').append(iframe);
			var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
			var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
			doc.getElementsByTagName('body')[0].innerHTML=html_to_print;
			win.print();
			$('iframe').remove();
		});

	})
</script>