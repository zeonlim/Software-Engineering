<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7208ce0048a1fad662fb2dccf0fd83f4
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7208ce0048a1fad662fb2dccf0fd83f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7208ce0048a1fad662fb2dccf0fd83f4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
