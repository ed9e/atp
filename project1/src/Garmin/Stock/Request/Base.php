<?php


namespace App\Garmin\Stock\Request;

use App\Config\FileLocator;
use App\Config\Service;
use App\Service\GarminConfig;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\BrowserKit\CookieJar;
use Symfony\Component\HttpClient\HttpClient;


abstract class Base implements InterfaceRequestStockGarmin
{
    protected $uri;

    protected $cookieStr = '__cfduid=dff6031eadfabcae9cc6a1a18d41cab631559565953; utag_main=v_id:016b1d604de9000ab5cf19ecde0a0104c002200900bd0$_sn:45$_ss:1$_st:1563183091869$ses_id:1563181291869%3Bexp-session$_pn:1%3Bexp-session; __utma=143254506.849559551.1559565979.1560944914.1561444382.18; __utmz=143254506.1560147763.8.2.utmcsr=sso.garmin.com|utmccn=(referral)|utmcmd=referral|utmcct=/sso/signin; G_ENABLED_IDPS=google; GARMIN-SSO=1; GarminNoCache=true; GARMIN-SSO-GUID=7EE1EAA41CFFAA748F052D108860CE96CC9FB062; GARMIN-SSO-CUST-GUID=6300101696356451; notice_preferences=2:; notice_gdpr_prefs=0,1,2:; SESSIONID=6802d73b-11d4-4a49-8341-90a35bca9362; ADRUM=s=1563181286928&r=https%3A%2F%2Fconnect.garmin.com%2Fmodern%2F%3F0';
    protected $content;

    protected $configService;

    public function __construct()
    {
        $this->configService = new GarminConfig(new Service(new FileLocator()));
        $this->setCookieStr($this->configService->getSession());
    }

    /**
     * @return string
     */
    public function getCookieStr(): string
    {
        return $this->cookieStr;
    }

    /**
     * @param string $cookieStr
     * @return Base
     */
    public function setCookieStr(string $cookieStr): Base
    {
        $this->cookieStr = $cookieStr;
        return $this;
    }

    public function fetch()
    {
        $this->prepareUri();
        $cookieJar = new CookieJar();
        foreach (explode('; ', $this->getCookieStr()) as $str) {
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
