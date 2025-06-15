<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP, OOP, Monster Class" />
    <meta name="author" content="Marco GIacoppo" />
    <title>Web Programming - Lab10</title>
</head>

<body>
    <h1>Web Programming - Lab10</h1>

    <?php
    require_once("monsterclass.php"); // Include the Monster class
    
    // Create two monsters
    $monster1 = new Monster(1, "red");  // A red monster with 1 eye
    $monster2 = new Monster(3, "blue"); // A blue monster with 3 eyes
    
    // Output the descriptions of the monsters
    echo "<p>{$monster1->describe()}</p>";
    echo "<p>{$monster2->describe()}</p>";
    ?>

</body>

</html>