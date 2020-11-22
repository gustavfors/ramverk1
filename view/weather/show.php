<?php

namespace Anax\View;

?>

<h1>Weather</h1>
<p>Sök på plats och få väderinformation. Exempel: "sverige,borlänge", "göteborg", "dalarna,malung"</p>
<form action="">
    <input type="text" name="location" placeholder="location...">
    <button type="submit">Show</button>
</form>


<h1>Weather Forecast</h1>

<div class="weather-forecast">
    <?php foreach($forecast as $day): ?>
        <div class="weather-forecast-item">
            
            <div class="weather-forecast-flex-item">
                <div><?= $day['day']; ?></div>
                <div><?= $day['date']; ?></div>
                
            </div>
            <div class="weather-forecast-item-box">
                
                
                <div class="weather">
                    <?= $day['weather']; ?>
                </div>
                <div class="weather-icon">
                    <img src="http://openweathermap.org/img/wn/<?= $day['weather-icon']; ?>@2x.png" alt="<?= $day['weather']; ?>">
                </div>
                <div class="temp">
                    <?= $day['temp']; ?>°C
                </div>
            </div>
            <div class="weather-forecast-flex-item">
                <div>Min <?= $day['min']; ?>°C</div>
                <div>Max <?= $day['max']; ?>°C</div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h1>Weather History</h1>