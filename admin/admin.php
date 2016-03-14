<?php include_once("../includes/header.php") ?>
<?php require_once("../includes/functions.php"); ?>
<?php 
//if (array_key_exists('add',$_POST)){
//    $errors = array();
//    if (!is_numeric(trim($_POST["number"]))) {
//        $errors[] = "num";
//        $number_error = "Customer number must contain numbers only";
//    } elseif (strlen(trim($_POST["number"])) != 5 && strlen(trim($_POST["number"])) != 7) {
//        $errors[] = "num";
//        $number_error = "Customer number must be either 5 or 7 characters long";
//    } 
//
//    $result_set = query_customer();
//
//    if(mysql_num_rows($result_set) != 0) {
//        $errors[] = "num";
//        $number_error = "Customer number " . $_POST['number'] . " already exists";
//    }
//
//    if (empty($errors)) {       
//        $message = insert_customer();
//        echo $message;
//    }
//} elseif (array_key_exists('delete',$_POST)){
//    $message = delete_customer();
//    echo $message;
//} //elseif (array_key_exists('getall',$_POST)){
////    get_surveys();
////}
//?>
<!--<form action="//<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="form">
    <p>Insert New Customer number:
    <span class="errorfield">-->
        <?php  
//            $err_num =  check_textbox_errors($errors, "number"); 
//            if ($err_num != "") {
//                echo $err_num;
//            } else {
//                echo $number_error;
//            }
//        ?>
<!--    </span>
    </p>
    <input size="20"maxlength="7"type="text" name="number" value="//<?php //if (!empty($errors)){echo htmlspecialchars(stripslashes(utf8_decode($_POST['number'])));}?>"/>
    <br />
    <input type="submit" value="Continue" name="add"/> 
    <br /><br />

    <p>Delete Existing Customer</p>
    <table>-->
    <?php 
//    $rs = get_all_customer_numbers();
//    $column_count = 5;
//
//    for ($i = 1; $i <= mysql_numrows($rs); $i++) {
//        $number = mysql_result($rs, $i-1);
//
//        if($i % $column_count == 1){
//            echo "<tr>";
//        }
//        echo "<td>";
//        echo "<input type='radio' name='number' value='" . $number . "' />";
//        echo $number . "</td>";
//        if($i % $column_count == 0){
//            echo "</tr>";
//        }
//    }
//
//    ?>
<!--    </table>
    <input type="submit" value="Delete" name="delete"/> 
    <br /><br />
</form>-->
<form action="process.php" method="post" name="form">
    
    <p>Extract Surveys</p>
    <input type="submit" value="Get Surveys" name="getall"/> 
</form>
<?php include_once("../includes/footer.php"); ?>