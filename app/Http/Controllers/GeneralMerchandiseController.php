<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralMerchandise;
use App\Models\Merchandise;

use Mail;
use App\Mail\MerchandisePostUserNotification;
use App\Mail\MerchandisePostAdminNotification;
use App\Mail\MerchandiseUpdateAdminNotification; 
use App\Mail\MerchandiseDeleteAdminNotification;

class GeneralMerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        $generalMerchandise = GeneralMerchandise::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('general-merchandise.index', compact('generalMerchandise'))->with('merchandise', $merchandise);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        
        return view('general-merchandise.create')->with('merchandise', $merchandise);;
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
            'merchandise' => 'required|numeric',
            'phone' => 'required|numeric|digits:11',
            'description' => 'required|min:30',
            'amount' => 'required|numeric',
            'time_frame' => 'required',
            'location' => 'required'
        ]);

        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        $postMerchandise = new GeneralMerchandise;

        $postMerchandise->merchandise_id = $request->get('merchandise');
        $postMerchandise->phone = $request->get('phone');
        $postMerchandise->amount = $request->get('amount');
        $postMerchandise->time_frame = $request->get('time_frame');
        $postMerchandise->description = $request->get('description');
        $postMerchandise->status = 'Pending';
        $postMerchandise->user_id = auth()->user()->id;
        $postMerchandise->location = $request->get('location');

       
        $customerEmail = auth()->user()->email;
        $customerData = [
            'customer_name' => auth()->user()->name,
            'customer_email' => $customerEmail,
            'customer_phone' => $request->get('phone'),
            'merchanddise_type' => $postMerchandise->merchandise->merchandise,
            'job_desc'=>$request->get('description'),
            'job_amount'=>$request->get('amount'),
            'job_loc'=>$request->get('location'),
            'job_start_time'=>$request->get('time_frame'),
        ];
        // mail to user 
        Mail::to($customerEmail)->send(new MerchandisePostUserNotification($customerData));
        // mail to admin 
        Mail::to('info@oandbservices.com')->send(new MerchandisePostAdminNotification($customerData));

        $postMerchandise->save();

        return redirect('/general-merchandise')->withStatus(__('Job posted successfully. Kindly check your mailbox'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        $generalMerchandise = GeneralMerchandise::find($id);

        return view('general-merchandise.show', compact('generalMerchandise'))->with('merchandise', $merchandise);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merchandise = Merchandise::orderBy('merchandise', 'asc')->get();
        $generalMerchandise = GeneralMerchandise::find($id);

        return view('general-merchandise.edit', compact('generalMerchandise'))->with('merchandise', $merchandise);
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
        $gMerchandise = GeneralMerchandise::find($id);

        $request->validate([
            'merchandise' => 'required|numeric',
            'phone' => 'required|numeric|digits:11',
            'description' => 'required|min:30',
            'amount' => 'required|numeric',
            'time_frame' => 'required',
            'location' => 'required'
        ]);

        $gMerchandise->merchandise_id = $request->input('merchandise');
        $gMerchandise->phone = $request->input('phone');
        $gMerchandise->description = $request->input('description');
        $gMerchandise->amount = $request->input('amount');
        $gMerchandise->time_frame = $request->input('time_frame');
        $gMerchandise->location = $request->input('location');
        $gMerchandise->save();

        $customerData = [
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'customer_phone' => $request->input('phone'),
            'merchanddise_type' => $gMerchandise->merchandise->merchandise,
            'job_desc'=>$request->input('description'),
            'job_amount'=>$request->input('amount'),
            'job_loc'=>$request->input('location'),
            'job_start_time'=>$request->input('time_frame'),
        ];
        Mail::to('info@oandbservices.com')->send(new MerchandiseUpdateAdminNotification($customerData));

        return redirect('/general-merchandise')->withStatus(__('Job updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gmerchandise = GeneralMerchandise::find($id);
        $gmerchandise->delete();

        $customerData = [
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'customer_phone' => $gmerchandise->phone,
            'merchanddise_type' => $gmerchandise->merchandise->merchandise,
            'job_desc'=>$gmerchandise->description,
            'job_amount'=>$gmerchandise->amount,
            'job_loc'=>$gmerchandise->location,
            'job_start_time'=>$gmerchandise->time_frame,
        ];
        Mail::to('info@oandbservices.com')->send(new MerchandiseDeleteAdminNotification($customerData));

        return redirect('/general-merchandise')->withStatus(__('Job deleted successfully.'));
    }
}
