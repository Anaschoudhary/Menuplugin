<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf0fa53712d73ec692800153d8f4568ff
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf0fa53712d73ec692800153d8f4568ff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf0fa53712d73ec692800153d8f4568ff::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
