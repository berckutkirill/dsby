ymaps.ready(initMap);
  
var markers = [
  {
    type: 'FS',
    coords: {
      lat: 53.844537,
      lng: 27.473931,
    },
    img: '/bitrix/templates/steelline/img/salon_map/1x/salon.jpg',
    address: 'Пр-т Дзержинского, 131, помещение 624',
    link: '#',
    work: [
      {
        days: 'пн—сб',
        time: '10…20'
      },
      {
        days: 'вс',
        time: '10…18'
      }
    ],
    ex: "31",
    phone: ['+375 44 743-68-47', '+375 29 211-49-99']
  },
  {
    type: 'FS',
    coords: {
      lat: 53.905883,
      lng: 27.533381
    },
    img: '/bitrix/templates/steelline/img/salon_map/1x/salon.jpg',
    address: 'Ул. Кальварийская, 7Б-6 ТЦ «Трюм»',
    link: '#',
    work: [
      {
        days: 'пн—сб',
        time: '10…20'
      },
      {
        days: 'вс',
        time: '10…18'
      }
    ],
    ex: "39",
    phone: ['+375 44 533-47-11', '+375 29 336-69-38']
  },
  {
    type: 'BS',
    coords: {
      lat: 53.933494,
      lng: 27.455205
    },
    img: '/bitrix/templates/steelline/img/salon_map/1x/salon.jpg',
    address: 'Ул. Тимирязева, 123-1 ТЦ «Град»',
    link: '#',
    work: [
      {
        days: 'вт—вс',
        time: '10…17'
      }
    ],
    ex: "4",
    phone: ['+375 29 166-11-55']
  },
  {
    type: 'BS',
    coords: {
      lat: 53.888089,
      lng: 27.520674
    },
    img: '/bitrix/templates/steelline/img/salon_map/1x/salon.jpg',
    address: 'Пр-т Дзержинского, 11-753',
    link: '#',
    work: [
      {
        days: 'пн—пт',
        time: '11…20'
      },
      {
        days: 'сб—вс',
        time: '10…18'
      }
    ],
    ex: '9',
    phone: ['+375 29 366-70-00']
  },
  { 
    type: 'BS',
    coords: {
      lat: 53.933033,
      lng: 27.456819
    },
    img: '/bitrix/templates/steelline/img/salon_map/1x/salon.jpg',
    address: 'Ул. Тимирязева, 123-2 ТЦ «Град»',
    link: '#',
    work: [
      {
        days: 'вт—вс',
        time: '10…17'
      }
    ],
    ex: '7',
    phone: ['+375 29 622-22-76']
  },
  {
    type: 'BS',
    coords: {
      lat: 53.935891,
      lng: 27.580416
    },
    img: '/bitrix/templates/steelline/img/salon_map/1x/salon.jpg',
    address: 'Ул. Богдановича, 153Б',
    link: '#',
    work: [
      {
        days: 'пн—пт',
        time: '11…19'
      },
      {
        days: 'сб',
        time: '11…17'
      }
    ],
    ex: '7',
    phone: ['+375 29 166-66-57']
  },
  {
    type: 'BS',
    coords: {
      lat: 53.929831,
      lng: 27.579228
    },
    img: false,
    address: 'Ул. Богдановича, 153Б',
    link: '#',
    work: [
      {
        days: 'пн—пт',
        time: '11…19'
      },
      {
        days: 'сб',
        time: '11…17'
      }
    ],
    ex: '7',
    phone: ['+375 29 166-66-57']
  }
]

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

  classIconBrend      = ymaps.templateLayoutFactory.createClass('<div class="c-map-icon-brend" style="background: {{ properties.bgc }};"></div>'),
  classIconSalon      = ymaps.templateLayoutFactory.createClass('<div class="c-map-icon-salon" style="background: {{ properties.bgc }};"><span>Ф</span></div>'),
  classIconClaster    = ymaps.templateLayoutFactory.createClass('<div class="c-map-icon-salon" style="background: {{ properties.bgc }};"><span>{{ properties.geoObjects.length }}</span></div>'),
  classBalloonContent = ymaps.templateLayoutFactory.createClass(
    '{% if properties.balloonImg %}' +
      '<img class="c-map-tooltip__img" src="{{ properties.balloonImg }}">' +
    '{% endif %}' +
    '<div class="c-map-tooltip__body">' +
      '<div class="c-map-tooltip__desc">' +
        '<div class="c-map-tooltip__addr">' +
          '<p class="c-map-tooltip__name">{{ properties.balloonTitle }}</p>' +
          '<a class="c-map-tooltip__link c-link" href="">{{ properties.balloonAddress }}</a>' +
        '</div>' +
        '<div class="c-map-tooltip__fct">' +
          '<span class="c-map-tooltip__count c-h2">{{ properties.balloonEx }}</span>' +
          '<span class="c-map-tooltip__ex">образец <br>в салоне</span>' +
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
  classBalloon =  ymaps.templateLayoutFactory.createClass(
    '<div class="c-map-tooltip c-p3 c-p3--small">' +
      '$[[options.contentLayout observeSize minWidth=385 maxWidth=385]]' +
      '<div class="c-map-tooltip__arrow"></div>' +
    '</div>', {
      build: function() {
        this.constructor.superclass.build.call(this);
        this._$element = $('.c-map-tooltip', this.getParentElement());
        this.applyElementOffset();
        
        this._$element[0].style.transform = 'translateY(0px)';
        this._$element[0].style.opacity = 1;

        map.events.once('click', function() {
          this.events.fire('userclose');
        }.bind(this));
      },
      clear: function() {
        this.constructor.superclass.clear.call(this);
      },
      applyElementOffset: function() {
        this._$element.css({
          left: -(this._$element[0].offsetWidth / 2),
          top: -(this._$element[0].offsetHeight + 30)
        });
      },
      onSublayoutSizeChange: function() {
        classBalloon.superclass.onSublayoutSizeChange.apply(this, arguments);
        if(!this._isElement(this._$element)) {
          return;
        }
        this.applyElementOffset();
        this.events.fire('shapechange');
      },
      getShape: function() {
        if(!this._isElement(this._$element)) {
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
      _isElement: function(element) {
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
    .add('mouseenter', function(e) {
      e.get('target').properties.set('bgc', '#B60000');
    })
    .add('mouseleave', function(e) {
      e.get('target').properties.set('bgc', '');
    })

  markers.forEach(function(item, i) {
    var placemark = new ymaps.Placemark(
      [item.coords.lat, item.coords.lng],
      {
        balloonTitle: item.type === 'FS' ? 'Фирменный салон' : 'Бренд секция',
        balloonAddress: item.address,
        balloonLink: item.link,
        balloonEx: item.ex,
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