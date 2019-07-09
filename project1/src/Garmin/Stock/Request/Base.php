<?php


namespace App\Garmin\Stock\Request;

use App\Garmin\Stock\Response\Iterators\BaseIteratorResponse;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


abstract class Base implements InterfaceRequestStockGarmin
{
    protected $uri;

    protected $cookieStr = '__cfduid=dff6031eadfabcae9cc6a1a18d41cab631559565953; utag_main=v_id:016b1d604de9000ab5cf19ecde0a0104c002200900bd0$_sn:35$_ss:0$_st:1562589932652$ses_id:1562587406420%3Bexp-session$_pn:15%3Bexp-session; __utma=143254506.849559551.1559565979.1560944914.1561444382.18; __utmz=143254506.1560147763.8.2.utmcsr=sso.garmin.com|utmccn=(referral)|utmcmd=referral|utmcct=/sso/signin; G_ENABLED_IDPS=google; GARMIN-SSO=1; GarminNoCache=true; GARMIN-SSO-GUID=7EE1EAA41CFFAA748F052D108860CE96CC9FB062; GARMIN-SSO-CUST-GUID=6300101696356451; GarminUserPrefs=en-US; notice_preferences=2:; notice_gdpr_prefs=0,1,2:; ADRUM=s=1562593875820&r=https%3A%2F%2Fconnect.garmin.com%2Fmodern%2Fsettings%2FprivacySettings%3F0; SESSIONID=9b7836db-64e7-43ef-9f0a-d6a0f4dfe0f1; ADRUM_BTa=R:0|g:28e37962-ef04-49f7-b562-875af2869c11|n:garmin_869629ee-d273-481d-b5a4-f4b0a8c4d5a3; ADRUM_BT1=R:0|i:259018|e:403; ADRUM_BTs=R:0|s:f';

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
    {
    }

    public function get()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return json_decode($this->content, true);
    }

    public function getContent()
    {
        return $this->content;
    }

    //abstract public function response(): BaseIteratorResponse;

}