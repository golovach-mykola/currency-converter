<?php


class CursConverter
{
    protected $converter;

    function __construct(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    function convert(){
        return $this->converter->convert();
    }
}