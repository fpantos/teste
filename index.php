<?php 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 
?>
<?php include_once ("includes/functions.php"); ?>
<?php 
    if (array_key_exists('submit',$_POST)){  
        $required = array('range', 
                          'experience', 
                          'support',
                          'leadtime',
                          'rush',
                          'service',
                          'needs',
                          'pricing',
                          'terms',
                          'overallvalue',
                          'calls',
                          'personnel',
                          'estimates',
                          'orders',
                          'complaints',
                          'status',
                          'communication',
                          'mail',
                          'website',
                          'rep',
                          'problems',
                          'contracts',
                          'products',
                          'effectively',
                          'reliably',
                          'delivered',
                          'containers',
                          'packed',
                          'field',
                          'name',
                          'number',
                          'address',
                          'phone1',
                          'phone2',
                          'phone3');  
        $allowed = $required;
        array_push($allowed, 'comments');
        
        $phone = trim($_POST["phone1"]) . trim($_POST["phone2"]) . trim($_POST["phone3"]);
        $errors = array();  
        
        foreach ($required as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                $errors[] = $field;
            } elseif ($field == "number") {
                if (!is_numeric(trim($_POST["number"]))) {
                    $errors[] = "num";
                    $number_error = "Customer number must contain numbers only";
                } elseif (strlen(trim($_POST["number"])) != 5 && strlen(trim($_POST["number"])) != 7) {
                    $errors[] = "num";
                    $number_error = "Customer number must be either 5 or 7 characters long";
                } 
                //$number = trim($_POST['number']);
//                $result_set = query_customer();
//                
//                if(mysql_num_rows($result_set) != 1) {
//                    $errors[] = "num";
//                    $number_error = "Customer number " . $_POST['number'] . " is not a valid number";
//               } else {
//                    $result_set = check_survey_submitted();  
//                    if (mysql_result($result_set,0) != 0) {
//                        $errors[] = "num";
//                        $number_error = "Survey from Customer number " . $_POST['number'] . " has already been submitted";
//                    }
//                }
            }
        }
        
        if (!is_numeric(trim($phone))) {
            $errors[] = "phone";
            $err_phone = "Telephone must contain numbers only";
        } elseif (strlen(trim($phone)) != 10) {
            $errors[] = "phone";
            $err_phone = "Telephone must be 10 digits long";
        }
        
        if (empty($errors)) {
            $error_msg = insert_data();
            $error_string = '<p class=\'error\'>{$error_msg}</p>' ;
        } else {
            $error_string = '<p class=\'error\'>One or more fields are missing. Please fill all necessary fields</p>';         
        }
        

    }  else {
        unset($errors);
    }
?>
<?php include_once("includes/header.php") ?>
<?php echo $error_string ?>
<?php echo $error_msg ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="form">
    <p>Customer name:
    <span class="errorfield"><?php  echo check_textbox_errors($errors, "name");  ?></span>
    </p>
    <input size="20"maxlength="40"type="text" name="name" value="<?php echo htmlspecialchars(stripslashes(utf8_decode($_POST["name"])));?>"/><br />               
    <p>Customer number:
    <span class="errorfield">
        <?php  
            $err_num =  check_textbox_errors($errors, "number"); 
            if ($err_num != "") {
                echo $err_num;
            } else {
                echo $number_error;
            }
        ?>
    </span>
    </p>
    <input size="20"maxlength="7"type="text" name="number" value="<?php echo htmlspecialchars(stripslashes(utf8_decode($_POST['number'])));?>"/>                    
    <p>Address:
    <span class="errorfield"><?php  echo check_textbox_errors($errors, "address");  ?></span>
    </p>
    <input size="20"maxlength="60"type="text" name="address" value="<?php echo htmlspecialchars(stripslashes(utf8_decode($_POST['address'])));?>"/>
    <p>Telephone:
    <span class="errorfield">
        <?php  
            $phones = array('phone1', 'phone2', 'phone3');
            foreach ($phones as $phone){
                $error_phone = check_textbox_errors($errors, $phone);
                if ($error_phone != "") {
                    echo $error_phone;
                    break;
                } else {
                    echo $err_phone;
                    break;
                }
            }
        ?>
    </span>
    </p>
    <input size="3"maxlength="3"type="text" name="phone1" id="phone1" onkeyup="moveOnMax(this,'phone2')" value="<?php echo htmlspecialchars(stripslashes(utf8_decode($_POST['phone1'])));?>"/>&nbsp;-
    <input size="3"maxlength="3"type="text" name="phone2" id="phone2" onkeyup="moveOnMax(this,'phone3')" value="<?php echo htmlspecialchars(stripslashes(utf8_decode($_POST['phone2'])));?>"/>&nbsp;-
    <input size="4"maxlength="4"type="text" name="phone3" id="phone3" value="<?php echo htmlspecialchars(stripslashes(utf8_decode($_POST['phone3'])));?>" />
    <br /><br />
    <?php 
        $first_section = array();
        $first_section['range'] = "Range of health care products offered";
        $first_section['experience'] = "Experience within our industry";
        $first_section['support'] = "Customer technical support capabilities";
        $first_section['leadtime'] = "Quoted delivery lead-times are acceptable";
        $first_section['rush'] = "Ability to respond to \"Rush\" requirements";
        $first_section['service'] = "Service delivery technology & innovation (e.g. supply chain management)";
        $first_section['needs'] = "Overall extent to which our capabilities meet your needs";

        $header_msg = "I. Product & Service Offering & Capabilities";
        echo (display_radio_buttons($first_section, $header_msg, $errors));
    ?>


    <?php 
        $second_section = array();
        $second_section['pricing'] = "Pricing is competitive";
        $second_section['terms'] = "Terms & conditions are acceptable";
        $second_section['overallvalue'] = "Overall value of competitiveness of offered products";

        $header_msg = "II. Product / Service Value";
        echo (display_radio_buttons($second_section, $header_msg, $errors));
    ?>

    <?php 
        $third_section = array();
        $third_section['calls'] = "Enquiries are answered & messages are returned in a timely manner";
        $third_section['personnel'] = "Personnel are responsive and courteous";
        $third_section['estimates'] = "Requests for estimates & technical questions are handled accurately and in a timely manner";
        $third_section['orders'] = "Orders are entered accurately";
        $third_section['complaints'] = "Complaints are handled promptly & effectively";
        $third_section['status'] = "Order status information is provided promptly and accurately when requested";
        $third_section['communication'] = "Communication re: problems / troubleshooting / corrective actions";
        $third_section['mail'] = "Voice mail & e-mail are used effectively";
        $third_section['website'] = "Web site is informative and helpful";
        $third_section['rep'] = "Sales rep is proactive & communicates frequently and meaningfully";
        $third_section['problems'] = "Sales rep resolves service problems effectively";


        $header_msg = "III. Customer Service";
        echo (display_radio_buttons($third_section, $header_msg, $errors));
    ?>

    <?php 
        $fourth_section = array();
        $fourth_section['contracts'] = "Contracts were prepared accurately";
        $fourth_section['products'] = "New products were introduced in a timely manner";
        $fourth_section['effectively'] = "Products perform effectively";
        $fourth_section['reliably'] = "Products function reliably";
        $fourth_section['delivered'] = "Products were delivered within the expected lead-time";
        $fourth_section['containers'] = "Containers were correctly labeled and with proper shipping documents";
        $fourth_section['packed'] = "Products were packed safely & securely and arrived in good condition";
        $fourth_section['field'] = "Field problems were resolved quickly and effectively";

        $header_msg = "IV. Product & Service Quality";
        echo (display_radio_buttons($fourth_section, $header_msg, $errors));
    ?>
    <br />
    <p>(Optional) Any additional comments and suggestions are welcome:</p>               
    <textarea rows="10" cols="60" maxlength="1024" type="text" name="comments" ><?php echo htmlspecialchars(stripslashes(utf8_decode($_POST['comments'])));?></textarea> <br /><br /> 
    <input type="submit" value="Continue" name="submit"/> 
    <br /><br />
</form>
<?php include_once("includes/footer.php"); ?>