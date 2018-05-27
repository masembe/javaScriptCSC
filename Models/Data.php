<?php


class Data
{
    protected $email;

    public function __construct($email)
    { $this->email = $email;}

    public function getEmail()
    {return $this->email;}

}