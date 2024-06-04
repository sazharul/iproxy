<?php

namespace VendorName\Iproxy\Services;

class IproxyService
{
    protected $apiKey;
    protected $domain = "https://api.iproxy.online/v1/";

    public function __construct()
    {
        $this->apiKey = config('iproxy.api_key');
    }

    public function api_request($end_point, $method, $data = [])
    {
        $curl = curl_init();

        if (in_array($method, ['POST', 'PATCH', 'PUT']) && !empty($data)) {
            $postData = json_encode($data);
        } else {
            $postData = '';
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->domain . $end_point,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $this->apiKey,
                "Content-Type: application/json"
            ),
        ));

        if (!empty($postData)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        }

        $response = curl_exec($curl);

        if ($response === false) {
            echo "cURL Error: " . curl_error($curl);
            curl_close($curl);
            return null;
        } else {
            $decodedResponse = json_decode($response, true);
            curl_close($curl);
            return $decodedResponse;
        }
    }

    public function getConnectionList()
    {
        return $this->api_request('connections', 'GET');
    }

    public function getProxiesByConnectionId($connectionId)
    {
        $end_point = 'connections/' . $connectionId . '/proxies';
        return $this->api_request($end_point, 'GET');
    }

    public function createProxy($connectionId)
    {
        $end_point = 'connections/' . $connectionId . '/proxies';
        return $this->api_request($end_point, 'POST');
    }

    public function deleteProxy($connectionId, $proxyId)
    {
        $end_point = 'connections/' . $connectionId . '/proxies/' . $proxyId;
        return $this->api_request($end_point, 'DELETE');
    }

    public function updateProxy($connectionId, $proxyId, $data)
    {
        $end_point = 'connections/' . $connectionId . '/proxies/' . $proxyId;
        return $this->api_request($end_point, 'PATCH', $data);
    }

    public function changeProxyPassword($connectionId, $proxyId, $newPassword)
    {
        $end_point = 'connections/' . $connectionId . '/proxies/' . $proxyId . '/set-password';
        $data = [
            'password' => $newPassword
        ];
        return $this->api_request($end_point, 'PUT', $data);
    }

    public function changeProxyLogin($connectionId, $proxyId, $newLogin)
    {
        $end_point = 'connections/' . $connectionId . '/proxies/' . $proxyId . '/set-login';
        $data = [
            'login' => $newLogin
        ];
        return $this->api_request($end_point, 'PUT', $data);
    }
}
