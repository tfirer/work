<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('write_sae_file'))
{
    function write_sae_file($sae_name, $content) {
        $res = array('errno' => 0, 'errmsg' => '',  'result' => '');
        $storage = new SaeStorage();
        $storage->write(SAE_IMAGE_DOMAIN, $sae_name, $content);
        if ($storage->errno() != 0) {
            $res['errno'] = $storage->errno();
            $res['errmsg'] = $storage->errmsg();
            return $res;
        }
        $res['result'] = SAE_IMAGE_HOST_URL.$sae_name;
        return $res;
        //$url =  $storage->getUrl(SAE_IMAGE_DOMAIN, $sae_name);
        //if ($storage->errno() != 0) {
        //    $res['errno'] = $storage->errno();
        //    $res['errmsg'] = $storage->errmsg();
        //}
        //$res['result'] = $url;
        //return $res; 
    }
}

if ( ! function_exists('write_local_image')) {
    function write_local_image($image_name, $content) {
        $res = array('errno' => 0, 'errmsg' => '',  'result' => '');
        $image_local_path = SERVER_IMAGE_LOCAL_PATH . '/' . $image_name;
        if ( ! write_file($image_local_path, $content)) {
            $res['errno'] = ERR_FAIL_UPLOAD_IMAGE;
            $res['errmsg'] = 'Fail upload image';
            return $res;
        }
        $res['result'] = SERVER_IMAGE_BASE_URL . '/' . $image_name;
        return $res;
    }
}
