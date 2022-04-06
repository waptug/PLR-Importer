<?php 

/*******************************************************
* PLR-Importer V1 Alpha
* Concept by Michael Scott McGinn
* Co-developed by: Michael Scott McGinn and Ed Reel
* Copyright 2022 by GeekZoneHosting.Com, LLC
* Licenced: MIT
********************************************************/
//The section extracts the files from the .zip and creates a folder to store the .txt files
echo "Uncompressing zip files.<br/>";
$filecounter=0;
$tag="";
$tagName="";
$processedfile=Array();
$combinedfiles=Array();

    if (isset($_POST["btn_zip"])) {
        $output = '';
        if ($_FILES['zip_file']['name'] != '') {
            
            $file_name = $_FILES['zip_file']['name'];
            $array = explode(".", $file_name);
            $name = $array[0];
            echo $name."<br/>";
            $tag=$name;
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
        //if ($_FILES['zip_file']['name'] = ''){die; }
        //if ($_FILES['zip_file']['name'] != ''){$filecounter=+1;}
        $filecounter=+1;
    }
    //End of File Extraction. 
    //All files should be extracted from the .zip file at this point and in the created folder.
    
    //Code added to display progress. When we get the code working we can comment this out.
    $domain="https://plrimporter.com/";//hard coded but would need to change when it gets installed on another domain.
    
    echo $filecounter." .zip files upcompressed<br/>";
    echo "==================<br/>The Path to your files is: ".$location."<br/>=============<br/>";
    // die;
    // End of progress display
    
    //Grabs the list of file paths for each file in the directory and loops through them putting them into $file
    //Everything happens in this loop to parse each file line by line in to $data array and create the .csv file
    
    $line_counter=0;//display the array position line is put in  
    // pull all fiels with the .txt extention and ignore the rest.
    foreach(glob($path.'/*.txt') as $file) {
         echo "<br/>====== processing file name ==========<br/>".$file."<br>========================<br/>";
        $single_txt_file = fopen($file, "r");
        //$first_line = true;
        
        //while (!feof($single_txt_file)) {
            //$line = fgets($single_txt_file);// grabs one line of the file that the pointer is pointing to as a string $line
             $fullfile=file_get_contents($file);
            
             //Code to split up the file

            $title = strtok($fullfile, "\n");
            $content = trim(substr($fullfile, strpos($fullfile, "\n") + 1));
            $tagName=$tag;
            

            //$processedfile=$title.','.$content.','.$tagName;
            //$processedfile=$title.$content.$tagName;
            //$processedfile=$title;
            //$processedfile+=$content;
            //$processedfile+=$tagName;
            array_push($processedfile,$title);
            array_push($processedfile,$content);
            array_push($processedfile,$tag);

            echo "<h1> processedfile array print_r contains</h1>";
            print_r($processedfile);

            echo "<br/><h1>Title=</h1>".$title."<br/><h1>Content=</h1>".$content."<br/><h1>tagName=</h1>".$tagName."<br/>";
            // end of test code
            $title="";
            $content="";
            
            //push processed file into combinedfiles array
            array_push($combinedfiles,$processedfile);
           
            //incriment linecounter to keep track of the number of files processed
            $line_counter+=1;

            //Clear the array for another file.
            $processedfile=Array();
        }
    
        //Report that we are done combining the files.
        echo "<br/><h1>Close single_txt_file </h1>";
        fclose($single_txt_file);
    
    //Report out results of processing
    echo "<h1>Processed: ".$line_counter." files. <h1>";
    echo "<h1>combinedfiles array print_r contains:</h1>";
    print_r($combinedfiles);
    echo "<br/><h1>End Combining File</h1>";

    //Write combinedfiles to a .csv file
    echo "<h1>Write combinedfiles into .csv file</h1>";


    $filename = $auto_generated.'.csv';
    echo "<br/>==================================================<br/>";
    echo "name of file csv will be written into:".$filename;
    echo "<br/>===================================================<br/>";

    $f = fopen($filename, 'w');// open csv file for writing

    if ($f === false) {
        die('<h1>Error opening the file</h1> ' . $filename);
    }
    //Convert combinedfiles into array main_data
    $main_data=$combinedfiles;

    // write each row of main_data to a .csv file generated and stored in filename var.
    $counter=0;
    foreach ($main_data as $row) {
        fputcsv($f,$row);
        //fwrite($f,$row);
        $counter+=1;
        echo "<br/><h1>Row # ".$counter.":</h1><h1>========== print_r contains =============</h1>".print_r([$row])."<h1>================================</h1>";
    }

    // close the file
    fclose($f);

echo "<br/>================ Processing Completed =====================<br/>";
echo "Your result is here:".$filename;
    //End writing combinedfiles to .csv file

    //Display link to download .csv file
    echo "<h1>Display Link to download .csv file.</h1>";

    //End of program display message to user.
    echo "<h1>Processing Complete</h1>";
    //die;//Stop the program here.
//End of new refactor
// rest of the old code
/*
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
        echo "<br/><h1>data contains:".$arraylength."elements. -data[3]=".$data[3]."=print_r=".print_r($data)."<br/></h1>";

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
            ['title', 'body','tag'],
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

    */
?>
<html>
    <body>
    <h1>SUCCESS! PLR Importer has converted your files into a combined .csv file.</h1>
    <h2>Click the file below to download to your local pc.</h2>
    <h3>You can then import them to Drupal or any other Content Management System with a .csv importer.</h3>
    <h1>Click this:><a href="<?php echo $filename; ?>"><?php echo $filename; ?></a></h1> 
    <hr>
    <p>Suggested Modules for Drupal to give you .csv importing ability:</p>
    <a href="https://drupal.org/project/csv_importer">CSV Importer</a>
    <br>
    <p>Suggested Drupal Web Hosting:</p>
    <a href="https://mtbn.net/drupal-web-hosting/">MTBN.NET Drupal Web Hosting</a>
</body>
</html>
