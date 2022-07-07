<script>
    /**
     * An event listener is added to listen to tap events on the map.
     * Clicking on the map displays an alert box containing the latitude and longitude
     * of the location pressed.
     * @param  {H.Map} map      A HERE Map instance within the application
     */
    function setUpClickListener(map, click) {
        // Attach an event listener to map display
        // obtain the coordinates and display in an alert box.
        map.addEventListener('tap', function(evt) {
            var coord = map.screenToGeo(evt.currentPointer.viewportX,
                evt.currentPointer.viewportY);
            // logEvent('Clicked at ' + Math.abs(coord.lat.toFixed(4)) +
            //     ((coord.lat > 0) ? 'N' : 'S') +
            //     ' ' + Math.abs(coord.lng.toFixed(4)) +
            //     ((coord.lng > 0) ? 'E' : 'W'));
            var kinhDo = document.getElementById('KinhDo').value = coord.lat;
            var viDo = document.getElementById('ViDo').value = coord.lng;
            // var click = 0;
            var lat = document.getElementById('KinhDo').value;
            var lng = document.getElementById('ViDo').value;
            // console.log('click khởi tạo: ' + click);

            if (click == 0) {
                // variable is undefined
                map.addObject(new H.map.Marker({
                    lat: lat,
                    lng: lng
                }));
                // console.log('Thêm cái đầu tiên: ' + click);
                click++;
            } else {
                // console.log('Xoá');
                map.removeObjects(map.getObjects({
                    lat: lat,
                    lng: lng
                }));
                document.getElementById('KinhDo').value = "";
                document.getElementById('ViDo').value = "";
                // console.log('click chưa xoá: ' + click);
                click--;
                // console.log('click xoá: ' + click);
            }
            // console.log('click kết thúc: ' + click);
        });
    }
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
    const coords = [
        [{{ $diaDiem->kinh_do }}, {{ $diaDiem->vi_do }},
            '{{ $diaDiem->ten_dia_diem }}'
        ],
    ];
    coords.forEach((el) => {
        map.addObject(new H.map.Marker({
            lat: el[0],
            lng: el[1]
        }));
    });
    // Step 4: create custom logging facilities
    // var logContainer = document.createElement('ul');
    // logContainer.className = 'log';
    // logContainer.innerHTML = '<li class="log-entry">Try clicking on the map</li>';
    // map.getElement().appendChild(logContainer);

    // Helper for logging events
    function logEvent(str) {
        var entry = document.createElement('li');
        entry.className = 'log-entry';
        entry.textContent = str;
        logContainer.insertBefore(entry, logContainer.firstChild);
    }

    var KinhDo = document.getElementById('KinhDo').value;
    var ViDo = document.getElementById('ViDo').value;
    if (KinhDo == null || ViDo == null) {
        var click = 0;
    } else {
        var click = 1;
    }
    setUpClickListener(map, click);

    map.setZoom(map.getZoom() + 19, true);
</script>
