<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FlightApiHelper;
use App\Http\Requests\BookingRequest;
use Carbon\Carbon;
use Carbon\Exceptions\BadUnitException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('index')->with(['title' => 'Titulo']);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function ajax(Request $request)
    {
        $params = $request->all();
        $function = $request->get('action', 'error');

        $helper = new FlightApiHelper();
        switch ($function) {
            case 'from':
                $response = $helper->getDestinationsAvailableFrom($params);
                break;
            case 'to':
                $response = $helper->getDestinationsAvailableTo($params);
                break;
            default:
                $response = 'Error';
        }

        return response()->json($response);
    }

    public function booking(BookingRequest $request)
    {
        $params = $request->all();

        $helper = new FlightApiHelper();
        $data = $helper->getAvailableFlights($params);

        foreach ($data->OUT as $temp) {
            if ($temp->date == $params['departure']) {
                $date1 = Carbon::createFromFormat('Y-m-d\TH:i:s', $temp->datetime);
                $temp->time1 = $date1->format('H:i');
                $interval = \DateInterval::createFromDateString($temp->duration);
                $date1->add($interval);
                $temp->time2 = $date1->format('H:i');
                $flights['out'][] = $temp;
            }
        }

        return view('flights')->with([
            'title'   => 'Titulo',
            'flights' => $flights
        ]);
    }
}
