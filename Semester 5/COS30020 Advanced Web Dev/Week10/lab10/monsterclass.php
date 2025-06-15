<?php
class Monster
{
    // Properties
    private $num_of_eyes;
    private $colour;

    // Constructor to initialize number of eyes and colour
    public function __construct($num, $col)
    {
        $this->num_of_eyes = $num;
        $this->colour = $col;
    }

    // Method to describe the monster
    public function describe()
    {
        return "The " . $this->colour . " monster has " . $this->num_of_eyes . " eyes.";
    }
}
