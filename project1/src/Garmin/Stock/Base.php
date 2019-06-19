<?php


namespace App\Garmin\Stock;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


abstract class Base
{

    protected $cookieStr = '__cfduid=d3481a4eab81924cbbe1e6ea3a5a90e371544269004; exp_last_visit=1555453778; exp_last_activity=1555539193; utag_main=v_id:01678d9b088d000291c7728e3e0e0104c002100900bd0$_sn:47$_ss:1$_st:1560896063114$ses_id:1560894263114%3Bexp-session$_pn:1%3Bexp-session; __utma=143254506.1798640067.1544269007.1560807763.1560894265.47; __utmz=143254506.1560807763.46.23.utmcsr=sso.garmin.com|utmccn=(referral)|utmcmd=referral|utmcct=/sso/signin; _ga=GA1.2.1798640067.1544269007; __cfduid=dd1213e31a829d3db1ec850cb2bd5400b1553706286; GarminGlobalStorage=%7B%22global%22%3A%7B%22locale%22%3A%22pl-PL%22%2C%22language%22%3A%22pl%22%2C%22country%22%3A%22PL%22%7D%7D; notice_preferences=2:; notice_gdpr_prefs=0,1,2:; gc__last_visit=1555270050; gc__last_activity=1555350549; G_ENABLED_IDPS=google; GARMIN-SSO=1; GarminNoCache=true; GARMIN-SSO-GUID=7EE1EAA41CFFAA748F052D108860CE96CC9FB062; GARMIN-SSO-CUST-GUID=6300101696356451; GarminUserPrefs=pl; SESSIONID=e72aa1b7-b95d-434f-aaa1-2ec9962aed11; __utmc=143254506; BIGipServercwp.garmin.com.80.pool=!0oqKFAdlV4AVdClq7giluby4Yq0w5a/i/yX0xx8nTHcqkOjZoIWSEu49kucm45iEuPa11CYt0DwpFIE=; __utmb=143254506.1.10.1560894265';

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