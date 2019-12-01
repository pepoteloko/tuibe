<?php


namespace App\Http\Helpers;


class FlightApiHelper
{
    /**
     * @var FlightApi
     */
    private $api;

    public function __construct()
    {
        $this->api = new FlightApi();
        $this->api->setCredentials(['user' => 'php-applicant', 'pass' => 'Z7VpVEQMsXk2LCBc']);
    }

    /**
     * @param $params
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDestinationsAvailableFrom($params)
    {
        $airport = $params['airport'];

        $response = $this->api->routes([
            'departureairport' => $airport
        ]);

        $data = [];
        foreach ($response as $route) {
            $data[$route->RetCode] = $route->RetName;
        }

        return $data;
    }

    /**
     * @param $params
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDestinationsAvailableTo($params)
    {
        $airport = $params['airport'];

        $response = $this->api->routes([
            'destinationairport' => $airport
        ]);

        $data = [];
        foreach ($response as $route) {
            $data[$route->RetCode] = $route->RetName;
        }

        return $data;
    }
//        $data = $helper->routes(['departureairport' => 'AGP']);
//        var_dump($data);
//
//        echo("<br>SEGUNDA<br>");
//
//        $data = $helper->schedules(['departureairport' => 'AGP', 'destinationairport' => 'BRU']);
//        var_dump($data);
//
//        echo("<br>TERCERA<br>");
//
//        $data = $helper->availability(['departureairport' => 'AGP', 'destinationairport' => 'BRU', 'departuredate' => '20191231']);
//        var_dump($data);
}
