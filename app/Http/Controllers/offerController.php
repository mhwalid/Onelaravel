<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use  LaravelLocalization;

class offerController extends Controller
{
    use OfferTrait;
    public function create()
    {
        // view from to ass this offer

        return view('offersajax.create');
    }

    public function store(offerRequest $req)  //why offerRequest  hot to the same validation 
    {
        //save offer into db using ajax
        $file_name = $this->SaveImage($req->photo, 'images/offers');

        //insert
        $offers = Offer::create([
            'photo' => $file_name,
            'name_fr' => $req->name_fr,
            'name_en' => $req->name_en,
            'price' => $req->price,
            'cato_fr' =>  $req->cato_fr,
            'cato_en' =>  $req->cato_en,
        ]);
        // retrun back with json 
        if ($offers) {
            return response()->json([
                'status' => true,
                'msg' => 'save done successfuly'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'save fild',
            ]);
        }
    }


    public function all()
    {
        $offers = Offer::select(
            'id',
            'cato_' . LaravelLocalization::getCurrentLocale() . ' as cato',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'photo'
        )->get();
        return view('offersajax.all', compact('offers'));
    }
    public function delete(Request  $req)
    {
        //  Offer::findOrFail($offer_id); // siil trouve pas 404
        $offer = Offer::find($req->id);
        if (!$offer) {
            return redirect()->back()->with(['error' => 'not existe']);
        }
        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'delete it  successfuly',
            'id' => $req->id,
        ]);
    }

    public function edit(Request $req)
    {

        $offer = Offer::find($req->offer_id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'save fild',
            ]);
        }
        $offer = Offer::select('id', 'name_fr', 'name_en', 'cato_fr', 'cato_en', 'price')->find($req->offer_id);
        return view('offersajax.edit', compact('offer'));
    }

    public function update(Request $req)
    {


        $offer = Offer::find($req->offer_id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'save fild',
            ]);


        //update
        $offer->update($req->all());
        return response()->json([
            'status' => true,
            'msg' => 'update it  successfuly',

        ]);
        //if  u wanna to updat a spcific id 
        /*  $offer->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
        ]);*/
    }
}
