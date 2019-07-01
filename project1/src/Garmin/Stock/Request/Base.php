<?php


namespace App\Garmin\Stock\Request;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


abstract class Base
{
    protected $uri;

    protected $cookieStr = '__cfduid=d3481a4eab81924cbbe1e6ea3a5a90e371544269004; exp_last_visit=1555453778; exp_last_activity=1555539193; utag_main=v_id:01678d9b088d000291c7728e3e0e0104c002100900bd0$_sn:54$_ss:1$_st:1561583896591$ses_id:1561582096591%3Bexp-session$_pn:1%3Bexp-session; __utma=143254506.1798640067.1544269007.1560974302.1561487306.51; __utmz=143254506.1560807763.46.23.utmcsr=sso.garmin.com|utmccn=(referral)|utmcmd=referral|utmcct=/sso/signin; _ga=GA1.2.1798640067.1544269007; __cfduid=dd1213e31a829d3db1ec850cb2bd5400b1553706286; GarminGlobalStorage=%7B%22global%22%3A%7B%22locale%22%3A%22pl-PL%22%2C%22language%22%3A%22pl%22%2C%22country%22%3A%22PL%22%7D%7D; notice_preferences=2:; notice_gdpr_prefs=0,1,2:; gc__last_visit=1555270050; gc__last_activity=1555350549; G_ENABLED_IDPS=google; GARMIN-SSO=1; GarminNoCache=true; GARMIN-SSO-GUID=7EE1EAA41CFFAA748F052D108860CE96CC9FB062; GARMIN-SSO-CUST-GUID=6300101696356451; __atuvc=1%7C26; SESSIONID=61112422-a5a9-4b5c-9793-f99fe1b9ba11; ADRUM_BTa=R:0|g:e0bdedca-fe25-47ef-b5c8-ff9d6da0333d|n:garmin_869629ee-d273-481d-b5a4-f4b0a8c4d5a3; ADRUM_BT1=R:0|i:259024';

    protected $content;

    public function fetch()
    {
        $this->prepareUri();
        $cookieJar = new CookieJar();
        foreach (explode('; ', $this->cookieStr) as $str) {
            $exploded = explode('=', $str);
            $cookie = new Cookie($exploded[0], $exploded[1]);
            $cookieJar->set($cookie);
        }

//        $cookie = new Cookie('SESSIONID', '1bbaff05-16b5-467c-8716-a077d627c614');
//        $cookieJar->set($cookie);

        $headers = [
            "Accept" => "application/json, text/plain, */*",
            "Accept-Encoding" => "deflate"
        ];


        $options = [
            'headers' =>
                array_merge(
                    $headers,
                    ['Cookie' => implode('; ', $cookieJar->all())]
                )

        ];
        $httpClient = HttpClient::create($options);
        $response = $httpClient->request('GET', $this->uri, $options);
        $this->content = $response->getContent();

        return $this;
    }

    protected function prepareUri()
    {}

    public function toArray()
    {
        return json_decode($this->content, true);
    }

    public function getContent()
    {
        return $this->content;
    }

    abstract public function response(): \App\Garmin\Stock\Response\Base;

}