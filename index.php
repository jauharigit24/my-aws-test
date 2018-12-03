<?php
require 'vendor/autoload.php';
ini_set('max_execution_time', 300); 
use Aws\S3\S3Client;
 
// Instantiate an Amazon S3 client.  
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-2',
    'credentials' => [
        'key'    => '####',
        'secret' => '###########'
    ]
]);
 
 
$bucketName = 'elasticbeanstalk-us-east-2-440225585470';
$file_Path = __DIR__ .'/DSC07472.jpg';
$key = 'images/'.basename($file_Path);

// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,
        'Body'   => fopen($file_Path, 'r'),
        'ACL'    => 'public-read',
    ]);
    echo $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
  }