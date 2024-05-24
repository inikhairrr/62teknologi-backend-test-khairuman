<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image_url' => 'nullable|url',
            'rating' => 'nullable|numeric',
            'review_count' => 'nullable|integer',
            'categories' => 'nullable|string',
            'price' => 'nullable|string',
            'location' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string',
        ]);

        $business = Business::create($validatedData);

        return response()->json($business, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image_url' => 'nullable|url',
            'rating' => 'nullable|numeric',
            'review_count' => 'nullable|integer',
            'categories' => 'nullable|string',
            'price' => 'nullable|string',
            'location' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string',
        ]);

        $business = Business::findOrFail($id);
        $business->update($validatedData);

        return response()->json($business);
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = Business::query();

        if ($request->has('term')) {
            $query->where('name', 'like', '%' . $request->term . '%');
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->has('latitude') && $request->has('longitude')) {
            $query->where('latitude', $request->latitude)
                  ->where('longitude', $request->longitude);
        }

        if ($request->has('categories')) {
            $query->where('categories', 'like', '%' . $request->categories . '%');
        }

        if ($request->has('sort_by')) {
            $query->orderBy($request->sort_by);
        }

        $businesses = $query->paginate($request->get('limit', 15));

        return response()->json($businesses);
    }
}
