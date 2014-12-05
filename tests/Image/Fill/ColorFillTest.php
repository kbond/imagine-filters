<?php

namespace Zenstruck\Imagine\Tests\Image\Fill;

use Imagine\Image\Color;
use Zenstruck\Imagine\Image\Fill\ColorFill;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ColorFillTest extends \PHPUnit_Framework_TestCase
{
    public function testGetColor()
    {
        $color = new Color('FFFFFF');

        $fill = new ColorFill($color);

        $this->assertSame($color, $fill->getColor($this->getMock('Imagine\Image\PointInterface')));
    }
}
