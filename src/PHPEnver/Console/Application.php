<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 03/04/13
 * Time: 06:36
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\Console;

use PHPEnver\Console\Command\GetCommand;
use PHPEnver\Console\Command\SetCommand;
use PHPEnver\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class Application extends BaseApplication
{
    /**
     * @return array
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new GetCommand();
        $commands[] = new SetCommand();

        return $commands;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        if (null === $output) {
            $output = new ConsoleOutput();
        }

        parent::run($input, $output);
    }

}