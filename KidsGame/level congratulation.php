<?php
//$_SESSION['level'] = 'success';
require "header.php";

?>
<main>

<div class="congrats-section">
    <h1>Congratulations!</h1>
    <p class='success'>You have won the game</p>
</div>


<form method="post" action="Level 1.php">
                            <button type="submit">Try again the Game</button>
                        </form>;

<?php



?>

<form method="post" action="index.php" class="home-btn">
    <button type="submit">Return to Home Page</button>
</form>
</main>

<?php
require "footer.php";
?>

</body>
</html>
