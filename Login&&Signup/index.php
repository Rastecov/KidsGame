<?php

require "header.php";

?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php
            if( isset($_SESSION['userName'])){
                echo'<p> You are logged out! </p>';

            }
            else{
                echo '<p> You are logged in! </p>';

            }
            
            ?>
            
            <p>You are log in! </p>
        </section>
    </div>
</main>

<?php

require "footer.php";
?>