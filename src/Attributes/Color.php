<?php declare(strict_types=1);

namespace PAN\Attributes;

trait Color
{
    protected $color;

    public function setColor(string $color): void
    {
        $this->color = ucwords(strtolower($color));
    }

    public function colorIsValid(): bool
    {
        $colors = [
            'Red', 'Green', 'Blue', 'Yellow', 'Copper', 'Orange',
            'Purple', 'Gray', 'Light Green', 'Cyan', 'Light Gray',
            'Blue Gray', 'Lime', 'Black', 'Gold', 'Brown', 'Olive',
            'Maroon', 'Red-Orange', 'Yellow-Orange', 'Forest Green',
            'Turquoise Blue', 'Azure Blue', 'Cerulean Blue',
            'Midnight Blue', 'Medium Blue', 'Cobalt Blue',
            'Violet Blue', 'Blue Violet', 'Medium Violet',
            'Medium Rose', 'Lavender', 'Orchid', 'Thistle',
            'Peach', 'Salmon', 'Magenta', 'Red Violet',
            'Mahogany', 'Burnt Sienna', 'Chestnut'
        ];

        return is_string($this->color) && in_array($this->color, $colors);
    }

    public function colorIsRequired(): bool
    {
        return false;
    }
}
