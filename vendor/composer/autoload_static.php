<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd40684c4ac1f7e0e6b04b26bcb64098f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sentiment\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sentiment\\' => 
        array (
            0 => __DIR__ . '/..' . '/davmixcool/php-sentiment-analyzer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd40684c4ac1f7e0e6b04b26bcb64098f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd40684c4ac1f7e0e6b04b26bcb64098f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd40684c4ac1f7e0e6b04b26bcb64098f::$classMap;

        }, null, ClassLoader::class);
    }
}