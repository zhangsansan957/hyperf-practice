<?php
/**
 * Date: 2022/11/3
 */

declare (strict_types=1);

namespace App\File\Handler;

use Monolog\Handler\RotatingFileHandler;

/**
 * 继承按日期处理handler
 * 1.严格level处理
 * Class RotatingFileStrictLevelHandler
 * @package App\File\Handler
 */
class RotatingFileStrictLevelHandler extends RotatingFileHandler
{
    public function isHandling(array $record): bool
    {
        return $record['level'] == $this->level;
    }
}