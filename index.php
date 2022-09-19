<?php
   $_SESSION['username'] = "admin";
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Photo Gallery</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
      <nav class="navbar bg-light mb-5">
         <div class="container-fluid">
            <a class="navbar-brand" href="#">Photo Gallery</a>
            <div class="d-flex justify-content-between">
               <ul class="navbar-nav me-2 mb-2 ">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="#">Logout</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <br/>
      <!--Content goes here-->
         <main class="mx-5">
             <!--Upload Form Card-->
             <?php
             if(isset($_SESSION['username'])){
               echo '<div class="col-lg-6 col-md-8 mx-auto mb-5">
               <div class="card p-3">
                  <div class="row justify-content-center">
                    <div class="col-12">
                        <h5 class="heading text-center">Upload Files</h5>
                    </div>
                  </div>
                  <div class="card-body">
                     <p class="card-text">Upload your images here and ready to share them with others :) </p>
                     <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data" class="form-card">
                        <div class="col-12 mb-3">
                           <input type="text" name="filename" placeholder="File name..." required class="form-control mb-3">
                           <input type="text" name="filetitle" placeholder="Image title..." required class="form-control mb-3">
                           <input type="text" name="filedesc" placeholder="Image description..." required class="form-control mb-3">
                           <input class="form-control" type="file" name="file" id="formFileMultiple" multiple>
                        </div>
                           <button type="submit" name="submit" class="btn btn-outline-primary"> Upload</button>
                     </form>
                  </div>
               </div>
            </div>';
             }
            ?>
              <!--Ending Upload Form Card-->
               <!--Images section-->
            <section >
                  <h3 class="text-center">Recently Uploaded</h3>
                  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 my-5">
                     <?php
                     include_once 'includes/dbh.inc.php';

                     $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC"
                     $stmt = mysqli_stmt_init($conn);
                     if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed!";
                     }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while ($row = mysqli_fetch_assoc($result)){
                           echo '<div class="col">
                           <div class="card">
                              <div style="background-image:url(../img/gallery/'.$row["imgFullNameGallery"].');"></div>
                              <div class="card-body">
                                 <h5 class="card-title">'.$row["titleGallery"].'</h5>
                                 <p class="card-text">'.$row["descGallery"].'</p>
                              </div>
                           </div>
                        </div>';
                        }
                     }
                     echo '<div class="col">
                        <div class="card">
                           <div></div>
                           <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                           </div>
                        </div>
                     </div>';
                     ?>
                  </div>
            </section>
         </main>
   </body>
</html>
