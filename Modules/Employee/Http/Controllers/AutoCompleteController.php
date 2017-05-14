<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 

use Modules\Employee\Repositories\JobOpeningRepository;
 
class AutoCompleteController extends Controller
{ 
    public function getJobOpenings(Request $request, JobOpeningRepository $jobOpeningRepository){ 
        return $jobOpeningRepository->all('job_title', $request->input('term'), ['id', 'job_title as text']); 
    }
 
}

