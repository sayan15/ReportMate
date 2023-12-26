<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){

        $status = 0;
        return view ('sendNotification')->with('status',$status);
    }
    
    public function sendNotification(Request $request){
        $topic = '/topics/incidents'; // Replace with your actual topic
        
        $message = [
            'data' => [
                'title' => $request->crimeInput,
                'message' => $request->locationInput,
                'latlng' => [
                    'latitude' => $request->latitudeInput,
                    'longitude' => $request->longitudeInput
                ]
            ],
            'to' => $topic
        ];
        

        $SERVER_API_KEY = 'AAAATD0tkxs:APA91bGDBwX6lnhVRXLHqENmrJPeumbEFDEQCdoyZHOwAaDRssAE-47TsVTuiDkBb2q261JieAQxoh3Mdj_MZqUxVMb_vfWtjiP8DIjm_CiO_QIoONNrVI7dndvc9stZlpKh6rNy7Rhn';

        $dataString = json_encode($message);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        // Get the HTTP status code
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close the cURL session
        curl_close($ch);

        if ($status === 200) {
            // Success
            return view ('sendNotification')->with('status',$status);
        } else {
            // Failure or other status
            return view ('sendNotification')->with('status',$status);
        }
    }
}
