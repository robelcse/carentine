<?php
session_start();
?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>How It works</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.css">
    <?php include 'includes/head.php'; ?>
    <style>
        
        @media only screen and (max-width : 768px) { 
            header .logo a.logo-text {
                margin-top: -15px !important;
            }
            .hamburger {
               margin: 0;
            }
            
            .modal{
                top: 30%;
            }
            
            .statuscheck{
                display: flex;
                margin-left: 0 !important;
            }
            
        }
        
        textarea{ margin-bottom: 15px; }
        
        .modal {
          text-align: center;
        }

        @media screen and (min-width: 768px) { 
          .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
          }
        }

        .modal-dialog {
          display: inline-block;
          text-align: left;
          vertical-align: middle;
        }
   
        input[type="number"] {
            background: #fff;
            height: 50px;
            padding: 10px 20px;
            -webkit-transition: background .25s ease;
            -moz-transition: background .25s ease;
            -o-transition: background .25s ease;
            -ms-transition: background .25s ease;
            transition: background .25s ease;
            float: left;
            width: 100%;
            outline: 0;
            border: 1px solid #ccc;
            color: #000;
            font-size: 20px;
            font-family: PSFournierWebRegular;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, .08);
        }
        
        .row{
            margin-bottom: 30px;
        }
        
        body { padding-right: 0 !important }
        
        select {
            background: #fff;
            height: 50px;
            padding: 10px 20px;
            -webkit-transition: background .25s ease;
            -moz-transition: background .25s ease;
            -o-transition: background .25s ease;
            -ms-transition: background .25s ease;
            transition: background .25s ease;
            float: left;
            width: 100%;
            outline: 0;
            border: 1px solid #ccc;
            color: #000;
            font-size: 20px;
            font-family: PSFournierWebRegular;
            box-shadow: 4px 4px 4px rgba(0, 0, 0, .08);
        }
        
        input[type='radio'] {
            height: 1px;
            width: 1px;
            opacity: 0;
        }

        input:checked+.outside .inside {
            -webkit-animation: radio-select 0.1s linear;
            animation: radio-select 0.1s linear;
            -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
        }


        label {
            /*margin: 2em;*/
            font-size: 18px;
            position: relative;
            cursor: pointer;
        }

        .outside {
            display: inline-block;
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -10px;
            width: 20px;
            height: 20px;
            border: 2px solid grey;
            /*border-radius: 50%;*/
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background: none;
        }

        .inside {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            display: inline-block;
            /*border-radius: 50%;*/
            width: 10px;
            height: 10px;
            background: #1dbf73;
            left: 3px;
            top: 3px;
            -webkit-transform: scale(0, 0);
            transform: scale(0, 0);
        }

        .no-transforms .inside {
            left: auto;
            top: auto;
            width: 0;
            height: 0;
        }
    
    </style>
</head>

<body class="home page-template-default page page-id-41">
    <?php include 'includes/nav.php'; ?>
    <div id="container-wrap">
        <main>

            <div class="topper-posts no-topper">
            </div>

            <div class="content">

                <div class="module full-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <h2>How It works ?</h2>
                                <p>
                                   <b>If you want help</b>: Simply <a href="want-help.php">post a request</a> with your phone number and post code. Someone nearby will contact you to help you. You can also <a href="search.php">browse</a> the people who want to help in your neighborhood. 
                                </p>
                                <p><b>If you want to help</b>: Simply <a href="want-help.php">post a request</a> with your phone number and post code. Someone nearby will contact for help. You can also <a href="search.php">browse</a> the people who want help in your neighborhood</p>
                                <p>Provide reviews, comments on users. Report any misconduct by any user via the <a href="contact.php">contact</a> page.</p>
                                <p>That’s’ it.</p>
                                <p><b>Note</b> that your phone number is protected as per the site's privacy law.<br>
                                This Site is made with love and is not made for commercial, unethical or illegal purposes.</p>
                                <p></p>
                                
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>


        <!--
				-->
    <?php include 'includes/footer.php'; ?>

    </div> <!-- #container-wrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.js"></script>
    <script type='text/javascript' src='assets/js/TweenMax.min.js.download'></script>
    <script type='text/javascript' src='assets/js/ScrollMagic.min.js.download'></script>
    <script type='text/javascript' src='assets/js/animation.gsap.min.js.download'></script>
    <script type='text/javascript' src='assets/js/debug.addIndicators.min.js.download'></script>
    <script type='text/javascript' src='assets/js/scripts.min.js.download'></script>
</body>

</html>