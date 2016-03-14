<?php require_once("../includes/functions.php"); ?>
<?php

$rs = get_all_surveys();

$header = "Survey ID" . "\t";
$header .= "Range of heathcare products offered" . "\t";
$header .= "Experience within our industry" . "\t";
$header .= "Customer technical support capabilities" . "\t";
$header .= "Quoted delivery lead-times are acceptable" . "\t";
$header .= "Ability to respond to \"Rush\" requirements" . "\t";
$header .= "Service delivery technology & innovation (e.g. supply chain management)" . "\t";
$header .= "Overall extent to which our capabilities meet your needs" . "\t";

$header .= "Pricing is logical and acceptable" . "\t";
$header .= "Terms & conditions are appropriate" . "\t";
$header .= "Overall value competitiveness of our products" . "\t";

$header .= "Telephone calls are answered & messages are returned in a timely manner" . "\t";
$header .= "Personnel are responsive and courteous" . "\t";
$header .= "Requests for estimates & technical questions are handled accurately and in a timely manner" . "\t";
$header .= "Orders are entered accurately and acknowledged" . "\t";
$header .= "Complaints are handled promptly & effectively" . "\t";
$header .= "Order status information is provided promptly and accurately when requested" . "\t";
$header .= "Communication re: problems / troubleshooting / corrective actions" . "\t";
$header .= "Voice mail & e-mail are used effectively" . "\t";
$header .= "Web site is informative and helpful" . "\t";
$header .= "Sales rep is proactive & communicates frequently and meaningfully" . "\t";
$header .= "Sales rep resolves service problems effectively" . "\t";

$header .= "Contracts were prepared accurately and quickly" . "\t";
$header .= "New products were introduced in a timely manner" . "\t";
$header .= "Products perform effectively" . "\t";
$header .= "Products function reliably" . "\t";
$header .= "Products were delivered within the expected lead-time" . "\t";
$header .= "Containers were correctly labeled and with proper shipping documents" . "\t";
$header .= "Products were packed safely & securely and arrived in good condition" . "\t";
$header .= "Field problems were resolved quickly and effectively" . "\t";

$header .= "Customer Name" . "\t";
$header .= "Customer Number" . "\t";
$header .= "Customer Address" . "\t";
$header .= "Customer Phone" . "\t";
$header .= "Comments";

while($row = mysql_fetch_row($rs))
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            if (is_numeric($value) ) {
                $value = '=CONCATENATE("' . $value . '")';
            } 
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-Disposition: attachment; filename=survey.xls");
header("Content-type: application/vnd.ms-excel; charset=UTF-8");
header("Pragma: no-cache");
header("Expires: 0");

print "$header\n$data";

function get_all_surveys() {
    $connection = db_connect();
    $query = "SELECT * FROM SURVEY";
    return mysql_query($query, $connection);   
}

?>

