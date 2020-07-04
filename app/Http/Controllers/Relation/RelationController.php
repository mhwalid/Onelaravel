<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\phone;
use App\Models\Service;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function hasOneRelation()
    {
        $user = \App\User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(5);
        return response()->json($user);
    }
    public function hasOneRelationRevers()
    {
        $phone = phone::find(1);
        //make a visible artibbute
        $phone->makeVisible(['user_id']); // of visublety
        $phone->makeHidden(['code']);  // to hidde it
        return $phone;
    }
    // one to many
    public function gethospitalDoctors()
    {
        /*  return $hospital = Hospital::with(['Doctor' => function ($q) {
            $q->select('name', 'id', 'hospital_id');
        }])->get(); 
        $hospital = Hospital::find(1);
        return $hospital->doctor;*/ // return  hospital doctor

    }

    public function hospitals()
    {

        $hospitals = Hospital::select('id', 'name', 'adresse')->get();
        return view('hospital.hospitals', compact('hospitals'));
    }
    public function doctors($hospital_id)
    {

        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctor;
        return view('hospital.doctors', compact('doctors'));
    }
    //hospitale must have doctors
    public function hospitalsHasDoctor()
    {
        return Hospital::whereHas('doctor')->get();
    }
    public function hospitalsHasOnlyMaleDoctors()
    {
        return $hospitals = Hospital::with('doctor')->whereHas('doctor', function ($q) {
            $q->where('sexe', 'mal');
        })->get();
    }
    public function hospitals_not_has_doctors()
    {
        return $hospitals = Hospital::whereDoesntHave('doctor')->get();
    }
    public function deletHospital($hospital_id)
    {
        $hospitals = Hospital::find($hospital_id);
        if (!$hospitals)
            return abort('404');
        // to delete doctres first
        $hospitals->doctor()->delete();
        $hospitals->delete();

        return redirect()->route('hospital.all');
    }
    public function getDoctorServices()
    {
        // return $doctor = Doctor::with('services')->find(1);

        return   $doctor = Doctor::with('services')->find(1);
        return $doctor->service;
    }
    public function getServiceDoctors()
    {
        // return $doctor = Doctor::with('services')->find(1);

        return   $doctor = Service::with(['doctors' => function ($q) {
            $q->select('doctors.id', 'name', 'title');
        }])->find(2);
    }
    public function getDoctorServicesById($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;  //doctor services

        $doctors = Doctor::select('id', 'name')->get();
        $allServices = Service::select('id', 'name')->get(); // all db serves

        return view('hospital.services', compact('services', 'doctors', 'allServices'));
    }

    public function saveServicesToDoctors(Request $request)
    {

        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor)
            return abort('404');
        //$doctor->services()->attach($request->servicesIds);  // many to many insert to database  judt adding no metter if it existe or not


        //$doctor ->services()-> sync($request -> servicesIds);	        //$doctor ->services()-> sync($request -> servicesIds); update 

        $doctor->services()->syncWithoutDetaching($request->servicesIds); // if it esxist it will not add it 
        return 'success';
    }

    public function getPatientDoctor()
    {
        $patient = Patient::find(2);
        return $patient->doctor;
    }
    public function getPatientDoctorLhanout()
    {
        $client = Clients::find(1);
        return $client->moulhanout;
    }
    public function getDoctorCountry()
    {
        $coutry = Country::find(1);
        return $coutry->doctor;
    }
    public function getCountryDoctors()
    {
        return   $coutry = Country::with('Doctor')->find(1);
        // return $coutry->doctor;
    }
    public function getCountryHospital()
    {
        return   $coutry = Country::with('hospital')->find(1);
    }
}
