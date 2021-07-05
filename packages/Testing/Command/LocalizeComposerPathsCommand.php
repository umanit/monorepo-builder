<?php

declare (strict_types=1);
namespace MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\Command;

use MonorepoBuilder20210705\Symfony\Component\Console\Input\InputArgument;
use MonorepoBuilder20210705\Symfony\Component\Console\Input\InputInterface;
use MonorepoBuilder20210705\Symfony\Component\Console\Output\OutputInterface;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ComposerJsonRepositoriesUpdater;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ComposerJsonRequireUpdater;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ValueObject\Option;
use MonorepoBuilder20210705\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand;
use MonorepoBuilder20210705\Symplify\PackageBuilder\Console\ShellCode;
use MonorepoBuilder20210705\Symplify\SmartFileSystem\SmartFileInfo;
final class LocalizeComposerPathsCommand extends \MonorepoBuilder20210705\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand
{
    /**
     * @var \Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider
     */
    private $composerJsonProvider;
    /**
     * @var \Symplify\MonorepoBuilder\Testing\ComposerJsonRequireUpdater
     */
    private $composerJsonRequireUpdater;
    /**
     * @var \Symplify\MonorepoBuilder\Testing\ComposerJsonRepositoriesUpdater
     */
    private $composerJsonRepositoriesUpdater;
    public function __construct(\MonorepoBuilder20210705\Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider $composerJsonProvider, \MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ComposerJsonRequireUpdater $composerJsonRequireUpdater, \MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ComposerJsonRepositoriesUpdater $composerJsonRepositoriesUpdater)
    {
        $this->composerJsonProvider = $composerJsonProvider;
        $this->composerJsonRequireUpdater = $composerJsonRequireUpdater;
        $this->composerJsonRepositoriesUpdater = $composerJsonRepositoriesUpdater;
        parent::__construct();
    }
    protected function configure() : void
    {
        $this->setDescription('Set mutual package paths to local packages - use for pre-split package testing');
        $this->addArgument(\MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ValueObject\Option::PACKAGE_COMPOSER_JSON, \MonorepoBuilder20210705\Symfony\Component\Console\Input\InputArgument::REQUIRED, 'Path to package "composer.json"');
    }
    protected function execute(\MonorepoBuilder20210705\Symfony\Component\Console\Input\InputInterface $input, \MonorepoBuilder20210705\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        $packageComposerJson = (string) $input->getArgument(\MonorepoBuilder20210705\Symplify\MonorepoBuilder\Testing\ValueObject\Option::PACKAGE_COMPOSER_JSON);
        $this->fileSystemGuard->ensureFileExists($packageComposerJson, __METHOD__);
        $packageComposerJsonFileInfo = new \MonorepoBuilder20210705\Symplify\SmartFileSystem\SmartFileInfo($packageComposerJson);
        $rootComposerJson = $this->composerJsonProvider->getRootComposerJson();
        // 1. update "require" to "*" for all local packages
        $packagesFileInfos = $this->composerJsonProvider->getPackagesComposerFileInfos();
        foreach ($packagesFileInfos as $packageFileInfo) {
            $this->composerJsonRequireUpdater->processPackage($packageFileInfo);
        }
        // 2. update "repository" to "*" for current composer.json
        $this->composerJsonRepositoriesUpdater->processPackage($packageComposerJsonFileInfo, $rootComposerJson, \false);
        $message = \sprintf('Package paths in "%s" have been updated', $packageComposerJsonFileInfo->getRelativeFilePathFromCwd());
        $this->symfonyStyle->success($message);
        return \MonorepoBuilder20210705\Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
    }
}