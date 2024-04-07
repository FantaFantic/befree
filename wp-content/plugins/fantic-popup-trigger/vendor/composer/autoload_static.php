<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcf774d220764a4d2e8b64280b4ed28a5
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcf774d220764a4d2e8b64280b4ed28a5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcf774d220764a4d2e8b64280b4ed28a5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcf774d220764a4d2e8b64280b4ed28a5::$classMap;

        }, null, ClassLoader::class);
    }
}
