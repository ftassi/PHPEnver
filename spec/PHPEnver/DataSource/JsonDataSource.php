<?php

namespace spec\PHPEnver\DataSource;

use PHPSpec2\Exception\Example\MatcherException;
use PHPSpec2\ObjectBehavior;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamWrapper;

class JsonDataSource extends ObjectBehavior
{
    /**
     * @param \PHPEnver\Encryption\EncryptionStrategy $encryptionStrategy
     */
    function let($encryptionStrategy)
    {
        vfsStreamWrapper::register();
        $root = vfsStreamWrapper::setRoot(new vfsStreamDirectory('root'));
        $jsonFile = new vfsStreamFile('file.json');
        $jsonFile->setContent(
            json_encode(
                array(
                    'foo.key' => 'fooCryptedValue',
                    'foo.key2' => 'fooCryptedValue2',
                )
            )
        );
        $root->addChild($jsonFile);

        $this->beConstructedWith('vfs://root/file.json', $encryptionStrategy);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('PHPEnver\DataSource\JsonDataSource');
        $this->shouldHaveType('PHPEnver\DataSource\DataSourceInterface');
    }

    function it_should_read_data_by_key($encryptionStrategy)
    {
        $encryptionStrategy->decrypt('fooCryptedValue')->willReturn('fooValue');
        $this->get('foo.key')->shouldReturn('fooValue');
    }

    function it_should_save_data_by_key($encryptionStrategy)
    {
        $encryptionStrategy->encrypt('fooNewValue')->willReturn('fooCryptedNewValue');
        $this->set('foo.newKey', 'fooNewValue')->shouldReturn(true);

        $fileContent = file_get_contents('vfs://root/file.json');
        if ($fileContent !== '{"foo.key":"fooCryptedValue","foo.key2":"fooCryptedValue2","foo.newKey":"fooCryptedNewValue"}'){
            throw new MatcherException('Invalid file content: ' . $fileContent);
        }
    }

    function it_should_delete_data_by_key()
    {
        $this->delete('foo.key')->shouldReturn(true);

        $fileContent = file_get_contents('vfs://root/file.json');
        if ($fileContent !== '{"foo.key2":"fooCryptedValue2"}'){
            throw new MatcherException('Invalid file content: ' . $fileContent);
        }
    }

    function it_should_return_all_keys()
    {
        $this->getKeys()->shouldReturn(array('foo.key', 'foo.key2'));
    }

}
