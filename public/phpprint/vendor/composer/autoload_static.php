<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite6a3ecdf760046d306a286763e9a4c51
{
    public static $classMap = array (
        'BasicIPP' => __DIR__ . '/../..' . '/lib/BasicIPP.php',
        'CupsPrintIPP' => __DIR__ . '/../..' . '/lib/CupsPrintIPP.php',
        'ExtendedPrintIPP' => __DIR__ . '/../..' . '/lib/ExtendedPrintIPP.php',
        'PrintIPP' => __DIR__ . '/../..' . '/lib/PrintIPP.php',
        'httpException' => __DIR__ . '/../..' . '/lib/http_class.php',
        'http_class' => __DIR__ . '/../..' . '/lib/http_class.php',
        'ippException' => __DIR__ . '/../..' . '/lib/BasicIPP.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite6a3ecdf760046d306a286763e9a4c51::$classMap;

        }, null, ClassLoader::class);
    }
}
