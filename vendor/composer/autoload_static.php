<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit59f97359bbb57ec1f0bea11b3d1dad31
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit59f97359bbb57ec1f0bea11b3d1dad31::$classMap;

        }, null, ClassLoader::class);
    }
}
