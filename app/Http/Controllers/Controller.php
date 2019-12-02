<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FlightApiHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view('index')->with(['title' => 'Titulo']);
    }

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
}
