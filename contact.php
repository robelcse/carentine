<?php
session_start();
?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact Us</title>
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

            .modal {
                top: 30%;
            }

            .statuscheck {
                display: flex;
                margin-left: 0 !important;
            }

        }

        textarea {
            margin-bottom: 15px;
        }

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

        .row {
            margin-bottom: 30px;
        }

        body {
            padding-right: 0 !important
        }

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
                                <h2>Contact Us</h2>
                                <div class="contact-area" style="">
	        					    <div class="alert alert-success" style="background:green;padding:20px;color:white;margin-bottom:15px;display:none">
    	        				        <center>Thanks. Your message has been sent.</center>
    	        				    </div>
    	        				     <form method="post" id="contact-form">
    	        						<div class="form-group">
    	        						    <input id="name" required name="name" type="text" placeholder="Enter your name" class="form-control">
    	        						</div>
    	        						<div class="form-group">
    	        						    <input id="email" required name="email" type="email" placeholder="Enter your email">
    	        						</div>
    	        						<div class="form-group">
    	        						    <textarea required name="message" id="message" cols="30" rows="10" placeholder="Enter your message"></textarea>
    	        						</div>
    	        						 <br>
    	        						<button id="send-message-btn" class="btn btn-sm" style="width:100%;background:#1dbf73;border-color:#1dbf73;height:50px">Submit</button>
	        						</form>
	        					</div>
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
    <script>
    jQuery(function($){
        $("#contact-form").on('submit', function(e){
            e.preventDefault();
            $("#send-message-btn").html('Sending....');
            $.ajax({
                type: "POST",
                url: "send-message.php",
                data: {email:$('#email').val(), name:$('#name').val(), message:$('#message').val()},
                success: function(data) {
                    $("#contact-form").hide();
                    $(".alert-success").show();
                    $("#send-message-btn").html('Send Message');
                }
            });
        });
    });
    </script>
</body>
</html>