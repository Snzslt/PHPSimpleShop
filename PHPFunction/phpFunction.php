
<?php
#Revision history:           DATE
#Zahra Soltani(1910291)       2021-02-21    Functionfooter
#Zahra Soltani(1910291)       2021-02-25     AddvertisingPictures/functionHeader/Logo/Navigation/introduction
#Zahra Soltani(1910291)       2021-02-27    functionCreateForm/ValidateInput/globalvariables
#Zahra Soltani(1910291)       2021-03-1    my previous project got trouble so I had to continue with this one
#Zahra Soltani(1910291)       2021-03-11    Read data from user/ write data to text box/put data in array/ create table / 
#Zahra Soltani(1910291)       2021-03-12    put data in Table and change colors in orders page
#Zahra Soltani(1910291)       2021-03-13     Debuggin and final corections/ ser colors for table 

#define constatnt variable for css
define("FOLDER_CSS","CSS/");
define("FILE_CSS",FOLDER_CSS."stylesheet.css");



#define constant variable for text
define("FOLDER_DATA","/Data/");
define("FILE_PURCHASE",FOLDER_DATA."text.txt");


#define constant variable for cheetsheet
define("FILE_CHSH","Data/cheetsheet.txt");


#defie constant variable for images 
define("FOLDER_IMAGES","IMAGE/");
define("FILE_LOGO",FOLDER_IMAGES."logoproject.PNG");
define("FILE_BACKGROUND",FOLDER_IMAGES."background.svg");
define("FILE_PIC1",FOLDER_IMAGES."Pic1.jpg");
define("FILE_PIC2",FOLDER_IMAGES."Pic2.jpeg");
define("FILE_PIC3",FOLDER_IMAGES."Pic3.jpg");
define("FILE_PIC4",FOLDER_IMAGES."Pic4.jpg");
define("FILE_PIC5",FOLDER_IMAGES."pic5.jpg");


#define constant variable for validations
define("PRODUCT_CODE_MAX_LENGTH",10);
define("CUSTOMER_FIRSTNAME_MAX_LENGTH",20);
define("CUSTOMER_LASTNAME_MAX_LENGTH",20);
define("CUSTOMER_CITY_MAX_LENGTH",20);
define("PRICE_MAX_VALUE",1000000);
define("PRICE_MIN_VALUE",0);
define("QUANTITY_MIN_VALUE",0);
define("QUANTITY_MAX_VALUE",99);
define("COMMENT_CITY_MAX_LENGTH",200);
define("LOCAL_TAXES",12.05);



#global variables
     $pCode= "";
     $fName = "";
     $lName = "";
     $city = "";
     $comments = "";
     $price = "";
     $quantity = "";
     $message="";
     $counter =0;
     $content ="";
     $title="";
     $subtotal;
     $taxAmount;
     $grandTotal;
     $ArrayInfo= array();
     
 #global variables error handling
     $errorProductCode = "";
     $errorfName = "";
     $errorLastName = "";
     $errorCity = "";
     $errorComments = "";
     $errorPrice = "";
     $errorQuantity = "";
   

$debug = False;
    


#creating function for header for pages
function createPageHeader($title){
     #Call the function to handle the errors and exceptions
 setErrorExceptionHandler();
    
    #force the browser to always get the latest version of your file
 header('Expires: Thu, 11 Aug 1995 00:00:00 GMT');

 header('Cache-Control: no-cache');

 header('Pragma: no-cache');
   ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS; ?> " />
        
        <title><?php echo $title?></title>
    </head>
    
  <?php BackgroundColor();?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <?php
        
 #call function to create logo
           createLogo();
           
           
 #call function to create Navigation
        createNavigation();
        
}






#fucntion to change background in orders page
function BackgroundColor(){
    global $title;
    #check if it is a order page
    if ($title === "Orders Page"){
        if (isset($_GET["command"])){
            if($_GET["command"]==="print"){
                
                
                #if command is print background turn to white
                ?>     
                 <body class=bodyprint">
                <?php
            }
             
       else{
                #put yellow background for orders page
              ?>
              <body class="bodyyellow">
              <?php
            }
    
         }
         
           else{
                #put yellow background for orders page
              ?>
              <body class="bodyyellow">
              <?php
            }
        
    }
else{
     #put purple background for other pages
           ?>
    <body class="bodypurple">
        <?php
}
  

}



#function to create footer
function createPageFooter(){
    ?> 
 
    <footer class="footer">
        <br><br> <span>Copyright Zahra Soltani 1910291--<?php echo date("Y"); ?>
            </span>
    </footer>
       </body>
       </html>
<?php

}





#function to create logo
function createLogo(){
    ?> <img  class="Logo" src="<?php echo FILE_LOGO; ?>"><!-- comment -->
    <?PHP
}




#function for part which we introduce us
function Introduce(){
    
    ?> <div class="introduce">
     
           <h2>Aladdin Expert Online Shop </h2>
        

        <blockquote>
          <b>Welcome to Aladdin Expert Online shop</b>
We are a brand-new online jewelry shop. You cannot find more beautiful, more rare, and cheaper jewelry than ours. We are presenting you numerous types of jewelries such as: neckless, earrings, rings, etc.
        </blockquote>
       </div>

    <?PHP
}



#function to create navigation

function createNavigation(){
  ?>
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="Buying.php">Buying</a></li>
  <li><a href="Orders.php">Orders</a></li>
  
</ul>
<?php
    
}





#function to show advertising pictures
function showAdvertising(){
    #CREATE ARRAY FOR ADVERTISING
    $ads= array(FILE_PIC1,FILE_PIC2,FILE_PIC3,FILE_PIC5,FILE_PIC4);
    Shuffle($ads);
    if($ads[0] === FILE_PIC1){
   echo"<a href ='https://aladdinexpert.com/'><img class='advertisinglogo1' src='".$ads[0]."'>";
    
}
else{
    #doubleprice picture
     echo"<a href ='https://aladdinexpert.com/'><img class='advertisinglogo' src='".$ads[0]."'>";
}
    
}








#function to create form
function createForm(){
    
    #global variables
    global $pCode;
    global $fName;
    global $lName;
    global $city;
    global $comments;
    global $price;
    global $quantity;
    global $errorProductCode;
    global $errorfName;
    global $errorLastName;
    global $errorCity;
    global $errorComments;
    global $errorPrice;
    global $errorQuantity;
    
?>
<div>
<!--    Create a form of inboxes and submit button-->
  <form action="Buying.php" method="POST">
   
      <label for="pCode"  class="required">Product Code</label>
      <input type="text" name="pCode" placeholder="Product Code" 
           value="<?php echo $pCode; ?>">
     <span class="error-validation"> 
               <?php echo $errorProductCode;?>
     </span><br><br>
           
           
           
    <label for="fname"  class="required">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your fisrt name.."
            value="<?php echo $fName ?>">
     <span class="error-validation"> 
                    <?php echo $errorfName;?>
     </span><br><br>
           
    
    <label class="required" for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.."
            value="<?php echo $lName ?>">
     <span class="error-validation"> 
                    <?php echo $errorLastName;?>
     </span><br><br>
     
     
     
    
     <label for="city"  class="required">City</label>
    <input type="text" id="City" name="city" placeholder="Your City"
           value="<?php echo $city ?>">
     <span class="error-validation"> 
                    <?php echo $errorCity;?>
     </span><br><br>
     
     
    
      <label for="price"  class="required">Price</label>
    <input type="text" id="price" name="price" placeholder="Price"
           value="<?php echo $price ?>">
    <span class="error-validation"> 
                    <?php echo $errorPrice;?>
    </span><br><br>
    
    
     
    
     <label for="quantity"  class="required">Quantity</label>
    <input type="text" id="Quantity" name="quantity" placeholder="Quantity" 
           value="<?php echo $quantity ?>">
    <span class="error-validation"> 
                    <?php echo $errorQuantity;?>
     </span>
    <br>
    <br>
    
    <label for="comments" style ="font-weight: bold" >Comments</label>
     <input class="comment" type="text" id="Comment" name="comments" placeholder="Write your comment here" 
           value="<?php echo $comments ?>">
    <span class="error-validation"> 
                    <?php echo $errorComments;?>
     </span>
    <br>
    <br>
    
    

<input type="submit" value="Submit" name="Submit">
  </form>
</div>
    <?php
 }
 
 
 
 
 
 
 
 #to show to user that their informations submit successfully
 function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 




#multiply function
function multiply($num1, $num2){
    return ($num1* $num2);
}

#function to calclulate tax amount
function taxCalculate($num1,$num2){
    return ($num1*$num2)/100;
}





#add function
 function Add($num1 ,$num2){
     return ($num1 + $num2);
 }
 
 
 
 
 #to read Data from text file
 function readData(){
  global $ArrayInfo;
  global $counter ;
  global $content;

    $fileHandle = fopen("FILE_PURCHASE","r") or die("Cannot open the file");
    
    if(file_exists("FILE_PURCHASE"))
    {
        #while file is not end of file
        while(!feof($fileHandle))
        {
            #It reads only one line
            $content = fgets($fileHandle);
            if($content != "")
            { $ArrayInfo[$counter] = json_decode($content, true);
                   $counter++;
            }
        }

        fclose($fileHandle);
 }
 else{
     echo"File Does not exist";
 }
 }
 
 
 
 
 
 #crate table for orders page
 function createTableOrders()
{
  #Create global variables
  global $ArrayInfo;
  global $counter ;



    ?>   
    
    <table class="customers">
            <tr>
                <th>Product ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>Comments</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Taxes</th>
                <th>Grand Total</th>
            </tr>   
     <?php
     readData();
     for ($i =0;$i<$counter;$i++){
     ?>
            
              <tr>
                <td><?php echo $ArrayInfo[$i]["ProductCode"] ?></td>
                <td><?php echo $ArrayInfo[$i]["FirstName"] ?></td>
                <td><?php echo $ArrayInfo[$i]["LastName"] ?></td>
                <td><?php echo $ArrayInfo[$i]["City"] ?></td>
                <td><?php echo $ArrayInfo[$i]["Comments"] ?></td>
                <td><?php echo $ArrayInfo[$i]["Price"]."$" ?></td>
                <td><?php echo $ArrayInfo[$i]["Quantity"] ?></td>
                <?php
                if(isset($_GET["command"])){
                    if($_GET["command"]==="color"){
                if(($ArrayInfo[$i]["SubTotal"])<100){
                    
                
                ?>
                     <td class="colorred" ><?php echo $ArrayInfo[$i]["SubTotal"]."$" ?></td>
                    <?php
                }
                else if(($ArrayInfo[$i]["SubTotal"])>100 &&($ArrayInfo[$i]["SubTotal"])<1000){
                    
                    ?>
                     <td class="colororange" ><?php echo $ArrayInfo[$i]["SubTotal"]."$" ?></td>
                    <?php 
                }
                else if(($ArrayInfo[$i]["SubTotal"])>=1000){
                    
                    ?>
                     <td class="colorgreen" ><?php echo $ArrayInfo[$i]["SubTotal"]."$" ?></td>
                    <?php 
                }
                }
                 else{
                    ?>
                    <td class="colorblack" ><?php echo $ArrayInfo[$i]["SubTotal"]."$" ?></td>
                    <?php
                }
                }
                else{
                    ?>
                    <td class="colorblack" ><?php echo $ArrayInfo[$i]["SubTotal"]."$" ?></td>
                    <?php
                }
                ?>
                
                <td><?php echo $ArrayInfo[$i]["TaxAmount"]."$" ?></td>
                <td><?php echo $ArrayInfo[$i]["GrandTotal"]."$" ?></td>                
            </tr>
            
  <?php
     }
     
     ?>
         
    </table>
       
    <?php
}

 


#function to get information from user
function saveInfo(){
    
    
    #global variables
    global $pCode;
    global $fName;
    global $lName;
    global $city;
    global $comments;
    global $price;
    global $quantity;
    global $subTotal;
    global $taxAmount;
    global $grandTotal;
    global $ArrayInfo;
    
     #Calculating suntotal, taxAmount and grandTotal values
    $subTotal = multiply($price, $quantity);
    $taxAmount = taxCalculate($subTotal,LOCAL_TAXES);
    $grandTotal = Add($subTotal, $taxAmount);
    
    
   #put our global varibales into an array(data which is get from user)
    $ArrayInfo= array();
    $ArrayInfo["ProductCode"]= $pCode;
    $ArrayInfo["FirstName"]= $fName;
    $ArrayInfo["LastName"]= $lName;
    $ArrayInfo["City"]= $city;
    $ArrayInfo["Comments"]= $comments;
    $ArrayInfo["Price"]= number_format($price, 2);
    $ArrayInfo["Quantity"]= $quantity;
    $ArrayInfo["SubTotal"]= round($subTotal, 2);
    $ArrayInfo["TaxAmount"]=  round($taxAmount, 2);
    $ArrayInfo["GrandTotal"]= round($grandTotal, 2);
    

    #Putting the array into a json file
    $customerInfo = json_encode($ArrayInfo). "\r\n";
   
    #open text file
    $myfilehandle = fopen("FILE_PURCHASE","a") or die("This file could not be opened");
      
    #write informations in text file
     fwrite($myfilehandle, $customerInfo);
     
     #close file
     fclose($myfilehandle);  
    
}




#validatation of our form
 function validateForm()
 
{  
     #global variables
    global $pCode;
    global $fName;
    global $lName;
    global $city;
    global $comments;
    global $price;
    global $quantity;
    global $errorProductCode; 
    global $errorfName;
    global $errorLastName;
    global $errorCity;
    global $errorComments;
    global $errorPrice;
    global $errorQuantity;
    global $subTotal;
    global $taxAmount;
    global $grandTotal;
    global $ArrayInfo;
    
    
    
#check if the user press submit buttom
    if(isset(($_POST["Submit"])) === true)
    {
        
        #check specefic html characters and also spaces after and before the data
        $pCode = htmlspecialchars(trim($_POST["pCode"]));
        $fName = htmlspecialchars(trim($_POST["firstname"]));
        $lName = htmlspecialchars(trim($_POST["lastname"]));
        $city = htmlspecialchars(trim($_POST["city"]));
        $price = htmlspecialchars(trim($_POST["price"]));
        $quantity = htmlspecialchars(trim($_POST["quantity"]));
        $comments = htmlspecialchars(trim($_POST["comments"]));
        $message="";

        #check if the productCode is empty
        if($pCode == "")
        {
            #The productCode is empty
            $errorProductCode = "Please enter the product code";
        }
        else
        {
            
            
            #The productCode cannot be longer than 12 characters
            if(strlen($pCode) > PRODUCT_CODE_MAX_LENGTH)
            {
                $errorProductCode = "The Product Code cannot contain more than ".PRODUCT_CODE_MAX_LENGTH." characters";
            }
           if($pCode[0] != "p" && $pCode[0] != "P" ){
            $errorProductCode = "IT start  NOT with P or p";
            
            }
            
        }
           
       
        
        
        #check if the First Name is empty
        if($fName == "")
        {
            #The FirstName is empty
            $errorfName = "Please enter your First Name";
        }
        else
        {
            #The First Name cannot be longer than 20 characters
            if(strlen($fName) > CUSTOMER_FIRSTNAME_MAX_LENGTH)
            {
                $errorfName = "The First Name cannot contain more than ".CUSTOMER_FIRSTNAME_MAX_LENGTH." characters";
            }
        } 
             
        
        
        
        #check if the Last Name is empty
        if($lName == "")
        {
            #The LastName is empty
            $errorLastName = "Please enter your Last Name";
        }
        else
        {
            #The Last Name cannot be longer than 20 characters
            if(strlen($lName) > CUSTOMER_LASTNAME_MAX_LENGTH)
            {
                $errorLastName = "The Last Name cannot contain more than ".CUSTOMER_LASTNAME_MAX_LENGTH." characters";
            }
        } 
        
        
      
       
        #The comment longer than 200 characters
        if(strlen($comments) > COMMENT_CITY_MAX_LENGTH)
        {
         $errorComments = "Your comment cannot contain more than ".COMMENT_CITY_MAX_LENGTH." characters";
         }
       
        
        
        
        
//        #check if the city is empty
        if($city == "")
        {
            #The City is empty
            $errorCity = "Please enter the City Name";
        }
        else
        {
            #The City Name cannot be longer than 8 characters
            if(strlen($city) > CUSTOMER_CITY_MAX_LENGTH)
            {
                $errorCity = "The City Name cannot contain more than ".CUSTOMER_CITY_MAX_LENGTH." characters";
            }
        } 
        
        
        
        
         #check validation for price
        if($price == ""){
             #The price is empty
            $errorPrice = "Please enter the price";
        }
        else{
             #The price should be numeric
         if(! is_numeric($price)){
             $errorPrice = "Please enter numberic value between ".PRICE_MIN_VALUE." and "
                     .PRICE_MAX_VALUE;
            }
            else{
                #TO MAKE SURE IT IS BETWEEN 1900 AND CURRENTYEAR+1
                if($price < PRICE_MIN_VALUE || $price > PRICE_MAX_VALUE){
                    
                      $errorPrice = "Please enter a value between ".PRICE_MIN_VALUE." and "
                     .PRICE_MAX_VALUE;
                }
            }
        }
        
           #check validation for quantity
        if($quantity == ""){
             #The quantity connot be empty
            $errorQuantity = "Please enter the Quantity";
        }
        else{
            #Quantity should be number
         if(! is_numeric($quantity)){
             $errorQuantity = "Please enter numberic value between ".QUANTITY_MIN_VALUE." and "
                     .QUANTITY_MAX_VALUE;
            }
            
            
            #Quantity should be Decimal
        if((int)$quantity != (float)$quantity){
           $errorQuantity = "please enter an integer number";
            }
            else{
                #TO MAKE SURE IT IS BETWEEN 1900 AND CURRENTYEAR+1
                if($quantity < QUANTITY_MIN_VALUE || $quantity > QUANTITY_MAX_VALUE){
                    
                      $errorQuantity = "PLEASE enter a value between ".QUANTITY_MIN_VALUE." and "
                     .QUANTITY_MAX_VALUE;
                }
            }
        }
        
        
//            if no error accure the save them in our text file    
        if ($errorProductCode == "" && $errorfName == "" && $errorLastName == "" && $errorCity == ""
                && $errorPrice =="" && $errorQuantity == "")
        {
            
            
            #save data in text file
            saveInfo();
            
            #empty variables for next time
            $pCode = "";
            $fName = "";
            $lName = "";
            $city = "";
            $quantity = "";
            $price = "";
            $comments="";

            #tell the user that informations saves successfully
          $message = "Transaction completed successfully";
          function_alert($message);
        }
    }
}


#function to manage errors

function manageError($errorNumber, $errorMessage, $errorFile,$errorLine)
{
    global $debug;
    echo "Error occured<br>";
    
    if($debug == true)
    {
    #log to the file
        echo "An error occured in the file $errorFile at line $errorLine: "
            ."Error number $errorNumber: $errorMessage";
    }

    die();
}

#function to manage exceptions

function manageException($errorObject)
{
    global $debug;
    echo "Error occured<br>";
    
    if($debug == true)
        {
        #log to the file
            echo "An error occured in the file ".$errorObject->getFile()." at line".
                $errorObject->GetLine()." ".$errorObject->getMessage();
        }
}

#function to manage errorhandling

function setErrorExceptionHandler()
{
    #error: problem occured when calling PHP functions
    #exceptions: problem occured when running a function
    
    set_error_handler("manageError");
    set_exception_handler("manageException");
}

#Function to download cheetsheet
function downloadCheatSheet()
{?><p>
    <a href="Data/cheetsheet.txt" download> <button class="button" >Download Cheat Sheet</button></a>
</p>
        <?php
}


?>

