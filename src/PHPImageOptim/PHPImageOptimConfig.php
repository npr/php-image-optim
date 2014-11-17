<?php

namespace PHPImageOptim;

class PHPImageOptimConfig
{
    public static $config = [

        "libs" => [
            "OptiPng" => [
                "binary"    => "/usr/local/bin/optipng",
                "options"   => ["-o2"],
                "version"   => "--version"
            ]
        ],

        "settings" => [
            "png" => [
                "OptiPng"
            ]
        ]

    ];

}
