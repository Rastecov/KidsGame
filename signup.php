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

else if($_GET['error'] == "invalidusername"){

    echo "<p class ='error'> You must add a valid Username!<p> ";
}

else if($_GET['error'] == "invalidfirstname"){

    echo "<p class ='error'> Sorry, your first name cannot start with a digit or number<p> ";
}
else if($_GET['error'] == "invalidlastname"){

    echo "<p class ='error'> Sorry, your last name cannot start with a digit or number<p> ";
}
else if($_GET['error'] == "NotTheSamePassword"){

    echo "<p class ='error'> Sorry, you entered 2 different passwords.<p> ";
}
else if($_GET['error'] == "usertaken"){

    echo "<p class ='error'> Sorry, this username already exists. Please, choose another one.<p> ";
}




    }
    else if (isset($_GET['Signup'])){
            echo "<p class ='success'> Data saved<p> ";
        
    } 
  
    ?>
            <form action =includes/signup_function.php method="post">
            <label for="uid">Username:</label>
            <input type="text" name="uid" placeholder ="Username">
            <label for="fName">Firstname:</label>
            <input type="text" name="fName" placeholder ="Firstname">
            <label for="lName">Lastname:</label>
            <input type="text" name="lName" placeholder ="Lastname">
            <label for="pwd">Password:</label>
            <input type ="password" name="pwd" placeholder ="Password">
            <label for="Cpwd">Confirm Password:</label>
            <input type ="password" name="Cpwd" placeholder ="Confirm your Password">
            <button type ="submit" name="signup-submit">Create</button>   
            </form>
            
            <form action="index.php" method ="post">
        <button type="submit" name="signin">Sign-In</button>
        </form>
        </section>
    </div>

   
</main>

<?php 

require "footer.php";
?>