<?php

namespace Anax\View;

?>

<h1>Results</h1>

<p><strong>IP</strong>: <?= $result->ip; ?></p>

<p><strong>Valid</strong>:  
<?php if ($result->valid) : ?>
    true
<?php else : ?>
    false
<?php endif; ?>
</p>

<p><strong>Protocol</strong>: <?= $result->protocol; ?></p>

<p><strong>Domain</strong>: <?= $result->domain; ?></p>

