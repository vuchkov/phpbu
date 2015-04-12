<?php
namespace phpbu\App\Cli\Executable;

/**
 * Compressor Test
 *
 * @package    phpbu
 * @subpackage tests
 * @author     Sebastian Feldmann <sebastian@phpbu.de>
 * @copyright  Sebastian Feldmann <sebastian@phpbu.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpbu.de/
 * @since      Class available since Release 2.1.0
 */
class CompressorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Compressor::getCommandLine
     */
    public function testDefault()
    {
        $path = realpath(__DIR__ . '/../../../_files/bin');
        $gzip = new Compressor('gzip', $path);
        $gzip->force(true)->compressFile(__FILE__);

        $this->assertEquals($path . '/gzip -f \'' . __FILE__ . '\' 2> /dev/null', $gzip->getCommandLine());
    }

    /**
     * Tests Compressor::compressFile
     *
     * @expectedException \phpbu\App\Exception
     */
    public function testCompressNonExistingFile()
    {
        $path = realpath(__DIR__ . '/../../../_files/bin');
        $gzip = new Compressor('gzip', $path);
        $gzip->compressFile(__FILE__ . '.fail');
    }

    /**
     * Tests Compressor::compressFile
     *
     * @expectedException \phpbu\App\Exception
     */
    public function testFailEarlyCompress()
    {
        $path = realpath(__DIR__ . '/../../../_files/bin');
        $gzip = new Compressor('gzip', $path);
        $gzip->run();
    }
}
