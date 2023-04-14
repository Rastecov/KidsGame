


<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php
            

            

            require "header.php";
            require "includes/database_handler.php"; 

            
            //checks if any errors or success messages has passed through the URL parameters then return the appropriated message              
            if(isset($_GET['error'])){

                if ($_GET['error'] == "emptyfields") {
                    //Message for empty fields
                    echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">You must fill all fields!!</div></div>';
                }
                if ($_GET['error'] == "NoUser") {
                    //Message error for when the username wasn't found in the database
                    echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">Sorry, you entered a wrong Username or Password!</div></div>';
                }
                //Message error for the username is found in the database but the password is incorrect
                if ($_GET['error'] == "InvalidPassword") {
                    echo '<div class="toast alert-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Alert</strong></div><div class="toast-body"></div></div>';
                    echo'<a href="includes/Forgotten_Password.php">Forgotten? Please, change your password.</a>';

               
                }

               
                
            }
               
            //checks  success messages has passed through the URL parameters then return the appropriated message              

        
            if(isset($_GET['success'])){
            if ($_GET['success'] == "Passchanged") {
                echo '<div class="toast success-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Success</strong></div><div class="toast-body">Password changed successfully</div></div>';
            }
        }
                    
          
            
            ?>
           
        <form action="includes/Login_function.php " method ="post">
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

