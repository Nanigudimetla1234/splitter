<?php 

$name="fgfdgdf";
$hash = password_hash($name,PASSWORD_DEFAULT);
echo $hash;
$name2 = "fgfdgf";
echo "<br>";
echo password_verify($name2, $hash);
if(password_verify($name2,$hash)){
    echo "<br>";
echo "sdfsdf";
}

?>
