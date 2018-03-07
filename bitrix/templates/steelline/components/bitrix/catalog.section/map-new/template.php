<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//print_r($arResult);
?>
<div class="c-salons">
    <div class="c-banner">
        <section class="c-salons-map" id="salons-map"></section>  
        <div class="c-salons-map__desc">
            <p class="c-salons-map__title c-h4">Карта салонов</p>
            <ul class="c-salons-map__info-list">
                <li class="c-salons-map__info-item">
                    <svg class="c-salons-map__salon-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31" height="31" viewBox="0 0 31 31">
                        <defs>
                            <circle id="b" cx="12.146" cy="12.146" r="12.146"></circle>
                            <filter id="a" width="145.3%" height="145.3%" x="-22.6%" y="-14.4%" filterUnits="objectBoundingBox">
                                <feOffset dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="1.5"></feGaussianBlur>
                                <feComposite in="shadowBlurOuter1" in2="SourceAlpha" operator="out" result="shadowBlurOuter1"></feComposite>
                                <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.247452446 0"></feColorMatrix>
                            </filter>
                        </defs>
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(3 1)">
                                <use fill="#000" filter="url(#a)" xlink:href="#b"></use>
                                <use fill="#E51010" xlink:href="#b"></use>
                                <circle cx="12.146" cy="12.146" r="11.396" stroke="#FFF" stroke-width="1.5"></circle>
                            </g>
                            <path fill="#FFF" d="M13.941 16.897c-.185.029-.374.048-.568.058-.195.01-.404.015-.627.015-.466 0-.899-.08-1.297-.241a2.746 2.746 0 0 1-1.042-.743c-.297-.336-.53-.758-.7-1.268-.17-.51-.255-1.115-.255-1.815 0-.66.085-1.251.255-1.77.17-.52.413-.963.729-1.327a3.195 3.195 0 0 1 1.13-.838 3.55 3.55 0 0 1 1.457-.292c.126 0 .282.005.466.015.185.01.335.029.452.058V7.51h1.968v1.283c.175-.049.381-.08.62-.095.237-.014.434-.022.59-.022.466 0 .898.085 1.297.255.398.17.745.428 1.042.773.296.345.527.772.692 1.282.165.51.248 1.1.248 1.771 0 .69-.092 1.297-.277 1.822a3.839 3.839 0 0 1-.758 1.32c-.32.354-.692.621-1.115.8-.423.18-.872.27-1.348.27a6.41 6.41 0 0 1-.518-.021 2.459 2.459 0 0 1-.473-.08v1.428H13.94v-1.4zm2.711-6.603c-.107 0-.243.005-.408.015-.165.01-.301.029-.408.058v4.956c.078.019.177.029.299.029h.357c.262 0 .51-.049.743-.146.233-.097.437-.253.612-.466.175-.214.311-.481.408-.802.098-.32.146-.71.146-1.166 0-.777-.155-1.385-.466-1.822-.311-.437-.739-.656-1.283-.656zm-3.396 5.058c.078 0 .197-.003.357-.008.16-.004.294-.026.401-.065v-4.941a2.144 2.144 0 0 0-.335-.037 9.15 9.15 0 0 0-.35-.007c-.534 0-.981.207-1.341.62-.36.413-.54 1.07-.54 1.974 0 .788.166 1.395.496 1.822.33.428.768.642 1.312.642z"></path>
                        </g>
                    </svg>
                    <p class="c-salons-map__info-text c-p3 c-p3--small">фирменный салон</p>
                </li>
                <li class="c-salons-map__info-item">
                    <div class="c-salons-map__brand-icon"></div>
                    <p class="c-salons-map__info-text c-p3 c-p3--small">бренд-секция</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="c-wrapper">

        <?
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", "", Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COUNT_DOORS" => $arResult["SALONS"]["dzer"]["COUNT_MODELS"],
            "PATH" => "/include/map-salon-dzer.php"
                )
        );
        ?>

        <section class="c-salons__item">

            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/map-salon-partner.php"
                    )
            );
            ?>
        </section>
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:main.include", "", Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "COUNT_DOORS" => $arResult["SALONS"]["trum"]["COUNT_MODELS"],
            "PATH" => "/include/map-salon-trum.php"
                )
        );
        ?>
        <section class="c-salons__item">
            <div class="c-salons__likely">
                <div class="c-block-likely"><span class="c-p2 c-block-likely__desc">Расскажите про дверь друзьям:</span>
                    <div class="c-block-likely__main">
                        <div class="likely">
                            <div class="twitter">Твитнуть</div>
                            <div class="facebook">Поделиться</div>
                            <div class="vkontakte">Запостить</div>
                            <div class="telegram">Отправить</div>
                            <div class="odnoklassniki">Класснуть</div>
                            <div class="gplus">Плюсануть</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    ymaps.ready(initMap);

    var markers = <?= json_encode($arResult["DATA_MAPS"]) ?>;
    
    console.log(markers);

    function initMap() {
        var map = new ymaps.Map('salons-map', {
            center: [53.902, 27.55],
            zoom: 12,
            controls: [
                'zoomControl'
            ]
        }, {
            minZoom: 7
        }),
                classIconBrend = ymaps.templateLayoutFactory.createClass('<div class="c-map-icon-brend" style="background: {{ properties.bgc }};"></div>'),
                classIconSalon = ymaps.templateLayoutFactory.createClass('<div class="c-map-icon-salon" style="background: {{ properties.bgc }};"><span>Ф</span></div>'),
                classIconClaster = ymaps.templateLayoutFactory.createClass('<div class="c-map-icon-salon" style="background: {{ properties.bgc }};"><span>{{ properties.geoObjects.length }}</span></div>'),
                classBalloonContent = ymaps.templateLayoutFactory.createClass(
                        '{% if properties.balloonImg %}' +
                        '<img class="c-map-tooltip__img" src="{{ properties.balloonImg }}">' +
                        '{% endif %}' +
                        '<div class="c-map-tooltip__body">' +
                        '<div class="c-map-tooltip__desc">' +
                        '<div class="c-map-tooltip__addr">' +
                        '<p class="c-map-tooltip__name">{{ properties.balloonTitle }}</p>' +
                        '<pre>' +
                        '<a class="c-map-tooltip__link c-link" href="{{properties.balloonLink}}">{{ properties.balloonAddress }}</a>' +
                        '</pre>' +
                        '</div>' +
                        '<div class="c-map-tooltip__fct">' +
                        '<span class="c-map-tooltip__count c-h2">{{ properties.balloonEx }}</span>' +
                        '<span class="c-map-tooltip__ex">{{ properties.balloonExTitle }} <br>в салоне</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="c-map-tooltip__desc">' +
                        '<div class="c-map-tooltip__worktime">' +
                        '{% for work in properties.balloonWork %}' +
                        '<div class="c-map-tooltip__worktime-item">' +
                        '<p>{{ work.days }}</p>' +
                        '<p>{{ work.time }}</p>' +
                        '</div>' +
                        '{% endfor %}' +
                        '</div>' +
                        '<div class="c-map-tooltip__phone">' +
                        '{% for phone in properties.balloonPhones %}' +
                        '<p>{{ phone }}</p>' +
                        '{% endfor %}' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                        ),
                classBalloon = ymaps.templateLayoutFactory.createClass(
                        '<div class="c-map-tooltip c-p3 c-p3--small">' +
                        '$[[options.contentLayout observeSize minWidth=385 maxWidth=385]]' +
                        '<div class="c-map-tooltip__arrow"></div>' +
                        '</div>', {
                            build: function () {
                                this.constructor.superclass.build.call(this);
                                this._$element = $('.c-map-tooltip', this.getParentElement());
                                this.applyElementOffset();

                                this._$element[0].style.transform = 'translateY(0px)';
                                this._$element[0].style.opacity = 1;

                                map.events.once('click', function () {
                                    this.events.fire('userclose');
                                }.bind(this));
                            },
                            clear: function () {
                                this.constructor.superclass.clear.call(this);
                            },
                            applyElementOffset: function () {
                                this._$element.css({
                                    left: -(this._$element[0].offsetWidth / 2),
                                    top: -(this._$element[0].offsetHeight + 30)
                                });
                            },
                            onSublayoutSizeChange: function () {
                                classBalloon.superclass.onSublayoutSizeChange.apply(this, arguments);
                                if (!this._isElement(this._$element)) {
                                    return;
                                }
                                this.applyElementOffset();
                                this.events.fire('shapechange');
                            },
                            getShape: function () {
                                if (!this._isElement(this._$element)) {
                                    return classBalloon.superclass.getShape.call(this);
                                }
                                var position = this._$element.position();

                                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                                    [position.left, position.top], [
                                        position.left + this._$element[0].offsetWidth,
                                        position.top + this._$element[0].offsetHeight + 20
                                    ]
                                ]))
                            },
                            _isElement: function (element) {
                                return element && element[0];
                            }
                        }
                );

        ymaps.layout.storage.add('my#iconBrend', classIconBrend);
        ymaps.layout.storage.add('my#iconSalon', classIconSalon);
        ymaps.layout.storage.add('my#iconClaster', classIconClaster);
        ymaps.layout.storage.add('my#balloon', classBalloon);
        ymaps.layout.storage.add('my#balloonContent', classBalloonContent),
                clusterer = new ymaps.Clusterer({
                    hasBalloon: false,
                    hasHint: false,
                    gridSize: 64,
                    zoomMargin: 50,
                    clusterIconLayout: 'my#iconClaster',
                    geoObjectBalloonContentLayout: 'my#balloonContent',
                    geoObjectBalloonLayout: 'my#balloon',
                    iconShape: {
                        type: 'Circle',
                        coordinates: [0, 0],
                        radius: 20
                    }
                });

        clusterer.events
                .add('mouseenter', function (e) {
                    e.get('target').properties.set('bgc', '#B60000');
                })
                .add('mouseleave', function (e) {
                    e.get('target').properties.set('bgc', '');
                })

        markers.forEach(function (item, i) {
            var placemark = new ymaps.Placemark(
                    [item.coords.lat, item.coords.lng],
                    {
                        balloonTitle: item.type === 'FS' ? 'Фирменный салон' : 'Бренд-секция',
                        balloonAddress: item.address,
                        balloonLink: item.link,
                        balloonEx: item.ex,
                        balloonExTitle: 5 <= item.ex && item.ex <= 20 ? 'образцов' : item.ex[item.ex.length - 1] == 1 ? 'образец' : 2 <= item.ex[item.ex.length - 1] && item.ex[item.ex.length - 1] <= 4 ? 'образца' : 'образцов',
                        balloonPhones: item.phone,
                        balloonWork: item.work,
                        balloonImg: item.img,
                        markerType: item.type,
                        bgc: ''
                    }, {
                balloonPanelMaxMapArea: 0,
                balloonAutoPanMargin: 60,
                balloonShadow: false,
                balloonOffset: item.type === 'FS' ? [0, -10] : [0, 0],

                hasHint: false,
                hideIconOnBalloonOpen: false,
                iconLayout: item.type === 'FS' ? 'my#iconSalon' : 'my#iconBrend',
                iconShape: {
                    type: 'Circle',
                    coordinates: [0, 0],
                    radius: item.type === 'FS' ? 20 : 10
                }
            }
            );

            clusterer.add(placemark);
        })

        map.behaviors.disable(["scrollZoom"]);
        map.geoObjects.add(clusterer);
    }
</script>
