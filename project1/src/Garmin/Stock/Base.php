<?php


namespace App\Garmin\Stock;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


abstract class Base
{

    protected $cookieStr = 'G_AUTHUSER_H=0; __cfduid=dff6031eadfabcae9cc6a1a18d41cab631559565953; GARMIN-SSO=1; GarminNoCache=true; GARMIN-SSO-GUID=7EE1EAA41CFFAA748F052D108860CE96CC9FB062; GARMIN-SSO-CUST-GUID=6300101696356451; utag_main=v_id:016b1d604de9000ab5cf19ecde0a0104c002200900bd0$_sn:17$_ss:1$_st:1560946713654$ses_id:1560944913654%3Bexp-session$_pn:1%3Bexp-session; __utma=143254506.849559551.1559565979.1560838576.1560944914.17; __utmz=143254506.1560147763.8.2.utmcsr=sso.garmin.com|utmccn=(referral)|utmcmd=referral|utmcct=/sso/signin; G_ENABLED_IDPS=google; GarminUserPrefs=en-US; ADRUM=s=1560838672106&r=https%3A%2F%2Fconnect.garmin.com%2Fmodern%2Fcalendar%3F0; SESSIONID=340e11e9-2f6b-48cd-9a1e-d4bf36adc572; __utmc=143254506; BIGipServercwp.garmin.com.80.pool=!F8D19QHgvMUulhtq7giluby4Yq0w5VQli2VSivtZej7AGfxuMmPk4Xc3KWCqQZ9AaldxZy4r2ZqVQA8=; __utmb=143254506.1.10.1560944914';

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

        return $this->content;
    }

    protected function prepareUri()
    {}

    public function toArray()
    {
        return json_decode($this->content, true);
    }
}