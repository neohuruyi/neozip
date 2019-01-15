hufang
=====

将多个文件打包成zip并下载

# 安装方法
命令行下, 执行 composer 命令安装:
````
composer require hufang/neozip
````

# 使用示例demo
````
use hufang\NeoZip\NeoZip;

$file_arr = [
	0=>'file1_path',
	1=>'file2_path',
];


// 下载download
NeoZip::zipAndDownload(file_arr);


````

# 关于导出的文件名
> 可以自行修改 src/ 下 NeoZip.php 中的文件名
