<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Rules\Password;

use App\Models\User;
use App\Models\Jobs;
use App\Models\JobTypes;
use App\Models\GeneralMerchandise;
use App\Models\Merchandise;

use Mail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();
        /* This is for recent jobs table list */
        $recentJobs = Jobs::orderBy('id', 'desc')->take(5)->get();

        /* This is for recent merchandise jobs table list */
        $recentMerchantJobs = GeneralMerchandise::orderBy('id', 'desc')->take(5)->get();

        /* This is for job count */
        $totalJobs1 = Jobs::where('deleted_at',null)->get();
        $totalJobs2 = GeneralMerchandise::where('deleted_at',null)->get();

        $totalJobCum = $totalJobs1->count() + $totalJobs2->count();
        $statusCompleted = $totalJobs1->where('status','Completed')->count() + $totalJobs2->where('status','Completed')->count();
        $statusPending = $totalJobs1->where('status','Pending')->count() + $totalJobs2->where('status','Pending')->count();

        return view('admin.dashboard',compact(['recentJobs','recentMerchantJobs','totalJobCum','statusCompleted','statusPending']))->with('user', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jobView(Request $request)
    {
        $id = $request->jobId;
        $jobs = Jobs::findOrFail($id);
        $jobTypes = JobTypes::orderBy('name', 'asc')->get();

        return view('admin.jobs-show', compact('jobs'))->with('jobTypes', $jobTypes);
    }

    public function merchandiseView(Request $request)
    {
        $id = $request->gmJobId;
        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        $generalMerchandise = GeneralMerchandise::find($id);

        return view('admin.merchandise-show', compact('generalMerchandise'))->with('merchandise', $merchandise);
    }

    public function jobHistory()
    {
        $jobTypes = JobTypes::orderBy('name', 'asc')->get();
        $jobs = Jobs::where('deleted_at', null)
                    ->orderBy('id', 'desc')->paginate(10);

        return view('admin.jobs-history', compact('jobs'))->with('jobtypes', $jobTypes);
    }

    public function merchandiseHistory()
    {
        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        $generalMerchandise = GeneralMerchandise::orderBy('id', 'desc')->paginate(10);

        return view('admin.merchandise-history', compact('generalMerchandise'))->with('merchandise', $merchandise);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jobStatus(Request $request, $id)
    {
        $status = Jobs::findOrFail($id);
        $status->status = $request->status;

        if ($status->status == 'Completed'){
            $status->date_completed = date('Y-m-d H:m:s');
        }else{
            $status->date_completed =NULL;
        }

        $status->save();

        return redirect()->route('admin.job-history');
    }

    public function merchandiseStatus(Request $request, $id)
    {
        $status = GeneralMerchandise::findOrFail($id);
        $status->status = $request->gmstatus;
        $status->save();

        return redirect()->route('admin.merchandise-history');
    }

    public function handymanSearch(Request $request)
    {
        $professionId = $request->professionId;
        $jobId = $request->jobId;
        $add = $request->address;

        $handymanSearch = User::where('user_type', 3)
                                ->where('job_type_id', $professionId)
                                ->orWhere('address','like',''.$add)
                                ->paginate(5);

        return view('admin.ajax-handyman-search', compact(['handymanSearch', 'jobId']));
    }

    public function userSearch(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;

        if($role == 0){
            $roles = '%%';
        }else{
            $roles = ''.$role;
        }

        $userSearch = User::where('name','like',''.$name)
                                ->orWhere('email', 'like',''.$email)
                                ->orWhere('user_type','like', $roles)
                                ->orderBy('name','asc')->orderBy('email','asc')->orderBy('user_type','asc')
                                ->paginate(20);

        return view('admin.ajax-user-search', compact('userSearch'));
    }

    public function userView (Request $request)
    {
        $id = $request->href;
        $user = User::findOrFail($id);
        
        return view('admin.user-view', compact('user'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignJob(Request $request, $id)
    {
        $assignJob = Jobs::findOrFail($id);
        $assignJob->assigned_to = $request->input('assign');
        $assignJob->date_assigned = date('Y-m-d H:m:s');
        $assignJob->date_completed = NULL;

        $getHandymanUser = User::where('id', $assignJob->assigned_to)->select('name', 'email')->first();
        $hMail = $getHandymanUser->email;
        $file = $assignJob->photo;
        
         // send mail to admin 
        Mail::send('mails.job-assigned', [
            'title' => 'Hello '.$getHandymanUser->name.',',
            'body' => 'A new job has been assign to you. Kindly view detials of request below.',
            'userDetails' => 'Job Details',
            'name' => $assignJob->user->name,
            'email' => $assignJob->user->email,
            'jobtitle' => $assignJob->job_title,
            'desc' => $assignJob->description,
            'budget' => $assignJob->amount,
            'phone' => $assignJob->phone,
            'location' => $assignJob->location,
        ],
            function ($message)use($file, $hMail) {
                    $message->from('no-reply@oandbservices.com','O & B Services');
                    $message->to($hMail)
                            ->subject('New Assigned Job');

            foreach(explode('|', $file ) as $files){
                $attach = public_path('job-images').'/'. $files;
                $message->attach($attach);
            }
        });
        $assignJob->save();

        return redirect()->route('admin.job-history')->withStatus('Job assigned Successfully!');
    }

    public function userList ()
    {
        $users = User::paginate(10);
        $usersTotal = User::all();

        return view('admin.users', compact('users','usersTotal'));
    }

    public function userCreate ()
    {
        return view('admin.user-create');
    }

    public function userStore (Request $request)
    {
        $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

        $user = new User ([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'user_type' => '1',
        ]);
        $user->save();

        return redirect()->route('admin.user-list')->withStatus('Admin user created successfully!');
    }

  

}
