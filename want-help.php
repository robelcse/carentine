<?php
session_start();
include 'db.php';
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $suburb = $_POST['suburb'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $emergency = $_POST['emergency'];
    $description = $_POST['description'];
    $post_type = 'wanthelp';
    $user_type = 'seller';
    $time = date('Y-m-d H:i');
    $stmt = $sql->prepare("select * from users where phone=?");
    $stmt->bindParam(1, $phone, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    if($stmt->rowCount()==0){
        $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">Your phone number is not verified.</div>';
    }elseif($stmt->rowCount()==1 && $row['type']=='buyer'){
        $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">This phone number is registered to help others.</div>';
    }else{
        $status = 'closed';
        $stmt = $sql->prepare("select * from posts where phone=? AND status!=?");
        $stmt->bindParam(1, $phone, PDO::PARAM_STR);
        $stmt->bindParam(2, $status, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if($stmt->rowCount()>=10){
            $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">Sorry, You can only have 10 open posts at a time.</div>';
        }else{
            $userid = $_SESSION['userid'];
            $query = "INSERT into posts (emergency, phone, user_type, post_type, address, suburb, postcode, state, description, time, userid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(1, $emergency, PDO::PARAM_STR);
            $stmt->bindParam(2, $phone, PDO::PARAM_STR);
            $stmt->bindParam(3, $user_type, PDO::PARAM_STR);
            $stmt->bindParam(4, $post_type, PDO::PARAM_STR);
            $stmt->bindParam(5, $address, PDO::PARAM_STR);
            $stmt->bindParam(6, $suburb, PDO::PARAM_STR);
            $stmt->bindParam(7, $postcode, PDO::PARAM_STR);
            $stmt->bindParam(8, $state, PDO::PARAM_STR);
            $stmt->bindParam(9, $description, PDO::PARAM_STR);
            $stmt->bindParam(10, $time, PDO::PARAM_STR);
            $stmt->bindParam(11, $userid, PDO::PARAM_INT);

            $stmt->execute();
            $msg = '<div class="alert alert-success" style="background:green;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">Your request has been posted.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html class="js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Want help - Carentine</title>
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
        
        .form-group{
            margin-bottom: 25px !important;
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
                        <div class="row" style="margin-bottom:0">
                            <div class="col-xs-12 col-md-8">
                                <?php if(isset($msg)){ echo $msg; } ?>
                                <h1>Want Help</h1>
                                <p>Post a new request. <br><span class="browsepeople" style="font-size:15px;text-decoration:underline"><a href="search.php">Browse people who want to help</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="module contact-block">
                    <div class="container">

                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                               
                                <div class="contact-area" style="padding:20px">
                                    <form method="post" id="request-form" action="">
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Enter phone number*</label>
                                            <input id="phone" required name="phone" type="text" placeholder="Example: 0499999999" class="form-control numeric">
                                        </div>
                                        
                                        <div class="form-group">
                                           <label for="" style="font-size:18px">Enter Address</label>
                                            <input id="" name="address" type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                           <label for="" style="font-size:18px">Enter Suburb</label>
                                            <input id="" name="suburb" type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                           <label for="" style="font-size:18px">Enter Postcode*</label>
                                            <input id="" required name="postcode" type="text" placeholder="" class="numeric form-control">
                                        </div>
                                        <div class="form-group">
                                           <label for="" style="font-size:18px">Select State*</label>
                                            <select required name="state" class="" id="">
                                               <option value="">Select</option>
                                                <?php
                                                $stmt = $sql->prepare("select * from states order by name asc");
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row){
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="margin-top: 70px;">
                                            <label for="" style="font-size:18px">Is this an emergency?</label>
                                            <select name="emergency" class="" id="">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group" style="margin-top:70px">
                                            <label for="" style="font-size:18px;">Description</label>
                                            <textarea name="description" id="" cols="30" rows="10" placeholder="Enter Description" ></textarea>
                                        </div>
                                        <div class="form-group"  style="margin-top:170px">
                                            <div id="phoneerror" class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px;display:none">Please enter correct phone number.</div>
                                            <center><button type="submit" name="postrequest" id="submitbtn" style='max-width:100%;height:50px;background:#1dbf73;border-color:#1dbf73' class="btn btn-primary">Post Request</button></center>
                                        </div>
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
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm your phone number</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="verifycode">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                   <div id="msg">
                                    
                                    </div>
                                    <input required name="code" type="text" id="code" class="numeric form-control" placeholder="Enter the PIN number">
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
    <script>
    
        
        
    var success = 0;
    jQuery(function($) {
        $("#request-form").on('submit', function(e) {
            var phone = $('#phone').val();
            if(phone.length != 10){
                $("#phoneerror").show();
                return false;
            }
            if(success == 0){
                $("#submitbtn").html('Please wait...');
                $("#submitbtn").prop('disabled', true);
                e.preventDefault();
                setTimeout(function(){
                    $.ajax({
                        type:"POST",
                        url:'verify-phone.php',
                        data:{ phone:$('#phone').val() },
                        success: function(response){
                            $("#submitbtn").html('Post Request');
                            $("#submitbtn").prop('disabled', false);
                            var data = JSON.parse(response);
                            if(data.phone_exists==1){
                                success = 1;
                                $("#request-form").submit();
                            }else{
                                $("#msg").html('<div class="alert alert-success">Please enter the PIN that we have sent to your phone.</div>');
                                $("#code").val("");
                                $("#myModal").modal('show');
                            }
                        }
                    });
                }, 1000);
            }
        });

        $("#verifycode").on('submit', function(e){
            e.preventDefault();
            $("#submitcodebtn").html('Verifying...');
            var data = $(this).serialize();
            setTimeout(function(){
                $.ajax({
                    type:"POST",
                    url:'verify-phone.php',
                    data:data,
                    success: function(response){
                        $("#submitcodebtn").html('Submit');
                        var data = JSON.parse(response);
                        console.log(data);
                        if(data.error==0){
                            success = 1;
                            $("#request-form").submit();
                        }else{
                            $("#msg").html(data.message);
                        }
                    }
                });
            }, 1000);
        });
    });
        
        
       jQuery(document).on("input", ".numeric", function() {
            this.value = this.value.replace(/\D/g,'');
        });
    </script>
</body>

</html>