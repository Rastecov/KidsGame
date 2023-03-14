<?php

//Game Levels
 
global $random_numbers;


/*  global $rString;
 $rString.=generateRandomLetters();




function generateRandomLetters(){

   
        $n = 6;
   
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
    
        for ($i = 0; $i <$n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        echo $randomString. "<br/>"; 
        return $randomString;

    
    


}

//Level 1

function acendingOrder($rString){

    $letters = str_split($rString);
    sort($letters); 
    $sortedString = implode(' ', $letters); 
    echo $sortedString. "<br/>";

    

}



echo acendingOrder($rString);


//Level 2


function descendingOrder($rString){

    $letters = str_split($rString);
    rsort($letters); 

    $sortedString = implode(' ', $letters); 
    echo $sortedString;
    

    

}


echo descendingOrder($rString);

 */


 
 

function generateRandomNumbers(){



    $n =6;
   
   // Generate an array of random numbers between 1 and 100
$random_numbers = array();
for ($i = 0; $i < $n; $i++) {
    $random_numbers[] = rand(1, 100);
}


// Print the sorted array of random numbers
foreach ($random_numbers as $number) {
 
    echo $number . " ";
}

return $random_numbers;



} 





echo $random_numbers;
//Level 3

function acendingOrder($random_numbers){
    $random_numbers =generateRandomNumbers();
    sort($random_numbers);

    foreach ($random_numbers as $number) {
 
        echo "<br/>".$number . " ";
    }
    
}

echo acendingOrder($random_numbers);







?>