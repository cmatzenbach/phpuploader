<style type="text/css">
.good {color:#009900;}
.bad {color:#CC0000;}
</style>


<?php
$firsturl = $_GET['first'];
$lasturl = $_GET['last'];
$dir = $_GET['dir'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Carib GP</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../Bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../Bootstrap/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="../Bootstrap/css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
 <body>

 <!-- Body
================================================== -->
<?php include ("navbar.php");?>
<div id="main-wrap">
<div class="container marketing">
<h1 class="page-header">Send Us Your Templates <small>Upload files here</small></h1>
</div>
<div class="container marketing">
<div class="row">
<div class="col-lg-12">
<div class="col-md-4">
<form action="" method="post" enctype="multipart/form-data">
<div class="control-group form-group">
<div class="controls">
<label>Full Name:</label>
<input type="text" class="form-control" id="name" name="name" required data-validation-required-message="Please enter your name.">
<p class="help-block"></p>
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label>Phone Number:</label>
<input type="tel" class="form-control" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label>Email Address:</label>
<input type="email" class="form-control" id="email"  name="email" required data-validation-required-message="Please enter your email address.">
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label>Company:</label>
<input type="text" class="form-control" id="company" name="company" required data-validation-required-message="Please enter your company name.">
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label>Location:</label>
<input type="text" class="form-control" id="location" name="location" required data-validation-required-message="Please enter your location.">
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label for="file">Choose file to upload:</label>
<input type="file" name="file" id="file">
</div>
</div>
<div class="control-group form-group">
<div class="controls">
<label>Enter an optional note to accompany your upload(s)</label>
<textarea rows="3" cols="60" class="form-control" id="message" name="message" maxlength="999" style="resize:none"></textarea>
</div>
</div>

<button type="submit" class="btn btn-primary" name="submit" id="Submit" value="Submit">Upload</button>
</form>


<?php
     
    // Credit to MTM and CMatz for uploader code
	// Uploader Variables needed:
	$allowed_file_types = array(".jpg",".JPG",".pdf",".PDF",".ai",".AI",".EPS",".eps",".pptx",".PPTX",".svg",".SVG",".ppt",".PPT",".MPG",".mpg",".mp2",".MP2",".mpeg",".MPEG",".mpg",".MPG",".mpe",".MPE",".mpv",".MPV",".m2v",".M2V",".mp4",".MP4",".m4v",".M4V",".wmv",".WMV",".mov",".MOV",".qt",".QT",".avi",".AVI",".mp2",".MP2",".DOC",".doc",".docx",".DOCX",".png",".PNG",".zip",".psd",".PSD",".xlsx",".XLSX",".xls",".XLS");
	$duplicates = true;
	$overwrite = false;
	$forcedfilename = false;	
	
    if (isset($_POST['submit'])) {
     
	 
	 	// Email Variables Needed
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email_address = $_POST['email'];
		$company = $_POST['company'];
		$location = $_POST['location'];
		$message = $_POST['message'];
		$to = 'noreply@test.com'; // enter email address you want files/message to be sent to
		$email_subject = "Online Upload Form:  $name"; 
		$headers = "From: noreply@test.com\n"; // from email address
		$headers .= "Reply-To: $email_address";
	
     	$filename = $_FILES["file"]["name"]; // original file name
    	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file name without extension
    	$file_ext = substr($filename, strripos($filename, '.')); // get file extension
		$file_ext = strtolower($file_ext); // make file extension lowercase for checking against allowed file list
    	$filesize = $_FILES["file"]["size"];
    	
		if (file_exists("uploads/")) {} else { mkdir("uploads/", 0777); } //creates uploads folder if doesn't already exist
		$foldername = "uploads/";
		
		// check if generic or not; if so, file path is just name; if not, must be uploads/$dir/$filename
     	$filedir = $foldername . $filename; 
		
		//$allowed_file_types MUST be set in Event Variables
    	if (in_array($file_ext,$allowed_file_types)  &&  ($filesize < 99000000)) {
     
    		     
    		// here separate by by $duplicates 
			// if $duplicates is enabled, then should check if file exists and rename it _copy1; if that already exists, names _copy2 and so on
			if($duplicates) {
				$i = 1;
				$actual_name = $filename;
				if(file_exists($filedir)) {
					$exist = TRUE;
					while($exist) {
						$actual_name = $foldername . $file_basename . "_copy" . $i . $file_ext;
						if(!file_exists($actual_name)) {
							$exist = FALSE;
							$filedir = $actual_name;
							$filename = $file_basename . "_copy" . $i . $file_ext;
						}
						$i++;
					}
				}
				move_uploaded_file($_FILES["file"]["tmp_name"], $filedir);
    			echo "<div id=\"success\" class=\"good\">" . $filename . " uploaded successfully.</div>";
				$email_body = "You have received a file upload from your website's form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nEmail: $email_address\n\nCompany: $company\n\nLocation: $location\n\nFile Name: $filename\n\nMessage:\n$message";
				mail($to,$email_subject,$email_body,$headers);
			}
			else {		// if duplicates is turned off
				if($overwrite) {// if overwrite is on
					move_uploaded_file($_FILES["file"]["tmp_name"], $filedir);
					if($forcedfilename !=false) // $forcedfilename being used
					{
						rename($filedir,$foldername . $forcedfilename);
					}
					echo "<div id=\"messages\" class=\"good\">" . $filename . " uploaded successfully.</div>";	
					} 
				
				elseif (file_exists($filedir)) {		
    				// file already exists error
    				echo "<div id=\"messages\" class=\"bad\">This file already exists. If you would like to replace it, please email info@caribgp.com</div>";
    			} else {
					// file doesn't exist, upload
    				move_uploaded_file($_FILES["file"]["tmp_name"], $filedir);
    				echo "<div id=\"messages\" class=\"good\">" . $filename . " uploaded successfully.</div>";	
					$email_body = "You have received a file upload from your website's form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nEmail: $email_address\n\nCompany: $company\n\nLocation: $location\n\nFile Name: $filename\n\nMessage:\n$message";
					mail($to,$email_subject,$email_body,$headers);		
    			}
			}
			
			//continue main if from above
    		} elseif (empty($file_basename)) {	
    			// file selection error
    			echo "<div id=\"messages\" class=\"bad\">Please select a file to upload.</div>";		
    		} elseif ($filesize > 8000000) {	
    			// file size error
    			echo "<div id=\"messages\" class=\"bad\">The file you are trying to upload is too large.</div>";		
    		} else {	
    			// file type error
    			echo "<div id=\"messages\" class=\"bad\">Only these file types are allowed for upload: " . implode(', ',$allowed_file_types) . "</div>";
    			unlink($_FILES["file"]["tmp_name"]);		
    		}

	/*if(empty($_POST['name'])  		||
   		empty($_POST['phone']) 		||
   		empty($_POST['email']) 		||
   		!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   		{
			echo "No arguments Provided!";
			return false;
   		}	*/		
	// create email body and send it	
	/*$to = 'cmatzenbach@gmail.com'; // PUT YOUR EMAIL ADDRESS HERE
	$email_subject = "CaribGP Online Upload Form:  $name"; // EDIT THE EMAIL SUBJECT LINE HERE
	$email_body = "You have received a file upload from your website's contact form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nEmail: $email_address\n\nMessage:\n$message";
	$headers = "From: noreply@your-domain.com\n";
	$headers .= "Reply-To: $email_address";	
	mail($to,$email_subject,$email_body,$headers);
	
	return true;*/
	
	}


    ?>

</form>
</div>
</div>
</div>


<!-- jQuery Version 1.11.0 -->
    <script src="../Bootstrap/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../Bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="../Bootstrap/js/jqBootstrapValidation.js"></script>
    <script src="../Bootstrap/js/hovernav.js"></script>

</body>

</html>
