<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBeersRequest;
use App\Models\Beer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeersController extends Controller
{
    public $beer;

    public function __construct(Beer $beer)
    {
        $this->beer = $beer;
    }

    public function index(): JsonResponse
    {
        $beer = $this->beer->all();
        
        return response()->json(['beer' => $beer]);
    }

    public function create(CreateBeersRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'description', 'first_brewed']);

        $beer = $this->beer->create($data);

        $response = [
            'error' => false,
            'beer' => $beer
        ];

        return response()->json(['data' => $response]);
    }

    public function update(CreateBeersRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'description', 'first_brewed']);

        $beer = $this->beer->find($request->id);

        if (!$beer) {
            return response()->json(['message' => 'The beer with the id '.$request->id.' was not found!']);
        }

        $beer->update($data);
        $beer->save();

        $response = [
            'error' => false,
            'message' => 'Beer data has been updated successfully!',
            'beer' => $beer
        ];

        return response()->json(['data' => $response]);
    }

    public function delete(Request $request)
    {
        $beer = $this->beer->find($request->id);

        if (!$beer) {
            return response()->json(['message' => 'The beer was not deleted because the id '.$request->id.' was not found!']);
        }

        $beer->delete();

        $response = [
            'error' => false,
            'message' => 'The beer with the id '.$request->id.' has been deleted successfully!'
        ];

        return response()->json(['data' => $response]);
    }
}
