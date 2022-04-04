<?php 

/*******************************************************
* PLR-Importer V1 Alpha
* Concept by Michael Scott McGinn
* Co-developed by: Michael Scott McGinn and Ed Reel
* Copyright 2022 by GeekZoneHosting.Com, LLC
********************************************************/
//The section extracts the files from the .zip and creates a folder to store the .txt files
echo "Uncompressing files.<br/>";
$filecounter=0;
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
        $filecounter=+1;
    }
    
    //Code added to display progress. When we get the code working we can comment this out.
    $domain="https://plrimporter.com/";//hard coded but would need to change when it gets installed on another domain.
    
    echo $filecounter." files upconpressed<br/>";
    echo "==================<br/>The Path to your files is: ".$location."<br/>=============<br/>";
    
    // End of progress display
    
    //Grabs the list of file paths for each file in the directory and loops through them putting them into $file
    //Everything happens in this loop to parse each file line by line in to $data array and create the .csv file
    $line_counter=0;//display the array position line is put in todo:fix it so it works for entire loop. 

    foreach(glob($path.'/*.*') as $file) {
         echo "<br/>====== processing file name ==========<br/>".$file."<br>========================<br/>";
        $single_txt_file = fopen($file, "r");
        $first_line = true;
        
        while (!feof($single_txt_file)) {
            $line = fgets($single_txt_file);// grabs one line of the file that the pointer is pointing to as a string $line
         
            //Test code to split up the file, not part of the orginal file

            //$title = strtok($single_txt_file, "\n");
            //$content = trim(substr($single_txt_file, strpos($single_txt_file, "\n") + 1));
            

            //echo "line var=".$line."<br/>Title=".$title."<br/>Content=".$content."<br/>";
            // end of test code

             
             if($first_line){
                echo "<br/>============ data[".$line_counter."] =============================</br>";
                echo "<h1>$line</h1>";// if this is the first line of the file then this is the title
                echo "===============================================================<br/>";
                $first_line = false;
                }else{
                    //$line_counter++;
                 echo "<br/>======== data[".$line_counter."] ================<br/>";   
                 echo $line . "<br>===============================<br/>";//This is the rest of the body of the article one line at a time.
                }
            $data[] = $line;//puts line into the array $data[]
            //if($first_line$){data[]+=",";}
            $line_counter++;
        }
        $arraylength=count($data);
        echo "<br/><h1>data contains:".$arraylength."-data[3]=".$data[3]."=print_r=".print_r($data)."<br/></h1>";

        $new_data[0] = "";
        foreach($data as $da){
            
            if(trim($da) == ""){
                
            }
            else{
                $new_data[0] .= $da;                
            }
        }
    
    echo "<br/>========= array dump new_data[0] array ========<br/>";
        print_r($new_data[0]);
    echo "<br/>==============================<br/>";    
        
        $main_data = [
            ['Title', 'body'],
            ['My Title', $new_data[0]]
        ];

        $filename = $auto_generated.'.csv';
echo "<br/>==================================================<br/>";
echo "name of file csv will be written into:".$filename;
echo "<br/>===================================================<br/>";
        
        $f = fopen($filename, 'w');// open csv file for writing

        if ($f === false) {
            die('Error opening the file ' . $filename);
        }

        // write each row at a time to a file
        $counter=0;
        foreach ($main_data as $row) {
            fputcsv($f,$row,",");
            $counter+=1;
            echo "<br/>Row:".$counter.":<br/>=======================<br/>".print_r([$row])."<br/>=================<br>";
        }

        // close the file
        fclose($f);
    }
    echo "<br/>================ Processing Completed =====================<br/>";
    echo "Your result is here:".$filename;

?>
<html>
    <body>
        <a href="<?php echo $filename; ?>"><?php echo $filename; ?></a>
</body>
</html>
