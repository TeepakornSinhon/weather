<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">
    <style>
        .background-area{
            background-color :cadetblue;
            font-family:'Athiti', sans-serif;
            height: 850px;
        }
    </style>
</head>

<body>
    <div class = "background-area">
        <div class="container mt-4 col-8" >
            <div class="container mx-auto">
                <br>
                <p class="text-center h1 "style="color: white ">What is the weather now....</p>
                <div class="input-group mb-3 mt-5">
                    <span class="input-group-text">Latitude</span>
                    <input type="text" class="form-control" placeholder="Latitude" aria-label="Latitude"
                        aria-describedby="Latitude" id="Latitude">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Longitude</span>
                    <input type="text" class="form-control" placeholder="Longitude" aria-label="Longitude"
                        aria-describedby="Longitude" id="Longitude">
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnSearch">SEARCH</button>
                </div>
            </div>
            <div class="container mt-5 d-flex justify-content-center">
                <div class="card" id="cardWeather" style="width: 18rem;">
                </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
<script>

    function setDefault(){
        var urlDefualt = "https://api.openweathermap.org/data/2.5/weather?lat=7.5506621&lon=99.5512595&appid=7130a5707de3d4310659ec378dcf6122";
        $.getJSON(urlDefualt)
            .done((data) => {
                var datetime = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(2));
                var humid = (data.main["humidity"]);
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);
                    }
                })
                
                var line = "<div id='dataWeather'>";
                    line += "<img src='https://www.chilljourney.com/wp-content/uploads/2019/07/Trang_Review2019_002.jpg' class='card-img-top' ><div class='card-body'>"
                    line += "<h5 class='card-title my-3 '>สถานที่ : "+ place +"</h5>";
                    line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : "+ sunrise +"</p>";
                    line += "<p class='card-text'>อาทิตย์ตกเวลา : "+ sunset +"</p>";
                    line += "<p class='card-text'>ความเร็วลม : "+ windSpeed +"</p>";
                    line += "<p class='card-text'>อุณหภูมิ : "+ temp +"</p>";
                    line += "<p class='card-text'>ความชื้นในอากาศ : "+ humid  +"</p>";
                    line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => {})
    } 

    function LoadForcast() {
        var x = $("#Latitude").val();
        var y = $("#Longitude").val();
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + x + "&lon=" + y + "&appid=7130a5707de3d4310659ec378dcf6122"       
        $.getJSON(url)
            .done((data) => {
                var datetime = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(2));
                var humid = (data.main["humidity"]);
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);
                    }
                })
                var line = "<div id='dataWeather'>";
                    line += "<img src='https://media-exp1.licdn.com/dms/image/C560BAQHtvo47dVEisg/company-logo_200_200/0/1625026934671?e=2159024400&v=beta&t=vAmme9yUoENBxoBqeSX0VX9Ko02BtDdsvkqFpRWUMzo' class='card-img-top' ><div class='card-body'>"
                    line += "<h5 class='card-title my-3'>สถานที่ : "+ place +"</h5>";
                    line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : "+ sunrise +"</p>";
                    line += "<p class='card-text'>อาทิตย์ตกเวลา : "+ sunset +"</p>";
                    line += "<p class='card-text'>ความเร็วลม : "+ windSpeed +"</p>";
                    line += "<p class='card-text'>อุณหภูมิ : "+ temp +"</p>";
                    line += "<p class='card-text'>ความชื้นในอากาศ : "+ humid  +"</p>";
                    line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => {})
    }

    function convertHMS(value) {
        let time = value;
        var convert = new Date(time * 1000);
        var hours = convert.getHours();
        var minutes = "0" + convert.getMinutes();
        var seconds = "0" + convert.getSeconds();
        return (hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2));
    }
    $(() => {
        setDefault();
        $("#btnSearch").click(() => {
            LoadForcast();
            $("#dataWeather").hide();
        });
    });
</script>
</html>
