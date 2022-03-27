<?php 
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
    echo "files upconpressed";
    echo "<br/>The Path is: ".$path;
    foreach(glob($path.'/*.*') as $file) {
         echo $file."<br>";
        $single_txt_file = fopen($file, "r");
        $first_line = true;
        while (!feof($single_txt_file)) {
            $line = fgets($single_txt_file);

             if($first_line){
                 echo "<h1>$line</h1>";
                 $first_line = false;
             }else{
                 echo $line . "<br>";
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
    
        print_r($new_data[0]);
        
        $main_data = [
            ['Title', 'Details'],
            ['My Title', $new_data[0]]
        ];

        $filename = $auto_generated.'.csv';

        // open csv file for writing
        $f = fopen($filename, 'w');

        if ($f === false) {
            die('Error opening the file ' . $filename);
        }

        // write each row at a time to a file
        foreach ($main_data as $row) {
            fputcsv($f,
                $row
            );
        }

        // close the file
        fclose($f);
    }
?>  