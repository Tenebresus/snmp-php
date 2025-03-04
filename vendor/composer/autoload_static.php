<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit192d13b599f20ed031600944b79f4869
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tenebresus\\Snmp\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tenebresus\\Snmp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit192d13b599f20ed031600944b79f4869::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit192d13b599f20ed031600944b79f4869::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit192d13b599f20ed031600944b79f4869::$classMap;

        }, null, ClassLoader::class);
    }
}
