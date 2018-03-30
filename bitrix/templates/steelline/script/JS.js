function yaRequest(param) {
	if(typeof yaCounter29969184 !== 'undefined') {
		yaCounter29969184.reachGoal(param);
	}

}

function gaRequest (param) {
   if (typeof(ga) !== 'undefined') {
	ga('send', 'event', 'anchor', 'click', param);
    }
}

var lastClick = false;
$(function(){

$('[data-scroll]').click(function (e) {
    e.preventDefault();
    var end_top = $($(this).attr('data-scroll')).offset().top,
        time = Math.abs(end_top - $(this).offset().top) * 0.2 + 200;

    $('html, body').animate({
        scrollTop: end_top - 50
    }, time);
});
$('[data-change]').on('click',function() {
    var arr = $(this).attr('data-change').split(' ');
    $(arr[0]).hide();
    $(arr[1]).show();
})

$('.item .sale_price').each(function() {
	format_price($(this));
})
$('.item .price_wrap .num').each(function() {
	format_price($(this));
})
$('.item .old_price').each(function() {
	$(this).html(String($(this).html()).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1&nbsp;')+' руб.')
})

$('.js_close_banner').click(function() {
	$('.banner_top').hide();
	var d = new Date();
	d.setTime(d.getTime() + (7*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = "closed_banner=true; "+expires+"; path=/";
})
if(document.cookie.indexOf("closed_banner=true") == -1) {
	$('.banner_top').removeClass('hidden');
}


$('.download_presentation').on('click', function(e){
gaRequest('Скачал презентацию');
yaRequest('download');
});
$('.download_presentation2').on('click', function(e){
	gaRequest('Скачал презентацию Дзержинка');
});
$('.redline').on('click', function(e){
	yaRequest('krasnayaliniya');
});
$('.erip_footer_button').on('click', function(e){
	yaRequest('def_payment');
});
$('.catalog_sidebar_arrow.show').on('click', function(e){
	yaRequest('vverh');
});
$('.bl-fr2-banner').on('click', function(e){
	gaRequest('Нажали на баннер');
	yaRequest('click_banner');
});

$('input[data-valid="phone"]').mask("+375 (99) 999-99-99", {autoclear: false});


$('.scrollTop').click(function() {
	var sec = $(document).scrollTop() / 4;
	$('html, body').animate({ scrollTop: 0 }, sec);
	return false;
});

// $('.close, .fade').on('click', function() {
// 	$('.popup, .fade').fadeOut(150);
// });
$("#filter input").on("click", function(){
	$("#filter").submit();
})

 $('[data-open]').on('click', function() {
 	if($(this).hasClass("disabled")) {
 		return false;
 	}
	lastClick = false;
	if($(this).hasClass("where_buy")) {
		sh = false;
		filter_map(false);
		gaRequest("Где купить");
	} else if($(this).hasClass("salon")) {
		gaRequest("Модель представлена в салоне");
		sh = true;
		filter_map(true);

	} else if ($(this).hasClass("dont_hide_fade")) {
		lastClick = "dont_hide_fade";
		filter_map(true, SALOONS);
	}

	$($(this).attr('data-open')+',.fade2').fadeIn(0);
	$('body').css('overflow','hidden');
 });
 // $('.popup .return,.fade2 .close,.fade2,.fade').on('click', function() {
 $('.popup .return,.fade2 .close,.fade2').on('click', function() {
  $('.popup,.fade2').fadeOut(150);
  $('body').css('overflow','auto');
 });
$(document).keydown(function(e) {	
	if(e.keyCode == 27) {
		 // $('.popup,.fade2,.fade').fadeOut(150);
		 $('.popup,.fade2').fadeOut(150);
 		 $('body').css('overflow','auto');
	}
});
$(".delete_from_cart").on("click", function(e){
	e.preventDefault();
	delete_from_cart($(this).closest(".door").attr("data-id"));
})

$(".minus").on("click", function(e){
	var inp = $(this).closest(".quantity").find(".quantity_input");
	var id = inp.attr("data-id");
	if(+inp.val() > 1)
	{
		inp.val(+inp.val()-1); 
		changeQuant(id, inp.val());
	}
	
})
$(".plus").on("click", function(e){
	var inp = $(this).closest(".quantity").find(".quantity_input");
	var id = inp.attr("data-id");
	if(+inp.val() < 100)
	{
		inp.val(+inp.val()+1); 
		changeQuant(id, inp.val());
	}
	
});

$(".nolink, .nolink *").on("click", function(e) {
	e.preventDefault();
})

function changeQuant(id, quant)
{
	$.ajax({
		url:"ajax.php",
		data: {"id":id, "quantity":quant,'action':'changeQuant'},
		type:"post",
		success:function(res){
			var result = JSON.parse(res);
				$("#price_all").html(result["sum_discount"]+" руб.");
				if($("#price_old_all").length)
				$("#price_old_all").html(result["sum"]+" руб.");
			$('.js_price_gen').each(function() {
				priceGen($(this));
			})

		}
	})
}


$('.map, #header .info').click(function() {
	$('.map_popup, .fade').fadeIn(150);
});
$('.conf').click(function() {
	$('.conf_popup, .fade').fadeIn(150);
});
// $('.fade, .close').click(function() {
// 	$('.map_popup, .fade').fadeOut(150);
// });

//item
var tab = $('.tech .tab'),
	li = $('.tech .tabs li');

tab.hover(function() {
	li.removeClass('hover');
	tab.removeClass('hover');
	if($(this).attr('data-tab')){
		$('.tech .tabs li[data-tab="'+$(this).attr('data-tab')+'"]').addClass('hover');
	}
},function() {
	li.removeClass('hover');
	tab.removeClass('hover');
});

li.hover(function() {
	li.removeClass('hover');
	tab.removeClass('hover');
	if($(this).attr('data-tab')){
		$(this).addClass('hover');
		$('.tech .tab[data-tab="'+$(this).attr('data-tab')+'"]').addClass('hover');
	}
},function() {
	li.removeClass('hover');
	tab.removeClass('hover');
});

$('.colors li').hover(function() {
	$(this).closest('.colors').find('li').addClass('focus');
	$(this).removeClass('focus');
},function() {
	$(this).closest('.colors').find('li').removeClass('focus');
});

// catalog

$('.nav .not').on('click', function(e) {
	e.preventDefault();
	$(this).next().toggleClass('open');
})
$('.cart .right .img').on('click', function() {
	var big = $(this).closest('.cart').find('.left img:first-child'),
		dobor = $(this).closest('.cart').find('.left img:last-child');
	if ($(this).closest('.double').length) {
		var temp1 = big.attr('src'),
			temp2 = dobor.attr('src');
		big.attr('src',$(this).find('img').attr('src'));
		dobor.attr('src',$(this).find('img').attr('data-dobor'));
		$(this).find('img').attr('src',temp1);
		$(this).find('img').attr('data-dobor',temp2);
		return;
	}
	big.attr('src',$(this).find('img').attr('src'));
})

$('.pdf').on('click', function(e) {
	e.preventDefault();
	$('.pdf_popup, .fade').fadeIn(150);
})

$('.slider a').on('click', function(e) {
	if(!$(this).closest('div').hasClass('current')) {
		e.preventDefault();
	};
	
})

// form validater

function checker(target) {
	var name_test = /^[A-Za-zА-Яа-яЁё_-\s]+$/,
		phone_test = /^(\+375){1}(\s){1}(\(){1}(\d){2}(\)){1}(\s){1}(\d){3}(\-){1}(\d){2}(\-){1}(\d){2}$/,
		email_test = /^([a-zA-ZА-Яа-яЁё0-9_-]+\.)*[a-zA-ZА-Яа-яЁё0-9_-]+@[a-zA-ZА-Яа-яЁё0-9_-]+(\.[a-zA-ZА-Яа-яЁё0-9_-]+)*\.[a-zA-ZА-Яа-яЁё]{2,6}$/;
	switch(target.attr('name')) {
		case 'name':
			target.removeClass('error');
			target.val().length < 2 || !name_test.test(target.val()) ? 
				target.removeClass('ok').addClass('error') : target.addClass('ok');
			break;
		case 'phone':
			target.removeClass('error');
			!phone_test.test(target.val()) ? 
				target.removeClass('ok').addClass('error') : target.addClass('ok');
			break;
		case 'email':
			target.removeClass('error');
			target.val().length < 9 || !email_test.test(target.val()) ? 
				target.removeClass('ok').addClass('error') : target.addClass('ok');
			break;
	}
};
var animate_go = true;
function validate(form, animate) {
	var must = form.find('.must'),
		n = 0, m = must.length;
	must.each(function() {
		$(this).hasClass('ok') ? n++ : $(this).addClass('error');
	});
	if(animate && animate_go) {
		var err = form.find(".error");
		animate_go = false;
	    if (err.length > 0) {
	        err.each(function() {
	            $(this)
	                .animate({ left: "-12px" }, 100).animate({ left: "12px" }, 100)
	                .animate({ left: "-10px" }, 100).animate({ left: "8px" }, 100)
	                .animate({ left: "-6px" }, 100).animate({ left: "0px" }, 100,
	                	function() {animate_go = true});
	        });
	    };
	}
	return n == m ? true : false;
};

$('.validate input.must').on('keyup change', function() {
	checker($(this));
});

$('.validate').on('submit', function() {
	return $(this).hasClass('animate') ? validate($(this),true) : validate($(this),false);
});
$('.basket_new form').on('submit', function() {
	if($('.salon_select').hasClass('err')) {
		$('.salon_select').addClass('or');
		return false;
	} else {
		return validate($(this),false);
	}
})

$(".ajaxForm").on("submit", function(e){
e.preventDefault();
var $this = $(this);

var data = $(this).serialize();
var url = $(this).attr("action");
	$.ajax({
		url:url,
		data:data,
		type:"post",
		success:function(res){
			if(res == "True"){
				$this.removeClass("not_found");
				$this.removeClass("serv_err");
				$this.addClass("reuslt");
			} else if(res == "not_found") {
				$this.removeClass("serv_err");
				$this.removeClass("reuslt");
				$this.addClass("not_found");
			} else {
				$this.removeClass("not_found");
				$this.removeClass("reuslt");
				$this.addClass("serv_err");
			}
		}
	})
})

}); // end document ready

function delete_from_cart(item_id) {

	$.ajax({
		url:"/cart/ajax.php",
		data: {"id":item_id, 'action':'delete_from_cart'},
		type:"post",
		success:function(res){
			var result = JSON.parse(res);
			if(result.status) {
				if($(".door").length > 1) {
					$(".door[data-id='"+item_id+"']").next().addClass('border');
					$(".door[data-id='"+item_id+"']").remove();
					$("#price_all").html(result["sum_discount"]+" Br");
					if($("#price_old_all").length)
					$("#price_old_all").html(result["sum"]+" Br");
					posa();
				} else {
					window.location.reload();
				}
			}
		}
	})

}

function row_slider(params) {

	var parent = params.parent_query,
		li_width = params.width_element_with_margin,
		li_visible = params.number_of_visible_elements,
		speed = params.speed_of_motion,
		carret = parent.find('.js_carret'),
		li = carret.find('.js_li'),
		next = parent.find('.js_next'),
		prev = parent.find('.js_prev'),
		state = 0,
		go = true,
		x = 0;
 
	//init
	carret.css('width',li.length*li_width);
	prev.addClass('disabled');
	if( li.length <= li_visible) {
		prev.addClass('disabled');
	};

	next.on('click',function() {
		if( go ) { 
			var rest = li.length - state - li_visible;
			go = false;
			prev.removeClass('disabled');
			if( rest <= li_visible) {
				x = rest*li_width;
				state += rest ;
				next.addClass('disabled');
			} else { 
				x = li_visible*li_width;
				state += li_visible;
			};
			carret.animate({'margin-left':'-='+x+'px'},(x*0.4+200),function() {go = true});
		};
	});
	
	prev.on('click',function() {
		if( go ) {
			go = false;
			next.removeClass('disabled');
			if(state <= li_visible) {
				x = state*li_width;
				state = 0;
				prev.addClass('disabled');
			} else {
				x = li_visible*li_width;
				state -= li_visible;
			};
			carret.animate({'margin-left':'+='+x+'px'},(x*0.4+200),function() {go = true});
		};
	});
};

function mini_slider(selector, row, x, col_viz, col_scroll, speed) { 
	var i = 1;
	var go = true;
	var num = $(selector+' li').length;

	var n = Math.ceil(((num/row - col_viz)/col_scroll))+1;
	$(selector+' ul').css('width', num*(x/row));
	$(selector+' .control.prev').hide();
	if(num <= col_viz*row){ 
		$(selector+' .control.next').hide();
	}
	$(selector+' .control').on('click', function() {
		if($(this).hasClass('next') && i < n && go) {
			go = false;
			$(selector+' ul').animate({"margin-left": "-="+x*col_scroll+"px"}, col_scroll*speed, function(){return go = true });
			$(selector+' .control.prev').show();
			i++;
			if(i==n) {$(selector+' .control.next').hide();}
		};
		if($(this).hasClass('prev') && i > 1 && go) {
			go = false;
			$(selector+' ul').animate({"margin-left": "+="+x*col_scroll+"px"}, col_scroll*speed, function(){return go = true }); 
			$(selector+' .control.next').show();
			i--;
			if(i==1) {$(selector+' .control.prev').hide();}
		};
	});
}

function Galery(opt) {
	var control = $(opt[0]).find(opt[1]),
		scrn = $(opt[0]).find(opt[2]),
		popup = $(opt[0]).find(opt[3]),
		prev_pop = popup.find(opt[4]),
		next_pop = popup.find(opt[5]),
		close = popup.find(opt[6]),
		fade = $(opt[7]),
		data = opt[9],
		pop_img = popup.find('img'),
		arr_data = [], n, go = true;
	
	function close_body(e) {
		// console.log(e.target);
		if (!e.target.classList.contains('uncl')) {
			close_down();
		}
	}
	function init() {
		scrn.each(function(i) {
			arr_data.push($(this).find('img').attr(data));
		});
	};
	function resize(w,h) {
		popup.width(w).height(h);
		setTimeout(function() {
			pop_img.fadeIn(100);
			go = true;
		},300)
	};
	function open(target) {
		pop_img.attr('src', target.attr(data)).hide();
		pop_img.get(0).onload = function() {
		  	resize(pop_img.width(),pop_img.height());
		}
		popup.fadeIn(250).addClass('open');
		fade.fadeIn(250);

		document.body.addEventListener('click', close_body);
	};
	function close_down() {
		popup.hide().removeClass('open');
		fade.fadeOut(250);
		pop_img.attr('src', '');

		document.body.removeEventListener('click', close_body);
	};
	function prev() {
		if(go) {
			go = false;
			n = arr_data.indexOf(pop_img.attr('src'));
			n < 1 ? n = (arr_data.length-1) : n--;
			pop_img.attr('src',arr_data[n]).hide();
			pop_img.get(0).onload = function() {
				resize(pop_img.width(),pop_img.height());
			}
		}
	};
	function next() {
		if(go) {
			go = false;
			n = arr_data.indexOf(pop_img.attr('src'));
			n == (arr_data.length-1) ? n = 0 : n++;
			pop_img.attr('src',arr_data[n]).hide();
			pop_img.get(0).onload = function() {
				resize(pop_img.width(),pop_img.height());
			}
		}
	};
	//handlers
	$(document).keydown(function(e) {
		if(e.keyCode == 37) {
			prev();
		} else if(e.keyCode == 39) {
			next();
		} else if(e.keyCode == 27) {
			close_down();
		}
	});
	scrn.click(function() {
		open($(this).find('img'));
	});
	prev_pop.click(function() {
		prev();
	});
	next_pop.click(function() {
		next();
	});
	fade.on('click', function() {
		close_down();
	});
	close.on('click', function() {
		close_down();
	});
	init();
};

var turn_add = {};
var can_add = true;
function addToBasked(id)
{

	if(!can_add) {
		turn_add[id] = id;
		return false;
	}
	if(turn_add[id]){
		delete turn_add[id];
	};
	can_add = false;
	var url = "/ajax.php";
	var quantity = $("#input_"+id).val();
	var data = {"action":"MOD2BASKET","id":id,"quantity": quantity};
	$.ajax({
		url:url,
		data:data,
		success:function(res){
			can_add = true;
			var attr = LastKeyVal(turn_add);
			if(attr){
				addToBasked(attr);
			} else {
				var ind = (res.lastIndexOf('{"TOTAL_COUNT'));
				var ind2 = (res.lastIndexOf('</div>'));
				var str2 = res.substring(ind,ind2);
				var result = JSON.parse(str2);
				// reloadRes(result);
			}
		}
	});
}

var turn_rem = {};
var can_remove = true;
function removeFromBasked(id)
{
	if(!can_remove) {
		turn_rem[id] = id;
		return false;
	}
	if(turn_rem[id]){
		delete turn_rem[id];
	};
	can_remove = false;
	var url = "/ajax.php";
	var data={'action':'deleteFromCart', 'id':id};
	$.ajax({
		url:url,
		data:data,
		success:function(res){
			can_remove = true;
			var attr = LastKeyVal(turn_rem);
			if(attr){
				removeFromBasked(attr);
			} else {
				var ind = (res.lastIndexOf('{"TOTAL_COUNT'));
				var ind2 = (res.lastIndexOf('</div>'));
				var str2 = res.substring(ind,ind2);

				var result = JSON.parse(str2);
				reloadRes(result);
			}
		}
	});
}

function classFunct(element, value){
	if(!value) return;
	if(element.indexOf("class"))
	{
		var actions = element.substring(element.indexOf("_class"));
		var el = document.getElementById(element.replace(actions,""));

		if(actions.indexOf("add"))
		{
			if(el.classList.contains(value)) return;
			el.ClassList.add(value);
		} else if(actions.indexOf("remove")) {
			if(el.classList.contains(value)){
			el.ClassList.remove(value);
			}
		} else if(actions.indexOf("toggle")) {
			el.ClassList.toggle(value);
		}
	}

}

function typeFunct(element, value)
{
	if(element.indexOf("class") > 0)
	{
		classFunct(element, value);
	} else {
		var el;
		if(el = document.getElementById(element))
		{
			switch(el.tagName)
			{
				case "INPUT":
					el.value = value;
					break;
				case "TEXTAREA":
					el.value = value;
					break;
				case "IMG":
					el.src = value;
					break;
				default:
					el.innerHTML = value;
			}
		}
	}
}

function LastKeyVal(obj) {
    var ret = 0;
    ret = obj[Object.keys(obj)[Object.keys(obj).length - 1]];
    return ret;
};

function reloadRes(result){
	for(var i in result)
	{
		typeFunct(i, result[i]);
	}
	refreshData();
}

function refreshData()
{

	$(".change_getter").each(function(){
		var val_set = $(".change_setter#"+$(this).attr("data-id")).val();
		$(this).html(val_set);
	});
	checkBasket();
}

function checkBasket(){
	var cnt = parseInt($("#TOTAL_COUNT_POS").val());
	if($('.basket').length) {
		if(cnt==0) {
			$('#end_but').attr('disabled',true);
		} else {
			$('#end_but').removeAttr('disabled',false);
		}
	}
	var classText = "in_basket";
	if(cnt > 0)
	{
		classText += " count";
	}
	$(".in_basket").each(function(){
		$(this).attr("class", classText);
	})
}

function formatPrice(price)
{
	return String(price).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1 ');
}

function changeQuantSklad(kuda,id) {
	var input = $("#input_"+id),
		max = 9999,
		min = input.attr('data-min') ? parseInt(input.attr('data-min')) : 0,
		num = /[^\d]/;
		if(num.test(input.val())||!input.val()) {
		  	input.val(min);
		};
		var val = input.val();
	if(kuda == 'up' && val < max ) {
	    input.val(++val);
	 } else if(kuda == 'down' && val > min) { 
	    input.val(--val);
	 }
	var sumField =  $("#sum_"+id);
	var price_one = sumField.attr('data-num');
	var resPrice = price_one * val;

	sumField.text(formatPrice(resPrice));

		if (val <= 0)
		removeFromBasked(id);
		else 
		addToBasked(id);
}

function Popup() {
	var fade = $('.fade'),
		popup = $('.popup'),
		trigg = $('[data-popup]'),
		close_area = $('.popup .close, .fade,.fade2');

	function open(trigg) {
		//$('body').css('overflow','hidden');
		$(trigg.attr('data-popup')).show(0,function() {
			$(this).addClass('opened');
		});
		fade.fadeIn(150);
	};

	function close() {
		fade.fadeOut(150);
		popup.removeClass('opened');
		setTimeout(function() {
			popup.hide();
		},150);
		//$('body').css('overflow','auto');
	};

	trigg.on('click', function() {
		open($(this));
	});
	close_area.on('click', function() {
		close();
	});
	$(document).keydown(function(e) {
		if(e.keyCode == 27) {
			close();
		}
	});
};

var DammSlider = function(param) {

	var delta = 160,
		delta_left = $(document).width()+'px',
		pos_default = {'top':'-'+$(document).height()-delta+'px','left':'0'},
		pos_left = {'top':'0','left':'-'+delta_left},
		pos_right = {'top':'0','left':delta_left},
		pos_curr = {'top':'0','left':'0'},
		slide = param.query.find('.slide'),
		curr = param.start_slide,
		ctrl = param.query.find('.control'),
		nav = param.query.find('.navigation'),
		trigger = true;

	function init() {
		slide.css(pos_default).eq(curr).addClass('curr').css(pos_curr);
		for (var i = 0; i < slide.length; i++) {
			$('<li></li>').appendTo(nav);
		};
		nav.find('li').each(function(i) {
			$(this).attr('data-num',i);
		});
		nav.find('li').eq(curr).addClass('curr');
	};

	function move(curr_slide,next_slide,invert) {
		if (trigger) {
			trigger = false;
			if (invert) {
				if (curr_slide > next_slide) {
					slide.removeClass('curr').eq(next_slide).addClass('curr').css(pos_right).animate({left:'0'},param.speed);
					slide.eq(curr_slide).animate({left:'-'+delta_left},param.speed,function(){trigger = true;});
				} else {
					slide.removeClass('curr').eq(next_slide).addClass('curr').css(pos_left).animate({left:'0'},param.speed);
					slide.eq(curr_slide).animate({left:delta_left},param.speed,function(){trigger = true;});
				};
				curr = next_slide;
			} else {
				if (curr_slide < next_slide) {
					slide.removeClass('curr').eq(next_slide).addClass('curr').css(pos_right).animate({left:'0'},param.speed);
					slide.eq(curr_slide).animate({left:'-'+delta_left},param.speed,function(){trigger = true;});
				} else {
					slide.removeClass('curr').eq(next_slide).addClass('curr').css(pos_left).animate({left:'0'},param.speed);
					slide.eq(curr_slide).animate({left:delta_left},param.speed,function(){trigger = true;});
				};
				curr = next_slide;
			}
			return true;
		}
		return false;
	};

	init();

	nav.find('li').on('click',function() {
		if ($(this).hasClass('curr')) return;
		if( move(curr,parseInt($(this).attr('data-num'))) ) {
			nav.find('li').removeClass('curr');
			$(this).addClass('curr');
		};
	});

	function controller(type) {
		if(type) {
			if(curr == slide.length-1) {
				var next = 0;
				move(curr,next,true);
			} else {
				var next = curr + 1;
				move(curr,next,false);
			}
		} else {
			if(curr == 0) {
				var next = slide.length-1;
				move(curr,next,true);
			} else {
				var next = curr - 1;
				move(curr,next,false);
			}
		}
		nav.find('li').removeClass('curr');
		nav.find('[data-num="'+next+'"]').addClass('curr');
	};

	ctrl.on('click',function() {
		if($(this).hasClass('next')) {
			controller(true);
		} else {
			controller();
		}
	});

	$(document).keydown(function(e) {
		if(e.keyCode == 39) {
			controller(true);
		} else if(e.keyCode == 37) {
			controller();
		};
	});

};

function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
} catch (e) {
    return false;
  }
}

var cnt_wins;
var inThatTime = true;

function showModalWindow(nowTS, lastUpd) {

	$('.NY_popup,.fade').fadeIn(100);

	setTimeout(function() {
		will_show();
		$('.NY_popup,.fade').fadeOut(100);
	},30000);
	
	function will_show() {
		localStorage.setItem("cheshire_will_show", 
			$('.NY_popup label input').get(0).checked ? false : true);
	};
	$('.NY_popup .close, .fade').on('click', function() {
		will_show();
		$('.NY_popup,.fade').fadeOut(100);
	})
}

dateObj = new Date(2016, 3, 1);
var itsTime = ((Date.now() - dateObj.getTime()) < 0);

if(itsTime && supports_html5_storage() && localStorage.getItem("cheshire_will_show") !== "false") {
	function refreshLS() {
		var nowTS = Date.now();
		var lastUpd = localStorage.getItem("cheshire_by_lastUpd") ? localStorage.getItem("cheshire_by_lastUpd") : 0;
		localStorage.setItem("cheshire_by_lastUpd", nowTS);
		if((nowTS - lastUpd > 24 * 60 * 60 * 1000 && inThatTime) || lastUpd == 0) {
			showModalWindow(nowTS, lastUpd);
		}
	}

	setInterval(function() {refreshLS();}, 1000);
} 

if(!Date.now) {
    Date.now = function() { return new Date().getTime(); }
}

$(function() {
	$('.js_price_gen').each(function() {
		priceGen($(this));
	})
})

function priceGen(parent) {
return;
	var newPrice = parent.find('.js_denomination_price'),
		oldPrice = parent.find('.js_old_denomination_price'),
		reg = /(\d)(?=(\d{3})+([^\d]|$))/g,
		num = +String(oldPrice.text()).replace(/[^\d.,]/g, '');

	newPrice.html(String(num.toFixed(1)).replace(reg, '$1&thinsp;').replace(/\./g, ','));
};

function denominator(target,brackets) {
	
	if(target.find('.new_rub').length) return;

    var price = +String(target.text()).replace(/[^\d.,]/g, ''),
        reg = /(\d)(?=(\d{3})+([^\d]|$))/g,
        oldPriceEl = $('<span class="old_rub"></span>'),
        newPriceEl = $('<span class="new_rub"></span>'),
        htmlOld = String(price).replace(reg, '$1&thinsp;')+' руб.';

    if(price) {
        target.html('');
        if (brackets) {
            htmlOld = '('+htmlOld+')';
        } 
        oldPriceEl.appendTo(target).html(htmlOld);
        newPriceEl.prependTo(target).html(String((price).toFixed(1))
            .replace(reg, '$1&thinsp;').replace(/\./g, ',')+' руб.');
    }
    
};

function row_slider(params) {

    var parent = params.parent_query,
        li_width = params.width_element_with_margin,
        li_visible = params.number_of_visible_elements,
        speed = params.speed_of_motion,
        carret = parent.find('.js_carret'),
        li = carret.find('.js_li'),
        next = parent.find('.js_next'),
        prev = parent.find('.js_prev'),
        state = 0,
        go = true,
        x = 0;

    //init
    carret.css('width', li.length * li_width);
    prev.addClass('disabled');
    if (li.length <= li_visible || (li.length * li_width - parseInt(li.css("margin-right")))<= parent.find(".slides_wrap").width()) {
        next.addClass('disabled');
        return;
    };

    next.on('click', function () {
        if (go) {
            var rest = li.length - state - li_visible;
            go = false;
            prev.removeClass('disabled');
            if ((rest * li_width) - parseInt(li.css("margin-right")) <= parent.find(".slides_wrap").width()) {
            	next.addClass('disabled');
            }
            if (rest <= li_visible) {
                x = rest * li_width;
                state += rest;
                next.addClass('disabled');
            } else {
                x = li_visible * li_width;
                state += li_visible;
            }
            ;
            carret.animate({'margin-left': '-=' + x + 'px'}, (x * 0.4 + 200),
                    function () {
                        go = true
                    });
        };
    });

    prev.on('click', function () {
        if (go) {
            go = false;
            next.removeClass('disabled');
            if (state <= li_visible) {
                x = state * li_width;
                state = 0;
                prev.addClass('disabled');
            } else {
                x = li_visible * li_width;
                state -= li_visible;
            }
            ;
            carret.animate({'margin-left': '+=' + x + 'px'}, (x * 0.4 + 200),
                    function () {
                        go = true
                    });
        };
    });
};
function Validator() {
    var params = [
        'js_validate',
        'data-valid',
        'data-valid-min',
        'js_class_valid',
        'js_invalid_animate',
        'error',
        'ok'
    ],
    forms = $('.' + params[0]),
    fields = forms.find('[' + params[1] + ']'),
    animate_stopper = true,
    regulars = {
        name: /^[A-Za-zА-Яа-яЁё_-\s]+$/,
        phone: /^(\+375){1}(\s){1}(\(){1}(\d){2}(\)){1}(\s){1}(\d){3}(\-){1}(\d){2}(\-){1}(\d){2}$/,
        email: /^([a-zA-ZА-Яа-яЁё0-9_-]+\.)*[a-zA-ZА-Яа-яЁё0-9_-]+@[a-zA-ZА-Яа-яЁё0-9_-]+(\.[a-zA-ZА-Яа-яЁё0-9_-]+)*\.[a-zA-ZА-Яа-яЁё]{2,6}$/,
        number: /^\d+$/
    };
    var fieldCount = 0;
    function worker(exp, field_wrap) {
        field_wrap.removeClass(params[5]);
        exp ?
                field_wrap.removeClass(params[6]).addClass(params[5]) :
                field_wrap.addClass(params[6]);
    };

    function check_reg(field) {
        var field_wrap, min;

        field.attr(params[2]) ?
                min = (field.val().length < field.attr(params[2])) : min = false;

        field.hasClass(params[3]) ?
                field_wrap = field : field_wrap = field.closest('.' + params[3]);

        switch (field.attr(params[1])) {
            case 'name':
                worker(min || !regulars.name.test(field.val()), field_wrap);
                break;
            case 'phone':
                worker(min || !regulars.phone.test(field.val()), field_wrap);
                break;
            case 'email':
                worker(min || !regulars.email.test(field.val()), field_wrap);
                break;
            case 'number':
                worker(min || !regulars.number.test(field.val()), field_wrap);
                break;
            case 'all':
                worker(min, field_wrap);
                break;
        }

 		enableButton();
    };

    function validate_cool(form) {
        var input = form.find('.' + params[3]),
                submit = true;

        input.each(function () {
            if ($(this).hasClass(params[5])) {
                return submit = false;
            }
        });

        if (form.hasClass(params[4]) && animate_stopper) {
            animate_stopper = false;
            input.each(function () {
                if ($(this).hasClass(params[5])) {
                    $(this)
                            .animate({left: "-12px"}, 100).animate({left: "12px"}, 100)
                            .animate({left: "-10px"}, 100).animate({left: "8px"}, 100)
                            .animate({left: "-6px"}, 100).animate({left: "0px"}, 100, function () {
                        animate_stopper = true;
                    });
                }
            });
        };

        return submit;
    };

    

    fields.on('focus', function () {
    	$(this).parent().removeClass("error ok");
    });
    fields.on('keyup', function () {
    	if($(this).data("valid") == "name" && $(this).val().length>=2 || $(this).data("valid") == "phone" && parseInt($(this).val().slice(18))>=0 || $(this).attr('id') == "happy_client_description" && $(this).val().length>=5){
    		check_reg($(this));
    	}
    });
    $(".js_class_valid .photo_way").on("change", function() {
    	check_reg($(this));
    });

    // fields.on('keyup', function () {
    //     check_reg($(this));
    // });

    fields.on('change, blur', function () {
    	if($(this).val() != "" /*&& $(this).data("valid") == "name"*/) {
    		check_reg($(this));	
    	 } else {
            $(this).parent().removeClass("error ok");
         }//else if ($(this).data("valid") != "name"){
    	// 	check_reg($(this));
    	// }
    	enableButton();
    });

    forms.on('submit', function (e) {
        $(this).find('[' + params[1] + ']').each(function () {
            check_reg($(this));
        });
        return validate_cool($(this));
    })
};
function enableButton() {
	if($(".js_class_valid").length == $(".js_class_valid.ok").length) {
    	$('button[type="submit"], button.send_button, input[name="send_form"]').removeClass('disabled');

    	/***  New FORM dis  ***/
    	var submit = document.querySelector('.c-form__submit');
    	if (submit)	submit.classList.remove('c-b-but--disabled');
    	

    } else if (!$('button[type="submit"]').hasClass("disabled") || !$('input[name="send_form"]').hasClass("disabled")) {
    	$('button[type="submit"], button.send_button, input[name="send_form"]').addClass('disabled');

    	/***  New FORM dis  ***/
    	var submit = document.querySelector('.c-form__submit');
    	if (submit) submit.classList.add('c-b-but--disabled');

    };
}
$("form.js_validate input:not([type='button']), form.js_validate textarea, form.js_validate  textarea").on("blur", function() {
	if($(this).val() && !$(this).parents("p, div").hasClass("js_class_valid"))
	$(this).parent("p, div").addClass("ok");
});

$("form.js_validate p:not(.js_class_valid) input:not([type='button']), form.js_validate p:not(.js_class_valid) textarea, form.js_validate div.field:not('.js_class_valid') textarea, form.js_validate div.c-form__field-main:not(.js_class_valid) input:not([type='button']), form.js_validate div.c-form__field-main:not(.js_class_valid) textarea").on("focus", function() {
	$(this).parent("p, div").removeClass("ok");
});
function cart_app(door_id) {
        door_id = door_id ? door_id : 0;
	var galery = $('.js_galery'),
		prev = galery.find('.js_prev'),
		next = galery.find('.js_next'),
		flip = galery.find('.js_flip'),
		front_img = galery.find('.js_front img'),
		back_img = galery.find('.js_back img'),
		door = $('[data-door]'),
		tables = $('.js_tables'),
		setter_info = $('.js_info_setter'),
		setter_img_front = $('.js_front_setter'),
		setter_img_back = $('.js_back_setter'),
		setter_inf_front = $('.js_front_setter_inf'),
		setter_inf_back = $('.js_back_setter_inf'),
		turn = $('.js_turn'),
		setter_price_sale = $('.js_price_sale'),
		setter_price = $('.js_price'),
		setter_old_price = $('.js_old_price'),
		setter_width = $('.js_width');
		tabs = $('.js_tabs_block'),
		fix = $('.js_fix'),
		buy = $('.js_buy'),
		reg = /(\d)(?=(\d{3})+([^\d]|$))/g,
		side = true,
		num = 0,
		anime = 0;

	door.on('click', function() {
		var price = +String($(this).attr('data-price')).replace(/[^\d.,]/g, ''),
			imgs = $(this).find('.js_img'),
			info = $(this).find('.js_info').html(),
			inf_front = $(this).find('.js_out').html(),
			inf_back = $(this).find('.js_in').html(),
			href = $(this).attr('data-href');
			doorWidth = $(this).attr('data-width');

		var credits = $('span.credit');
		if (credits.length > 0) {
			credits.each(function(i, item) {
				// $(item).fadeOut(100, function() {
				// 	this.innerHTML = ' &mdash; от ' + Math.floor(price / item.getAttribute('data-credit')) + ' руб.';
				// 	$(this).fadeIn(200);
				// });

				item.innerHTML = item.getAttribute('data-card') + ' &mdash; от ' + Math.ceil(price / item.getAttribute('data-credit')) + ' руб.';
			})
		}

		if ($(this).attr('data-price-sale')) {
			$(".cool_item .main_info .salons.carts").addClass("hidden");
			$(".cool_item .main_info .salons.manager_contact_info").addClass("move_down");
			$(".cool_item .main_info .salons.carts_message").removeClass("hidden");
			$(".cool_item .manager_call").addClass('sale');
			var price_sale =+String($(this).attr('data-price-sale'));
			$('.js_price_wrap').addClass('sale');
			setter_price_sale.html(String((price_sale).toFixed(1))
            .replace(reg, '$1&nbsp;').replace(/\./g, ','));
            setter_old_price.html(String(price_sale).replace(reg, '$1&nbsp;')+' руб.');
            if(navigator.userAgent.indexOf('Mac') > 0) {
            	$(".cool_item .fix .right .sale_price").addClass("mac-os");
            }
		} else {
			$('.js_price_wrap').removeClass('sale');
			$(".cool_item .main_info .salons.carts").removeClass("hidden");
			$(".cool_item .main_info .salons.manager_contact_info").removeClass("move_down");
			$(".cool_item .main_info .salons.carts_message").addClass("hidden");
			$(".cool_item .manager_call").removeClass('sale');
			setter_old_price.html(String(price).replace(reg, '$1&nbsp;')+' руб.');
		}

		if(doorWidth){
			setter_width.text(doorWidth);
		}
		door.removeClass('active');
		num = $(this).attr('data-door');
		$('[data-door="'+num+'"]').addClass('active');
		tables.find('[data-num]').hide();
		tables.find('[data-num="'+num+'"]').show();


		flip.fadeOut(anime,function() {
			front_img.attr('src',imgs.eq(0).attr('src')).closest('.js_img');
			back_img.attr('src',imgs.eq(1).attr('src')).closest('.js_img');
			flip.fadeIn(anime);
			anime = 220;
		});
		
		setter_info.html(info);
		setter_img_front.attr('src',imgs.eq(0).attr('src'));
		setter_img_back.attr('src',imgs.eq(1).attr('src'));
		setter_inf_front.html(inf_front);
		setter_inf_back.html(inf_back);
		buy.attr('href',href);

		
		setter_price.html(String((price).toFixed(1))
            .replace(reg, '$1&nbsp;').replace(/\./g, ','));
		
	});
	
	if(door.length === 2) {
		next.hide();
		prev.hide();
	}
	tables.find('[data-num]').hide();
	tables.find('[data-num="0"]').show();
        if($("[data-offerId='"+door_id+"']").length) {
            $("[data-offerId='"+door_id+"']").trigger('click');
        } else {
            door.eq(0).trigger("click");
        }
        
        flip.find('.js_back').hide(); 
        	
	
	

	flip.on('click', function() {
		if(side) {
			flip.find('.js_front').fadeOut(120,function() {
				flip.find('.js_back').fadeIn(120);
				side = false;
				turn.text('снаружи');
			});
		} else {
			flip.find('.js_back').fadeOut(120,function() {
				flip.find('.js_front').fadeIn(120);
				side = true;
				turn.text('внутри');
			});
		}
	});

	next.on('click', function() {
		num == door.length/2 - 1 ? num = 0 : num++;
		$('[data-door="'+num+'"]').eq(0).trigger('click');
	})
	prev.on('click', function() {
		num == 0 ? num = door.length/2 - 1 : num--;
		$('[data-door="'+num+'"]').eq(0).trigger('click');
	})

	tabs.each(function() {
		for_tabs($(this));
	})

	$(document).trigger('scroll');

	$(document).scroll(function(){
		if ($('.c-concept').length > 0) {return;}
		var top = $(document).scrollTop(),
			// stop = $('.js_row_slider').offset().top - $(window).height()-60;
			stop = $('.cool_item_reviews').offset().top - $(window).height()-70;

		top>=stop ? fix.addClass('stop').css('bottom',$('.cool_clones_container').outerHeight()+$('.cool_item_reviews').outerHeight() +220) : fix.removeClass('stop').css('bottom', '0');
	})

	$('.js_row_slider .sale_price').each(function() {
		format_price($(this));
	})
	$('.js_row_slider .price_wrap .num').each(function() {
		format_price($(this));
	})

};
function format_price(el) {
	var str = +String(el.html()).replace(/[^\d.,]/g, ''),
		reg = /(\d)(?=(\d{3})+([^\d]|$))/g,
		newStr = String((str).toFixed(1))
            .replace(reg, '$1&nbsp;').replace(/\./g, ',');

    el.html(newStr);
    if(navigator.userAgent.indexOf('Mac') > 0) {
        $(el).addClass("mac-os");
    }
};

function for_tabs(tabs) {
	var control = tabs.find('.js_control [data-tab]'),
		scrn = tabs.find('.js_screen');

	scrn.find('[data-tab]').hide();
	scrn.find('[data-tab="'+$('.js_control .active').attr('data-tab')+'"]').show();
	control.on('click', function() {
		control.removeClass('active');
                gaRequest($(this).text());
		$(this).addClass('active');
		scrn.find('[data-tab]').hide();
		scrn.find('[data-tab="'+$(this).attr('data-tab')+'"]').show();
	})
};

function ctrl_offer(q,bool) {
	bool ? $(q).fadeIn(150) : $(q).fadeOut(150);
};

function super_offer() {
	var close = $('.super_offer .close, a.red_but');

	close.on('click', function() {
		var papa = $(this).closest('.super_offer'),
			id = papa.attr('id'),
			data = {id:id};

		papa.fadeOut(150);
		$.ajax({
			url:'/request/reject.php',
			data:data,
			type:"post",
			success:function(res){
				
			}
		});
	})
};

function thanks_offer() {
	$('#offer_10 .inner').hide();
	$('#offer_10 .thanks').show();
}
$(window).load(function() {
	var d = new Date();
	if(d.getHours()<10 || d.getHours()>=18) {
		$(".b24-widget-button-icon-container").addClass('night');
	} else {
		$(".b24-widget-button-icon-container").removeClass('night');
	}
})


Array.prototype.forEach.call(document.querySelectorAll('.furn-trig'), function(item) {
	var triggers = item.querySelectorAll('.furn-trig__act'),
			prices   = item.querySelectorAll('.furn-trig__price'),
			content  = item.querySelector('.furn-trig__content');

	for (var i = 0; i < triggers.length; i++) {
		triggers[i].addEventListener('click', function() {
			if (this.classList.contains('active')) return;

			for (var i = 0; i < triggers.length; i++) {
				triggers[i].classList.toggle('active');
				prices[i].classList.toggle('active');
			}

			content.classList.toggle('active');
		})
	}
	console.log(triggers, prices, content);
});