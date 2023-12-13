<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Product;
use Illuminate\Http\Request;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $data = Crop::all();
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

        return view("admin/cropManagement", ['data' => $resultArray]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'crop_id' => 'required|string|uuid',
            'name' => 'required|string',
            'average_price' => 'nullable|numeric',
            'sales_change' => 'nullable|numeric',
        ]);

        // Create a new Crop instance with the validated data
        Crop::create([
            // 'crop_id' => $request->input('crop_id'),
            'name' => $request->input('name'),
        ]);

        // Optionally, you can redirect to another page with a success message
        return redirect()->route('admin.cropManagement')->with('success', 'Crop added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function show(Crop $crop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function edit(Crop $crop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crop $crop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function destroy($crop_id)
    {
        $crop = Crop::find($crop_id);

        if (!$crop) {
            return redirect()->route('admin.cropManagement')->with('error', 'Crop not found');
        }

        $crop->delete();

        return redirect()->route('admin.cropManagement')->with('success', 'Crop deleted successfully');
    }
}
