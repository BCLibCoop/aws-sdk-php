<?php
namespace Aws\Test\Sqs;

use Aws\Sqs\SqsFactory;
use Aws\Test\SdkTest;

/**
 * @covers Aws\Sqs\SqsFactory
 */
class SqsTest extends \PHPUnit_Framework_TestCase
{
    public function testAttachesSubscribers()
    {
        $f = new SqsFactory();
        $client = $f->create([
            'service' => 'sqs',
            'region'  => 'us-west-2',
            'version' => 'latest'
        ]);

        $this->assertTrue(SdkTest::hasListener(
            $client->getEmitter(),
            'Aws\Sqs\QueueUrlSubscriber',
            'prepared'
        ));

        $this->assertTrue(SdkTest::hasListener(
            $client->getEmitter(),
            'Aws\Sqs\Md5ValidatorSubscriber',
            'process'
        ));
    }
}