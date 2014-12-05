<?php

namespace Zenstruck\Imagine\Image\Fill;

use Imagine\Image\Fill\FillInterface;
use Imagine\Image\PointInterface;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ColorFill implements FillInterface
{
    private $color;

    /**
     * @param \Imagine\Image\Palette\Color\ColorInterface|\Imagine\Image\Color $color
     */
    public function __construct($color)
    {
        if (class_exists('\Imagine\Image\Color') && !$color instanceof \Imagine\Image\Color) {
            throw new \InvalidArgumentException('Must be instance of \Imagine\Image\Color.');
        }

        if (interface_exists('\Imagine\Image\Palette\Color\ColorInterface') && !$color instanceof \Imagine\Image\Palette\Color\ColorInterface) {
            throw new \InvalidArgumentException('Must be instance of \Imagine\Image\Palette\Color\ColorInterface.');
        }

        $this->color = $color;
    }

    /**
     * {@inheritdoc}
     */
    public function getColor(PointInterface $position)
    {
        return $this->color;
    }
}
