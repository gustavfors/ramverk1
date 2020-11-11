<?php

namespace Gufo\Validator;

class IpValidator
{
    public static function test($ipAddress)
    {
        $data = [
            "ip" => $ipAddress,
            "valid" => false,
            "protocol" => null,
            "domain" => null
        ];
        
        if (filter_var($data['ip'], FILTER_VALIDATE_IP)) {
            $data['valid'] = true;
            $data['domain'] = gethostbyaddr($data['ip']);
            if (filter_var($data['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $data['protocol'] = "IPv6";
            } else if (filter_var($data['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $data['protocol'] = "IPv4";
            }
        }

        return [$data];
    }
}