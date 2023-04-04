<?php

require "header.php";

?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php
            if(isset($_GET['error'])){

                if($_GET['error'] == "emptyfields"){

                    echo "<p class ='error'> You must fill all fields!!<p> ";
                    echo "<p class ='error'> Invalid ID or Password<p> ";
                }

                if($_GET['error'] == "Invalid ID or Password"){

                    echo "<p class ='error'> Invalid ID or Password<p> ";
                }

            }
          
            
            ?>
           
        <form action="includes/Login2.php " method ="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="login-submit">Login</button>
        </form>
         <a href="signup.php">Signup</a>';
            
            
        </section>
    </div>
</main>

<?php

require "footer.php";
?>