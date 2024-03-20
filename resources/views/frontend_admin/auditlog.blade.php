<head>
    <!-- Preload Critical CSS -->
  <link rel="preload" href="/assets/css/app.min.css" as="style">
  <link rel="preload" href="/assets/css/style.css" as="style">
  <link rel="preload" href="/assets/css/components.css" as="style">
  <link rel="preload" href="/assets/css/custom.css" as="style">
   <!-- Preload Critical JS -->
   <link rel="preload" href="/assets/js/app.min.js" as="script">
   <link rel="preload" href="/assets/js/scripts.js" as="script">
   <link rel="preload" href="/assets/js/custom.js" as="script">
</head>
@extends('frontend_home.leftmenu')
 
<style>
    /* Custom CSS to adjust positioning */
    .main-content {
        margin-top: -30px; /* Adjust this value as needed */
    }
    .custom-thead {
        background-color: #c7e1ff;
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
                                <div class="d-flex justify-content-end mb-3"> <!-- Align button to the right -->
                                    <button id="exportAllBtn" class="btn btn-success">Export to Excel</button>
                                </div>
                                <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                  <thead class="custom-thead">
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
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include SheetJS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
    $(document).ready(function () {
        $('#exportAllBtn').click(function () {
            // Send AJAX request to fetch all data
            $.ajax({
                url: '/fetch-all-audit-log', // Update with your backend route
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        // Convert data to Excel
                        const sheet = XLSX.utils.json_to_sheet(response.data);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, sheet, 'Audit Log Data');
                        const excelBuffer = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });

                        // Save Excel file
                        saveAsExcel(excelBuffer, 'Audit_Log_Data.xlsx');
                    } else {
                        alert('Failed to fetch data.');
                    }
                },
                error: function () {
                    alert('Error occurred while fetching data.');
                }
            });
        });

        // Function to save Excel file
        function saveAsExcel(buffer, fileName) {
            const blob = new Blob([buffer], { type: 'application/octet-stream' });
            const url = URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.href = url;
            a.download = fileName;
            a.click();

            URL.revokeObjectURL(url);
        }
    });
</script>







