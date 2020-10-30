@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12" style="height: 800px">
            <div id="local-map" style="height: 100%; width: 100%"></div>
        </div>
    </div>



@endsection



@section('script')

    <script>

        let localMap;
        let localMarkers = [];

        $(document).ready(function () {
            localMap = new google.maps.Map(document.getElementById("local-map"), {
                zoom: 6,
                center: {lat: 14.264612, lng: 100.697404},
            });
            getProductLocation();
        });

        function getProductLocation() {
            $.ajax({
                type: "get",
                url: '{!! url('report/pointerLocation/getAllDetail') !!}',
                success: function (data) {
                    for (let i = 0; i < localMarkers.length; i++) {
                        localMarkers[i].setMap(null);
                    }

                    $.each(data.product, function (index, value) {
                        const localMarker = new google.maps.Marker({
                            label: value.code,
                            // icon: 'https://www.shareicon.net/data/2016/06/24/785635_machine_100x100.png',
                            position: {lat: parseFloat(value.latitude), lng: parseFloat(value.longitude)},
                        });

                        localMarker.setMap(localMap);
                        localMarkers.push(localMarker);
                        // if (index === 0) {
                        //     localMap.panTo(localMarker.getPosition());
                        // }
                    });
                }
            });
            $('.map-section-all-product').show();
        }

    </script>
@endsection
