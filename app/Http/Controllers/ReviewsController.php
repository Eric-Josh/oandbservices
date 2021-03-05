<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Reviews::orderBy('id','desc')->paginate(9);
        return view('reviews-view', compact('reviews'));
    }

    public function create()
    {
        return view('reviews-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'star' => 'required|numeric',
            'comments' => 'required',
        ]);

        $reviews = new Reviews([
            'stars' => $request->get('star'),
            'comments' => $request->get('comments') ,
            'user_id' => auth()->user()->id, 
        ]);
        $reviews->save();

        return redirect()->route('dashboard')->withStatus('success','Thanks for you feedback.');
    }
}
