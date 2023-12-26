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
        try {
        $data =  $this->database->getReference($this->table)->getValue();
        foreach ($data as $key => $values) {
            $locations[] = [
                'key' => $key,
                'crime_type' => $values['crime_type'],
                'description' => $values['description'],
                'generated_at' => $values['generated_at'],
                'happenedAt' => $values['happenedAt'],
                'lat' =>$values['latitude'],
                'lng' => $values['longitude'],
                'officer_id' => $values['officer_id'],
                'phone' => $values['phone'],
                'status' => $values['status'],
                'title' => $values['title'],
                'updated_at' => $values['updated_at']
            ];
        }}catch (\Exception $e) {
            // You might want to log this exception or handle it in a way other than just showing the dashboard
        }
        return view('map.map')->with('locations',$locations);
    }


    public function store(Request $request) {
        
        $nodeRef =  $this->database->getReference($this->table.'/'.$request->input('key'));

        // Retrieve the existing data at the specified location
        $existingData = $this->database->getReference($this->table . '/' . $request->input('key'))->getValue();

        // Merge the new status value with the existing data
        $existingData['status'] = $request->input('status');
        $existingData['updated_at'] = date('Y-m-d H:i:s');
        $existingData['officer_id'] = auth()->user()->id;

        $nodeRef->set($existingData);

        return redirect()->route('map.getIncident', ['key' =>$request->input('key')]) // Redirect to a page after successful user creation.
        ->with('success', 'updated successfully'); // Flash a success message.
    }

    //get images of specific incidents
    public function getPics(String $key) {
        $imageUrls = [];
        try {
            $storageClient = $this->storage->getStorageClient();
            $defaultBucket = $this->storage->getBucket();
            
            // List objects (images) in the bucket with the specified prefix
            $objects = $defaultBucket->objects(['prefix' => 'incidents/'.$key]);
        

            // Iterate through the objects
            foreach ($objects as $object) {
                // Generate a signed URL for each object, valid for 1 hour
                $imageUrl = $object->signedUrl(new \DateTime('+1 hour'));
                $imageUrls []= $imageUrl;
            }
            
            return $imageUrls;
        } catch (\Exception $e) {
            // If an error occurs (e.g., bucket does not exist), return an empty array
            return $imageUrls;
        }
        
    }
    
    //get details of the specific incident
    public function getIncident(String $key)
    {
        
        $locations = [];
        $userLocation=[];
        $data =  $this->database->getReference($this->table.'/'.$key)->getValue();
        
        $locations[] = [
            'key' => $key,
            'crime_type' => $data['crime_type'],
            'description' => $data['description'],
            'generated_at' => $data['generated_at'],
            'happenedAt' => $data['happenedAt'],
            'lat' => $data['latitude'],
            'lng' => $data['longitude'],
            'officer_id' => $data['officer_id'],
            'phone' => $data['phone'],
            'status' => $data['status'],
            'title' => $data['title'],
            'updated_at' => $data['updated_at']
        ];
        //dd($locations[0]['description']);
        $imageUrls=$this->getPics($key);
        //specific officer location
        $userLocation=[
            'lat'=>auth()->user()->lat,
            'lng'=>auth()->user()->lng
        ];

        return view('map.incidentDetail')->with(['locations'=>$locations,'imageUrls'=>$imageUrls,'userLocation'=>$userLocation]);
    }

}
