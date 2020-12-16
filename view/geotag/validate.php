<?php

namespace Anax\View;

?>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

<!-- VALIDATE VIEW -->
<h1>
    Väder
</h1>

<!-- If it's invalid -->
<h4 style="color: red"><?php echo $error; ?></h4>

<div id="mapid"></div>
<p>
    <b>Latitud: </b> <?php echo $lat; ?>. <br>
    <b>Longitud: </b> <?php echo $lon; ?>.
</p>

<!-- Todays weather -->

<h3>Idag</h3>
<p>
    <b>Temperatur:</b> <?php echo $current_temp; ?> grader celsius. <br>
    <b>Känns som:</b> <?php echo $current_feels_like; ?> grader celsius. <br>
    <b>Väder:</b> <?php echo $current_weather_main; ?> <br>
    <b>Vindhastighet:</b> <?php echo $current_wind_speed; ?> m/s. <br>
</p>

<!-- Previous 5 days weather -->

<h3>Igår</h3>

<p>
    <b>Temperatur:</b> <?php echo $prev_temp[0]; ?> grader celsius. <br>
    <b>Känns som:</b> <?php echo $prev_feels_like[0]; ?> grader celsius. <br>
    <b>Väder:</b> <?php echo $prev_weather_main[0]; ?> <br>
    <b>Vindhastighet:</b> <?php echo $prev_wind_speed[0]; ?> m/s. <br>
</p>

<h3>I förrgår</h3>

<p>
    <b>Temperatur:</b> <?php echo $prev_temp[1]; ?> grader celsius. <br>
    <b>Känns som:</b> <?php echo $prev_feels_like[1]; ?> grader celsius. <br>
    <b>Väder:</b> <?php echo $prev_weather_main[1]; ?> <br>
    <b>Vindhastighet:</b> <?php echo $prev_wind_speed[1]; ?> m/s. <br>
</p>

<h3>Tre dagar sedan</h3>

<p>
    <b>Temperatur:</b> <?php echo $prev_temp[2]; ?> grader celsius. <br>
    <b>Känns som:</b> <?php echo $prev_feels_like[2]; ?> grader celsius. <br>
    <b>Väder:</b> <?php echo $prev_weather_main[2]; ?> <br>
    <b>Vindhastighet:</b> <?php echo $prev_wind_speed[2]; ?> m/s. <br>
</p>

<h3>Fyra dagar sedan</h3>

<p>
    <b>Temperatur:</b> <?php echo $prev_temp[3]; ?> grader celsius. <br>
    <b>Känns som:</b> <?php echo $prev_feels_like[3]; ?> grader celsius. <br>
    <b>Väder:</b> <?php echo $prev_weather_main[3]; ?> <br>
    <b>Vindhastighet:</b> <?php echo $prev_wind_speed[3]; ?> m/s. <br>
</p>

<h3>Fem dagar sedan</h3>

<p>
    <b>Temperatur:</b> <?php echo $prev_temp[4]; ?> grader celsius. <br>
    <b>Känns som:</b> <?php echo $prev_feels_like[4]; ?> grader celsius. <br>
    <b>Väder:</b> <?php echo $prev_weather_main[4]; ?><br>
    <b>Vindhastighet:</b> <?php echo $prev_wind_speed[4]; ?> m/s. <br>
</p>

<a href="<?= url("geotag") ?>">Gå tillbaka -></a>

<script>
    var mymap = L.map('mapid').setView([<?php echo $lat; ?>, <?php echo $lon; ?>], 10);

    const tileURL = "";

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
        maxZoom: 18,
        tileSize: 512,
        zoomOffset: -1,
    }).addTo(mymap);
</script>

<style>
    #mapid { height: 250px; }
</style>