<?php 


if(isset($_GET['watch'])){
        $yt_id= $_GET['watch'];
    } else {
    	die('lol');
    }



    $gg = mysqli_connect("localhost", "root", "", "datach");

    $query = mysqli_query($gg, "SELECT * FROM isidata WHERE yt_id = '$yt_id'");
    $r = mysqli_fetch_array($query);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Nonton</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<iframe width="853" height="480" src="https://www.youtube.com/embed/<?php echo $r['yt_id'] ?>" title="Jangan Lupa di Claim Redeem Codenya Kawan !!! Genshin Impact v3.1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</body>
</html>


