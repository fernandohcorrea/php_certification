<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb51568dc967b29a58ab3b0e13981110b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpCertification\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpCertification\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/PhpCertification',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb51568dc967b29a58ab3b0e13981110b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb51568dc967b29a58ab3b0e13981110b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
