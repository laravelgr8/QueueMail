<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SendBulkMailController extends Controller
{
    public function sendBulkMail(Request $request)
    {
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $data=DB::table('users')->insert([
            "name"=>$name,
            "email"=>$email,
            "password"=>$password
        ]);

        $email=$email;
    	$details = [
    		'subject' => 'Welcome Mail',
            'email'=>$email
    	];

    	// send all mail in the queue.
        $job = (new \App\Jobs\SendBulkQueueEmail($details))
            ->delay(
            	now()
            	->addSeconds(2)
            ); 

        dispatch($job);
        return back();    
        echo "Bulk mail send successfully in the background...";
    }
}
