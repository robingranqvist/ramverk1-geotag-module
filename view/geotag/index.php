<?php

namespace Anax\View;

// if (!$_SERVER['HTTP_X_FORWARDED_FOR']) {
//     $ip = $_SERVER['REMOTE_ADDR'];
// } else {
//     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
// }

?>

<!-- GEOTAG -->
<h1>Väder</h1>
<p>
    Välkommen till Robins lilla webbtjänst som visar dig väderprognoser samt 
    historiskt väder baserat på position. Väderdatan hämtas från <a href="https://openweathermap.org/api">
    Open Weather Map's API</a>, data om din IP hämtas från <a href="https://ipstack.com/">IPStack.com</a>
    samt kartor från <a href="https://www.openstreetmap.org/">Open Street Map</a>.
</p>

<!-- VALIDATE TEXT -->
<h3>
Väderdata i textformat.
</h3>

<p>Du kan kolla upp väderdata genom din IP-address.</p>

<form method="post" action="<?= url("geotag/validate") ?>" class="main-form">
    <input type="text" name="ip-check" placeholder="IP">
    <button type="submit" class="btn">Sök</button>
</form>

<p>Alternativt kan du skriva in koordinater; latitud och longitud.</p>

<form method="post" action="<?= url("geotag/validate") ?>">
    <input type="text" name="lat-input" placeholder="Latitud">
    <input type="text" name="long-input" placeholder="Longitud">
    <button type="submit" class="btn">Sök</button>
</form>



<!-- VALIDATE JSON -->
<h3>
Väderdata i JSON-format
</h3>

<p>Du kan kolla upp väderdata genom din IP-address.</p>

<form method="get" action="<?= url("geotag/json") ?>" class="main-form">
    <input type="text" name="ip" placeholder="IP">
    <button type="submit" class="btn">Kör</button>
</form>

<p>Alternativt kan du skriva in koordinater; latitud och longitud.</p>

<form method="get" action="<?= url("geotag/json") ?>">
    <input type="text" name="lat" placeholder="Latitud">
    <input type="text" name="lon" placeholder="Longitud">
    <button type="submit" class="btn">Kör</button>
</form>

<!-- API INFO -->
<h3>
    API
</h3>
<p>
    API'et tar emot GET-requests på <b>/json</b> med antingen en ip-parameter <b>?ip=93.106.206.157</b>
    alternativt latitud och longitud parametrar <b>?lat=60.85&lon=26.76</b>.
</p>
<p>
    Som svar får man som exempel:
</p>
{ <br>
"current_temp": 1.22, <br>
"current_feels_like": -3.13, <br>
"current_weather_main": "Clear", <br>
"current_wind_speed": 2.1, <br>
"prev_temp": [ <br>
4.15, <br>
6.96, <br>
8.19, <br>
4.09, <br>
4.89 <br>
], <br>
"prev_feels_like": [ <br>
-1.09, <br>
4.35, <br>
3.76, <br>
-1.3, <br>
0.2 <br>
], <br>
"prev_weather_main": [ <br>
"Clear", <br>
"Rain", <br>
"Clear", <br>
"Clear", <br>
"Clouds" <br>
], <br>
"prev_wind_speed": [ <br>
4.1, <br>
2.1, <br>
2.1, <br>
4.1, <br>
3.1 <br>
], <br>
"lat": 40.7589111328125, <br>
"lon": -73.97901916503906, <br>
"error": "" <br>
} <br>

<!-- TEST ROUTES -->
<h3>Test routes</h3>
<ul>
    <li>
        <a href="<?= url("geotag/json?ip=96.158.226.150") ?>">96.158.226.150</a>
    </li>
    <li>
        <a href="<?= url("geotag/json?lat=60.85&lon=26.76") ?>">?lat=60.85&lon=26.76</a>
    </li>
    <li>
        <a href="<?= url("geotag/json?ip=dettaaringenip") ?>">DettaaringenIP</a>
    </li>
    <li>
        <a href="<?= url("geotag/json?ip=54a0:7531:8915:0fda:b298:82e1:7d8d:7f91") ?>">54a0:7531:8915:0fda:b298:82e1:7d8d:7f91</a>
    </li>
</ul>




<style>
    .btn {
        padding: 4px 25px;
    }

    .main-form {
        margin-bottom: 50px;
    }
</style>