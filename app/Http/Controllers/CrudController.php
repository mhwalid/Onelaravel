<?php

namespace App\Http\Controllers;

use App\Events\VideoViwer;
use App\Http\Requests\offerRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\video;
use App\Traits\OfferTrait;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;



class CrudController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *

     */
    public function getOffers()
    {
        $offers = Offer::select(
            'id',
            'cato_' . LaravelLocalization::getCurrentLocale() . ' as cato',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'photo'
        )->get();
        return view('offers.all', compact('offers'));
    }


    /*  public function store()
    {
        return  Offer::create([
            'name' => 'offeers3',
            'price ' => 5000,

        ])->get();
    } */

    public function create()
    {
        return view('offers.create');
    }

    use OfferTrait;
    public function store(offerRequest $req)
    {
        //validation 

        /* $messages = $this->getMessage();
       // $rules = $this->getRules();
        $validator = Validator::make($req->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($req->all());
        }
          */


        $file_name = $this->SaveImage($req->photo, 'images/offers');

        //insert
        Offer::create([
            'photo' => $file_name,
            'name_fr' => $req->name_fr,
            'name_en' => $req->name_en,
            'price' => $req->price,
            'cato_fr' =>  $req->cato_fr,
            'cato_en' =>  $req->cato_en,



        ]);

        return redirect()->back()->with(['success' => 'was created ']);
    }

    /*    protected function getMessage()
    {
        return $messages = [
            'name.required' => __('message.offer name required'),
            'name.unique' => __('message.offer name must be unique'),
            'price.numeric' => 'le prix il faut qui soit en form numerique ',
            'price.required' => ' remplier le prix',

        ];
    }
   protected function getRules()
    {
        return $rules = [
            

        ];
    } */
    public function getVideo()
    {
        $video = video::first();
        event(new VideoViwer($video));
        return view('video')->with('video', $video);
    }

    public function editOffer($offer_id)
    {
        //  Offer::findOrFail($offer_id); // siil trouve pas 404
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();
        $offer = Offer::select('id', 'name_fr', 'name_en', 'cato_fr', 'cato_en', 'price')->find($offer_id);
        return view('offers.edit', compact('offer'));
    }
    public function delete($offer_id)
    {
        //  Offer::findOrFail($offer_id); // siil trouve pas 404
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back()->with(['error' => 'not existe']);
        }
        $offer->delete();
        return redirect()->route('offers.all')->with(['success' => 'delete succesfuly']);
    }

    public function updateOffer(offerRequest $req, $offer_id)
    {
        //verfication in offerREq file
        // verfay if the id existe

        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();

        //update
        $offer->update($req->all());
        return redirect()->back()->with(['success' => 'update done with succcess']);

        //if  u wanna to updat a spcific id 
        /*  $offer->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
        ]);*/
    }
}
