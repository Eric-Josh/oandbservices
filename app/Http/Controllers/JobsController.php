<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\JobTypes;
use Mail;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::where('user_id', auth()->user()->id)
                    ->where('deleted_at', null)
                    ->orderBy('id', 'desc')->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobTypes = JobTypes::orderBy('name', 'asc')->get();

        return view('jobs.create')->with('jobtypes', $jobTypes);
    }

    /**
     * Get the error messages for the defined validation rules. customly added
     *
     * @return array
     */
    public function messages()
    {
        return [
            'jobtype.required' => 'Please select a job',
            'jobtitle.required' => 'Please enter a job title',
            'phone.required' => 'Please enter a valid phone number',
            'description.required' => 'Please describe your job',
            'time_frame.required' => 'Please pick your preffered time',
            'amount.required' => 'please enter an valid amount',
            'file.required' => 'Please add a photo'
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jobtype' => 'required',
            'jobtitle' => 'required',
            'phone' => 'required|numeric|digits:10',
            'description' => 'required|min:30',
            'time_frame' => 'required',
            'amount' => 'required|numeric',
            'file' => 'required',
            'location' => 'required'
            
        ]);
        $postJob = new Jobs;
        $jobImage=array();
        if($request->file('file')){
            foreach($request->file('file') as $image)
            {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('job-images'), $new_name);
                $jobImage[] = $new_name;
            }
        }
        $postJob->job_id = $request->get('jobtype');
        $postJob->job_title = $request->get('jobtitle');
        $postJob->phone = $request->get('phone');
        $postJob->description = $request->get('description');
        $postJob->time_frame = $request->get('time_frame');
        $postJob->amount = $request->get('amount');
        $postJob->status = 'Pending';
        $postJob->user_id = auth()->user()->id;
        $postJob->date_requested = date('Y-m-d H:m:s');
        $postJob->date_completed = '';
        $postJob->reference_id = rand().date('Ymd');
        $postJob->photo = implode("|",$jobImage);
        $postJob->location = $request->get('location');
        

        // send mail to user 
        Mail::send('mails.jobpost-user-notification', [
            'title' => 'Hello '.auth()->user()->name.',',
            'body' => 'We will connect you to a handy man within your chosen time.'
            ],
            function ($message) {
                    $message->from('no-reply@oandbservices.com','O & B Services');
                    $message->to(auth()->user()->email)
                            ->subject('O & B Services: New Job Post');
        });

        
        $file = $postJob->photo;
        
         // send mail to admin 
         Mail::send('mails.jobpost-admin-notification', [
            'title' => 'Hello Admin,',
            'body' => 'A new job has been posted. Kindly view detials of request below.',
            'userDetails' => 'Job Details',
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'jobtitle' => $request->get('jobtitle'),
            'desc' => $request->get('description'),
            'budget' => $request->get('amount'),
            'phone' => $request->get('phone'),
            'location' => $request->get('location'),
            'userTimeFrame' => $request->get('time_frame')
        ],
            function ($message)use($file) {
                    $message->from('no-reply@oandbservices.com','O & B Services');
                    $message->to(auth()->user()->email)
                            ->subject('New Job Post');

            foreach(explode('|', $file ) as $files){
                $attach = public_path('job-images').'/'. $files;
                $message->attach($attach);
            }
        });
        $postJob->save();
        
        return redirect('/jobs')->withStatus(__('Job posted successfully. Kindly check your mailbox'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobTypes = JobTypes::orderBy('name', 'asc')->get();
        $jobs = Jobs::find($id);

        return view('jobs.show', compact('jobs'))->with('jobtypes', $jobTypes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobTypes = JobTypes::orderBy('name', 'asc')->get();
        $jobs = Jobs::find($id);

        return view('jobs.edit', compact('jobs'))->with('jobtypes', $jobTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postJob = Jobs::find($id);
        $jobImage=array();

        $request->validate([
            'jobtype' => 'required',
            'jobtitle' => 'required',
            'phone' => 'required|numeric|digits:10',
            'description' => 'required|min:30',
            'time_frame' => 'required',
            'amount' => 'required|numeric',
            'file' => 'required',
            'location' => 'required'
            
        ]);

        if($request->file('file') != ''){

            // code for remove old file
            if($postJob->photo != ''  && $postJob->photo != null){
                $old_photo = public_path('job-images').'/'.$postJob->photo;
                unlink($old_photo);
            }

            foreach($request->file('file') as $image)
            {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('job-images'), $new_name);
                $jobImage[] = $new_name;
            }
        }
        $postJob->job_id = $request->input('jobtype');
        $postJob->job_title = $request->input('jobtitle');
        $postJob->phone = $request->input('phone');
        $postJob->description = $request->input('description');
        $postJob->time_frame = $request->input('time_frame');
        $postJob->amount = $request->input('amount');
        $postJob->location = $request->input('location');
        $postJob->photo = implode("|",$jobImage);
        $postJob->save();

        return redirect('/jobs')->withStatus(__('Job updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobs = Jobs::find($id);
        $jobs->delete();

        return redirect('/jobs')->withStatus(__('Job deleted successfully.'));
    }


}
