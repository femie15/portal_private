<?php
session_start();

// error_reporting(0);
$con=mysqli_connect("localhost","root","","oyoedumi_portals") or die("Not Connected");


if (isset($_POST['topic']) && isset($_POST['start_date']) && isset($_POST['password']) && isset($_POST['subject']))
{
    $topic=$_SESSION['topic']=$_POST['topic'];
    $start_date=$_SESSION['start_date']=$_POST['start_date'];
    $password=$_SESSION['password']=$_POST['password'];
    $subject=$_SESSION['subject']=$_POST['subject'];


    $classd=$_SESSION['classd']=$_POST['classd'];
    $school_id=$_SESSION['school_id']=$_POST['school_id'];


}elseif(isset($_SESSION['topic']) && isset($_SESSION['start_date']) && isset($_SESSION['password']) && isset($_SESSION['subject']))
{
    $topic=$_SESSION['topic'];
    $start_date=$_SESSION['start_date'];
    $password=$_SESSION['password'];
    $subject=$_SESSION['subject'];
	
    $classd=$_SESSION['classd'];
    $school_id=$_SESSION['school_id'];
}else
{
    $topic="CLASS BY OYO LMS";
    $start_date='';
    $password='';
    $subject='';
	
    $classd='';
    $school_id='';

    header('location:../../dashboard');
}

// die(date($start_date.' 00:00:00'));


include('config.php');
include('api.php');
$tm=str_replace('T',' ',$start_date).':59';
$arr['topic']=strtoupper($subject).' Class By '.$topic;
$arr['start_date']=date($tm);
// $arr['start_date']=date('2022-01-24 20:00:30');
$arr['duration']=40;
$arr['password']=$password;
$arr['type']='2';


// die(date($tm));

$result=createMeeting($arr);

// die(print_r($result));
// die( $school_id.'_'. $classd.'_'.$result->join_url.'_'.$result->start_url.'_'.$result->password.'_'.$result->topic.'_'.$subject.'_'.$tm);

$shw='';
if(isset($result->id)){
	$fo=str_replace('Z','',$result->start_time);
	$shw.= "<br/><br/><br/><a href='".$result->start_url."'><button class='btn btn-primary btn-lg'>Start Class</button></a><br/>";
	// $shw.= "<br/><br/><br/><a href='".$result->join_url."'><button class='btn btn-primary btn-lg'>Start Class</button></a><br/>";
	$shw.= "<br/>Passcode: ".$result->password."<br/>";
	$shw.= "<br/>Class Start Time: ".str_replace('T',' ',$fo)."<br/>";
	$shw.= "<br/>Class Duration: ".$result->duration." Minutes <br/>";


$sql = "INSERT INTO classed_school (id,school_id,class_id,join_url,start_url,start_time,passcode,topic,subjects) VALUES(NULL,'$school_id','$classd','$result->join_url','$result->start_url','$tm','$result->password','$result->topic','$subject')";
$query= mysqli_query($con, $sql);

}else{
	echo '<pre>';
	print_r($result);
}
?> 


<head>
    <title>OYO LMS Classroom</title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.1.1/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.1.1/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href="../../assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../assets/css/font-icons/entypo/css/entypo.css">

    <link rel="stylesheet" href="../../assets/css/neon-core.css">
<link rel="stylesheet" href="../../assets/css/adm.css">
<link rel="stylesheet" href="../../assets/css/neon-theme.css">
<link rel="stylesheet" href="../../assets/css/neon-forms.css">
<link rel="stylesheet" href="../../assets/css/custom.css">
<link rel="stylesheet" href="../../assets/css/skins/red.css">

<br>
<a class="navbar-brand" href="../../dashboard" style="color:#ff0000;">
              <img src="../../assets/images/logo.png"  alt="Logo" width="100px">
                OYO LMS CLASS
            </a>
</head>

<body>
<br><br><br>
	<center>
		<?php echo $shw; ?>
	</center>
</body>