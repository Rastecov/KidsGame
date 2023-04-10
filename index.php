<head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>





<?php

require "header.php";

?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php
            

           

            if(isset($_GET['error'])){

                
            if(isset($_GET['error'])){

                if ($_GET['error'] == "emptyfields") {
                    echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">You must fill all fields!!</div></div>';
                }
                if ($_GET['error'] == "NoUser") {
                    echo '<div class="toast error-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Error</strong></div><div class="toast-body">Sorry, you entered a wrong Username or Password!</div></div>';
                }
                if ($_GET['error'] == "InvalidPassword") {
                    echo '<div class="toast alert-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Alert</strong></div><div class="toast-body"></div></div>';
                    echo'<a href="includes/Forgotten_Password.php">Forgotten? Please, change your password.</a>';

               
                }

               
                
            }
        }
            if(isset($_GET['success'])){
            if ($_GET['success'] == "Passchanged") {
                echo '<div class="toast success-toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Success</strong></div><div class="toast-body">Password changed successfully</div></div>';
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

<script>
    $(document).ready(function(){
        $('.toast').toast('show');
    });
</script>


<?php

require "footer.php";
?>

</body>