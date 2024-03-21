<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\QueryDetail;

class QueryController extends Controller
{
    //

    public function createQuery()
    {
        //
    }


    public function showPendingQueries()
    {   
        //get the user details from session and get the user id
        $userDetails = session('user');
        $userId = $userDetails->tbl_user_id;

        //get the module data from session and check the modules assigned to the users
        $moduleData = session('moduleData');
        $myQueriesExist = false;
        $showQueriesExist = false;

        foreach($moduleData as $data)
        {
            if($data['module']->module_name === 'My Queries'){
                $myQueriesExist = true;
            }

            if($data['module']->module_name === 'Show Queries'){
                $showQueriesExist = true;
            }

            if($myQueriesExist && $showQueriesExist){
                break;
            }
        }

            //if the user is one who creates query following block will be executed
            if($myQueriesExist)
            {
                // $queries = QueryDetail::where('add_by',$userId)->where('query_status','Pending')->where('flag','show')->get();
                // $pendingQueryCount = $queries->count();
                // $cqueries = QueryDetail::where('add_by',$userId)->where('query_status','Completed')->where('flag','show')->get();
                // $completedQueryCount = $cqueries->count();
                $queries = QueryDetail::where('add_by',$userId)->where('flag','show')->get();
                
                
                foreach($queries as $query)
                {
                    $query->enc_query_id = EncryptionDecryptionHelper::encdecId($query->tbl_query_detail_id, 'encrypt');

                    //query the Query model to get the name of user to whom task is assigned
                    $assignedUser = User::find($query->selected_user_id);
                    if ($assignedUser) {
                        $query->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                    }
                }

                $columnName = "Query Raised To";

            return view('frontend_query.showQuery',['queries'=>$queries,'columnName'=>$columnName]);
            
        
            
             }


    }
}
