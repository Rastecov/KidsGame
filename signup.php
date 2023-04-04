<?php 

require "header.php";

?>
<link rel ="stylesheet" href="style.css">
<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Signup</h1>
            <?php
    
 
    if(isset($_GET['error'])){
if($_GET['error'] == "emptyfields"){

    echo "<p class ='error'> You must fill all fields!!<p> ";
}

else if($_GET['error'] == "invalidusernameMail"){

    echo "<p class ='error'> You must add a valid Email and Username!<p> ";
}
else if($_GET['error'] == "invalidusername"){

    echo "<p class ='error'> You must add a valid Username!<p> ";
}
else if($_GET['error'] == "invalidMail"){

    echo "<p class ='error'> You must add a valid Email!<p> ";
}
else if($_GET['error'] == "NotTheSamePassword"){

    echo "<p class ='error'> You must enter the same password<p> ";
}
else if($_GET['error'] == "usertaken"){

    echo "<p class ='error'> Username already exist in the database<p> ";
}




    }
    else if (isset($_GET['Signup'])){
       
            echo "<p class ='success'> Data saved<p> ";
        
    } 
  
    ?>
            <form action =includes/signup_function.php method="post">
            <input type="text" name="uid" placeholder ="Username">
            <input type="text" name="mail" placeholder ="Email">
            <input type="text" name="fName" placeholder ="Firstname">
            <input type="text" name="lName" placeholder ="Lastname">
            <input type ="password" name="pwd" placeholder ="Password">
            <input type ="password" name="Cpwd" placeholder ="Confirm your Password">
            <button type ="submit" name="signup-submit">Signup</button>
                  
            </form>
            <a href="index.php">Loging</a>;
        </section>
    </div>

   
</main>

<?php 

require "footer.php";
?>