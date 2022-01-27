<?php
if (isset($_GET['web'])) {
  $web=$_GET['web'];
}else{
  $web='https://www.learninggamesforkids.com';
}
?>

<!DOCTYPE html>

<head>
    <title>Primary Classroom</title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.1.1/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.1.1/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/font-icons/entypo/css/entypo.css">

    <link rel="stylesheet" href="../assets/css/neon-core.css">
<link rel="stylesheet" href="../assets/css/adm.css">
<link rel="stylesheet" href="../assets/css/neon-theme.css">
<link rel="stylesheet" href="../assets/css/neon-forms.css">
<link rel="stylesheet" href="../assets/css/custom.css">
<link rel="stylesheet" href="../assets/css/skins/red.css">
 
<style>
  #google_center_div{
    Display:none;
  }
</style>

<a class="navbar-brand" href="primary.php?web=https://www.learninggamesforkids.com" style="color:#ff0000;">
              <img src="../assets/images/logo.png"  alt="Logo" width="30px">
              Primary Classroom
            </a> 
&emsp;
            <!-- <a href="primary.php?web=https://www.learninggamesforkids.com"><button class="btn btn-primary">Basic</button></a> -->
            <a href="primary.php?web=https://math-world.e-learningforkids.org/en/grade-1"><button class="btn btn-success">Primary maths</button></button></a>

            <a href="primary.php?web=https://science-world.e-learningforkids.org/en/grade-1/map"><button class="btn btn-danger">Primary science</button></a>
</head>

<body>
    <br><br>
    <embed src="<?php echo $web;?>" style="width:100%; height: 100vh;">
        

    <!-- <iframe src="http://www.coolmath4kids.com"
          width="100%" height="100%" allowfullscreen sandbox>
    <p>
      <a href="http://www.coolmath4kids.com">
         Fallback link for browsers that don't support iframes
      </a>
    </p>
  </iframe> -->

</body>

</html>