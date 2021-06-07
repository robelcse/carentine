<?php
session_start();
?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Who Am I?</title>
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
                                <h2>Who Am I ?</h2>
                                <p>
                                    I lost my mother to Coronavirus on 23 Apr 2020 4:30pm. Trust me you’d know the pain only If you lost your mother. This project is a dedication to my mother and I know she is watching. 
                                </p>
                                <p>People lost jobs, children lost education, families lost homes. Some even don’t have enough food. Some are sleeping on the street. Please help them.</p>
                                <p>Give a toy to a kid. Give food to a poor man. Drive an ill woman to a hospital. Help a jobless man. Or just talk to a depressed person. Help in any way you can. Please help. <a href="how-it-works.php">Please read how it works</a></p>
                                <p>Take Care, <br>Me</p>
                                
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