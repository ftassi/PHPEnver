<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ftassi
 * Date: 05/04/13
 * Time: 22:27
 * To change this template use File | Settings | File Templates.
 */

namespace PHPEnver\Console\Command;


use PHPEnver\DataSource\JsonDataSource;
use PHPEnver\Encryption\Mcrypt;
use PHPEnver\PHPEnver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetCommand extends Command
{
    protected function configure()
    {
        $this->setName('set')
            ->setDescription('Store a password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $passwordFile = getenv('HOME') . '/.phpenver/password.json';

        /** @var $dialog DialogHelper */
        $dialog = $this->getHelperSet()->get('dialog');

        $masterPassword = $dialog->askHiddenResponse($output, 'Master password ');

        $dataSource = new JsonDataSource($passwordFile, new Mcrypt($masterPassword));
        $enver = new PHPEnver($dataSource);

        $keyList = $enver->getKeys();

        $key = $dialog->ask($output, 'Password identifier ', '', $keyList);
        $data = $dialog->askHiddenResponse($output, 'Password ');

        $output->writePrivateData($enver->set($key, $data));
    }
}