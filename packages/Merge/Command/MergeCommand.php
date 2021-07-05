<?php

declare (strict_types=1);
namespace MonorepoBuilder20210705\Symplify\MonorepoBuilder\Merge\Command;

use MonorepoBuilder20210705\Symfony\Component\Console\Input\InputInterface;
use MonorepoBuilder20210705\Symfony\Component\Console\Output\OutputInterface;
use MonorepoBuilder20210705\Symplify\ComposerJsonManipulator\ComposerJsonFactory;
use MonorepoBuilder20210705\Symplify\ComposerJsonManipulator\FileSystem\JsonFileManager;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\Merge\Application\MergedAndDecoratedComposerJsonFactory;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\Merge\Guard\ConflictingVersionsGuard;
use MonorepoBuilder20210705\Symplify\MonorepoBuilder\Validator\SourcesPresenceValidator;
use MonorepoBuilder20210705\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand;
use MonorepoBuilder20210705\Symplify\PackageBuilder\Console\ShellCode;
final class MergeCommand extends \MonorepoBuilder20210705\Symplify\PackageBuilder\Console\Command\AbstractSymplifyCommand
{
    /**
     * @var \Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider
     */
    private $composerJsonProvider;
    /**
     * @var \Symplify\ComposerJsonManipulator\ComposerJsonFactory
     */
    private $composerJsonFactory;
    /**
     * @var \Symplify\ComposerJsonManipulator\FileSystem\JsonFileManager
     */
    private $jsonFileManager;
    /**
     * @var \Symplify\MonorepoBuilder\Merge\Application\MergedAndDecoratedComposerJsonFactory
     */
    private $mergedAndDecoratedComposerJsonFactory;
    /**
     * @var \Symplify\MonorepoBuilder\Validator\SourcesPresenceValidator
     */
    private $sourcesPresenceValidator;
    /**
     * @var \Symplify\MonorepoBuilder\Merge\Guard\ConflictingVersionsGuard
     */
    private $conflictingVersionsGuard;
    public function __construct(\MonorepoBuilder20210705\Symplify\MonorepoBuilder\FileSystem\ComposerJsonProvider $composerJsonProvider, \MonorepoBuilder20210705\Symplify\ComposerJsonManipulator\ComposerJsonFactory $composerJsonFactory, \MonorepoBuilder20210705\Symplify\ComposerJsonManipulator\FileSystem\JsonFileManager $jsonFileManager, \MonorepoBuilder20210705\Symplify\MonorepoBuilder\Merge\Application\MergedAndDecoratedComposerJsonFactory $mergedAndDecoratedComposerJsonFactory, \MonorepoBuilder20210705\Symplify\MonorepoBuilder\Validator\SourcesPresenceValidator $sourcesPresenceValidator, \MonorepoBuilder20210705\Symplify\MonorepoBuilder\Merge\Guard\ConflictingVersionsGuard $conflictingVersionsGuard)
    {
        $this->composerJsonProvider = $composerJsonProvider;
        $this->composerJsonFactory = $composerJsonFactory;
        $this->jsonFileManager = $jsonFileManager;
        $this->mergedAndDecoratedComposerJsonFactory = $mergedAndDecoratedComposerJsonFactory;
        $this->sourcesPresenceValidator = $sourcesPresenceValidator;
        $this->conflictingVersionsGuard = $conflictingVersionsGuard;
        parent::__construct();
    }
    protected function configure() : void
    {
        $this->setDescription('Merge "composer.json" from all found packages to root one');
    }
    protected function execute(\MonorepoBuilder20210705\Symfony\Component\Console\Input\InputInterface $input, \MonorepoBuilder20210705\Symfony\Component\Console\Output\OutputInterface $output) : int
    {
        $this->sourcesPresenceValidator->validatePackageComposerJsons();
        $this->conflictingVersionsGuard->ensureNoConflictingPackageVersions();
        $mainComposerJsonFilePath = \getcwd() . '/composer.json';
        $mainComposerJson = $this->composerJsonFactory->createFromFilePath($mainComposerJsonFilePath);
        $packageFileInfos = $this->composerJsonProvider->getPackagesComposerFileInfos();
        $this->mergedAndDecoratedComposerJsonFactory->createFromRootConfigAndPackageFileInfos($mainComposerJson, $packageFileInfos);
        $this->jsonFileManager->printComposerJsonToFilePath($mainComposerJson, $mainComposerJsonFilePath);
        $this->symfonyStyle->success('Main "composer.json" was updated.');
        return \MonorepoBuilder20210705\Symplify\PackageBuilder\Console\ShellCode::SUCCESS;
    }
}