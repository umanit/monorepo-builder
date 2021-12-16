<?php

declare (strict_types=1);
namespace MonorepoBuilder20211216\Symplify\SymplifyKernel\Contract\Config;

use MonorepoBuilder20211216\Symfony\Component\Config\Loader\LoaderInterface;
use MonorepoBuilder20211216\Symfony\Component\DependencyInjection\ContainerBuilder;
interface LoaderFactoryInterface
{
    public function create(\MonorepoBuilder20211216\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder, string $currentWorkingDirectory) : \MonorepoBuilder20211216\Symfony\Component\Config\Loader\LoaderInterface;
}
