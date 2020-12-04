<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Validate IP Addresses.",
            "mount" => "validate",
            "handler" => "\Gufo\Controller\IpController",
        ],
    ]
];