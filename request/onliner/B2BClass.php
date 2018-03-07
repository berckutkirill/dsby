<?php

class B2BOnliner {

    private $authUrl;
    private $csvUrl;
    private $email;
    private $password;
    private $cookie;
    private $uagent;

    public function __construct() {
        $this->authUrl = "https://b2b.onliner.by/login";
        $this->csvUrl = "https://b2b.onliner.by/pricelists/positions?format=csv&currency=BYR&submit=%D0%A1%D0%BA%D0%B0%D1%87%D0%B0%D1%82%D1%8C";
        $this->email = "ДВЕРНОЙ СЕЗОН";
        $this->password = "K5dbfde2";
        $this->cookie = $_SERVER['DOCUMENT_ROOT'] . '/request/onliner/cookies.txt';
        $this->uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)";
    }

    public function auth() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->authUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->uagent);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$this->email&password=$this->password");
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_exec($ch);
        curl_close($ch);
    }
    public function getCsv() {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->csvUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->uagent);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        $content = curl_exec($ch);
        curl_close($ch);
        
        $Data = str_getcsv($content, "\n"); //parse the rows 
        foreach($Data as &$Row) {
            $Row = str_getcsv($Row, ";"); //parse the items in rows 
        }
        
        return $Data;
    }

}