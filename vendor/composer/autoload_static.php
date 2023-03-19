<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf08171d380845fca75fd30bea961d8a7
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WP_SENPAI\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WP_SENPAI\\' => 
        array (
            0 => __DIR__ . '/..' . '/senpai/wp-senpai/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf08171d380845fca75fd30bea961d8a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf08171d380845fca75fd30bea961d8a7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf08171d380845fca75fd30bea961d8a7::$classMap;

        }, null, ClassLoader::class);
    }
}
