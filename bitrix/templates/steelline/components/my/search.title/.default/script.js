function JCTitleSearch(arParams)
{
	var _this = this;

	this.arParams = {
		'AJAX_PAGE': arParams.AJAX_PAGE,
		'CONTAINER_ID': arParams.CONTAINER_ID,
		'INPUT_ID': arParams.INPUT_ID,
		'MIN_QUERY_LEN': parseInt(arParams.MIN_QUERY_LEN)
	};
	if(arParams.WAIT_IMAGE)
		this.arParams.WAIT_IMAGE = arParams.WAIT_IMAGE;
	if(arParams.MIN_QUERY_LEN <= 0)
		arParams.MIN_QUERY_LEN = 1;

	// this.cacheSessionStorage = window.sessionStorage.getItem('cache');
	this.cache = [];

	// if (this.cacheSessionStorage) {
	// 	var arr = this.cacheSessionStorage.split(',,,');
	// 	console.log(arr.length);
	// 	for (var i = 0; i < arr.length; i++) {
	// 		var res = arr[i].split('===');
	// 		this.cache[res[0]] = res[1];
	// 	}
	// }

	// console.log(this.cache);

	this.cache_key = null;

	this.startText = '';
	this.currentRow = -1;
	this.RESULT = null;
	this.CONTAINER = null;
	this.INPUT = null;
	this.WAIT = null;

	this.RES     = document.getElementById('search-res'); 
	this.RESNULL = document.getElementById('search-null');
	this.LOADER  = document.getElementById('search-loader');

	this.LOADERTIMER;

	this.ShowResult = function(result)
	{
		var pos = BX.pos(_this.CONTAINER);
		// pos.width = pos.right - pos.left;
		// _this.RESULT.style.position = 'absolute';
		// _this.RESULT.style.top = (pos.bottom + 2) + 'px';
		// _this.RESULT.style.left = pos.left + 'px';
		// _this.RESULT.style.width = pos.width + 'px';
		if(result != null)
			_this.RESULT.innerHTML = result;
			_this.RESNULL.style.display = 'none';
		if(_this.RESULT.innerHTML.length > 0) {
			_this.RESULT.style.display = 'block';
			_this.RESNULL.style.display = 'none';
		}
		else {
			_this.RESULT.style.display = 'none';
			_this.RESNULL.style.display = 'block';
		}

		//ajust left column to be an outline
		var th;
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'justified_container search_items__wrap'}, true);
		if(tbl) th = BX.findChild(tbl, {'tag':'th'}, true);
		if(th)
		{
			var tbl_pos = BX.pos(tbl);
			tbl_pos.width = tbl_pos.right - tbl_pos.left;

			var th_pos = BX.pos(th);
			th_pos.width = th_pos.right - th_pos.left;
			th.style.width = th_pos.width + 'px';

			_this.RESULT.style.width = (pos.width + th_pos.width) + 'px';

			//Move table to left by width of the first column
			_this.RESULT.style.left = (pos.left - th_pos.width - 1)+ 'px';

			//Shrink table when it's too wide
			if((tbl_pos.width - th_pos.width) > pos.width)
				_this.RESULT.style.width = (pos.width + th_pos.width -1) + 'px';

			//Check if table is too wide and shrink result div to it's width
			tbl_pos = BX.pos(tbl);
			var res_pos = BX.pos(_this.RESULT);
			if(res_pos.right > tbl_pos.right)
			{
				_this.RESULT.style.width = (tbl_pos.right - tbl_pos.left) + 'px';
			}
		}

		var fade;
		if(tbl) fade = BX.findChild(_this.RESULT, {'class':'title-search-fader'}, true);
		if(fade && th)
		{
			res_pos = BX.pos(_this.RESULT);
			fade.style.left = (res_pos.right - res_pos.left - 18) + 'px';
			fade.style.width = 18 + 'px';
			fade.style.top = 0 + 'px';
			fade.style.height = (res_pos.bottom - res_pos.top) + 'px';
			fade.style.display = 'block';
		}
		$('#search_result li').hover(function() {
			var src = $(this).find('img').attr('src');
			$('#search_result .foto img').attr('src',src);
			$('#search_result .foto').show();
		},function() {
			$('#search_result .foto').hide();
		});
	}

	this.onKeyPress = function(keyCode)
	{
		// _this.RESNULL.style.display = 'none';
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'justified_container search_items__wrap'}, true);
		if(!tbl)
			return false;

		var cnt = tbl.rows.length;

		switch (keyCode)
		{
		case 27: // escape key - close search div
			_this.RESULT.style.display = 'none';
			_this.currentRow = -1;
			_this.UnSelectAll();
		return true;

		case 40: // down key - navigate down on search results
			if(_this.RESULT.style.display == 'none')
				_this.RESULT.style.display = 'block';

			var first = -1;
			for(var i = 0; i < cnt; i++)
			{
				if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
				{
					if(first == -1)
						first = i;

					if(_this.currentRow < i)
					{
						_this.currentRow = i;
						break;
					}
					else if(tbl.rows[i].className == 'title-search-selected')
					{
						tbl.rows[i].className = '';
					}
				}
			}

			if(i == cnt && _this.currentRow != i)
				_this.currentRow = first;

			tbl.rows[_this.currentRow].className = 'title-search-selected';
		return true;

		case 38: // up key - navigate up on search results
			if(_this.RESULT.style.display == 'none')
				_this.RESULT.style.display = 'block';

			var last = -1;
			for(var i = cnt-1; i >= 0; i--)
			{
				if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
				{
					if(last == -1)
						last = i;

					if(_this.currentRow > i)
					{
						_this.currentRow = i;
						break;
					}
					else if(tbl.rows[i].className == 'title-search-selected')
					{
						tbl.rows[i].className = '';
					}
				}
			}

			if(i < 0 && _this.currentRow != i)
				_this.currentRow = last;

			tbl.rows[_this.currentRow].className = 'title-search-selected';
		return true;

		case 13: // enter key - choose current search result
			if(_this.RESULT.style.display == 'block')
			{
				for(var i = 0; i < cnt; i++)
				{
					if(_this.currentRow == i)
					{
						if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
						{
							var a = BX.findChild(tbl.rows[i], {'tag':'a'}, true);
							if(a)
							{
								window.location = a.href;
								return true;
							}
						}
					}
				}
			}
		return false;
		}

		return false;
	}

	this.onTimeout = function()
	{
		_this.onChange(function(){
			setTimeout(_this.onTimeout, 500);
		});
	}

	this.onChange = function(callback)
	{
		

		if(_this.INPUT.value != _this.oldValue && _this.INPUT.value != _this.startText)
		{
			_this.oldValue = _this.INPUT.value;
			if(_this.INPUT.value.length >= _this.arParams.MIN_QUERY_LEN)
			{
				_this.cache_key = _this.arParams.INPUT_ID + '|' + _this.INPUT.value;
				if(_this.cache[_this.cache_key] == null)
				{
					if(_this.WAIT)
					{
						var pos = BX.pos(_this.INPUT);
						var height = (pos.bottom - pos.top)-2;
						_this.WAIT.style.top = (pos.top+1) + 'px';
						_this.WAIT.style.height = height + 'px';
						_this.WAIT.style.width = height + 'px';
						_this.WAIT.style.left = (pos.right - height + 2) + 'px';
						_this.WAIT.style.display = 'block';
					}

					_this.RESNULL.style.display = 'none';

					// _this.LODERTIMER = setTimeout(function() {
						_this.LOADER.style.display = 'block';
					// }, 300)
					

					BX.ajax.post(
						_this.arParams.AJAX_PAGE,
						{
							'ajax_call':'y',
							'INPUT_ID':_this.arParams.INPUT_ID,
							'q':_this.INPUT.value,
							'l':_this.arParams.MIN_QUERY_LEN
						},
						function(result)
						{
							// clearTimeout(_this.LODERTIMER);
							_this.LOADER.style.display = 'none';
							_this.cache[_this.cache_key] = result;

							// var str = window.sessionStorage.getItem('cache');
							// if (!str) {
							// 	window.sessionStorage.setItem('cache', _this.cache_key + "===" + _this.cache_key);
							// } else {
							// 	window.sessionStorage.setItem('cache', str + ',,,' + _this.cache_key + "===" + _this.cache_key);
							// }

							// console.log(_this.cache);
							// _this.ShowResult(result);
							if(result.length) {

								_this.RESNULL.style.display = 'none';

								$.get('/bitrix/templates/steelline/mustache/catalog.section/items.html', function (template) {
									var template_ob = JSON.parse(result),
									singleDoors = {},
									doubleDoors = {};
									singleDoors['ITEMS'] = template_ob['ITEMS'];
									doubleDoors['ITEMS'] = template_ob['DOUBLE_DOORS'][0];
									prepareItems(singleDoors['ITEMS']);
									prepareItems(doubleDoors['ITEMS']);
									var rendered_html = Mustache.render(template, singleDoors) + Mustache.render(template, doubleDoors);
									_this.ShowResult(rendered_html);
									fromBlured($('.search_items__wrap'));
								})

							} else {
								_this.RESNULL.style.display = 'block';
				
								_this.RESULT.style.display = 'none';
							}
							
							
							_this.currentRow = -1;
							_this.EnableMouseEvents();
							if(_this.WAIT)
								_this.WAIT.style.display = 'none';
							if (!!callback)
								callback();
						}
					);
					return;
				}
				else
				{
					// _this.ShowResult(_this.cache[_this.cache_key]);
					// console.log(_this.arr);
					$.get('/bitrix/templates/steelline/mustache/catalog.section/items.html', function (template) {
									var template_ob = JSON.parse(_this.cache[_this.cache_key]),
									singleDoors = {},
									doubleDoors = {};
									singleDoors['ITEMS'] = template_ob['ITEMS'];
									doubleDoors['ITEMS'] = template_ob['DOUBLE_DOORS'][0];
									prepareItems(singleDoors['ITEMS']);
									prepareItems(doubleDoors['ITEMS']);
									var rendered_html = Mustache.render(template, doubleDoors) + Mustache.render(template, singleDoors);
									_this.ShowResult(rendered_html);
									fromBlured($('.search_items__wrap'));
								})
					_this.currentRow = -1;
					_this.EnableMouseEvents();
				}
				$('.js_price_gen').each(function() {
					priceGen($(this));
				})

			}
			else
			{
				_this.RESULT.style.display = 'none';
				_this.currentRow = -1;
				_this.UnSelectAll();
			}
		}
		if (!!callback)
			callback();
	}

	this.UnSelectAll = function()
	{
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'justified_container search_items__wrap'}, true);
		if(tbl)
		{
			var cnt = tbl.rows.length;
			for(var i = 0; i < cnt; i++)
				tbl.rows[i].className = '';
		}
	}

	this.EnableMouseEvents = function()
	{
		var tbl = BX.findChild(_this.RESULT, {'tag':'table','class':'justified_container search_items__wrap'}, true);
		if(tbl)
		{
			var cnt = tbl.rows.length;
			for(var i = 0; i < cnt; i++)
				if(!BX.findChild(tbl.rows[i], {'class':'title-search-separator'}, true))
				{
					tbl.rows[i].id = 'row_' + i;
					tbl.rows[i].onmouseover = function (e) {
						if(_this.currentRow != this.id.substr(4))
						{
							_this.UnSelectAll();
							this.className = 'title-search-selected';
							_this.currentRow = this.id.substr(4);
						}
					};
					tbl.rows[i].onmouseout = function (e) {
						this.className = '';
						_this.currentRow = -1;
					};
				}
		}
	}

	this.onFocusLost = function(hide)
	{
		// setTimeout(function(){_this.RESULT.style.display = 'none';}, 250);
	}

	this.onFocusGain = function()
	{
		if(_this.RESULT.innerHTML.length)
			_this.ShowResult();
	}

	this.onKeyDown = function(e)
	{
		if(!e)
			e = window.event;

		if (_this.RESULT.style.display == 'block')
		{
			if(_this.onKeyPress(e.keyCode))
				return BX.PreventDefault(e);
		}
	}

	this.Init = function()
	{
		this.CONTAINER = document.getElementById(this.arParams.CONTAINER_ID);
		// this.RESULT = document.body.appendChild(document.createElement("DIV"));
		this.RESULT = _this.RES.appendChild(document.createElement("DIV"));
		this.RESULT.className = 'justified_container search_items__wrap';
		this.INPUT = document.getElementById(this.arParams.INPUT_ID);
		this.startText = this.oldValue = this.INPUT.value;
		BX.bind(this.INPUT, 'focus', function() {_this.onFocusGain()});
		BX.bind(this.INPUT, 'blur', function() {_this.onFocusLost()});

		if(BX.browser.IsSafari() || BX.browser.IsIE())
			this.INPUT.onkeydown = this.onKeyDown;
		else
			this.INPUT.onkeypress = this.onKeyDown;

		if(this.arParams.WAIT_IMAGE)
		{
			this.WAIT = document.body.appendChild(document.createElement("DIV"));
			this.WAIT.style.backgroundImage = "url('" + this.arParams.WAIT_IMAGE + "')";
			if(!BX.browser.IsIE())
				this.WAIT.style.backgroundRepeat = 'none';
			this.WAIT.style.display = 'none';
			this.WAIT.style.position = 'absolute';
			this.WAIT.style.zIndex = '1100';
		}

		BX.bind(this.INPUT, 'bxchange', function() {_this.onChange()});
	}

	BX.ready(function (){_this.Init(arParams)});

	// Restoring search state at History-back
	if (this.INPUT.value.length !== 0) {
		this.startText = '';
		this.oldValue = '';
		this.onChange();
	}

	// Fix search from page-404
	var getParam = this.INPUT.getAttribute('data-value');
	if (getParam) {
		console.log(getParam);
		this.INPUT.value = getParam;
		this.onChange(function(){this.INPUT.removeAttribute('data-value');}.bind(this));
		
		window.history.replaceState(null, null, window.location.href.split('?')[0]);
	}
}

$(document).on("click", ".card_article", function () {
    var selectedGood = $(this).parents(".catalog_main_content_card");
    $(this).siblings().removeClass("active");
    if ($(this).index() > 0) {
        $(this).siblings(":first-child").addClass("inactive");
        $(this).addClass("active");
    } else if ($(this).hasClass("inactive")) {
        $(this).removeClass("inactive");
    }
    $(selectedGood).find(".card_current_article_item").attr("href", $(this).attr("data-href"));
    $(selectedGood).find(".card_current_article_item_price span").text(parseFloat($(this).attr("data-price")).toLocaleString('ru-RU') + $(this).attr("data-price").slice($(this).attr("data-price").indexOf('.') - 1));
    $(selectedGood).find(".card_current_article_item_discount_price").text(parseFloat($(this).attr("data-discountPrice")).toLocaleString('ru-RU') + $(this).attr("data-discountPrice").slice($(this).attr("data-discountPrice").indexOf('.') - 1));
    if ($(this).attr("data-discountPrice") == 0) {
        $(selectedGood).find(".card_current_article_item_descr").removeClass("discounted");
    } else {
        $(selectedGood).find(".card_current_article_item_descr").addClass("discounted");
    }
    $(selectedGood).find(".card_current_article_item_img img").eq(0).attr("src", $(this).find("img").eq(0).attr("src"));
    $(selectedGood).find(".card_current_article_item_img img").eq(1).attr("src", $(this).find("img").eq(1).attr("src"));
    if (navigator.userAgent.indexOf('Mac') > 0) {
        $(".card_current_article_item_discount_price").addClass("mac-os");
    }
});
function prepareItems(items) {
   
    for (var i = 0; i < items.length; i++) {
        if(!items[i].OFFERS) {
            continue;
        }
        if (Object.keys(items[i]).length > 1) {
            items[i].URL = items[i].OFFERS[0].DETAIL_PAGE_URL;
            items[i].IMGINFO = items[i].OFFERS[0].PREVIEW_PICTURES;
            var priceArr = items[i].OFFERS[0].MIN_PRICE;
            var priceArrString = {};
            var price = parseFloat(priceArr.VALUE).toLocaleString('ru-RU') + priceArr.VALUE.slice(priceArr.VALUE.indexOf('.') - 1); //для дробной части -> + priceArr.VALUE.toString().slice(priceArr.VALUE.toString().indexOf('.'))
            var discountPrice = priceArr.DISCOUNT_VALUE && parseFloat(priceArr.DISCOUNT_VALUE).toLocaleString('ru-RU') + priceArr.DISCOUNT_VALUE.slice(priceArr.DISCOUNT_VALUE.indexOf('.') - 1); //для дробной части -> + priceArr.DISCOUNT_VALUE.toString().slice(priceArr.DISCOUNT_VALUE.toString().indexOf('.'))
            priceArrString.VALUE = price;
            priceArrString.DISCOUNT_VALUE = discountPrice;
            items[i].PRICE = priceArrString;
        }
    }
}