<?php 

require "header.php";

?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Signup</h1>
            <form action =includes/signup_function.php method="post">
            <input type="text" name="uid" placeholder ="Username">
            <input type="text" name="mail" placeholder ="Email">
            <input type="text" name="fName" placeholder ="Firstname">
            <input type="text" name="lName" placeholder ="Lastname">
            <input type ="password" name="pwd" placeholder ="Password">
            <input type ="password" name="Cpwd" placeholder ="Confirm your Password">
            <button type ="submit" name="signup-submit">Signup</button>
                  
            </form>
        </section>
    </div>
</main>

<?php 

require "footer.php";
?>