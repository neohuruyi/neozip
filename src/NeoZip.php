<?php 
namespace hufang\neozip;

/**
 * 压缩文件并下载.
 *
 * @author  hansan.hu@foxmail.com
 * @link    https://github.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 */
class NeoZip
{
    
    const VERSION = '0.1.0';

    /**
     * @DateTime    2019-01-10
     * @Author      hufang
     * @description 压缩文件并下载
     * @var         [var]
     * @param       [Type]        [name] [<description>]
     * @param       [Type]        [name] [<description>]
     * @param       [type]        $file  [文件位置]
     * @return      [type]               [description]
     */
    static public function zipAndDownload(array $files)
    {
        $zip=new \ZipArchive();
        $today = date('ymdHi');
        $zipname = public_path("zipfile".$today.'.zip');

        if($zip->open($zipname,\ZipArchive::CREATE)!==TRUE){
            $info = [
                'error'=>'1',
                'errorMsg'=>'Unable to open file, or file creation failed',
            ];
            return $info;
        }
        
        foreach ($files as $key => $v) {
            $file = public_path(ltrim($v,'/'));
            $file_type = pathinfo($file, PATHINFO_EXTENSION);  //文件类型，取后缀
            $file_basename = basename($file);
            if (file_exists($file)) {
                $new_name = $file_basename.'.'.$file_type;
                $zip->addFile($file,$new_name);
            else{
                $zip->addFile($file_basename.'_'.'(File_Miss)'.'.'.$file_type);
            }
        }

        $zip->close();
        header('Pragma: public'); // required
        header('Expires: 0'); // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private',false);
        header('Content-Type: application/force-download');//强制下载
        header('Content-Disposition: attachment; filename="'.basename($zipname).'"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: close');
        readfile($zipname); // push it out
          //每一次下载后删除旧压缩包
        if (file_exists($zipname)) {
             @unlink($zipname);
        }
        exit();
    }

    
}