<html>
    <head>
        <meta http-equiv='refresh' content='60'>
        <script type='text/javascript'>var centreGot = false;</script>
        {!! $map['js'] !!}
    </head>
    <body>
        <div id='map_canvas' style='width:100%; height:100%;'></div>
        <div  class="card" style='z-index: 999; position: fixed; right: 20px; top: 20px; width: 130px; background-color: aliceblue;'>
            <div class="card-body">
                <div class="card-title">Sieci:</div>
                <div class="card-text">
                    @foreach($networks as $network)
                    {{$network->name}}<br>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>