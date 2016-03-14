<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="StyleSheet" href="styles/styles.css" type="text/css" media="screen" />
<!--        <link rel="shortcut icon" href="images/arrow_up.ico" />-->
        <script type="text/javascript">
            // moves cursor on textfield to next nextfield when max is reached
            function moveOnMax(field,nextFieldID){
                if(field.value.length >= field.maxLength){
                    document.getElementById(nextFieldID).focus();
                }
            }
            
            // prevent user from using back button on browser
            function preventBack(){window.history.forward();}

            setTimeout("preventBack()", 0);

            window.onunload=function(){null};
        </script>
        <title>Medical Mart Survey</title>
    </head>
    <body>
        <div class="content">
            <div class="top">
                <div id="logo">
                    <img src="images/mmfade2.jpg" align="left"/>
                </div>  <br /><br /><br />
                <div id="header">
                    Customer Satisfaction Survey
                </div> 
                
            </div>
            <div class="bottom">