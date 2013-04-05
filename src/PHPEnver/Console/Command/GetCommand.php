<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 30/03/13
 * Time: 17:30
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\Console\Command;

use PHPEnver\DataSource\JsonDataSource;
use PHPEnver\Encryption\Mcrypt;
use PHPEnver\Encryption\PlainText;
use PHPEnver\PHPEnver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetCommand extends Command
{
    protected function configure()
    {
        $this->setName('get')
            ->setDescription('Copy a password to your clipboard');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $passwordFile = getenv('HOME') . '/.phpenver/password.json';
        $dialog = $this->getHelperSet()->get('dialog');

        $masterPassword = $dialog->askHiddenResponse($output, 'Master password ');

        $dataSource = new JsonDataSource($passwordFile, new Mcrypt($masterPassword));
        $enver = new PHPEnver($dataSource);

        $keyList = $enver->getKeys();

        $key = $dialog->ask($output, 'Which password you need? ', '', $keyList);
        $output->writePrivateData($enver->get($key));
    }
}