<?php

declare (strict_types = 1);

namespace PhpSnake;

abstract class MenuComponentInterface
{
	/**
     * @var string
     */
    private $name;

    /**
	 * @var string
	 */
    private $key;

     /**
     * @var string
     */
    private $functionName;





    abstract function getName();

    abstract function getfunctionName();

    abstract function setKey($key);

    abstract function getKey();

}