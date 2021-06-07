<?php
session_start();
?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Terms</title>
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
                                
                                <h2>Terms</h2>
                                <p><strong>In case of Emergency</strong>
                                <br>We try our best through our Site and community users to help you but We are unable to guarantee services to 
                                meet your emergency requirements. We require you to contact your local emergency support or law enforcement 
                                authority in emergency and life threatening circumstances.
                                </p>
                                <p><strong>Anti-Money Laundering</strong>
                                <br>Users are encouraged to help people in the neighborhood. We disallow users to engage with, transact with, donate to or travel to users in another
                                state or country. This is in compliance to pandemic health guides and AML laws.
                                </p>
                                <p><strong>Transactional Liability</strong>
                                <br>Website and its owner do not accept or receive donation or money or transaction information or cannot 
                                act as a middleman between your monetary engagement or transactions. Therefore, the website does not 
                                assume any responsibility of any transaction that you do. We however, ask you to report any
                                misconduct or fradulent activity to contact@carentine.com.
                                </p>
                                <p><strong>Rule of Engagements</strong>:<br>
                                <ul>
                                <li>The website restricts a user to engage with up to 10 other users. </li>
                                <li>The website restricts any user to post a maximum of 10 requests.</li>
                                <li>The website restricts a user and its IP or digital identity to allow up to 05 invalid 
                                phone verification attempts.</li>
                                </ul>
                                </p>
                                <p><strong>Privacy Policy</strong>
                                <br>This Privacy Policy explains how information about you is collected, used and disclosed in connection with your use of this site ("Carentine", “Site”, “we,” or “us”).</p>
                                <p>We may change this Privacy Policy from time to time. We encourage you to review this page whenever you access the Site.</p>

                                <p><strong>Information You Provide to Us</strong></p>
                                <p>We collect information you provide directly to us. For example, we collect information if you fill out a form, request information or otherwise communicate with us. The types of information we collect may include your contact information, address and other information you choose to provide.</p>
                                <p>When you access or use our Site, we automatically collect information about you, including:</p>
                                <ul>
                                    <li><strong>Log Information: </strong>We log information about your use of the Site, including the type of browser you use, access times, pages viewed, your IP address and the page you visited before navigating to our Site.</li>
                                    <li><strong>Device Information:</strong>We may collect information about the computer or mobile device you use to access our Site, including the hardware model, operating system and version, device identifiers and mobile network information.</li>
                                    <li><strong>Cookies:</strong>We use various technologies to collect information, and this may include sending cookies to your computer or mobile device. Cookies are small data files stored on your hard drive or in device memory that helps us to improve our Site and your experience, see which areas and features of our Site are popular and count visits.</li>
                                </ul>

                                <p><strong>Your information is used to</strong>:</p>
                                <ul>
                                    <li>Provide the services expected by you and users</li>
                                    <li>Provide, maintain and improve our Site</li>
                                    <li>Send you support services and administrative messages</li>
                                    <li>Provide and deliver the information you request</li>
                                    <li>Respond to your emails, comments, questions</li>
                                </ul>
                                <p>Carentine is initiated and based in Australia and is governed by the Australian law.</p>
                                <p><strong>Sharing of your information</strong><br>
                                We only share your information with other users after applying due dilligence and verification of users' identity. We
                                apply digital monitoring on our Site about users' information sharing, consumption and pattern. We restrict users in case of 
                                any misconduct or abnormal use. We ask you to report any user for misconduct to contact@carentine.com. We, however, do not have any 
                                control over your actions, transactions or information that happen between users outside our Site. We require you to act or engage responsibly
                                with other users off the site.
                                </p>
                                <p><strong>Last Updated: June 8, 2020</strong></p>
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
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm your Phone number</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="verifycode">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="alert alert-success">
                                        Please enter the verification code we have sent you on your phone number.
                                    </div>
                                    <input required name="code" type="number" id="code" class="form-control" placeholder="Enter verification code">
                                </div>
                                <button type="submit" id="submitcodebtn" class="btn btn-sm" style="width:30%;background:#1dbf73">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.js"></script>
    <script type='text/javascript' src='assets/js/TweenMax.min.js.download'></script>
    <script type='text/javascript' src='assets/js/ScrollMagic.min.js.download'></script>
    <script type='text/javascript' src='assets/js/animation.gsap.min.js.download'></script>
    <script type='text/javascript' src='assets/js/debug.addIndicators.min.js.download'></script>
    <script type='text/javascript' src='assets/js/scripts.min.js.download'></script>
</body>

</html>