<?php


namespace App\Http\Helpers;


use Carbon\Carbon;

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

    /**
     * @param $params
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAvailableFlights($params)
    {
        $departure = Carbon::createFromFormat('Y-m-d', $params['departure']);
        $return = Carbon::createFromFormat('Y-m-d', $params['return']);

        $response = $this->api->availability([
            'departureairport' => $params['from'],
            'destinationairport' => $params['to'],
            'returndepartureairport' => $params['to'],
            'returndestiantionairport' => $params['from'],
            'departuredate' => $departure->format('Ymd'),
            'returndate' => $return->format('Ymd'),
        ]);

        return $response->flights;
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
