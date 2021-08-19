<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20210819\Symfony\Component\DependencyInjection\Exception;

/**
 * Base LogicException for Dependency Injection component.
 */
class LogicException extends \LogicException implements \MonorepoBuilder20210819\Symfony\Component\DependencyInjection\Exception\ExceptionInterface
{
}
