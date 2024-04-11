<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basics</title>
</head>
<body>
    <h1>Welcome to the PHP Introduction Class</h1>
    <?php 
    // echo("Hello World<br>");
    // echo("Hello <br>");
    // $name=("Suraj Kanwar");
    // echo ($name);

    // $a=20;
    // $b=10;
    // $result= $a+$b;
    // echo $result;

    // $first_name="Alex";
    // $last_name="Nepali";
    // echo "Welcome" .$first_name.$last_name;
    // $Name="Suraj";
    // echo(var_dump($Name));
    // echo(gettype($Name));

    // $number=20;
    // if($number==20){
    //     echo "Number is $number";
    // }
    // elseif($number>20){
    //     echo "$number is greater than 20";
    // }
    // else{
    //     echo"$number is less than 20 ";
    // }

    $attendance= 79;
    $attitude= 69;
    $academics=67;
    if($attendance==80 && $attitude= 70&& $academics= 70){
        echo ("Congratulations! You have got an Scholorship.");
    }
    elseif($attendance<80 && $attitude<70 && $academics<70){
        echo ("Sorry you are not eligible for a scholarhip ");
    }
    else{
        echo ("You need more efforts");
    }

    for($i=0;$i<=10;$i++){
        echo"<br> Hello World<br>";
    }

    $collection=[1,2,3,4];
    for($i=0;$i<=count($collection)-1;$i++){
        echo "$collection[$i]<br>";
    }

    $i=0;
    while($i<count($collection)){
        echo"$collection[$i]<br>";
        $i++;
    }

    $i=0;
    while($i>0){
        echo "Hello World";
    }

    //do while
    // for each
    $collection=[1,2,3,4,5];
    foreach($collection as $num){
        echo "$num<br>";
    }

    //create a multiplication table of 5
    $n=5;
    for($i=1;$i<=10;$i++){
        $result=("<br>$n*$i =" .$n * $i. "<br>");
        echo $result;
    }


    $cars=["honda","toyota","suxuki"];
    foreach($cars as $car){
        echo "$car<br>";
    }

    // for($a=0;$a<=8;$a++){

    // }

    $string="Hello world";
    $length=strlen($string);
    echo "$length<br>";

    $a="nayan";
    $palin=strrev($a);
    echo $palin;



//store data in json server 
// // Prepare data to be written to the JSON file
                // $weatherData = [
                //     'city' => $row['city'],
                //     'temperature' => round($temperatureCelsius, 2),
                //     'date_time' => $dateTime->format('Y-m-d H:i:s'),
                //     'pressure' => $row['pressure'],
                //     'wind_speed' => $row['wind_speed'],
                //     'humidity' => $row['humidity'],
                //     'icon' => $icon
                // ];

                // // Read existing data from the JSON file
                // $jsonFile = 'weather.json';
                // $existingData = file_get_contents($jsonFile);
                // $existingDataArray = json_decode($existingData, true);

                // // Add the new weather data to the existing data array
                // $existingDataArray[] = $weatherData;

                // // Convert the updated data array to JSON format
                // $updatedData = json_encode($existingDataArray, JSON_PRETTY_PRINT);

                // // Write the updated data back to the JSON file
                // file_put_contents($jsonFile, $updatedData);

 


    



    ?>
</body>
</html>