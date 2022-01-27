<?php
session_start();

if (isset($_POST['display_name']) && isset($_POST['meeting_number']) && isset($_POST['meeting_pwd']) && isset($_POST['meeting_email']))
{
    $display_name=$_SESSION['display_name']=$_POST['display_name'];
    $meeting_number=$_SESSION['meeting_number']=$_POST['meeting_number'];
    $meeting_pwd=$_SESSION['meeting_pwd']=$_POST['meeting_pwd'];
    $meeting_email=$_SESSION['meeting_email']=$_POST['meeting_email'];
}elseif(isset($_SESSION['display_name']) && isset($_SESSION['meeting_number']) && isset($_SESSION['meeting_pwd']) && isset($_SESSION['meeting_email']))
{
    $display_name=$_SESSION['display_name'];
    $meeting_number=$_SESSION['meeting_number'];
    $meeting_pwd=$_SESSION['meeting_pwd'];
    $meeting_email=$_SESSION['meeting_email'];
}else
{
    $display_name="OYO LMS";
    $meeting_number='';
    $meeting_pwd='';
    $meeting_email='';
    header('location:../../dashboard');
}
?>



<!DOCTYPE html>

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

</head>

<body> 
    <style>
        .sdk-select {
            height: 34px;
            border-radius: 4px;
        }

        .websdktest button {
            float: right;
            margin-left: 5px;
        }

        #nav-tool {
            margin-bottom: 0px;
        }

        #show-test-tool {
            position: relative;
            top: 100px;
            left: 0;
            display: block;
            z-index: 99999;
        }

        #display_name {
            width: 250px;
        }


        #websdk-iframe {
            width: 700px;
            height: 500px;
            border: 1px;
            border-color: red;
            border-style: dashed;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            left: 50%;
            margin: 0;
        }
    </style>

    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="../../dashboard" style="color:#fff;">
              <img src="../../assets/images/logo.png"  alt="Logo" width="100px">
                OYO LMS CLASS
            </a>

    <!-- <center> -->
<br/><br/><br/><br/><br/>
            <?php
echo
"<div style='color:#fff;'><br/> Your Name: ".$display_name
."<br/> Meeting Number: ".$meeting_number
."<br/> Meeting Password: ".$meeting_pwd
."<br/> Your Email: ".$meeting_email."</div>";
?>

<br/><br/>
<!-- </center> -->

            </div>
            <div id="navbar" class="websdktest">
            
                <form class="navbar-form navbar-right" id="meeting_form">
                    <div class="form-group">
                        <input type="hidden" name="display_name" id="display_name" value="<?php echo $display_name;?>" maxLength="100" placeholder="Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="meeting_number" id="meeting_number" value="<?php echo $meeting_number;?>" maxLength="200" style="width:150px" placeholder="Meeting Number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="meeting_pwd" id="meeting_pwd" value="<?php echo $meeting_pwd;?>" style="width:150px" maxLength="32" placeholder="Meeting Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="meeting_email" id="meeting_email" value="<?php echo $meeting_email;?>" style="width:150px" maxLength="32" placeholder="Email option" class="form-control">
                    </div>

                    <div class="form-group">
                        <select id="meeting_role" class="sdk-select" hidden>
                            <option value="0" selected>Attendee</option>
                            <option value="1">Host</option>
                            <option value="5">Assistant</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="meeting_china" class="sdk-select" hidden>
                            <option value="0" selected>Global</option>
                            <option value="1">China</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="meeting_lang" class="sdk-select" hidden>
                            <option value="en-US">English</option>
                        </select>
                    </div>

                    <div class="form-group">
                    <input type="hidden" value="" id="copy_link_value" /> <br>
                      <input type="submit" class="btn btn-success btn-lg" id="join_meeting" value="Join Class"/> 
                      <!-- Join Class </button> -->
                    <button type="submit" class="btn btn-primary" id="clear_all"></button>
                    <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')"
                        class="btn btn-primary" id="copy_join_link"></button>
                    </div>
                        <br/>

                </form>

            </div>
            <!--/.navbar-collapse -->
        </div>
    </nav>









    <div id="show-test-tool">
        <!-- <button type="submit" class="btn btn-primary" id="show-test-tool-btn"
            title="show or hide top test tool" hidden>Show</button> -->
            <br/><br/>

    </div>
    <script>
        document.getElementById('show-test-tool-btn').addEventListener("click", function (e) {
            var textContent = e.target.textContent;
            if (textContent === 'Show') {
                document.getElementById('nav-tool').style.display = 'block';
                document.getElementById('show-test-tool-btn').textContent = 'Hide';
            } else {
                document.getElementById('nav-tool').style.display = 'none';
                document.getElementById('show-test-tool-btn').textContent = 'Show';
            }
        })
    </script>

    <script src="https://source.zoom.us/2.1.1/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.1.1/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.1.1/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.1.1/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.1.1/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.1.1.min.js"></script>
    <script src="js/tool.js"></script>
    <script src="js/vconsole.min.js"></script>
    <script src="js/index.js"></script>

    <script>


    </script>
</body>
<center>
<footer>
<br/>
            <?php
echo
"<div style='color:#fff;'><br/> Your Name: ".$display_name
."<br/> Meeting Number: ".$meeting_number
."<br/> Meeting Password: ".$meeting_pwd
."<br/> Your Email: ".$meeting_email."</div>";
?>
</footer>
</center>
</html>