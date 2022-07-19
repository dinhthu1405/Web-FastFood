<script>
    //Step 1: initialize communication with the platform
    // In your own code, replace variable window.apikey with your own apikey
    // Initialize the platform object
    var platform = new H.service.Platform({
        'apikey': '3gdxgRQseSEqxb7r4qFCmKlAE-0aASmiSrmKSg68fQg'
    });

    // Obtain the default map types from the platform object
    var defaultLayers = platform.createDefaultLayers();

    // Instantiate (and display) the map
    var map = new H.Map(
        document.getElementById('mapContainer'),
        defaultLayers.vector.normal.map, {
            zoom: 10,
            center: {
                lat: 10.771595, //Kinh độ
                lng: 106.7013516, //Vĩ độ
            }
            // pixelRatio: window.devicePixelRatio || 1
        });
    // add a resize listener to make sure that the map occupies the whole container
    window.addEventListener('resize', () => map.getViewPort().resize());

    //Step 3: make the map interactive
    // MapEvents enables the event system
    // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    var ui = H.ui.UI.createDefault(map, defaultLayers);

    // const coords = [
    //     [10.7716, 106.7017, 'Khu F'], //Khu F
    //     [10.7713, 106.7021, 'Khu B'], // Khu B
    //     [10.7713, 106.7022, 'Ngoài khu F'] //Ngoài khu F
    // ];
    const coords = [
        @foreach ($lstDiaDiem as $diaDiem)
            [{{ $diaDiem->kinh_do }}, {{ $diaDiem->vi_do }},
                '{{ $diaDiem->ten_dia_diem }}', '{{ $diaDiem->thoi_gian_mo }}',
                '{{ $diaDiem->thoi_gian_dong }}'
            ],
        @endforeach
    ];
    coords.forEach((el) => {
        map.addObject(new H.map.Marker({
            lat: el[0],
            lng: el[1]
        }));
    });

    function addMarkerToGroup(group, coordinate, html) {
        var marker = new H.map.Marker(coordinate);
        // add custom data to the marker
        marker.setData(html);
        group.addObject(marker);
    }


    function addInfoBubble(map) {
        var group = new H.map.Group();

        map.addObject(group);

        // add 'tap' event listener, that opens info bubble, to the group
        group.addEventListener('tap', function(evt) {
            // event target is the marker itself, group is a parent event target
            // for all objects that it contains
            var bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                // read custom data
                content: evt.target.getData(),
            });
            // .H_ib_body {
            //     background: rgb(45, 213, 201);
            // }
            // show info bubble
            ui.addBubble(bubble);
        }, false);
        coords.forEach((el) => {
            addMarkerToGroup(group, {
                    lat: el[0],
                    lng: el[1]
                },
                '<div style="max-width: 1200px;"><div><img src="{{ asset('assets/img/favicon/heremap.png') }}" style="max-width:50px" alt=""></div><div><span>Tên:</span> <span>' +
                el[2] +
                '</span></div><div><span>Thời gian mở:' +
                el[3] + '</span></div><div><span>Thời gian đóng:' + el[4] + '</span></div></div>'
            );
        });
    }

    // Now use the map as required...
    addInfoBubble(map);

    // //Test
    // //Xử lý sự kiện
    // // Enable the event system on the map instance:
    // var mapEvents = new H.mapevents.MapEvents(map);

    // // Add event listener:
    // map.addEventListener('tap', function(evt) {
    //     // Log 'tap' and 'mouse' events:
    //     console.log(evt.type, evt.currentPointer.type);
    // });
    // // Instantiate the default behavior, providing the mapEvents object:
    // var behavior = new H.mapevents.Behavior(mapEvents); //Sự kiện di chuyển bản đồ

    // // Create the default UI:
    // var ui = H.ui.UI.createDefault(map, defaultLayers);

    // //Căn chỉnh vị trí của UI
    // var mapSettings = ui.getControl('mapsettings');
    // var zoom = ui.getControl('zoom');
    // var scalebar = ui.getControl('scalebar');

    // mapSettings.setAlignment('top-left');
    // zoom.setAlignment('top-left');
    // scalebar.setAlignment('top-left');

    // // Create an info bubble object at a specific geographic location:
    // var bubble = new H.ui.InfoBubble({
    //     lng: 13.4,
    //     lat: 52.51
    // }, {
    //     content: '<b>Hello World!</b>'
    // });
    // // Add info bubble to the UI:
    // ui.addBubble(bubble);

    // // Get an instance of the geocoding service:
    // var service = platform.getSearchService();

    //Mốc điểm vị trí
    // Call the geocode method with the geocoding parameters,
    // the callback and an error callback function (called if a
    // communication error occurs):
    // service.geocode({
    //     q: '65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh'
    // }, (result) => {
    //     // Add a marker for each location found
    //     result.items.forEach((item) => {
    //         map.addObject(new H.map.Marker(item.position));
    //     });
    // }, alert);

    // //Hover title
    // // Call the reverse geocode method with the geocoding parameters,
    // // the callback and an error callback function (called if a
    // // communication error occurs):
    // service.reverseGeocode({
    //     at: '10.771595,106.7013516,15'
    // }, (result) => {
    //     result.items.forEach((item) => {
    //         // Assumption: ui is instantiated
    //         // Create an InfoBubble at the returned location with
    //         // the address as its contents:
    //         ui.addBubble(new H.ui.InfoBubble(item.position, {
    //             content: item.address.label
    //         }));
    //     });
    // }, alert);

    // //Tự động hoàn thành nơi đang tìm kiếm
    // // Call the "autosuggest" method with the search parameters,
    // // the callback and an error callback function (called if a
    // // communication error occurs):
    // service.autosuggest({
    //     // Search query
    //     q: '65 Đ. Huỳnh Thúc Kháng',
    //     // Center of the search context
    //     at: '10.771595,106.7013516'
    // }, (result) => {
    //     let {
    //         position,
    //         title
    //     } = result.items[0];
    //     // Assumption: ui is instantiated
    //     // Create an InfoBubble at the returned location
    //     ui.addBubble(new H.ui.InfoBubble(position, {
    //         content: title
    //     }));
    // }, alert);

    // var dataPoints = [],
    //     markers = [];
    // dataPoints.push(new H.clustering.DataPoint(10.7713966, 106.7019788)); //Khu F
    // dataPoints.push(new H.clustering.DataPoint(10.771581, 106.7016218)); // Khu B
    // dataPoints.push(new H.clustering.DataPoint(10.771310, 106.702197)); //Ngoài khu F
    // //Đánh dấu điểm trên map
    // /**
    //  * Assuming that 'dataPoints' and 'map' 
    //  * is initialized and available, create a data provider:
    //  */
    // var clusteredDataProvider = new H.clustering.Provider(dataPoints);

    // // Create a layer that includes the data provider and its data points: 
    // var layer = new H.map.layer.ObjectLayer(clusteredDataProvider);

    // // Add the layer to the map:
    // map.addLayer(layer);

    //Thu phóng map -- 1
    // // Assumption: 'map' is initialized and available.
    // var currentZoom = map.getZoom();
    // var endZoom = currentZoom + 3;

    // // Update zoom level on each animation frame,
    // // till we reach endZoom:
    // function step() {
    //     currentZoom += 18;
    //     map.setZoom(currentZoom);

    //     (currentZoom < endZoom) && requestAnimationFrame(step);
    // }

    // // Start zoom animation
    // step();

    //Thu phóng map -- 2
    /**
     * Assumption: 'map' is initialized and available
     */
    // Call getZoom() with an optional second parameter,
    // indicating that an animation is to be performed:
    map.setZoom(map.getZoom() + 19, true);
    // map.getObjectAt(0, 0, (obj) => {
    //     if (obj && obj instanceof H.map.Marker) {
    //         console.log(obj.getGeometry());
    //     }
    // });
</script>
