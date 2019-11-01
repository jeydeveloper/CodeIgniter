<div id="page-title">
	<h2><?php echo $page_title; ?></h2>
</div>
<div class="panel">
	<div class="panel-body">
		<div class="row">
            <div class="col-sm-6 col-md-offset-6 text-right">
                <button type="button" class="btn btn-info mrg20B" id="add_data">
                    Add Data &nbsp;
                    <i class="glyph-icon icon-plus-square"></i>
                </button>
            </div>
        </div>
		<div class="example-box-wrapper">
		    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="datatable-example">
			    <thead>
				    <tr>
			    	<?php foreach($column_list as $val) : ?>
	                    <th><?php echo $val['title_header_column']; ?></th>
	                <?php endforeach; ?>
				    </tr>
			    </thead>
		    </table>
		</div>
	</div>
</div>

<div class="panel" id="panel_form" style="display:none">
	<div class="panel-body">
		<h3 class="title-hero">
		    Form Data
		</h3>
		<div id="dynamic_errmsg" class="alert alert-danger" style="display:none">
	        <p></p>
	    </div>
		<div class="example-box-wrapper">
	        <form method="post" class="form-horizontal bordered-row" id="dynamic_form" data-parsley-validate>
	        	<input name="id" id="id" type="hidden" value="" />
	        	<div class="form-group">
	                <label class="col-sm-3 control-label">Nama</label>
	                <div class="col-sm-6">
	                	<input name="nama" id="nama" type="text" class="form-control" placeholder="Nama..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Email</label>
	                <div class="col-sm-6">
	                	<input name="email" id="email" type="text" class="form-control" placeholder="Email..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Password</label>
	                <div class="col-sm-6">
	                	<input name="password" id="password" type="text" class="form-control" placeholder="Password..." />
	                </div>
	            </div>
	            <div class="bg-default content-box text-center pad20A mrg25T">
	                <button class="btn btn-success" id="dynamic_btn_process">Process</button>
	                <button type="reset" class="btn btn-primary">Reset</button>
	                <button class="btn btn-black" id="dynamic_btn_close">Close</button>
	            </div>
	        </form>
	    </div>
	</div>
</div>

<!-- Below script for modal box -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm</h4>
            </div>
            <div class="modal-body">
                Delete this data?
            </div>
            <div style="display:none;" id="hd_delete_id"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="doFormDelete();return false;">Yes</button>
            </div>
        </div>
    </div>
</div>

<a id="hd_modalboxdelete" style="display:none;" href="#" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#smallModal">Click to open Modal</a>

<span style="display:none;" id="hd_delete_id"></span>

<script type="text/javascript">
var myowndatatable = '';

var enbl_btn_process = true;

var param_list = {
    'formid'            : '#dynamic_form',
    'panel_form'        : '#panel_form',
    'url_ajax_action'   : '<?php echo $api_url; ?>',
    'dynamic_btn_close' : '#dynamic_btn_close',
    'btn_submit'        : '#dynamic_btn_process',
    'div_errmsg'        : '#dynamic_errmsg',
    'parameter'        	: '',
    'method'        	: '',
    'callback'        	: function(data) {
        if(data.status == 'success') {
            $.jGrowl('Submit data success', {
                sticky: false,
                position: 'top-right',
                theme: 'bg-red'
            });
            refreshTable();
            $(param_list.panel_form).hide();
        	autoScrolling('html, body');
        	enbl_btn_process = true;
            $(param_list.btn_submit).attr('disabled', false);
        } else {
            $.jGrowl('Oops.. please try again', {
                sticky: false,
                position: 'top-right',
                theme: 'bg-red'
            });
        }
    },
};

$(document).ready(function() {
    myowndatatable = $('#datatable-example').dataTable({
    	"processing": true,
        "serverSide": true,
        "ajax": '<?php echo $api_url; ?>',
        "columnDefs": [ 
            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            },
            {
                "searchable": false,
                "orderable": false,
                "targets": <?php echo (count($column_list) - 1); ?>
            }
        ],
        "order": [[ 1, 'asc' ]]
    });

    $('.dataTables_filter input').attr("placeholder", "Search...");

    $('#add_data').click(function() {
    	param_list.method = 'POST';
    	emptyFormData();
        $(param_list.panel_form).show();
        autoScrolling(param_list.panel_form);
    });

    $(param_list.dynamic_btn_close).click(function(e) {
        e.preventDefault();
        $(param_list.panel_form).hide();
        autoScrolling('html, body');
    });

    $(param_list.formid).submit(function(){
        MYAPP.doFormSubmit.process(param_list);
        return false;
    });
});

function doFormEdit(rowid) {
	$(param_list.panel_form).show();
	param_list.parameter = {'id' : rowid};
	param_list.method = 'GET';
	var callback = function(data) {
    	param_list.method = 'PUT';
    	fillFormData(data);
    	$(param_list.panel_form).show();
        $(param_list.formid).find(':input:eq(1)').focus();
        autoScrolling(param_list.panel_form);
    };
    MYAPP.doAjax.process(param_list.url_ajax_action, param_list.parameter, callback, '', '', param_list.method);
}

function fillFormData(data) {
	$('#id').val(data.id);
	$('#nama').val(data.nama);
	$('#email').val(data.email);
	$('#password').val('');
}

function emptyFormData() {
	$('#id').val('');
	$('#nama').val('');
	$('#email').val('');
	$('#password').val('');
}

function showModalBoxDelete(rowid) {
    $('#hd_delete_id').text(rowid);
    $('#hd_modalboxdelete').trigger('click');
}

function doFormDelete() {
    var param = {
        'url_ajax_action'   : '<?php echo $api_url; ?>',
        'parameter'         : {'id' : $('#hd_delete_id').text()},
        'method'         	: 'DELETE',
        'data_type'         : 'json',
        'callback'          : function(data) {
            if(data.status == 'success') {
                $.jGrowl('Delete success', {
                    sticky: false,
                    position: 'top-right',
                    theme: 'bg-red'
                });
                refreshTable();
            } else {
                $.jGrowl('Oops.. please try again', {
                    sticky: false,
                    position: 'top-right',
                    theme: 'bg-red'
                });
            }
            $('#smallModal').modal('hide');
            $(param_list.dynamic_btn_close).trigger('click');
        }
    };
    MYAPP.doAjax.process(param.url_ajax_action, param.parameter, param.callback, param.data_type, '', param.method);
}

function refreshTable() {
    myowndatatable.fnClearTable(0);
    myowndatatable.fnDraw();
}

function autoScrolling(panel_id) {
    $('html, body').animate({
        scrollTop: $(panel_id).offset().top
    }, 700);
}
</script>