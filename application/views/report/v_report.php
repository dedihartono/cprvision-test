<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Submission Product Report</h6>
        </div>

        <div class="card-body">
            <form id="form_filter" class="form-inline">
                <div class="input-group mb-2">
                    <label for="from_date" class="sr-only label">From Date</label>
                    <input type="text" name="from_date" class="form-control input-sm datepicker" id="from_date"
                        placeholder="From Date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="input-group mx-sm-3 mb-2" id="to_datepicker">
                    <label for="to_date" class="sr-only mx-sm-2 label">To Date</label>
                    <input type="text" name="to_date" class="form-control datepicker" id="to_date"
                        placeholder="To Date">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="form-group mx-sm-2">
                    <button id="btn_filter" type="button" class="btn btn-primary mb-2"><i class="fa fa-search"></i>
                        Filter</button>
                </div>
                <div class="form-group">
                    <button id="btn_reset" type="button" class="btn btn-warning mb-2">Clear Filter</button>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Count</th>
                            <th>USER/PIN</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    let table;

    table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url()?>report/ajax_list",
            "type": "POST",
            "data": function(data) {
                data.from_date = $('#from_date').val();
                data.to_date = $('#to_date').val();
            }
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }, ],
    });

    $('#btn_filter').click(function() {
        table.ajax.reload();
    });

    $('#btn_reset').click(function() {
        $('#form_filter')[0].reset();
        table.ajax.reload();
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });
});
</script>
