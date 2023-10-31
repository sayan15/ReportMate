<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Psy\Readline\Hoa\Console;
use Kreait\Firebase\Contract\Storage;

class MapController extends Controller
{
    public function __construct(Database $database,Storage $storage)
    {
        $this->database = $database;
        $this->storage = $storage;
        $this->table ='Incidents';
    }
    public function index()
    {
        $locations = [];
        $data =  $this->database->getReference($this->table)->getValue();
        foreach ($data as $key => $values) {
            $locations[] = [
                'lat' => $values['lat'],
                'lng' => $values['lng'],
                'title' => $values['title'],
                'description' => $values['description'],
            ];
        }
        return view('map.map')->with('locations',$locations);
    }


    public function dstore() {
        $locations = [
            'lat' => 52.23059,
            'lng' => -0.8869,
            'title' => "University of Northampton",
            'description' => "University in Northampton.",
            'status'=>'no'
        ];

        $data =  $this->database->getReference($this->table)->push($locations);
    }

    //get images of specific incidents
    public function getPics() {
        $storageClient = $this->storage->getStorageClient();
        $defaultBucket = $this->storage->getBucket();
        
          
        //$defaultBucket ->upload(asset('public/images/login-office.jpeg'), ['name' => "incidents/-NhBQurPiBLaAQLsSTxt/login.jpeg"]); 
        // List objects (images) in the bucket
        $objects = $defaultBucket->objects(['prefix' => 'incidents/-NhBQurPiBLaAQLsSTxt']);

        $imageUrls = [];
            // Iterate through the objects
        foreach ($objects as $object) {
            $imageUrl = $object->signedUrl(new \DateTime('+1 hour'));
            $imageUrls []= $imageUrl ;
        }
        
        return $imageUrls;
    }
    
    //get details of the specific incident
    public function getIncident(String $key)
    {
        
        $locations = [];
        $data =  $this->database->getReference($this->table.'/'.$key)->getValue();
        
        $locations[] = [
            'lat' => $data ['lat'],
            'lng' => $data ['lng'],
            'title' => $data ['title'],
            'description' => $data ['description'],
        ];
        //dd($locations[0]['description']);
        $imageUrls=$this->getPics();
        
        return view('map.incidentDetail')->with(['locations'=>$locations,'imageUrls'=>$imageUrls]);
    }

}
