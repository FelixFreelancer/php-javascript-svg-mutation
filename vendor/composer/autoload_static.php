<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita45b09e40aa03bd4979d1e89101eec74
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SVG\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SVG\\' => 
        array (
            0 => __DIR__ . '/..' . '/meyfa/php-svg/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita45b09e40aa03bd4979d1e89101eec74::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita45b09e40aa03bd4979d1e89101eec74::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}