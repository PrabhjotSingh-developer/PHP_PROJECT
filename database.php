<?php
$rel = "Stylesheet";
$href = "./style.css";
echo "<link rel='{$rel}' href='{$href}'>";
$conn = mysqli_connect("localhost", "Prabhjot", "Prabhjot@123", "bca3");
if (!$conn)
    die("Connection not successful");


if (isset($_GET["submit"])) {
    // echo "Simple insert wala";
    insert($conn);
} else if (isset($_GET["updateRoll"])) {
    // echo "Yes bhai update kiya liya chla";
    update($conn);
} else if (isset($_GET["deleteRoll"])) {
    // echo "Yes bhai delete ka liye chla ...";
    deleteRoll($conn);
}
else if(isset($_GET["display_roll"]))
{
    
     display($conn);
}

// echo "$s";
//    $q = "create database bca3";
//    $r = mysqli_query($conn,$q);
//    if(!$r)
//   die("Database not created");

//   echo "database created";
// database created ^

// create a table 

// $sql = "create table STUDENT(NAME varchar(30), ROLLNO int(4) Primary Key, CLASS varchar(10), EMAILID varchar(40), MOBNUMBER int(10))";
// if (mysqli_query($conn, $sql) === true)
//     echo "table  created";
// else
//     echo "Error." . $sql . "<br/>" . mysqli_query($conn, $sql);

//  "table created successfuly";

function insert($conn)
{
    $name = $_GET["name"];
    $rollNo = (int) $_GET["rollno"];
    $class = $_GET["class"];
    $email = $_GET["emailId"];
    $mobile = (int) $_GET["mobile"];
    echo $mobile;
    $q = "insert into STUDENT(NAME,ROLLNO,CLASS,EMAILID,MOBNUMBER) values ('$name',$rollNo , '$class', '$email',  $mobile)";
    $res = mysqli_query($conn, $q);
    if ($res)
        echo "<h1>🤟💪 Result recorded 🤟💪</h1>";
    else
    echo "<h1>😓😓Result Not inserted 😓😓</h1>";

}

function update($conn)
{
    $roll = (int)$_GET["uproll"];
    $q = "select * from STUDENT WHERE ROLLNO = $roll";
    $res = mysqli_query($conn, $q);
    $arr = mysqli_fetch_array($res);
    //  foreach($res as $key => $value)
    //  {
    //     echo "$key => $value <br>";
    //  }
    // echo sizeof($arr);
   if($arr === null)
   {
    
        
        echo "<h1>😓😓 Record not found 😓😓</h1>";
        echo "<h1> for exp pehla istmall kro or fir vishwas kro vese hi <br/> pehla insert kro or fir update kro </h1>";
    
   }
   else
   {
     $a=0;
     while ($r = $arr ) {
        // echo "NAME = " . $r['NAME'] . "<br/>";
        // echo "ROLL NO = " . $r['ROLLNO'] . "<br/>";
        // echo "CLASS = " . $r['CLASS'] . "<br/>";
        // echo "EMAIL ID = " . $r['EMAILID'] . "<br/>";
        // echo "MOBILE = " . $r['MOBNUMBER'] . "<br/>";
        $a++;
       $name = $r['NAME'];
       $rollno = $r['ROLLNO'] ;
       $class = $r['CLASS'];
       $email =  $r['EMAILID'];
       $mob = $r['MOBNUMBER']; 
       $str = <<<demo
       <form action="new.php" class="form_data">
       <h4>Update Data</h4>
        <div>
              <label for="name">Name</label>
              <input type="text" name="update_name" id="name" value=$name>
        </div>
        <div>
               <label for="rollno">Roll No</label>
               <input type="text" readonly name="update_rollno" id="rollno" value="$rollno">

        </div>
        <div>
               <label for="class">Class</label>
                <input type="text" name="update_class" id="class" value = $class>
        </div>
       <div>
            <label for="emailId">Email id</label>
            <input type="email" name="update_emailId" id="emailId" value = "$email">
       </div>
       <div>
              <label for="mobile">Mobile No</label>
              <input type="text" name="update_mobile" id="mobile" value="$mob">
              
       </div>
       <div class="buttons">
              <input type="submit"class="btn"  value="Submit" name="updatesubmit">
              <input type="reset" class="btn" value="Reset">
       </div>
   </form>
demo;
    echo "$str";
        if($a<=1)
          break;
        
   }
}
  
}

function display($conn)
{
     $roll = (int)$_GET["disroll"];
     $q = "select * from student where ROLLNO = $roll";
     $arr = mysqli_query($conn,$q);
     $res = mysqli_fetch_array($arr);
     $a = 1;
     if($res === null)
     echo "<h1>😓😓 Record not found 😓😓</h1>";


    
     while($r = $res)
     {
        
          if($a<=1)
          {
            $str = <<<demo
             <table class="displaySingle">
                <tr>
                        <td>Name </td>
                        <td>$r[NAME]  </td>   

                </tr>
                <tr>
                  <td>ROLL NO </td>
                  <td>$r[ROLLNO]  </td>   
                 
                </tr>
                <tr>
                   <td>CLASS </td>
                   <td> $r[CLASS]  </td>   
         
               </tr>
                <tr>
                  <td>EMAIL ID </td>
                   <td>$r[NAME]  </td>   
 
                 </tr>
                 <tr>
                  <td>MOBILE NUMBER </td>
                   <td>$r[MOBNUMBER]  </td>   
 
                 </tr>
             </table>
demo;
            echo $str;
             $a++;
          }
          else 
            break;

     }
}
function deleteRoll($conn)
{
    $roll = (int)$_GET["delroll"];
   
    $res = "select *from STUDENT where ROLLNO = $roll";
     $obj = mysqli_query($conn,$res);
    $arr = mysqli_fetch_array($obj);
 
   if($arr === null)
   {
    echo "<h1>😓😓 Record not found 😓😓</h1>";
   }
   else
   {
    $q = "delete from STUDENT where ROLLNO = $roll";
     mysqli_query($conn,$q);
        echo "<h1>😞😔 Record deleted 😞😔</h1>";
   }
    
 
        
}
