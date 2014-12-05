<?php

namespace Zenstruck\Imagine\Tests\Image\Fill;

use Imagine\Image\Color;
use Imagine\Image\Palette\RGB;
use Zenstruck\Imagine\Image\Fill\ColorFill;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ColorFillTest extends \PHPUnit_Framework_TestCase
{
    public function testGetColor()
    {
        if (class_exists('Imagine\Image\Color')) {
            $color = new Color('FFFFFF');
        } else {
            $color = new RGB();
            $color = $color->color('FFFFFF');
        }

        $fill = new ColorFill($color);

        $this->assertSame($color, $fill->getColor($this->getMock('Imagine\Image\PointInterface')));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidColor()
    {
        $fill = new ColorFill('foo');
    }
}
