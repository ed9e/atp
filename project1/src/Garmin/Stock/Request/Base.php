<?php


namespace App\Garmin\Stock\Request;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


abstract class Base
{
    protected $uri;

    protected $cookieStr = 'G_AUTHUSER_H=0; __cfduid=dff6031eadfabcae9cc6a1a18d41cab631559565953; utag_main=v_id:016b1d604de9000ab5cf19ecde0a0104c002200900bd0$_sn:23$_ss:1$_st:1561644576742$ses_id:1561642776742%3Bexp-session$_pn:1%3Bexp-session; __utma=143254506.849559551.1559565979.1560944914.1561444382.18; __utmz=143254506.1560147763.8.2.utmcsr=sso.garmin.com|utmccn=(referral)|utmcmd=referral|utmcct=/sso/signin; G_ENABLED_IDPS=google; GarminUserPrefs=en-US; ADRUM=s=1561642773649&r=https%3A%2F%2Fconnect.garmin.com%2Fmodern%2F%3F0; GARMIN-SSO=1; GarminNoCache=true; GARMIN-SSO-GUID=7EE1EAA41CFFAA748F052D108860CE96CC9FB062; GARMIN-SSO-CUST-GUID=6300101696356451; SESSIONID=586d8257-486e-43ef-9fe8-976c4c25bde6';

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