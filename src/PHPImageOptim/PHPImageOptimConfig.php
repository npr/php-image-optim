<?php

namespace PHPImageOptim;

/**
 * Class PHPImageOptimConfig
 *
 * Separates out environment-specific and library-specific configurations
 */
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
