<?php

declare (strict_types=1);
namespace MonorepoBuilder20211011\Symplify\SymplifyKernel\Bundle;

use MonorepoBuilder20211011\Symfony\Component\DependencyInjection\ContainerBuilder;
use MonorepoBuilder20211011\Symfony\Component\HttpKernel\Bundle\Bundle;
use MonorepoBuilder20211011\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass;
use MonorepoBuilder20211011\Symplify\SymplifyKernel\DependencyInjection\Extension\SymplifyKernelExtension;
final class SymplifyKernelBundle extends \MonorepoBuilder20211011\Symfony\Component\HttpKernel\Bundle\Bundle
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder
     */
    public function build($containerBuilder) : void
    {
        $containerBuilder->addCompilerPass(new \MonorepoBuilder20211011\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass());
    }
    protected function createContainerExtension() : ?\MonorepoBuilder20211011\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
    {
        return new \MonorepoBuilder20211011\Symplify\SymplifyKernel\DependencyInjection\Extension\SymplifyKernelExtension();
    }
}
