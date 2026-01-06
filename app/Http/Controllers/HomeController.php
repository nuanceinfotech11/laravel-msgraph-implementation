<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dcblogdev\MsGraph\Facades\MsGraph;
use App\Models\Emails;
use App\Services\EmailDataProcessorService;
use App\Http\Requests\EmailsDataRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param EmailsDataRequest $request
     * @param EmailSchedulerService $emailSchedulerService
     * fetch emails from MSGraph
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(EmailsDataRequest $request,EmailSchedulerService $emailDataProcessorService )
    {
        
        $pageTitle = "List";
        $perpage = config('msgraph.perpage');
        $counterInc = $skip = 0;
        $pageno = 1;
        
        // Fetch email record using MSGraph API
        $emailsResult = MsGraph::emails()->top($perpage);
        
        // Ajax reuqest check and fetch next record
        if($request->ajax()){
            
            $counterInc = $skip = ($request->page*$perpage);
            $pageno = $request->page+1;
            
            // Fecth next record
            $emailsResult = $emailsResult->skip($skip)->get();
            
            // Logic for class to show or hide load more button according to records
            $classhide = ((count($emailsResult['value'])+$counterInc) == $emailsResult['@odata.count']) ? 'hide' : '';
            
            // Save record in table using service
            $emailDataProcessorService->insertEmailData($emailsResult);

            // Create load more button according to next record
            $loadmoreBtn = view('partials.pagination-load-more-btn',compact('classhide','pageno'))->rendor();

            // Create table list
            $html = view('partials.email-list-table', compact('emailsResult','counterInc'))->render();

            return response()->json(['status'=>true,'html'=>$html,'loadmoreBtn'=>$loadmoreBtn],200);
        }

        // Fecth record
        $emailsResult = $emailsResult->skip($skip)->get();
        $classhide = ((count($emailsResult['value'])+$counterInc) == $emailsResult['@odata.count']) ? 'hide' : '';
        
        // Insert fetch data in database using service
        $emailDataProcessorService->insertEmailData($emailsResult);

        // Render view with fetch records
        return view('list',compact('emailsResult','pageTitle','pageno','counterInc','classhide'));
    }
}
