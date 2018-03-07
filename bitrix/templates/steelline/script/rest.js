/* global Mustache, LZString, fromBlured */
var loading = true;
var requestCount = 0;
var factoidsArr = {
    item: 0,
    last: 0,
    from: 1,
    started: false,
    elemsPerPage: 12,
    CURRENT_FACTOID: -1,
    CURRENT_PERIOD: 0,
    FACTOID_PERIODS: [6, 8],
    FACTOIDS: [],
    init: function () {
        this.item = 0;
        this.last = 0;
        this.from = 1;
        this.CURRENT_PERIOD = 0;
        this.CURRENT_FACTOID = -1;
        this.started = false;
    },
    insertFactoids: function (forMustache, sortType) {
        if (sortType.search("showsDESC")>-1 || !doubleDoorsArr.DOUBLE_DOORS.length) {
            for (var i = 0; i < forMustache.length; i++) {
                if (this.item === this.getSliceIndex() && this.FACTOIDS.length != 0) {
                    forMustache.splice(i++, 0, this.getFactoid());
                    this.last = this.item;
                }
                this.item++;
            }
            if(!this.last && this.FACTOIDS.length > 0) {
                forMustache.splice(i++, 0, this.getFactoid());
                this.last = this.item;
            }
        }
    },
    getFactoid: function () {
        if (this.started) {
            this.CURRENT_PERIOD = ++this.CURRENT_PERIOD % this.FACTOID_PERIODS.length;
        }
        this.started = true;
        this.CURRENT_FACTOID = ++this.CURRENT_FACTOID % this.FACTOIDS.length;
        return this.FACTOIDS[this.CURRENT_FACTOID];
    },
    getPeriod: function () {
        return this.FACTOID_PERIODS[this.CURRENT_PERIOD];
    },
    getSliceIndex: function () {
        if (!this.started) {
            return this.from;
        }
        return this.last + this.FACTOID_PERIODS[this.CURRENT_PERIOD];
    }
};
var doubleDoorsArr = {
    item: 0,
    last: 0,
    from: 0,
    doorCounter: 0,
    started: false,
    elemsPerCatalog: 12,
    CURRENT_DOUBLE_DOOR: -1,
    DOUBLE_DOOR_PERIOD: 0,
    DOUBLE_DOOR_PERIOD_COUNTER: 0,
    DOUBLE_DOORS: [],
    current_position: 0,
    init: function () {
        this.item = 0;
        this.last = 0;
        this.from = 0;
        this.DOUBLE_DOOR_PERIOD = 0;
        this.CURRENT_DOUBLE_DOOR = -1;
        this.started = false;
    },
    insertDoubleDoors: function (forMustache) {
        var counter = this.doorCounter;
        
        this.getPeriod(forMustache);
        prepareItems(this.DOUBLE_DOORS);
        for (var i = 0; i < forMustache.length; i++) {
            if (this.item === this.getSliceIndex() && this.DOUBLE_DOORS.length != 0 && counter < this.DOUBLE_DOORS.length) {
                forMustache.splice(i++, 0, this.getDoubleDoor());
                this.getSliceIndex(); //мистика
                this.last = this.item;
                counter++;
                this.doorCounter = counter;
            }
            this.item++;
            if(this.doorCounter > this.DOUBLE_DOORS.length - 1) {
                break;
            }
        }
    },
    sortDoubleDoors: function(forMustche, sortType) {
        
        if(this.item > this.DOUBLE_DOORS.length - 1) {
                return forMustche;
            }
        var allForMustche= this.elemsPerCatalog + factoidsArr.FACTOIDS.length -1;
        this.DOUBLE_DOORS.sort(function (a, b) {
            if(sortType.search("PROPERTY_MINIMUM_PRICEASC")> -1) {
                return parseFloat(a["OFFERS"][0]["MIN_PRICE"]["VALUE"].replace(",",".")) - parseFloat(b["OFFERS"][0]["MIN_PRICE"]["VALUE"].replace(",","."));
            } else {
                return parseFloat(b["OFFERS"][0]["MIN_PRICE"]["VALUE"].replace(",",".")) - parseFloat(a["OFFERS"][0]["MIN_PRICE"]["VALUE"].replace(",","."));
            }
        })
        for (var k = 0; k < this.DOUBLE_DOORS.length; k++) {
            if(k%2 > 0) {
                this.DOUBLE_DOORS[k].REVERSE_STYLE = true;
            } else {
                this.DOUBLE_DOORS[k].REVERSE_STYLE = false;
            }
        }
        var correct = 1;
		if(sortType.search("PROPERTY_MINIMUM_PRICEASC") == -1) {
            correct = -1;
        }
        for (var i = 0; i < forMustche.length; i++) {
        	var x = (parseFloat(forMustche[i]["OFFERS"][0]["MIN_PRICE"]["VALUE"].replace(",",".")) - parseFloat(this.DOUBLE_DOORS[this.item]["OFFERS"][0]["MIN_PRICE"]["VALUE"].replace(",","."))) * correct > 0;
            
            if(x) {
	           	this.getSortedDoubleDoor(forMustche, i);
            }
            if(this.item > this.DOUBLE_DOORS.length - 1) {
	            break;
	        }
	        this.current_position++;
        }
         if(getPage() == navPageCount && this.item < this.DOUBLE_DOORS.length - 1) {
        	if (this.current_position%2) {
            	forMustche.splice( forMustche.length, 0, factoidsArr.FACTOIDS[1]);
            }
        	forMustche = forMustche.concat(this.DOUBLE_DOORS.slice(this.item));
        }
        return forMustche;
    },
    getDoubleDoor: function () {
        this.started = true;
        this.CURRENT_DOUBLE_DOOR = ++this.CURRENT_DOUBLE_DOOR % this.DOUBLE_DOORS.length;
        return this.DOUBLE_DOORS[this.CURRENT_DOUBLE_DOOR];
    },
    getPeriod: function () {
        var factoidsPerSum = 0;
        for (var i=0; i < factoidsArr.FACTOID_PERIODS.length; i++) {
            factoidsPerSum += factoidsArr.FACTOID_PERIODS[i];
        }
        var factoidsUsedQuant = parseInt(this.elemsPerCatalog/parseInt(factoidsPerSum/factoidsArr.FACTOID_PERIODS.length));
        var periodDraft = Math.floor((this.elemsPerCatalog + factoidsUsedQuant)/ this.DOUBLE_DOORS.length);
        // this.DOUBLE_DOOR_PERIOD = (periodDraft % 2 == 0) ? (periodDraft) : (periodDraft - 1);
        //or
        // if(periodDraft % 2 == 0) {
        // 	this.DOUBLE_DOOR_PERIOD = periodDraft;
        // } else {
        // 	if (this.DOUBLE_DOOR_PERIOD_COUNTER == 0) {
        // 		this.DOUBLE_DOOR_PERIOD = periodDraft - 1;
        // 		this.DOUBLE_DOOR_PERIOD_COUNTER = 1;
        // 	} else {
        // 		this.DOUBLE_DOOR_PERIOD = periodDraft + 1;
        // 		this.DOUBLE_DOOR_PERIOD_COUNTER = 0;
        // 	}
        // }
        //or
        this.DOUBLE_DOOR_PERIOD = periodDraft;
        return this.DOUBLE_DOOR_PERIOD;
    },
    getSliceIndex: function () {
        if (!this.started) {
            return this.from;
        }
        if (this.DOUBLE_DOOR_PERIOD%2 == 0) {
        	return this.last + this.DOUBLE_DOOR_PERIOD;
        } else {
        	if (this.DOUBLE_DOOR_PERIOD_COUNTER == 0) {
        		this.DOUBLE_DOOR_PERIOD_COUNTER = 1;
        		return this.last + this.DOUBLE_DOOR_PERIOD - 1;
        	} else {
        		this.DOUBLE_DOOR_PERIOD_COUNTER = 0;
        		return this.last + this.DOUBLE_DOOR_PERIOD + 1;
        	}
        }
         
    },
    getSortedDoubleDoor: function (forMustche, i) {
    	forMustche.splice(i, 0, this.DOUBLE_DOORS[this.item]);
        if (this.current_position%2) {
        	forMustche.splice(i, 0, factoidsArr.FACTOIDS[i] || factoidsArr.FACTOIDS[1]);
        }
        this.current_position++;
        this.item++;
    }
};
function onPageResponse(page, response, cacheId) {
    pagesLoaded.lastCacheId = cacheId;
    factoidsArr.elemsPerPage = response.NAV_PAGE_COUNT;
    doubleDoorsArr.elemsPerCatalog = parseInt(response.ELEMENT_PAGE_COUNT);
    var sortType = pagesLoaded.lastCacheId.slice(pagesLoaded.lastCacheId.lastIndexOf("/")+1);
    if (response.MY_FILTER) {
        $.get('/bitrix/templates/steelline/mustache/catalog.section/filter.html', function (template) {
            var rendered = Mustache.render(template, {MY_FILTER: response.MY_FILTER});
            domItems.MY_FILTER.html(rendered);
        });
    }
    if (response.NOT_FOUND) {
        noSuchElements();
        loading = false;
    } else {
        $(".catalog_error_message").css("display", "none");
    }
    var forMustche = response.ITEMS.slice(0);
    for (var j = 0; j < forMustche.length; j++) {
        if (forMustche[j].DOUBLE_DOORS == true) {
            if(j%2 > 0) {
                forMustche[j].REVERSE_STYLE = true;
            }
        }
    }
    if (forMustche && forMustche.length) {
        if (response.FACTOIDS) {
            if (!factoidsArr.FACTOIDS.length) {
                for (var i = 0; i < response.FACTOIDS.length; i++) {
                    factoidsArr.FACTOIDS.push({"FACTOIDPROP": response.FACTOIDS[i]});
                }
                factoidsArr.FACTOIDS.sort(function (a, b) {
                    if (a['FACTOIDPROP']["UF_SORT"] == b['FACTOIDPROP']["UF_SORT"]) {
                        // return Math.floor(Math.random() * 2) -1;
                        return .5 - Math.random();
                    } else {
                        return a['FACTOIDPROP']["UF_SORT"] - b['FACTOIDPROP']["UF_SORT"];
                    }
                });
            }
        }
        if(response.DOUBLE_DOORS) {
            if (!doubleDoorsArr.DOUBLE_DOORS.length || cacheId !== domItems.ITEMS.attr('data-cacheId')) {
                doubleDoorsArr.DOUBLE_DOORS = [];
                for (var i = 0; i < response.DOUBLE_DOORS.length; i++) {
                    if(i%2 > 0) {
                        response.DOUBLE_DOORS[i].REVERSE_STYLE = true;
                    }
                    doubleDoorsArr.DOUBLE_DOORS.push(response.DOUBLE_DOORS[i]);
                }

                prepareItems(doubleDoorsArr.DOUBLE_DOORS);
            }
        }
        if (cacheId !== domItems.ITEMS.attr('data-cacheId')) {
            factoidsArr.init();
            doubleDoorsArr.init();
        }
        factoidsArr.insertFactoids(forMustche, sortType);
        prepareItems(forMustche);
        if (doubleDoorsArr.DOUBLE_DOORS.length != 0) {
            if(sortType.search("showsDESC")== -1) {
               forMustche = doubleDoorsArr.sortDoubleDoors(forMustche, sortType);
            } else {
                doubleDoorsArr.insertDoubleDoors(forMustche);
            }
        };
        

        $.get('/bitrix/templates/steelline/mustache/catalog.section/items.html', function (template) {
            var rendered = Mustache.render(template, {ITEMS: forMustche});
            if (cacheId !== domItems.ITEMS.attr('data-cacheId')) {
                domItems.ITEMS.attr('data-cacheId', cacheId);
                domItems.ITEMS.html(rendered);
            } else {
                domItems.ITEMS.append(rendered);
            }
            if (typeof fromBlured === "function") {
                fromBlured(domItems.ITEMS);
            }
            loading = false;
            if (navigator.userAgent.indexOf('Mac') > 0) {
                $(".card_current_article_item_discount_price").addClass("mac-os");
            }
        });
    }
    if (response.NAME) {
        domItems.H1.text(response.NAME);
    }

    if (response.SERIES) {
        domItems.SERIES.text(response.SERIES);
        $(".catalog_main_header").addClass("series_open");
    }
    domItems.minHeight.css('min-height', '');
    navPageCount = response.NAV_PAGE_COUNT;
    factoidsArr.elemsPerPage = navPageCount;
    requestCount++;
    // response.NAV_PAGE_COUNT количество страниц
}
var navPageCount;

function progressPreloader(itemHeight, currentHeight) {

    // var circleChange = 359.999 / navPageCount;
    // var headerHeight = 0;
    // var rowsPerPage = ELEMENTS_ON_PAGE / 2;
    // var factoidsRowsPerPage = 0;
    // if (factoidsArr.FACTOID_PERIOD) {
    //     factoidsRowsPerPage = Math.floor(((ELEMENTS_ON_PAGE - ELEMENTS_ON_PAGE % factoidsArr.FACTOID_PERIOD) / factoidsArr.FACTOID_PERIOD));
    //     rowsPerPage += factoidsRowsPerPage;
    // }
    // var pageViewedNum = Math.ceil(($(window).scrollTop() - headerHeight) / (itemHeight * rowsPerPage));
    // if ($(window).scrollTop() > 500 && navPageCount > 1) {
    //     $(".preloader").fadeIn();
    // } else {
    //     $(".preloader").fadeOut();
    // }
    // document.getElementById("arc1").setAttribute("d", describeArc(30, 30, 25, 0, circleChange * pageViewedNum));
}

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


/*ARTICLE SELECTION*/
$(document).on("click", ".navigation_item.active>a", function () {
    return false;
});
$(document).on("click", ".card_article", function () {
    var selectedGood = $(this).parents(".catalog_main_content_card");
    $(this).siblings().removeClass("active");
    if ($(this).index() > 0) {
        $(this).siblings(":first-child").addClass("inactive");
        $(this).addClass("active");
    } else if ($(this).hasClass("inactive")) {
        $(this).removeClass("inactive");
    }
    $(selectedGood).find(".card_current_article_item a:first-child").attr("href", $(this).attr("data-href"));
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

/*FILTER & SORT*/
var dataSorfAndFilter = {
    SORT_FIELD: 'shows',
    SORT_ORDER: 'DESC'
};
var myHistory = {};
$(document).on("click", ".catalog_main_header_filter_item", function () {
    if ($(this).hasClass("disabled")) {
        return false;
    } else {
        if (!$(this).hasClass("active")) {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            dataSorfAndFilter.FILTER = $(this).attr("data-filtertype");
        } else {
            $(this).removeClass("active");
            dataSorfAndFilter.FILTER = false;
        }
        if (dataSorfAndFilter.FILTER) {
            history.pushState(myHistory, '', "?filter=" + dataSorfAndFilter.FILTER);
        } else {
            history.replaceState(myHistory, '', location.pathname + location.hash);
        }
        doubleDoorsArr.doorCounter = 0;
        renderPage(1, false, dataSorfAndFilter);
    }

});
function getPage() {
	var pageHash = window.location.hash.match(/#page([\d]*)/);
    var page = pageHash && pageHash[1] ? pageHash[1] : 1;
    return page;
}
// $(".catalog_main_header_sort_listitem").on("click", function() {}) - in section.php
$(window).scroll(function () {
    if (loading) {
        return;
    }
    var currentHeight = $(".catalog_main_content").height();
    var itemHeight = $(document).find(".catalog_main_content_card").outerHeight(true);
    var pageHash = window.location.hash.match(/#page([\d]*)/);
    var page = pageHash && pageHash[1] ? pageHash[1] : 1;
    progressPreloader(itemHeight, currentHeight);
    if (page < navPageCount) {
        if ($(this).scrollTop() > (currentHeight - itemHeight * 3)) {
            loading = true;
            renderPage(++page, false, dataSorfAndFilter);
        }
    }
    /*for toTop arrow in catalog*/
    if ($(window).scrollTop() + $(window).height() > $(document).height() - $("footer div.mid").height()) {
        $(".catalog_sidebar_arrow").addClass("bottom");
        $(".preloader").addClass("bottom");
        if (navigator.userAgent.indexOf('Mac') > 0) {
            $('body').addClass('mac-os');
        }
    } else {
        $(".catalog_sidebar_arrow").removeClass("bottom");
        $(".preloader").removeClass("bottom");
        $("body").removeClass('mac-os');
    }

});

function getParamInfo() {
    var getParamInfo = location.search;
    var infoFilter = getParamInfo.match(/filter=([^&#$]*)(&|#|$)/);
    var infoSort = getParamInfo.match(/sort=([^&#$]*)(&|#|$)/);
    var infoSortOrder = getParamInfo.match(/order=([^&#$]*)(&|#|$)/);

    if (infoFilter && infoFilter[1]) {
        dataSorfAndFilter.FILTER = infoFilter[1];
    }
    if (infoSort && infoSort[1]) {
        dataSorfAndFilter.SORT_FIELD = infoSort[1];
        if (infoSortOrder && infoSortOrder[1]) {
            dataSorfAndFilter.SORT_ORDER = infoSortOrder[1]
        } else {
            dataSorfAndFilter.SORT_ORDER = "ASC";
        }

    }
}



// Don't touch

function isLocalStorageNameSupported() {
    var testKey = 'test', storage = window.localStorage;
    try {
        storage.setItem(testKey, '1');
        storage.removeItem(testKey);
        return true;
    } catch (error) {
        return false;
    }
}
var use_storage = true;
var today = parseInt(Date.now()/(1000*60*60*24));
var SERVER_VERSION_STORAGE = today;

if (use_storage) {
    var client_version_storage = localStorage.getItem('client_version');
    if (!client_version_storage || client_version_storage !== SERVER_VERSION_STORAGE) {
        localStorage.removeItem('pagesLoadedCache');
        localStorage.setItem('client_version', SERVER_VERSION_STORAGE);
    }
}



var domItems = {};
var pagesLoaded = {
    loaded: [],
    setLoaded: function (cacheId, page) {
        if (!this.loaded[cacheId]) {
            this.loaded[cacheId] = [];
        }
        this.loaded[cacheId][page - 1] = true;
    },
    isLoaded: function (cacheId, page) {
        return this.loaded[cacheId] && this.loaded[cacheId][page - 1];
    },
    lastCacheId: null
};
var ELEMENTS_ON_PAGE = 12;
var pagesLoadedCacheStr = '';
var pagesLoadedCache = {};

if (use_storage) {
    pagesLoadedCacheStr = localStorage.getItem('pagesLoadedCache');
    if (pagesLoadedCacheStr) {
        pagesLoadedCache = JSON.parse(pagesLoadedCacheStr);
    }
}

function domLoaded() {
    domItems = {
        minHeight: $('.catalog_main'),
        MY_FILTER: $('.catalog_main_header_filter'),
        ITEMS: $('.catalog_main_content'),
        H1: $('h1'),
        SERIES: $('.catalog_main_title_detail.series')
    };
    var needBack = false;
    if (window.location.hash) {
        var BACK_TO = window.location.hash.match(/#page([\d]*)/);
        if (BACK_TO && BACK_TO[1]) {
            needBack = BACK_TO[1];
        }
    }
    getParamInfo();
    renderPage(1, needBack, dataSorfAndFilter);
    if (use_storage && needBack) {
        var clientHeight = localStorage.getItem('contentHeight');
        if (clientHeight) {
            domItems.minHeight.css('min-height', clientHeight + 'px');
            if (localStorage.getItem('contentScroll')) {
                $(document).scrollTop(localStorage.getItem('contentScroll'));
                localStorage.removeItem('contentScroll');
            }
            localStorage.removeItem('contentHeight');
        }
    }
}
if (use_storage) {
    window.onunload = function () {
        localStorage.setItem('needBack', 1);
        localStorage.setItem('contentHeight', domItems.minHeight.height());
        localStorage.setItem('contentScroll', $(document).scrollTop());
    };
}
String.prototype.hashCode = function () {
    var hash = 0, i, chr, len;
    if (this.length === 0)
        return hash;
    for (i = 0, len = this.length; i < len; i++) {
        chr = this.charCodeAt(i);
        hash = ((hash << 5) - hash) + chr;
        hash |= 0;
    }
    return hash;
};
function noSuchElements() {
    $(".catalog_error_message").css("display", "block");
}

function checkCache(page, needBack, cacheId) {
    var cache = pagesLoadedCache[cacheId];
    if (cache && cache.ITEMS[page - 1]) {
        var response = {};
        if (!needBack) {
            if (cache.ITEMS[page - 1]) {
                response.MY_FILTER = cache.MY_FILTER;
                response.NAME = cache.NAME;
                response.SERIES = cache.SERIES;
                response.FACTOIDS = cache.FACTOIDS;
                response.DOUBLE_DOORS = cache.DOUBLE_DOORS;
                response.NOT_FOUND = cache.NOT_FOUND;
                response.NAV_PAGE_COUNT = cache.NAV_PAGE_COUNT;
                response.ELEMENT_PAGE_COUNT = cache.ELEMENT_PAGE_COUNT;
                response.ITEMS = cache.ITEMS[page - 1];
                pagesLoaded.setLoaded(cacheId, page);
                onPageResponse(page, response, cacheId);
                return true;
            }
            return false;
        } else {
            if (cache && cache.ITEMS[needBack - 1]) {
                var validCache = true;
                response.MY_FILTER = cache.MY_FILTER;
                response.NAME = cache.NAME;
                response.SERIES = cache.SERIES;
                response.FACTOIDS = cache.FACTOIDS;
                response.DOUBLE_DOORS = cache.DOUBLE_DOORS;
                response.NOT_FOUND = cache.NOT_FOUND;
                response.NAV_PAGE_COUNT = cache.NAV_PAGE_COUNT;
                response.ELEMENT_PAGE_COUNT = cache.ELEMENT_PAGE_COUNT;
                response.ITEMS = [];
                for (var i = 0; i < needBack; i++) {
                    if (!cache.ITEMS[i]) {
                        validCache = false;
                        break;
                    }
                    pagesLoaded.setLoaded(cacheId, i + 1);
                    response.ITEMS = response.ITEMS.concat(cache.ITEMS[i]);
                }
            }
            if (validCache) {
                onPageResponse(page, response, cacheId);
                return true;
            }
            return false;
        }
    }
    return false;
}

function renderPage(page, needBack, dataSorfAndFilter) {
    loading = true;
    page = page || 1;
    if (!dataSorfAndFilter) {
        dataSorfAndFilter = {};
    }
    dataSorfAndFilter.SORT_FIELD = dataSorfAndFilter.SORT_FIELD || 'shows';
    dataSorfAndFilter.SORT_ORDER = dataSorfAndFilter.SORT_ORDER || 'DESC';
    var data = {
        FOR_PATH: window.location.pathname,
        SORT_FIELD: dataSorfAndFilter.SORT_FIELD, // ворзможно shows, PROPERTY_MINIMUM_PRICE
        SORT_ORDER: dataSorfAndFilter.SORT_ORDER // ворзможно DESC, ASC
    };

    if (dataSorfAndFilter.FILTER) {
        data.FILTER = dataSorfAndFilter.FILTER; // ворзможно home, flat stock, order, hit, discount, new profit
    }
    var cacheId = '';
    for (var i in data) {
        cacheId += data[i];
    }
    if (!needBack) {
        history.pushState(myHistory, '', '#page' + page);
    }
    if (pagesLoaded.isLoaded(cacheId, page) && !needBack) {
        if (checkCache(page, needBack, cacheId)) {
            return;
        }
    }


    data.ELEMENTS_ON_PAGE = ELEMENTS_ON_PAGE; // количество на странице
    data.PAGEN_1 = page; // номер страницы
    if (checkCache(page, needBack, cacheId)) {
        return;
    }
    if (needBack) {
        data.BACK = needBack;
    }
    $.ajax({
        url: '/rest/',
        data: data
    }).done(function (res) {
        // console.log(res);
        var response = JSON.parse(res);
        saveCache(page, response, cacheId, needBack);
        onPageResponse(page, response, cacheId);
    });


}
function saveCache(page, response, cacheId, needBack) {
    if (!pagesLoadedCache[cacheId]) {
        pagesLoadedCache[cacheId] = {
            MY_FILTER: response.MY_FILTER,
            NAME: response.NAME,
            SERIES: response.SERIES,
            FACTOIDS: response.FACTOIDS,
            DOUBLE_DOORS: response.DOUBLE_DOORS,
            NOT_FOUND: response.NOT_FOUND,
            NAV_PAGE_COUNT: response.NAV_PAGE_COUNT,
            ELEMENT_PAGE_COUNT: response.ELEMENT_PAGE_COUNT,
            ITEMS: []
        };
    }

    if (needBack) {
        for (var i = 0; i < needBack; i++) {
            pagesLoadedCache[cacheId].ITEMS[i] = response.ITEMS.slice(i * ELEMENTS_ON_PAGE, i * ELEMENTS_ON_PAGE + ELEMENTS_ON_PAGE);
            pagesLoaded.setLoaded(cacheId, i + 1);
        }
    } else {
        pagesLoadedCache[cacheId].ITEMS[page - 1] = response.ITEMS;
        pagesLoaded.setLoaded(cacheId, page);
    }
    pagesLoadedCacheStr = JSON.stringify(pagesLoadedCache);
    if (use_storage) {
        // console.log(pagesLoadedCache);
        localStorage.setItem('pagesLoadedCache', pagesLoadedCacheStr);
    }
}


/*PRELOADER FUNCTIONS*/
function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
    var angleInRadians = (angleInDegrees - 90) * Math.PI / 180.0;

    return {
        x: centerX + (radius * Math.cos(angleInRadians)),
        y: centerY + (radius * Math.sin(angleInRadians))
    };
}

function describeArc(x, y, radius, startAngle, endAngle) {

    var start = polarToCartesian(x, y, radius, endAngle);
    var end = polarToCartesian(x, y, radius, startAngle);

    var largeArcFlag = endAngle - startAngle <= 180 ? "0" : "1";

    var d = [
        "M", start.x, start.y,
        "A", radius, radius, 0, largeArcFlag, 0, end.x, end.y
    ].join(" ");

    return d;
}