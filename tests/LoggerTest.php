<?php


namespace Test;

use App\StringCalculator\StringCalculatorLogger;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{

    /**
     * @var \org\bovigo\vfs\vfsStreamFile
     */
    private $file;
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $root;

    /**
     *
     */
    public function setUp()
    {
        $this->root = vfsStream::setup('root');
        $this->file = vfsStream::newFile('test.txt')->at($this->root);
    }

    /**
     *
     */
    public function testLogger()
    {
        $logger = new StringCalculatorLogger($this->file->url());

        $logger->logSum(4);

        $this->assertTrue($this->root->hasChild('root/test.txt'));
        $this->assertEquals('Sum: 4 \\n', $this->file->getContent());
    }
}
