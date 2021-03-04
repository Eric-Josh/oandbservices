<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\GeneralMerchandise;

class BasicUserController extends Controller
{
    public function dashboard()
    {
         /* This is for recent jobs table list */
         $recentJobs = Jobs::where('user_id', auth()->user()->id)
         ->orderBy('id', 'desc')->take(10)->get();

        /* This is for recent merchandise jobs table list */
        $recentMerchantJobs = GeneralMerchandise::where('user_id', auth()->user()->id)
                ->orderBy('id', 'desc')->take(10)->get();

        /* This is for job count */
        $totalJobs1 = Jobs::where('user_id', auth()->user()->id)
                    ->where('deleted_at',null)->get();
        $totalJobs2 = GeneralMerchandise::where('user_id', auth()->user()->id)
                    ->where('deleted_at',null)->get();

        $totalJobCum = $totalJobs1->count() + $totalJobs2->count();
        $statusCompleted = $totalJobs1->where('status','Completed')->count() + $totalJobs2->where('status','Completed')->count();
        $statusPending = $totalJobs1->where('status','Pending')->count() + $totalJobs2->where('status','Pending')->count();

        return view('customer-dashboard', compact(['recentJobs','recentMerchantJobs','totalJobCum','statusCompleted','statusPending']));

    }
}
