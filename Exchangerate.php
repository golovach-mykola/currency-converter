<?php
require_once('ConverterInterface.php');

class Exchangerate implements ConverterInterface
{

    private $local;
    private $signforeign;
    private $signlocal;
    private $baseUrl="https://exchangerate.guru/";

    function __construct($signlocal="USD",$signforeign="UAH",$amount=1)
    {
        $this->signlocal=$signlocal;
        $this->signforeign=$signforeign;
        $this->local=$amount;
    }
    function convert(){
        $url=$this->baseUrl.strtolower($this->signlocal)."/".strtolower($this->signforeign)."/".$this->local;
        $foreign=$this->parser($url);
        if(!empty($foreign)){
            return array($this->signlocal=>$foreign[0],$this->signforeign=>$foreign[1]);
        }
        return array();
    }
    function nativecurl($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);

        return $result;
    }
    function parser ($url){
        $html = $this->nativecurl($url);
        $dom = new DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        $val=array();
        $input = $dom->getElementsByTagName('input');
        foreach ($input as $tag) {
            $val[] = $tag->getAttribute('value');
        }
        libxml_use_internal_errors($internalErrors);
        return $val;
    }
}