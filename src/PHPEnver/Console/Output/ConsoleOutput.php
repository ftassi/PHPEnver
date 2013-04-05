<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 05/04/13
 * Time: 21:27
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\Console\Output;

use Symfony\Component\Console\Output\ConsoleOutput as BaseConsoleOutput;

class ConsoleOutput extends BaseConsoleOutput
{
    public function writePrivateData($messages, $type = 0)
    {
        exec(sprintf('printf %s | pbcopy', $messages));
        $this->writeln('Data sent to clipboard', $type);
    }
}