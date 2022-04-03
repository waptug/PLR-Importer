<?php 

/*******************************************************
* PLR-Importer V1 Alpha
* Concept by Michael Scott McGinn
* Co-developed by: Michael Scott McGinn and Ed Reel
* Copyright 2022 by GeekZoneHosting.Com, LLC
********************************************************/
//The section extracts the files from the .zip and creates a folder to store the .txt files
    if (isset($_POST["btn_zip"])) {
        $output = '';
        if ($_FILES['zip_file']['name'] != '') {
            
            $file_name = $_FILES['zip_file']['name'];
            $array = explode(".", $file_name);
            $name = $array[0];
            
            $ext = $array[1];        
            if ($ext == 'zip') {
                $auto_generated = time() . rand(111, 999);
                $path = 'upload/' . $auto_generated;
                $location = $path . $file_name;

                if (move_uploaded_file($_FILES['zip_file']['tmp_name'], $location)) {
                    $zip = new ZipArchive;
                    if ($zip->open($location)) {
                        $zip->extractTo($path);
                        $zip->close();
                    }
                    unlink($location);
                }
            }
        }
    }
    
    //Code added to display progress. When we get the code working we can comment this out.
    $domain="https://plrimporter.com/";//hard coded but would need to change when it gets installed on another domain.
    
    echo "files upconpressed";
    echo "<br/>The Path is to your file is: ".$location."<br/>";
    
    // End of progress display
    
    foreach(glob($path.'/*.*') as $file) {
         echo "<br/>".$file."<br>";
        $single_txt_file = fopen($file, "r");
        $first_line = true;
        while (!feof($single_txt_file)) {
            $line = fgets($single_txt_file);

             if($first_line){
                 echo "<h1>$line</h1>";// This is the title
                 $first_line = false;
             }else{
                 echo $line . "<br>";//This is the rest of the body of the article.
             }
            $data[] = $line;
        }

        $new_data[0] = "";
        foreach($data as $da){
            
            if(trim($da) == ""){
                
            }
            else{
                $new_data[0] .= $da;                
            }
        }
    
    echo "========= array dump ========<br/>";
        print_r($new_data[0]);
    echo "==============================<br/>";    
        
        $main_data = [
            ['Title', 'body'],
            ['My Title', $new_data[0]]
        ];

        $filename = $auto_generated.'.csv';
echo "=============<br/>";
echo "name of result file:".$filename."<br/>";
echo "=============<br/>";
        // open csv file for writing
        $f = fopen($filename, 'w');

        if ($f === false) {
            die('Error opening the file ' . $filename);
        }

        // write each row at a time to a file
        $counter=0;
        foreach ($main_data as $row) {
            fputcsv($f,
                $row
            );
            $counter+=1;
            echo "Row:".$counter.":".$row."<br/>";
        }

        // close the file
        fclose($f);
    }
?>
