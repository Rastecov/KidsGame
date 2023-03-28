

<!DOCTYPE html>
<html>
<head>
    <title>Game Six</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
            padding-bottom: 30px;
            padding-top: 40px;
        }

        h3 {
            text-align: center;
        }

        .container {
            align-items: center;
            background-color: aquamarine;
            border: 5px solid;
            margin: auto;
            width: 40%;
            height: 500px;
            padding: 10px;
        }

    </style>
</head>
<body class=center;>
    <dix>
        <h1>Game Six</h1>
    </dix>
    <div class="container">
        <h3>Displaying the game</h3>
        <?php
        generateRandomNumbers();
        ?>
        <form method="post">
            <br />
            <label class="center" for="word">Enter the minimum number and maximum number separated by comma.</label>
            <input type="text" name="numbers">
            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    if(isset($_POST['numbers'])) {
    $numbers = $_POST['numbers'];
    $numbers_array = explode(',', $numbers);

    $numbers_array = array_map('trim', $numbers_array);

    $numbers_array = array_filter($numbers_array);

    if(!empty($numbers_array)) {

    $min_number = min($numbers_array);
    $max_number = max($numbers_array);

    echo 'Smallest number: ' . $min_number . '<br>';
    echo 'Biggest number: ' . $max_number;
    } else {
    echo 'Please enter at least one number';
    }
    }
    ?>

</body>
</html>