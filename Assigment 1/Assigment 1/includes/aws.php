<?php 

    require_once('libraries/AWS/aws-autoloader.php');

    $s3 = new Aws\S3\S3Client([
        'region'  => S3_REGION,
        'version' => 'latest',
        'credentials' => [
            'key'    => S3_KEY,
            'secret' => S3_SECRET,
        ]
    ]);

    function upload_image($name, $filepath) {
        global $s3;

        $result = $s3->putObject([
            'Bucket' => S3_BUCKET,
            'Key'    => $name,
            // 'Body' => 'test text',
            'SourceFile' => $filepath,
            'ACL'    => 'public-read'
        ]);

        return $result['ObjectURL'];
    }

    

