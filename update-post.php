<?php
session_start();
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $sql->prepare("select * from posts where id=?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()==0){
        header("location:index.php");
    }
    $postdata = $stmt->fetch();
}else{
    header("location:index.php");
}


if(isset($_POST['password'])){
    $address = $_POST['address'];
    $suburb = $_POST['suburb'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $status = $_POST['status'];
   
    $emergency = $_POST['emergency'];
    $description = $_POST['description'];
    $post_type = 'wanthelp';
    $user_type = 'seller';
    $time = date('Y-m-d H:i');
    $password = $_POST['password'];
    $stmt = $sql->prepare("select * from users where phone=? AND password=?");
    $stmt->bindParam(1, $postdata['phone'], PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    
    if($stmt->rowCount()==0){
        $msg = '<div class="alert alert-danger" style="background:red;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">You have entered an incorrect PIN.</div>';
    }else{
        $user = $stmt->fetch();
        $userid = $user['id'];
        $query = "update posts set status=?, emergency=?, address=?, suburb=?, postcode=?, state=?, description=? where id=?";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $status, PDO::PARAM_STR);
        $stmt->bindParam(2, $emergency, PDO::PARAM_STR);
        $stmt->bindParam(3, $address, PDO::PARAM_STR);
        $stmt->bindParam(4, $suburb, PDO::PARAM_STR);
        $stmt->bindParam(5, $postcode, PDO::PARAM_STR);
        $stmt->bindParam(6, $state, PDO::PARAM_STR);
        $stmt->bindParam(7, $description, PDO::PARAM_STR);
        $stmt->bindParam(8, $id, PDO::PARAM_STR);
        $stmt->execute();
        $msg = '<div class="alert alert-success" style="background:green;padding:15px;color:white;margin-bottom:15px;font-size:20px;border-radius:5px">Your post has been updated.</div>';
    }
}

function getNewPostData($id){
    global $sql;
    $stmt = $sql->prepare("select * from posts where id=?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

$postdata = getNewPostData($id);

?>
<!DOCTYPE html>
<html class="js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Post - Carentine</title>
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
                                <?php if(isset($msg)){ echo $msg; } ?>
                                <h1>Update Post</h1>
                                <a href="view-request.php?id=<?php echo $id; ?>">View Post</a>
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
                                           <label for="" style="margin-right:10px" class="statuscheck">Status: </label>
                                           <label style="padding-left:25px" class="statuscheck">
                                               <input <?php if($postdata['status']=='open'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="status" value="open">

                                               <span class="outside">
                                                   <span class="inside"></span>
                                               </span>
                                               Open
                                           </label>
                                           <label style="padding-left:25px;margin-left:15px" class="statuscheck">
                                               <input <?php if($postdata['status']=='inprogress'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="status" value="inprogress">
                                               <span class="outside">
                                                   <span class="inside"></span>
                                               </span>
                                               In Progress
                                           </label>
                                           <label style="padding-left:25px;margin-left:15px" class="statuscheck">
                                               <input <?php if($postdata['status']=='closed'){ echo 'checked'; } ?> type="radio" class="radio-inline" name="status" value="closed">
                                               <span class="outside">
                                                   <span class="inside"></span>
                                               </span>
                                               Closed
                                           </label>
                                       </div>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Phone number</label>
                                            <input type="text" readonly value="<?php echo $postdata['phone']; ?>" class="form-control">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Address</label>
                                            <input id="" name="address" type="text" placeholder="Enter Address" class="form-control" value="<?php echo $postdata['address']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Suburb</label>
                                            <input id="" name="suburb" type="text" placeholder="Enter Suburb" class="form-control" value="<?php echo $postdata['suburb']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Postcode*</label>
                                            <input id="" required name="postcode" type="text" placeholder="Enter Postcode*" class="form-control" value="<?php echo $postdata['postcode']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">State*</label>
                                            <select required name="state" class="" id="" style="margin-bottom:15px">
                                               <option value="">Select</option>
                                                <?php
                                                $stmt = $sql->prepare("select * from states order by name asc");
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach($result as $row){
                                                ?>
                                                <option <?php if($postdata['state']==$row['id']) echo 'selected'; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Description</label>
                                            <textarea name="description" id="" cols="30" rows="10" placeholder="Enter Description"><?php echo $postdata['description']; ?></textarea>
                                        </div>
                                        <?php if($postdata['post_type']=='wanthelp'){ ?>
                                        <label for="" style="font-size:18px">Is this an emergency?</label>
                                        <select name="emergency" class="" id="" style="margin-bottom:15px">
                                            <option value="">Is that an emergency?</option>
                                            <option <?php if($postdata['emergency']==1) echo 'selected'; ?> value="1">Yes</option>
                                            <option <?php if($postdata['emergency']==0) echo 'selected'; ?> value="0">No</option>
                                        </select>
                                        <?php }else{ ?>
                                        <input type="hidden" value="" name="emergency">
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="" style="font-size:18px">Enter PIN Number*</label>
                                            <input id="" required name="password" type="text" placeholder="" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <center><button type="submit" name="postrequest" id="" style='margin-top:15px;max-width:100%;height:50px;background:#1dbf73;border-color:#1dbf73' class="btn btn-primary">Update Post</button></center>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bottom-share">
                    <div class="social links">
                        <span>Share</span>
                        <ul>
                            <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=https://www.hillaryclinton.com/contact/&t=Contact" class="social-pop"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                            <li class="twitter"><a href="http://twitter.com/intent/tweet?text=Contact+-+https%3A%2F%2Fwww.hillaryclinton.com%2F%3Fp%3D740+via+%40WideEyeDev" class="social-pop"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                            <li class="email"><a href="#" class="addthis_button_email" addthis:title="Contact - The Office of Hillary Rodham Clinton" addthis:url="https://www.hillaryclinton.com/contact/"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                        </ul>
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
                                    <div class="alert alert-success">
                                        Please enter the verification PIN we have sent you to your phone.
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