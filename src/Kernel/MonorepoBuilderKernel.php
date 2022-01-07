<?php

declare (strict_types=1);
namespace Symplify\MonorepoBuilder\Kernel;

use MonorepoBuilder20220107\Psr\Container\ContainerInterface;
use MonorepoBuilder20220107\Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonManipulatorConfig;
use MonorepoBuilder20220107\Symplify\ConsoleColorDiff\ValueObject\ConsoleColorDiffConfig;
use Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface;
use MonorepoBuilder20220107\Symplify\PackageBuilder\DependencyInjection\CompilerPass\AutowireInterfacesCompilerPass;
use MonorepoBuilder20220107\Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;
final class MonorepoBuilderKernel extends \MonorepoBuilder20220107\Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel
{
    /**
     * @param string[] $configFiles
     */
    public function createFromConfigs(array $configFiles) : \MonorepoBuilder20220107\Psr\Container\ContainerInterface
    {
        $configFiles[] = __DIR__ . '/../../config/config.php';
        $configFiles[] = \MonorepoBuilder20220107\Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonManipulatorConfig::FILE_PATH;
        $configFiles[] = \MonorepoBuilder20220107\Symplify\ConsoleColorDiff\ValueObject\ConsoleColorDiffConfig::FILE_PATH;
        $autowireInterfacesCompilerPass = new \MonorepoBuilder20220107\Symplify\PackageBuilder\DependencyInjection\CompilerPass\AutowireInterfacesCompilerPass([\Symplify\MonorepoBuilder\Release\Contract\ReleaseWorker\ReleaseWorkerInterface::class]);
        $compilerPasses = [$autowireInterfacesCompilerPass];
        return $this->create([], $compilerPasses, $configFiles);
    }
}
