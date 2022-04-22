Step 1:-
First you migrate your migration.

Step 2:-
run cmd for queue table.

php artisan queue:table
php artisan migrate
then create a new table, which name is jobs

Step 3:-
Create Queue Job
php artisan make:job SendEmailJob
now you can see in app folder create a nwe folder, which name is 'jobs', and create a file inside jobs table.
open SendEmailJob.php file

use Mail;
use App\Models\User;

protected $details; ye kisi function me nahi rahega. only class ke under rahega.

public function __construct($details)
{
    $this->details = $details;
}


public function handle()
{
    $email=$this->details['email'];
    $name=$this->details['name'];
    $input['subject'] = $this->details['subject'];
    $dat=["email"=>$email];
    $input['email'] = $email;
    $input['name'] = $name;

    Mail::send('welcome', $dat, function($message) use($input){
        $message->to($input['email']);
        $message->subject($input['subject']);
    });
}


//for send bulk sms
public function handle()
{   
    $data=DB::table('users')->get();

    $input['subject'] = $this->details['subject'];
    $dat=["email"=>"hello"]; //send data to view
    foreach ($data as $key => $value) {
        
        $input['email'] = $value->email;
        $input['name'] = $value->name;
        \Mail::send('email', $dat, function($message) use($input){
            $message->to($input['email'], $input['name'])
                ->subject($input['subject']);
        });
    }
    
}


Step 4:-
create a controller 
public function sendmail(Request $request)
{
    $details = [
        'subject' => 'Welcome Mail',
        'email'=>'suman.krgr8@gmail.com',
        'name'=>'suman'
    ];

    // send all mail in the queue.
    $job = (new \App\Jobs\SendEmailJob($details))
        ->delay(
            now()
            ->addSeconds(2)
        ); 

    dispatch($job);
    return back();    
    echo "mail send successfully in the background...";
}



php artisan queue:work
