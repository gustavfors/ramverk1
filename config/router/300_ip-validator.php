<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Validate IP Addresses.",
            "mount" => "validate",
            "handler" => "\Anax\Controller\IpController",
        ],
    ]
];
