<?php
namespace PlatziPHP\Domain;

class EntityNotFound extends \OutOfBoundsException
{
    private $id;

    public function __construct($id, $message = '', $code = 0, \Exception $previous = null)
    {
        $this->id = $id;

        parent::__construct($message, $code, $previous);
    }

    public function id()
    {
        return $this->id;
    }
}