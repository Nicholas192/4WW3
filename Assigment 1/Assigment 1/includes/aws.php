<?php 

    /*
        This file houses all functions related AWS S3 buckts
    */



    // Load the AWS S3 libraray provided by AWS
    require_once('libraries/AWS/aws-autoloader.php');



    // Connect to the S3 bucket.
    // Credentials are stored in a security file that's only accessible via SSH to the web server
    $s3 = new Aws\S3\S3Client([
        'region'  => S3_REGION,
        'version' => 'latest',
        'credentials' => [
            'key'    => S3_KEY,
            'secret' => S3_SECRET,
        ]
    ]);



    // Function upload_image()
    // Pushes an image file to S3 bucket and returns the public URL for the file.
    function upload_image($name, $filepath) {

        // Get the $s3 connection
        global $s3;

        // Push the image to S3
        $result = $s3->putObject([
            'Bucket' => S3_BUCKET,
            'Key'    => $name,
            // 'Body' => 'test text',
            'SourceFile' => $filepath,
            'ACL'    => 'public-read'
        ]);

        // Return the public URL
        return $result['ObjectURL'];
    }

    

