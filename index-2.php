 <!DOCTYPE html>
 <html>
<!--This is the index file front end to allow the upload of a .zip file containing .txt formated articles. -->
<!-- It will uncompress them and turn them into a .csv file that can be imorted into a CMS like Drupal -->
 <head>
     <title>PLR-Importer</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>

 <body>
     <br />
     <div class="container" style="width:500px;">
         <h3 align="">PLR Importer - Alpha V1.0 Test New Post Processor</h3><br />
         <p>Save all your .txt PLR Articles in a zip file and name the zip file<br/>
          with the catagory tag name for your articles.<br/>
          Then Upload it here to have it converted into a .csv file that you can import into Drupal as Articles</p>
          <p>All files in the zip must end in .txt and be saved in the UTF8 charecter set.</p>
          <p>File names must not have spaces in the name.</p>
         <form action="index_post2.php" method="post" enctype="multipart/form-data">
             <label>Please Select Zip File</label>
             <input type="file" name="zip_file" />
             <br />
             <input type="submit" name="btn_zip" class="btn btn-info" value="Upload" />
         </form>
         <br />
         <?php
            if (isset($output)) {
                echo $output;
            }
            ?>
     </div>
     <br />
     <div class="container" style="width:500px;">
     Need hosting or a domain for your blog? <br/>
     Check out <a href="https://mtbn.net">MTBN.NET</a>
 </body>

 </html>
 
