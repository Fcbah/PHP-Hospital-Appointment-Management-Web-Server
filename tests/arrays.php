<?php

//php.net 
// 
//for ARRAYS 

$array_example  = []; //an empty array

$array_example_2 = ["mike"];

$array_example_3 = ["mike",3,"orange",true];

//index - position of an element (item) in the array
//position 0

print $array_example_3[0]; // prints mike
print $array_example_3[3]; // prints true

//length
print count($array_example_3); //print out 4

 $imaginary_array = [];

 print $imaginary_array[count($imaginary_array)-1]; //prints the last item in the array

 $array_example_4 = array();
 $array_example_4[0] = "Seyi";
 $array_example_4[1] = "Onifade";
 $array_example_4[2] = "xyluz";

 print $array_example_4 // [ "Seyi", "Onifade" , "xyluz"]