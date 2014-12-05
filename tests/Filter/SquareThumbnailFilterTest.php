<?php

namespace Zenstruck\Imagine\Tests\Filter;

use Imagine\Image\Box;
use Imagine\Image\Color;
use Zenstruck\Imagine\Filter\SquareThumbnailFilter;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class SquareThumbnailFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testApplyWithLargerImage()
    {
        $size = new Box(10, 10);
        $filter = new SquareThumbnailFilter($size, new Color('FFFFFF'));
        $thumb = $this->getMock('Imagine\Image\ImageInterface');
        $image = $this->getMock('Imagine\Image\ImageInterface');

        $image->expects($this->once())
            ->method('getSize')
            ->will($this->returnValue(new Box(20, 20)));
        $image->expects($this->once())
            ->method('thumbnail')
            ->with($size)
            ->will($this->returnValue($thumb));
        $image->expects($this->once())
            ->method('resize');
        $image->expects($this->once())
            ->method('fill')
            ->with($this->isInstanceOf('Zenstruck\Imagine\Image\Fill\ColorFill'));
        $thumb->expects($this->once())
            ->method('getSize')
            ->will($this->returnValue(new Box(5, 5)));
        $image->expects($this->once())
            ->method('paste')
            ->with($thumb, $this->isInstanceOf('Imagine\Image\Point'));

        $this->assertSame($image, $filter->apply($image));
    }

    public function testApplyWithSmallerImage()
    {
        $size = new Box(10, 10);
        $filter = new SquareThumbnailFilter($size, new Color('FFFFFF'));
        $thumb = $this->getMock('Imagine\Image\ImageInterface');
        $image = $this->getMock('Imagine\Image\ImageInterface');

        $image->expects($this->once())
            ->method('getSize')
            ->will($this->returnValue(new Box(8, 8)));
        $image->expects($this->once())
            ->method('thumbnail')
            ->with(new Box(8, 8))
            ->will($this->returnValue($thumb));
        $image->expects($this->once())
            ->method('resize');
        $image->expects($this->once())
            ->method('fill')
            ->with($this->isInstanceOf('Zenstruck\Imagine\Image\Fill\ColorFill'));
        $thumb->expects($this->once())
            ->method('getSize')
            ->will($this->returnValue(new Box(5, 5)));
        $image->expects($this->once())
            ->method('paste')
            ->with($thumb, $this->isInstanceOf('Imagine\Image\Point'));

        $this->assertSame($image, $filter->apply($image));
    }
}
