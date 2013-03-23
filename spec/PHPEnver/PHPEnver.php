<?php

namespace spec\PHPEnver;

use PHPSpec2\ObjectBehavior;

class PHPEnver extends ObjectBehavior
{
    /**
     * @param \PHPEnver\DataSource\DataSourceInterface $dataSource
     */
    function let($dataSource)
    {
        $this->beConstructedWith($dataSource);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('PHPEnver\PHPEnver');
    }

    function it_get_a_data_by_key($dataSource)
    {
        $dataSource->get('foo.key')->willReturn('fooValue');

        $this->get('foo.key')->shouldReturn('fooValue');
    }

    function it_store_a_value($dataSource)
    {
        $dataSource->set('foo.key', 'fooValue')->willReturn(true);
        $this->set('foo.key', 'fooValue')->shouldReturn(true);
    }

    function it_delete_a_value($dataSource)
    {
        $dataSource->delete('foo.key')->willReturn(true);
        $this->delete('foo.key')->shouldReturn(true);
    }

    function it_list_existing_keys($dataSource)
    {
        $existingDatas = array(
            'foo.key'
        );
        $dataSource->getKeys()->willReturn($existingDatas);
        $this->getKeys()->shouldReturn($existingDatas);
    }

}
