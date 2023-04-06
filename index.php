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
                    
                }

                if($_GET['error'] == "Invalid ID or Password"){

                    echo "<p class ='error'> Sorry, you entered a wrong Username or Password!”, <p> ";
                }

            }
          
            
            ?>
           
        <form action="includes/Login2.php " method ="post">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username">
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="login-submit">Connect</button>
        </form>

         <form action="signup.php " method ="post">
        <button type="submit" name="signup">Sign-Up</button>
        </form>
            
            
        </section>
    </div>
</main>

<?php

require "footer.php";
?>