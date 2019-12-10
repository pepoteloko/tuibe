<?php


namespace App\Http\Helpers;


use GuzzleHttp\Client;

class FlightApi
{
    private $user;
    private $pass;

    /**
     * @param array $credentials
     */
    public function setCredentials(array $credentials)
    {
        $this->user = $credentials['user'];
        $this->pass = $credentials['pass'];
    }

    /**
     * @param array $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function routes(array $params)
    {
        $data = $this->makeCall('flightroutes/', $params);

        return $data->flightroutes;
    }

    /**
     * @param array $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function schedules(array $params)
    {
        $data = $this->makeCall('flightschedules/', $params);

        return $data->flightschedules;
    }

    /**
     * @param array $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function availability(array $params)
    {
        return $this->makeCall('flightavailability', $params);
    }

    /**
     * @param $uri
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function makeCall($uri, $params)
    {
        $client = new Client();
        $response = $client->get(
            'http://tstapi.duckdns.org/api/json/1F/' . $uri,
            [
                'auth' => [$this->user, $this->pass],
                'params' => $params
            ]
        );

        return json_decode($response->getBody()->getContents());
    }
}
