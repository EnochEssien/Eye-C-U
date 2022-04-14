<?php
if(isset($_POST['submit'])){
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];

  $fileTmpname = $_FILES['file']['tmp_name'];
  $fileType = $_FILES['file']['type'];
  $fileError = $_FILES['file']['error'];
  $filePath = $_FILES['file']['full_path'];
  $fileExt = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('jpg', 'jpeg','png');







  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {

      $fileDestination ='Uploads/'.$fileName;
      move_uploaded_file($fileTmpname, $fileDestination);

      $stringyBoi = '"'.$fileDestination.'"';
      shell_exec("python main.py $stringyBoi");
      ?> <!DOCTYPE html>
      <html lang="en" dir="ltr">
        <head>
          <meta charset="utf-8">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
          <link rel="stylesheet" type="text/css" href="result.css">
          <title></title>
        </head>
        <body>

      <div class="Starter">

        <p>Welcome to Eye-C-U</p>

        <h1> Here are the results of the experiment.
          The blue box around on the image shows the detection of the participant's face, While the red box shows the detection of a smile.</h1>

          <div class="results" style="background-image: url( '<?php echo $fileDestination ?>');">

          </div>




      <h2> credit to www.itsourcecode.com for the creation of the object detector</h2>
      </div>

        </body>
      </html>
<?php
    }
    else{echo "Unable to upload image.";}
  }
  else{ echo "Invalid image format.";}
}
 ?>
