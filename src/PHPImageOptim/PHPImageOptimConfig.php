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

        // compression libraries and their configurations
        "libs" => [
            // http://optipng.sourceforge.net/optipng-0.7.5.man.pdf
            "OptiPng" => [
                "binary"    => "/usr/local/bin/optipng",
                // o2 = optimization level. 2 seemed to give the best bang for the buck in terms of reduction/time
                // i0 = interlacing option. 0 turns interlacing off
                "options"   => ["-o2", "-i0"],
                "version"   => "--version"
            ]
        ],

        // defines which libraries are applied to which extensions
        "settings" => [
            "png" => [
                "OptiPng"
            ]
        ]

    ];

}
