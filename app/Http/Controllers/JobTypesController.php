<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobTypes;

class JobTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTypes = JobTypes::paginate(20);
        
        return view('jobTypes.index', compact('jobTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobTypes.create');
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
            'jobtype' => 'required'
        ]);
        $jobTypes = new JobTypes([
            'name' => $request->get('jobtype')
        ]);
        $jobTypes->save();

        return redirect('/jobtypes')->withStatus(__('Job Type successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobTypes = JobTypes::find($id);

        return view('jobTypes.edit', compact('jobTypes'));
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
        $jobTypes = JobTypes::find($id);
        $jobTypes->name = $request->input('jobtype');
        $jobTypes->save();

        return redirect('/jobtypes')->withStatus(__('Job Type successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobTypes = JobTypes::find($id);
        $jobTypes->delete();

        return redirect('/jobtypes')->withStatus('success', 'Job Type deleted!');
    }
}
