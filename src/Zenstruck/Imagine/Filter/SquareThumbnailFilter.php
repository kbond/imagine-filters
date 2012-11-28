<?php

namespace Zenstruck\Imagine\Filter;

use Imagine\Filter\FilterInterface;
use Imagine\Image\Color;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use Zenstruck\Imagine\Image\Fill\ColorFill;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class SquareThumbnailFilter implements FilterInterface
{
    protected $size;
    protected $color;

    public function __construct(BoxInterface $size, Color $color)
    {
        $this->size = $size;
        $this->color = $color;
    }

    public function apply(ImageInterface $image)
    {
        // create thumbnail
        $thumb = $image->thumbnail($this->size, ImageInterface::THUMBNAIL_INSET);

        // create square canvas
        $image->resize($this->size);

        // fill with color
        $image->fill(new ColorFill($this->color));

        // center thumbnail
        $thumbSize = $thumb->getSize();
        $x = (int) floor(($this->size->getWidth()/2)-($thumbSize->getWidth()/2));
        $y = (int) floor(($this->size->getHeight()/2)-($thumbSize->getHeight()/2));
        $pastePoint = new Point($x, $y);

        // place thumbnail on square canvas
        $image->paste($thumb, $pastePoint);

        return $image;
    }
}
