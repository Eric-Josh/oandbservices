<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralMerchandise;
use App\Models\Merchandise;
use Mail;

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
            'phone' => 'required|numeric|digits:10',
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

        // send mail to user 
        Mail::send('mails.merchandise-user-notification', [
            'title' => 'Hello '.auth()->user()->name.',',
            'body' => 'Thank You for placing a request.
                        We will connect you to a '. $postMerchandise->merchandise->merchandise .' within your chosen time.'
            ],
            function ($message) {
                    $message->from('no-reply@oandbservices.com','O & B Services');
                    $message->to(auth()->user()->email)
                            ->subject('Merchandise - New Job Post');
        });

        // send mail to admin 
        Mail::send('mails.merchandise-admin-notification', [
            'title' => 'Hello Admin,',
            'body' => 'A new Merchandise resquest has been posted. Kindly view detials of request below.',
            'userDetails' => 'Merchandise Details',
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'jobtitle' => $postMerchandise->merchandise->merchandise,
            'desc' => $request->get('description'),
            'budget' => $request->get('amount'),
            'phone' => $request->get('phone'),
            'location' => $request->get('location'),
            'userTimeFrame' => $request->get('time_frame')
        ],
            function ($message) {
                    $message->from('no-reply@oandbservices.com','O & B Services');
                    $message->to(auth()->user()->email)
                            ->subject('Merchandise - New Job Post');
        });
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
            'phone' => 'required|numeric|digits:10',
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

        return redirect('/general-merchandise')->withStatus(__('Job deleted successfully.'));
    }
}
