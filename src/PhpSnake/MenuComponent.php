<?php

declare (strict_types = 1);

namespace PhpSnake;

class MenuComponent extends MenuComponentInterface
{

	/**
     * @var string
     */
    public $name;

    /**
	 * @var string
	 */
    private $key;

     /**
     * @var string
     */
    private $functionName;

	public function __construct(string $name, string   $functionName)
    {
    	    $this->name = $name;
            $this->functionName = $functionName;
    }


    public function getName()
    {
    	return $this->name;
    }

    public function setKey($key)
    {
    	$this->key=$key; 
    }

    public function getKey()
    {
    	return $this->key;
    }

    public function getfunctionName()
    {
        return $this->functionName;
    }


}