<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function formatDatatable($data = null, $all = null, $filtered = null) {
	$ci = & get_instance();
	$draw = $ci->get('draw');
	if(empty($draw)) return $data;
	$ret = [
		'data' => $data,
		'recordsTotal' => count($all),
		'recordsFiltered' => count($filtered),
		'draw' => (int)$draw,
	];
	return $ret;
}

function uploadImage($dirImage = '') {
	$status = true;

    $ret = [
    	'files' => array(),
    	'success_msg' => '',
    	'err_msg' => '',
    ];

    if(!empty($_FILES)) {
        $uploaddir = !empty($dirImage) ? $dirImage : DIR_UPLOAD_IMAGE;
        foreach($_FILES as $file)
        {
        	$tmpFilename = explode('.', basename($file['name']));
        	$filename = md5($tmpFilename[0]).'.'.$tmpFilename[1];
            if(move_uploaded_file($file['tmp_name'], $uploaddir .$filename))
            {
                $files[] = $filename;
            }
            else
            {
                $status = false;
            }
        }

        if($status) {
            $ret['success_msg'] = 'Upload data success.';
            $ret['files'] = $files;
        } else {
            $ret['err_msg'] = 'Upload file failed';
        }
    }

    return $ret;
}

?>