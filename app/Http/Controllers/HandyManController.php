<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Rules\Password;

use Validator;
use Input;
use Auth;

use App\Models\Jobs;
use App\Models\JobTypes;
use App\Models\HandyManUser;

class HandyManController extends Controller
{
    // use PasswordValidationRules;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $handyManJob = Jobs::where('assigned_to', auth()->user()->id)
                            ->where('deleted_at', null)->get();
        $handyManJob2 = Jobs::where('assigned_to', auth()->user()->id)->orderBy('id', 'desc')->take(10)->get();
        return view('handy-man.dashboard', compact(['handyManJob','handyManJob2']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobTypes = JobTypes::orderBy('name', 'asc')->get();
        return view('auth.handyman-register-step2')->with('jobTypes', $jobTypes);
    }

    
    public function register(Request $request)
    {
        $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

        $newHandymanUser = new HandyManUser ([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'user_type' => '3',
        ]);
        $newHandymanUser->save();
        Auth::login($newHandymanUser);

        return redirect()->route('handyman.dashboard');
    }
    

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $handyManRegUpdate = HandyManUser::findOrFail($id);

        $request->validate([
            'phone' => 'required|numeric|digits:10',
            'profession' => 'required|numeric',
            'address' => 'required',
        ]);

        $workProof=array();
        if($request->file('file')){
            foreach($request->file('file') as $image)
            {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('work-proof'), $new_name);
                $workProof[] = $new_name;
            }
        }

        $handyManRegUpdate->phone1 = $request->input('phone');
        $handyManRegUpdate->job_type_id = $request->input('profession');
        $handyManRegUpdate->address = $request->input('address');
        $handyManRegUpdate->work_proof = implode("|",$workProof);
        $handyManRegUpdate->save();

        return redirect()->route('handyman.dashboard');
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
        $jobs = Jobs::findOrFail($id);
        return view('handy-man.job-show', compact('jobs'))->with('jobtypes', $jobTypes);
    }

    public function history()
    {
        $handyManJob = Jobs::where('assigned_to', auth()->user()->id)
                            ->where('deleted_at', null)->paginate(10);
        return view('handy-man.job-history', compact('handyManJob'));
    }
}
