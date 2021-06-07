<?php
session_start();
include 'db.php';
if(isset($_GET['post-id'])){
    $postid = $_GET['post-id'];
    $stmt = $sql->prepare("select * from posts where id='$postid'");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()==0){
        header("location:index.php");
    }
    $postdata = $stmt->fetch();
}else{
    header("location:index.php");
}


if(isset($_POST['submit'])){
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $phone = $_POST['phone'];
    $posttype = $postdata['post_type'];
    if($posttype=='wanttohelp'){
        $helper_phone = $postdata['phone'];
        $helpee_phone = $phone;
    }else{
        $helper_phone = $phone;
        $helpee_phone = $postdata['phone'];
    }
    $stmt = $sql->prepare("select * from helper_helpee where (helper_phone=? AND helpee_phone=?) OR (helper_phone=? AND helpee_phone=?)");
    $stmt->bindParam(1, $helper_phone, PDO::PARAM_STR);
    $stmt->bindParam(2, $helpee_phone, PDO::PARAM_STR);
    $stmt->bindParam(3, $helpee_phone, PDO::PARAM_STR);
    $stmt->bindParam(4, $helper_phone, PDO::PARAM_STR);
    $stmt->execute();
    
    if($postdata['phone']==$phone){
        $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">You can\'t rate your own post.</div>';
    }elseif($stmt->rowCount()==0){
        $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">You didn\'t submit your phone number to rate this post.</div>';
    }else{
        
        $stmt = $sql->prepare("select * from ratings where reviewer_phone=? and postid=?");
        $stmt->bindParam(1, $phone, PDO::PARAM_STR);
        $stmt->bindParam(2, $postid, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">You already rated this post.</div>';
        }else{
            $stmt = $sql->prepare("update posts set rated=? where id=?");
            $rated = 1;
            $stmt->bindParam(1, $rated, PDO::PARAM_STR);
            $stmt->bindParam(2, $postid, PDO::PARAM_STR);
            $stmt->execute();

            $stmt = $sql->prepare("insert into ratings (postid, reviewer_phone, rating, comment, postphone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $postid, PDO::PARAM_STR);
            $stmt->bindParam(2, $phone, PDO::PARAM_STR);
            $stmt->bindParam(3, $rating, PDO::PARAM_STR);
            $stmt->bindParam(4, $comment, PDO::PARAM_STR);
            $stmt->bindParam(5, $postdata['phone'], PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['message'] = '<div class="alert alert-danger" style="background:green;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">You rating has been posted.</div>';
            header("location:view-request.php?id=$postid");
            
        }
    }
}


?>
<!DOCTYPE html>
<html class="js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rate Post - Carentine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.css">
    <?php include 'includes/head.php'; ?>
    <link rel="stylesheet" href="assets/css/jquery.rateyo.min.css">
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
                                <h1>Rate Post</h1>
                                <p><span class="browsepeople" style="font-size:15px;text-decoration:underline"><a href="view-request.php?id=<?php echo $postid; ?>">Back to Post</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="module contact-block">
                    <div class="container">
                        <?php if($postdata['status']=='closed'){ ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                               
                                <div class="contact-area" style="padding:20px">
                                   <div class="alert alert-danger" style="display:none" id="error">
                                       Please select rating
                                   </div>
                                    <form method="post" id="rating-form" action="">
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Select Rating*</label>
                                            <div id="rateYo"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                           <label for="" style="font-size:18px">Your comment</label>
                                            <input id="" name="comment" type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Enter phone number*</label>
                                            <input id="phone" required name="phone" type="text" placeholder="Example: 0430174622" class="form-control numeric">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <center><button type="submit" name="submit" id="submitbtn" style='max-width:100%;height:50px;background:#1dbf73;border-color:#1dbf73' class="btn btn-primary">Submit</button></center>
                                        </div>
                                        <input type="hidden" id="rating" name="rating">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <h3 style="color:red">This post is not closed yet.</h3>
                            </div>
                        </div>
                        <?php } ?>
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
                                   <div id="msg">
                                    
                                    </div>
                                    <input required name="code" type="number" id="code" class="numeric form-control" placeholder="Enter verification code">
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
    <script src="assets/js/jquery.rateyo.min.js"></script>
    <script>
        
    jQuery("#rating-form").on('submit', function(){
       if(!jQuery('#rating').val()){
           jQuery("#error").show();
           return false;
       } 
    });
        
    jQuery(function () {
      jQuery("#rateYo").rateYo({
        rating: 0,
        fullStar: true,
        onSet: function (rating, rateYoInstance) {
            jQuery('#rating').val(rating);
        }
      });
    });
    
      jQuery(document).on("input", ".numeric", function() {
            this.value = this.value.replace(/\D/g,'');
        });
    </script>
</body>

</html>