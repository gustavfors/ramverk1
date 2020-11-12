<?php

namespace Anax\View;

?>

<h1>Results</h1>

<p><strong>IP</strong>: <?= $data['ipAddress']; ?></p>

<p><strong>Valid</strong>:  
<?php if ($data['valid']) : ?>
    true
<?php else : ?>
    false
<?php endif; ?>
</p>

<p><strong>Protocol</strong>: <?= $data['protocol']; ?></p>

<p><strong>Domain</strong>: <?= $data['domain']; ?></p>

<p><strong>Country</strong>: <?= $data['country_name']; ?></p>

<p><strong>Region</strong>: <?= $data['region_name']; ?></p>

<p><strong>City</strong>: <?= $data['city']; ?></p>

<p><strong>Latitude</strong>: <?= $data['latitude']; ?></p>

<p><strong>Longitude</strong>: <?= $data['longitude']; ?></p>

