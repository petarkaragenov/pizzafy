<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Pizza;

class PizzasController extends Controller
{
    public function index() {
        return response()->json(Pizza::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ]);

        $stripe = Stripe::make(env('STRIPE_SECRET'));

        $product = $stripe->products()->create([
            'name' => $data['name'],
            'type' => 'good'
        ]);

        $sku = $stripe->skus()->create([
            'product'   => $product['id'],
            'price'     => $data['price'],
            'currency'  => 'usd',
            'inventory' => [
                'type'     => 'infinite'
            ]
        ]);
        
        $data['sku'] = $sku['id'];
        $data['image'] = $request->image->store('pizza_images', 'public');

        $image = Image::make(public_path("storage/".$data['image']))->fit(300,200);
        $image->save();

        Pizza::create($data);

        return response()->json('success');
    }

    public function edit(Pizza $pizza) {
        return response()->json($pizza);
    }

    public function update(Request $request, Pizza $pizza) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if ($request->image) {
            $data['image'] = $request->validate(['image' => 'image']);

            $exists = Storage::disk('local')->exists('public/'.$pizza->image);

            if ($exists) {
                Storage::delete('public/pizza_images/'.$pizza->image);
            }

            $data['image'] = $request->image->store('pizza_images', 'public');

            $image = Image::make(public_path("storage/".$data['image']))->fit(300,200);
            $image->save();

            return response()->json('success');
        } 
        
        $pizza->update($data);
    }

    public function destroy(Pizza $pizza) {
        $pizza->delete();

        Storage::delete('/storage'.$pizza->image);

        return response()->json('success');
    }

    public function sort(Request $request) {
        return response()->json(Pizza::orderBy($request->sortBy, $request->order)->get());
    }

    public function search(Request $request) {
        return response()->json(Pizza::where('name', 'like', "%{$request['query']}%")->get());
    }
}
