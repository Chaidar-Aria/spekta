<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit977621902085e84d35bc1e4c96c6e773
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit977621902085e84d35bc1e4c96c6e773::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit977621902085e84d35bc1e4c96c6e773::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit977621902085e84d35bc1e4c96c6e773::$classMap;

        }, null, ClassLoader::class);
    }
}
