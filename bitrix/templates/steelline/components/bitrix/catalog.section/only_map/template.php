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
    <div class="c-banner">
        <section class="c-salons-map" id="salons-map"></section>  
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
