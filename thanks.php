<?php 
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    
?>
<?php include_once("includes/header.php") ?>
<h2>Your survey has been successfully submitted <br />Thank you for your participating</h2>
<?php include_once("includes/footer.php"); ?>
