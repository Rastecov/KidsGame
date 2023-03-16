<?php

//Game Levels
 



  global $rString;
 $rString.=generateRandomLetters();




function generateRandomLetters(){

   
        $n = 6;
   
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
    
        for ($i = 0; $i <$n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        echo "The random letters generated are : "."<br/>".$randomString."<br/>"; 
        return $randomString;

    
    


}

echo "</br>Level 1"."</br>";

function acsendingOrderLetter($rString){

    $letters = str_split($rString);
    sort($letters); 
    $sortedString = implode(' ', $letters); 
    echo $sortedString. "<br/>";

    

}



echo acsendingOrderLetter($rString);


echo "</br>Level 2"."</br>";


function descendingOrderLetter($rString){

    $letters = str_split($rString);
    rsort($letters); 

    $sortedString = implode(' ', $letters); 
    echo $sortedString."</br>";
    

    

}


echo descendingOrderLetter($rString);

 


 

$random_numbers = array();

 function generateRandomNumbers()
{
    global $random_numbers;
    $n = 6;
    // Generate an array of random numbers between 1 and 100
    for ($i = 0; $i < $n; $i++) {
        $random_numbers[] = rand(1, 100);
    }

    // Print the sorted array of random numbers
    echo "<br/>"."The random Numbers generated are : "."<br/>"; 
    foreach ($random_numbers as $number) {
        echo " ".$number . " ";
    }

    return $random_numbers;
}

$random_numbers = generateRandomNumbers();


echo "</br> Level 3";
function ascendingOrderNumber($arr){
    sort($arr);
    foreach ($arr as $number) {
        echo "<br/> <br/>".$number . " ";
    }
}

ascendingOrderNumber($random_numbers);

echo "</br>Level 4"."</br>";
function descendingOrderNumber($arr){
    rsort($arr);
    foreach ($arr as $number) {
        echo "<br/> <br/>".$number . " ";
    }
}

descendingOrderNumber($random_numbers);




echo "</br>Level 5"."</br>";


function FindFirstLastLetters($rString){

    $letters = str_split($rString);
    echo "After sorting the letters are: ";
    sort($letters);
    
    $first = $letters[0];
    $sortedString = implode(' ', $letters); 
    $last =  $letters[count($letters)-1]; // get the last character of the sorted string

    foreach($letters as $character){
        echo $character;
    }

    echo "<br/>The first Letter is: ". $first;
    echo "<br/>The last Letter is: ". $last."</br>";
}


FindFirstLastLetters($rString); // call FindFirstLastr function with rString as input





//$random_numbers = array();

/* function generateRandomNumbers()
{
    global $random_numbers;
    $n = 6;
    // Generate an array of random numbers between 1 and 100
    for ($i = 0; $i < $n; $i++) {
        $random_numbers[] = rand(1, 100);
    }

    // Print the sorted array of random numbers
    foreach ($random_numbers as $number) {
        echo $number . " ";
    }

    return $random_numbers;
}

$random_numbers = generateRandomNumbers(); */

echo "</br>Level 6"."</br>";

function FindFirstLastNumber($random_numbers){

  // $num = str_split($random_numbers);
    echo "After sorting the letters are: ";
    sort($random_numbers);
    
    $first = $random_numbers[0];
    $last =  $random_numbers[count($random_numbers)-1]; // get the last character of the sorted string

    foreach($random_numbers as $sNum){
        echo $sNum. " ";
    }

    echo "<br/>The Minimum Number is: ". $first;
    echo "<br/>The Maximum Number is: ". $last;
}


FindFirstLastNumber($random_numbers); // call FindFirstLastr function with rString as input


?>
