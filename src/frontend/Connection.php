<?php

namespace app\modules\research\frontend;
use Google\Service\Batch;
use Google\Service\CloudSearch\Resource\Indexing;
use Google\Service;
use Google_Client;

class Connection
{
    /**
     * Базовая авторизация Google / AuthConfig
     */
    public function BasicAuth() {

        $client = new Google_Client();
        $client->setAuthConfig(__DIR__.'/key.json');
        $client->addScope('https://www.googleapis.com/auth/indexing');
        return $client;
    }
    public function postRequest(string $url, int $type_id) {
        $currentURL = "http://my-website.myftp.org:8000";
        $type = array(
            1 => "URL_UPDATED",
            2 => "URL_DELETED"
        );
        $t = $type[$type_id];
        // Get a Guzzle HTTP Client
        $httpClient = $this->BasicAuth()->authorize();
        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

        $content = "{
          'url': '$currentURL/$url',
          'type': '$t'
        }";

        $response = $httpClient->post($endpoint, [ 'body' => $content ]);
        $status_code = $response->getStatusCode();
        return var_dump($status_code);
    }
}
?>