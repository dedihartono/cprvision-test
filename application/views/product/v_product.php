<!-- <div class="container-fluid">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Product A</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>20 users included</li>
                    <li>10 GB of storage</li>
                    <li>Priority email support</li>
                    <li>Help center access</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Enterprise</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>30 users included</li>
                    <li>15 GB of storage</li>
                    <li>Phone and email support</li>
                    <li>Help center access</li>
                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
            </div>
        </div>
	</div>
	

</div> -->

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Submission Product</h6>
        </div>

        <div class="card-body">
            <form id="form_product">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th class="d-none d-sm-block">Product Image</th>
                                <th>Product Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($product): ?>
                            <?php $i=1 ?>
                            <?php foreach ($product as $key => $value): ?>
                            <tr>
                                <td> <?php echo $value->name ?> </td>
                                <td class="d-none d-sm-block"> <img width="100px" src="<?php echo $value->image ?>">
                                </td>
                                <td>
                                    <input type="hidden" name="id[<?php echo $key?>]" readonly
                                        value="<?php echo $value->id ?>">
                                    <input type="number" name="quantity[<?php echo $key?>]" placeholder="Quantity"
                                        class="form-control" value="0">
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">
                                    <button type="button" id="button_save"
                                        class="btn btn-lg btn-block btn-primary">Submit</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('#table').DataTable({
		"columnDefs": [{
            "targets": [1,2],
            "orderable": false,
        }, ],
	});
});

$("#button_save").on('click', function(e) {
    let product = $('#form_product').find('input').serialize();

    $.ajax({
        url: "<?php echo base_url()?>product/save",
        method: 'POST',
        dataType: "json",
        data: product,
        success: function(data) {
            alert(data.message, data.status);
            $("#button_save").removeClass('loading');
            $("#button_save").hide();
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $("#button_save").removeClass('loading');
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
});
</script>
