<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Http;
use App\Models\FilteredPrice;


class PredictionController extends Controller
{

    public function redirectToFlask(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $flaskUrl = env('FLASK_URL');
        return redirect($flaskUrl);
    }

//    public function predictPrice(Request $request)
//    {
//        $response = Http::post('http://ec2-16-171-19-64.eu-north-1.compute.amazonaws.com/predict', $request->all());
//
//        if ($response->successful()) {
//            return $response->json();
//        } else {
//            return response()->json(['error' => 'Failed to predict price.'], 500);
//        }
//    }


//    public function showPredictionForm()
//    {
//        return view('frontend.pages.ai');
//    }
//
//    public function predictPrice(Request $request)
//    {
//        $make = $request->input('make');
//        $model = $request->input('model');
//        $model_year = $request->input('model_year');
//        $transmission = $request->input('transmission');
//        $fuel_type = $request->input('fuel_type');
//        $engine_capacity = $request->input('engine_capacity');
//        $mileage = $request->input('mileage');
//
//        // Make a POST request to your Flask API
//        $response = Http::post('http://ec2-16-171-19-64.eu-north-1.compute.amazonaws.com/predict', [
//            'make' => $make,
//            'model' => $model,
//            'model_year' => $model_year,
//            'transmission' => $transmission,
//            'fuel_type' => $fuel_type,
//            'engine_capacity' => $engine_capacity,
//            'mileage' => $mileage,
//        ]);
//
//        $predictedPrice = $response->json()['prediction_text'][0] ?? null;
//
//        return view('frontend.pages.ai', ['predictedPrice' => $predictedPrice]);
//    }
//    public function predictPrice(Request $request)
//    {
//        // Fetch car models dynamically
//        $models = dd(FilteredPrice::distinct()->pluck('model')->toArray());
//        dd($models);
//
//        // Fetch car years dynamically
//        $years = FilteredPrice::distinct()->pluck('model_year')->toArray();
//
//        // Check if models and years are retrieved successfully
//        if ($models && $years) {
//            // Pass models and years to the view along with other request data
//            return view('frontend.pages.ai', [
//                'models' => $models,
//                'years' => $years,
//                // Include other request data if needed
//            ]);
//        } else {
//            // Handle the case where fetching models or years failed
//            return back()->with('error', 'Failed to fetch car models or years.');
//        }
//    }

//    public function predictPrice(Request $request)
//    {
//        $response = Http::post('http://127.0.0.1:5000/predict', $request->all());
//        return $response->json();
//    }
//    public function selectModelYear(Request $request)
//    {
//        $make = $request->input('make');
//        $response = Http::post('http://127.0.0.1:5000/selectModelYear', ['make' => $make]);
//        return $response->json();
//    }
//
//    public function selectCarModel(Request $request)
//    {
//        $make = $request->input('make');
//        $response = Http::post('http://127.0.0.1:5000/selectCarModel', ['make' => $make]);
//        return $response->json();
//    }
}
