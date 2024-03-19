@extends('frontend_home.leftmenu')
 
<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
 
    #designationName{
        width: 400px; /* Adjust the width as needed */
    }

    
</style>
 
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="max-width: 1000px;">
                        <div class="card-header">
                            <h4 class="mt-2">Nixcel Software Solutions Log Details</h4>
                        </div>
                        
                        <!-- Table displaying designations -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                  <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Activity Name</th>
                                        <th>Activity By</th>
                                        <th>Activity Date</th>
                                        <th>Activity Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($auditlogs as $index => $log)
                                  <tr>
                                    <td>{{ $index+1 }}</td>                
                                    <td>{{ $log->activity_name}}</td>
                                    <td>{{ $log->username}}</td>
                                    <td>{{ $log->activity_date}}</td>
                                    <td>{{ $log->activity_time}}</td>
                                </tr>  
                                @endforeach
                                </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>






