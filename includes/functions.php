<?php

function display_header($header_msg){
    $display = "<tr>";
    $display .= "<td class='first'><b>{$header_msg}</b></td>";
    $display .= "<td>1 <br />Very Satisfied</td>";
    $display .= "<td>2 <br />Generally Satisfied</td>";
    $display .= "<td valign='top'>3 <br />Neutral</td>";
    $display .= "<td>4 <br />Somewhat Dissatisfied</td>";
    $display .= "<td>5 <br />Very Dissatisfied</td>";
    $display .= "<td>N/A</td>";
    $display .= "</tr>";
    
    return $display;
}

function display_radio_buttons($display_arr, $header_msg, $errors) {
    $values_arr = array('1', '2', '3', '4', '5', 'N/A');
    $counter = 1;
    
    $display="<table>";
    $display .= display_header($header_msg);
    
    $display .=  "<tr>";

    // display rows, including description and radio buttons
    foreach ($display_arr as $key => $desc){
        $display .=  "<td class='first'><ol><li value='{$counter}'";
        
        // highlight descriptions that haven't been filled
        if (count($errors)>0) {
            foreach($errors as $error){
                if($error == $key){
                    $display .= " class='error' ";
                }
            }
        }
        $display .= ">{$desc}</li></ol></td>";
        
        // check fields previously filled by user
        foreach ($values_arr as $value) {
            $display .=  "<td><input type='radio' name='{$key}' value='{$value}' ";
            if ($_REQUEST[$key] == $value) {
                $display .= " checked";
            }
            
            $display .= "/></td>";
        }
        $display .=  "</tr>";
        $counter++;
    }    
    $display .= "</table>";
    unset ($display_arr);
    return $display;
}

function check_textbox_errors ($errors, $field) {
    // check if textboxes have been filled
    if (count($errors)>0) {
        foreach ($errors as $error) {
            if ($error == $field) {
                return "Field required";
            }
        }
    }
    return "";
}

function mysql_prep( $value ) {
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
    if( $new_enough_php ) { // PHP v4.3.0 or higher
        // undo any magic quote effects so mysql_real_escape_string can do the work
        if( $magic_quotes_active ) { $value = stripslashes( $value ); }
        $value = mysql_real_escape_string( $value );
    } else { // before PHP v4.3.0
        // if magic quotes aren't already on then add slashes manually
        if( !$magic_quotes_active ) { $value = addslashes( $value ); }
        // if magic quotes are active, then the slashes already exist
    }
    return $value;
}

function db_connect() {
    // db parameters
    $host = "localhost:8080";
    $user = "root";
    $pass = "";
    $database = "survey";

    $connection = mysql_connect($host, $user, $pass) or die("Sql error : " . mysql_error( ));
    mysql_select_db($database, $connection) or die("Sql error : " . mysql_error( )); 
    return $connection;
}

function query_customer() {
    $number = mysql_prep(trim($_POST['number']));
    $connection = db_connect();
    $query = "SELECT * 
            FROM CUSTOMER 
            WHERE CUSNUMBER = '{$number}' 
            LIMIT 1";
    return mysql_query($query, $connection);
}

function get_all_customer_numbers() {
    $connection = db_connect();
    $query = "SELECT * FROM CUSTOMER";
    return mysql_query($query, $connection);   
}

//function get_all_surveys() {
//    $connection = db_connect();
//    $query = "SELECT * FROM SURVEY";
//    return mysql_query($query, $connection);   
//}

function check_survey_submitted() {
    $number = mysql_prep(trim($_POST['number']));
    $connection = db_connect();
    $query = "SELECT COUNT(ID)
            FROM SURVEY S, CUSTOMER C 
            WHERE C.CUSNUMBER = S.CUSNUMBER
            AND C.CUSNUMBER = '{$number}'";
    return mysql_query($query, $connection);
}

function insert_customer() {
    $connection = db_connect();
    $number = mysql_prep(trim($_POST['number']));
    
    $query = "INSERT INTO CUSTOMER (CUSNUMBER)
            VALUES ('{$number}')";
    if ($result = mysql_query($query, $connection)){
        $message = "Customer number " . $number . " successfully submitted.";
    } else {
        $message = "There was an error submitting your request.";
        $message .= "<br />" . mysql_error();
    }
    
    mysql_free_result($result);

    mysql_close($connection);
    
    return $message;
}

function delete_customer() {
    $connection = db_connect();
    $number = mysql_prep(trim($_POST['number']));
    
    $query = "DELETE FROM CUSTOMER 
            WHERE CUSNUMBER='{$number}'";
    mysql_query($query, $connection);        
    if (mysql_affected_rows() == 1) {
        return "Customer {$number} successfully deleted.";
    } else {
        return "Unable to delete customer {$number}.<br />Error " . mysql_error();
    }
}

function insert_data () {
    $connection = db_connect();
    // clean fields from sql injection
    // creates variables used on query. $$key creates a variable named after $key value
    foreach ($_POST as $key=>$value) {
        $$key = mysql_prep(trim($value));
    }
    $phone = $phone1 . $phone2 . $phone3;
    
    $query = "INSERT INTO SURVEY (PRODUCTRANGE, EXPERIENCE, SUPPORT, LEADTIME, RUSH,
                SERVICE, NEEDS, PRICING, TERMS, OVERALLVALUE, CALLS, PERSONNEL, ESTIMATES,
                ORDERS, COMPLAINTS, ORDERSTATUS, COMMUNICATION, MAIL, WEBSITE, REP, PROBLEMS,
                CONTRACTS, PRODUCTS, EFFECTIVELY, RELIABLY, DELIVERED, CONTAINERS, PACKED,
                FIELD, CUSNAME, CUSNUMBER, CUSADDRESS, CUSPHONE, COMMENT
            ) VALUES ('{$range}', '{$experience}', '{$support}', '{$leadtime}',
                '{$rush}', '{$service}', '{$needs}', '{$pricing}', '{$terms}', 
                '{$overallvalue}', '{$calls}', '{$personnel}', '{$estimates}', '{$orders}', 
                '{$complaints}', '{$status}', '{$communication}', '{$mail}', 
                '{$website}', '{$rep}', '{$problems}', '{$contracts}', '{$products}', 
                '{$effectively}', '{$reliably}', '{$delivered}', '{$containers}', 
                '{$packed}', '{$field}', '{$name}', '{$number}', '{$address}', 
                '{$phone}', '{$comments}'
             );";
    
    if ($result = mysql_query($query, $connection)){
        header("Location: thanks.php");
        exit;
    } else {
        $message = "There was an error submitting the survey.";
        $message .= "<br />" . mysql_error();
    }
    
    mysql_free_result($result);

    mysql_close($connection);
    
    return $message;
}
?>