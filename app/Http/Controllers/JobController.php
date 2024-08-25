<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewJobMail;
use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // used this query instead of JOB::all() preventing the N+1 problem
        $jobs = Job::with('employer')->with('tags')->latest()->simplePaginate(10);

        return view('jobs.index',[
            'jobs' => $jobs
        ]);
    }

    /**
     * Display user jobs
     */
    public function userJobs(){
        $jobs = Job::with('employer')->where('employer_id',Auth::id())->latest()->get();
        return view('jobs.index',[
            'jobs' => $jobs
        ]);
    }

    /**
     * Display a create page.
     */
    public function create(){
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => ['required','min:3'],
            'salary' => ['required']
        ]);

        $job = Job::create([
            'title' => $request->title,
            'salary' => $request->salary,
            'employer_id' => Auth::id()
        ]);

        SendNewJobMail::dispatch($job)->delay(10);

        return redirect('/jobs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        // to remember
        // $job = Job::with('employer','tags')->find($id);

        // to remember
        // if (! $job) {
        //     abort(404);
        // }

        // Gate::authorize('edit-job',$job);

        return view('jobs.show',[
            'job' => $job,
        ]);
    }



    /**
     * Display edit page for specified resource.
     */
    public function edit(Job $job){
        //    $job = Job::with('employer','tags')->find($id);

        // to remember
        // if(Auth::guest()){
        //     return redirect('/login');
        // }

        // Gate::authorize('edit-job',$job);

        return view('jobs.edit',[
            'job' => $job,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Job $job)
    {
        // authorize NOT NOW



         // Find the job by id
        // $job = Job::findOrFail($id);

        // Validate
        $validatedData = $request->validate([
            'title' => 'required|string|min:3',
            'salary' => 'required',
        ]);


        // Update the job with the validated data
        $job->update($validatedData);

        // Optionally, you can redirect back with a success message

        return redirect('/jobs/'. $job->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        // authorize NOT NOW

        // Find the job by id
        // $job = Job::findOrFail($id);

        $job->delete();

        return redirect('/jobs');
    }
}
