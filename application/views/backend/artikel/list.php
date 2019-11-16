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
	                	<input name="artikel_name" id="artikel_name" type="text" class="form-control" placeholder="Nama..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Content</label>
	                <div class="col-sm-6">
	                	<input name="artikel_content" id="artikel_content" type="text" class="form-control" placeholder="Content..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Image</label>
	                <div class="col-sm-6">
	                	<input name="artikel_image" id="artikel_image" type="text" class="form-control" placeholder="Image..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Publish</label>
	                <div class="col-sm-6">
	                	<input name="artikel_publish" id="artikel_publish" type="text" class="form-control" placeholder="Publish..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Author</label>
	                <div class="col-sm-6">
	                	<input name="artikel_author" id="artikel_author" type="text" class="form-control" placeholder="Author..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Is Actived</label>
	                <div class="col-sm-6">
	                	<input name="artikel_isactive" id="artikel_isactive" type="text" class="form-control" placeholder="Is actived..." />
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">ID Sub Menu</label>
	                <div class="col-sm-6">
	                	<input name="id_sub_menu" id="id_sub_menu" type="text" class="form-control" placeholder="ID sub menu..." />
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
	$('#id').val(data.artikel_id);
	$('#artikel_name').val(data.artikel_name);
	$('#artikel_content').val(data.artikel_content);
	$('#artikel_image').val(data.artikel_image);
	$('#artikel_publish').val(data.artikel_publish);
	$('#artikel_author').val(data.artikel_author);
	$('#artikel_isactive').val(data.artikel_isactive);
	$('#id_sub_menu').val(data.id_sub_menu);
}

function emptyFormData() {
	$('#id').val('');
	$('#artikel_name').val('');
	$('#artikel_content').val('');
	$('#artikel_image').val('');
	$('#artikel_publish').val('');
	$('#artikel_author').val('');
	$('#artikel_isactive').val('');
	$('#id_sub_menu').val('');
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