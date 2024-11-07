<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit543604cc8561c14136d1dfeb3eb1d9bf
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Libsql\\Tests\\' => 13,
            'Libsql\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Libsql\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/turso/libsql/tests',
        ),
        'Libsql\\' => 
        array (
            0 => __DIR__ . '/..' . '/turso/libsql/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Libsql\\Blob' => __DIR__ . '/..' . '/turso/libsql/src/Blob.php',
        'Libsql\\CharBox' => __DIR__ . '/..' . '/turso/libsql/src/CharBox.php',
        'Libsql\\Connection' => __DIR__ . '/..' . '/turso/libsql/src/Connection.php',
        'Libsql\\Database' => __DIR__ . '/..' . '/turso/libsql/src/Database.php',
        'Libsql\\LibsqlException' => __DIR__ . '/..' . '/turso/libsql/src/LibsqlException.php',
        'Libsql\\Prepareable' => __DIR__ . '/..' . '/turso/libsql/src/Prepareable.php',
        'Libsql\\Row' => __DIR__ . '/..' . '/turso/libsql/src/Row.php',
        'Libsql\\Rows' => __DIR__ . '/..' . '/turso/libsql/src/Rows.php',
        'Libsql\\Statement' => __DIR__ . '/..' . '/turso/libsql/src/Statement.php',
        'Libsql\\Transaction' => __DIR__ . '/..' . '/turso/libsql/src/Transaction.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit543604cc8561c14136d1dfeb3eb1d9bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit543604cc8561c14136d1dfeb3eb1d9bf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit543604cc8561c14136d1dfeb3eb1d9bf::$classMap;

        }, null, ClassLoader::class);
    }
}