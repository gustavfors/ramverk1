<?php

namespace Anax\View;

?>

<h1>A page for validating IP adresses</h1>

<h3>Text based result</h3>
<form action="" method="POST">
    <label for="address">IP Address:</label>
    <input type="text" id="address" name="address" value="194.47.150.9">
    <button type="submit">Validate</button>
</form>

<h3>JSON based result</h3>
<form action="<?= $this->di->request->getBaseUrl(); ?>/api/ip" method="POST">
    <label for="address">IP Address:</label>
    <input type="text" id="address" name="address" value="194.47.150.9">
    <button type="submit">Validate</button>
</form>

<h1>API Documentation</h1>

<p>To validate an IP address send a POST request to the following endpoint:</p>

<pre class="code-block">
<?= "{$this->di->request->getBaseUrl()}/api/ip"; ?>
</pre>

<p>Set <strong>address</strong> to the ip you want to validate in the body of the request</p>

<p>The result will be returned as JSON</p>

<h3>Test Routes</h3>

<form action="<?= "{$this->di->request->getBaseUrl()}/api/ip"; ?>" method="POST" class="mb-1">
    <input type="hidden" name="address" value="194.47.150.9">
    <button type="submit">Test: 194.47.150.9 (Ipv4)</button>
</form>

<form action="<?= "{$this->di->request->getBaseUrl()}/api/ip"; ?>" method="POST" class="mb-1">
    <input type="hidden" name="address" value="2001:0db8:85a3:0000:0000:8a2e:0370:7334">
    <button type="submit">Test: 2001:0db8:85a3:0000:0000:8a2e:0370:7334 (IPv6)</button>
</form>

<form action="<?= "{$this->di->request->getBaseUrl()}/api/ip"; ?>" method="POST">
    <input type="hidden" name="address" value="dsadsad.dasffsfads.dasdas">
    <button type="submit">Test: dsadsad.dasffsfads.dasdas (invalid)</button>
</form>

</form>



