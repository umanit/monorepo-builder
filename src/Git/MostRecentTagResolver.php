<?php

declare(strict_types=1);

namespace Symplify\MonorepoBuilder\Git;

use Symplify\MonorepoBuilder\Contract\Git\TagResolverInterface;
use Symplify\MonorepoBuilder\Release\Process\ProcessRunner;

/**
 * @api used by default autowire
 */
final class MostRecentTagResolver implements TagResolverInterface
{
    /**
     * @var string[]
     */
    private const COMMAND = 'git tag -l --merged %s --sort=committerdate';

    public function __construct(
        private ProcessRunner $processRunner
    ) {
    }

    /**
     * Returns null, when there are no local tags yet
     */
    public function resolve(string $gitDirectory): ?string
    {
        $currentBranch = trim(
            preg_replace(
                '/\s+/',
                ' ',
                $this->processRunner->run('git branch --show-current')
            )
        );
        $tagList = $this->parseTags($this->processRunner->run(sprintf(self::COMMAND, $currentBranch), $gitDirectory));
        /** @var string $theMostRecentTag */
        $theMostRecentTag = (string) array_pop($tagList);

        if ($theMostRecentTag === '') {
            return null;
        }

        return $theMostRecentTag;
    }

    /**
     * @return string[]
     */
    private function parseTags(string $commandResult): array
    {
        $tags = trim($commandResult);

        // Remove all "\r" chars in case the CLI env like the Windows OS.
        // Otherwise (ConEmu, git bash, mingw cli, e.g.), leave as is.
        $normalizedTags = str_replace("\r", '', $tags);

        return explode("\n", $normalizedTags);
    }
}
