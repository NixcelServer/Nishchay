<?php 

    namespace App\Helpers;

    use App\Models\AuditLogDetail;
    use Illuminate\Support\Facades\Date;

    class AuditLogHelper{
        
        public static function logDetails($activity_name,$activity_by){

            $log_details = new AuditLogDetail;
            $log_details->activity_name = $activity_name;
            $log_details->activity_by = $activity_by;
            $log_details->activity_date = Date::now()->toDateString();
            $log_details->activity_time = Date::now()->toTimeString(); // Assuming $log_details is an object
            $log_details->save();
            
            
        }
    }

    
?>