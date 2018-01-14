<?php

declare (strict_types = 1);

namespace PhpSnake;

class MenuComponent extends MenuComponentInterface
{

	/**
     * @var string
     */
    public $name;

	public function __construct(string $name)
    {
    	    $this->name = $name;
    }


    public function getName()
    {
    	return $this->name;
    }


}