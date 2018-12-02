<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb75706530db4495421b13b8490c3f1ed
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb75706530db4495421b13b8490c3f1ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb75706530db4495421b13b8490c3f1ed::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}