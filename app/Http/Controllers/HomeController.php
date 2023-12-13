<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'isUser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getSalesStatistics(){

        $results = Product::selectRaw('products.crop_id, crops.name, SUM(products.quantity) as quantitySold, AVG(products.price) as avgPrice, DATE(products.created_at) as date')
            ->join('crops', 'products.crop_id', '=', 'crops.crop_id')
            ->groupBy('crops.name', 'products.crop_id', 'date') // Group by crop name, crop_id, and date
            ->orderBy('crops.name')
            ->orderByDesc('date') // Order by date in descending order
            ->get();

        // Process the $results to get only the top 2 results for each crop
        $filteredResults = collect([]);

        $results->each(function ($result) use ($filteredResults) {
            $cropId = $result->crop_id;

            // If there are fewer than 2 results for the current crop, add it to the filtered results
            if ($filteredResults->where('crop_id', $cropId)->count() < 2) {
                $filteredResults->push($result);
            }
        });

        $previousResults = [];
        $latestResults = [];

        foreach ($filteredResults as $item) {
            $cropId = $item['crop_id'];

            // If the crop is not yet in $latestResults or it's a later date, update it
            if (!isset($latestResults[$cropId]) || $latestResults[$cropId]['date'] < $item['date']) {
                $latestResults[$cropId] = $item;
            }

            // If the crop is not yet in $previousResults or it's an earlier date, update it
            if (!isset($previousResults[$cropId]) || $previousResults[$cropId]['date'] > $item['date']) {
                $previousResults[$cropId] = $item;
            }
        }

        $resultArray = [];

        foreach ($latestResults as $latest) {
            $cropId = $latest['crop_id'];

            if (isset($previousResults[$cropId])) {
                $previous = $previousResults[$cropId];
                $salesChange = (($latest['quantitySold'] - $previous['quantitySold']) / $previous['quantitySold']) * 100;

                $resultArray[] = [
                    'crop_id' => $cropId,
                    'name' => $latest['name'],
                    'average_price' => $latest['avgPrice'],
                    'sales_change' => $salesChange,
                    'date' => $latest['date'],
                ];
            }
        }


        return view('cropSalesStatistics', ['data'=> $resultArray]);
    }

    public function getGraph($cropName, $id){

        // Query the database to get sales data for the specified crop
        $salesData = Product::where('crop_id', $id)
            ->selectRaw('DATE(created_at) as date, SUM(quantity) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Extract data for the chart
        $dates = $salesData->pluck('date');
        $sales = $salesData->pluck('total_sales');

        // Convert data to JSON for JavaScript in the view
        $datesJson = $dates->toJson();
        $salesJson = $sales->toJson();

        return view('chartjs', ['sales'=>$salesJson, 'dates'=>$datesJson]);
    }

    public function getSalesTracker(){
        return view('cropSalesTracker');
    }
}
