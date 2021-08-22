<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Aliases for the whitelisted classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#class-whitelisting
if (!class_exists('ComposerAutoloaderInitb45ad35fc9eb8fc5f04f49d1062395d4', false) && !interface_exists('ComposerAutoloaderInitb45ad35fc9eb8fc5f04f49d1062395d4', false) && !trait_exists('ComposerAutoloaderInitb45ad35fc9eb8fc5f04f49d1062395d4', false)) {
    spl_autoload_call('MonorepoBuilder20210822\ComposerAutoloaderInitb45ad35fc9eb8fc5f04f49d1062395d4');
}
if (!class_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !interface_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false) && !trait_exists('Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator', false)) {
    spl_autoload_call('MonorepoBuilder20210822\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator');
}
if (!class_exists('Normalizer', false) && !interface_exists('Normalizer', false) && !trait_exists('Normalizer', false)) {
    spl_autoload_call('MonorepoBuilder20210822\Normalizer');
}
if (!class_exists('JsonException', false) && !interface_exists('JsonException', false) && !trait_exists('JsonException', false)) {
    spl_autoload_call('MonorepoBuilder20210822\JsonException');
}
if (!class_exists('Attribute', false) && !interface_exists('Attribute', false) && !trait_exists('Attribute', false)) {
    spl_autoload_call('MonorepoBuilder20210822\Attribute');
}
if (!class_exists('Stringable', false) && !interface_exists('Stringable', false) && !trait_exists('Stringable', false)) {
    spl_autoload_call('MonorepoBuilder20210822\Stringable');
}
if (!class_exists('UnhandledMatchError', false) && !interface_exists('UnhandledMatchError', false) && !trait_exists('UnhandledMatchError', false)) {
    spl_autoload_call('MonorepoBuilder20210822\UnhandledMatchError');
}
if (!class_exists('ValueError', false) && !interface_exists('ValueError', false) && !trait_exists('ValueError', false)) {
    spl_autoload_call('MonorepoBuilder20210822\ValueError');
}
if (!class_exists('ReturnTypeWillChange', false) && !interface_exists('ReturnTypeWillChange', false) && !trait_exists('ReturnTypeWillChange', false)) {
    spl_autoload_call('MonorepoBuilder20210822\ReturnTypeWillChange');
}

// Functions whitelisting. For more information see:
// https://github.com/humbug/php-scoper/blob/master/README.md#functions-whitelisting
if (!function_exists('resolveConfigFileInfo')) {
    function resolveConfigFileInfo() {
        return \MonorepoBuilder20210822\resolveConfigFileInfo(...func_get_args());
    }
}
if (!function_exists('composerRequireb45ad35fc9eb8fc5f04f49d1062395d4')) {
    function composerRequireb45ad35fc9eb8fc5f04f49d1062395d4() {
        return \MonorepoBuilder20210822\composerRequireb45ad35fc9eb8fc5f04f49d1062395d4(...func_get_args());
    }
}
if (!function_exists('setproctitle')) {
    function setproctitle() {
        return \MonorepoBuilder20210822\setproctitle(...func_get_args());
    }
}
if (!function_exists('array_is_list')) {
    function array_is_list() {
        return \MonorepoBuilder20210822\array_is_list(...func_get_args());
    }
}
if (!function_exists('enum_exists')) {
    function enum_exists() {
        return \MonorepoBuilder20210822\enum_exists(...func_get_args());
    }
}
if (!function_exists('includeIfExists')) {
    function includeIfExists() {
        return \MonorepoBuilder20210822\includeIfExists(...func_get_args());
    }
}
if (!function_exists('dump')) {
    function dump() {
        return \MonorepoBuilder20210822\dump(...func_get_args());
    }
}
if (!function_exists('dd')) {
    function dd() {
        return \MonorepoBuilder20210822\dd(...func_get_args());
    }
}

return $loader;
