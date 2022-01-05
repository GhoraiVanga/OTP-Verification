<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata');
include 'db_connect.php';
//checking new user or not with insert value
if (!isset($_SESSION['last_id'])) 
    {
      header("Location: index.php"); 
      exit(); 
    }
  //calculate Time Left 
   $date = date('d-m-Y H:i:s');
   $id   = $_SESSION['last_id'];
   $expired_date  = $conn->query("SELECT `otp_expired` FROM `membership` WHERE  `id`='$id' ")->fetch_object()->otp_expired;
   $expired_date_timestamp = strtotime($expired_date);
   $convert_date = date('d-m-Y H:i:s', $expired_date_timestamp);
    if($date <=  $convert_date )
     {
          $date1 = date_create($date);
          $date2 = date_create($convert_date);
          $diff = date_diff($date1,$date2);
          $minutes = 60* ($diff->i);
          $seconds =  $minutes + ( $diff ->s);
     }
   else {
          unset($_SESSION['last_id']);
          header("Location: index.php"); 
          
        }
  
  
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hosla</title>
    <!-- google-fonts -->
    <link href="//fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- //google-fonts -->
    <!-- Template CSS Style link -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="assets/images/logo.png" rel="icon">
    <link href="assets/images/logo.png" rel="apple-touch-icon">
    <style>

video {
  object-fit: fill;
}
</style>
   
</head>

<body>
    <!--header-->
   <header id="site-header" class="fixed-top">
        <div class="container">
             <?php  include "nav.php"  ?>
            
        </div>
    </header>
    <!--//header-->
    
         <section class="w3l-features-7 py-5">
  <div class="container py-md-5 py-4">
            <div class="title-heading-w3 mx-auto text-center mb-5 pb-xl-4">
                <h3 class="title-main"> OTP Verification </h3>
            </div>
            <!--  Count Down Timer Start From Here  -->
            <div class="timer">
                      <div class="time text-muted">
                        Time left: <span id="time">Loading...</span>
                      </div>
            </div>
    
            <!-- Count Down Start End Here    -->
    
    
            <div class="row features-top">
                         <div class="col-lg-12 col-sm-12 col-md-12  ">
                            <div class="features-top-left ">
                                <form class="form-inline"  id="membership-form">
                                             <div class="form-group mx-sm-3 mb-2">
                                                <label for="inputPassword6">OTP</label>
                                                <input type="number" id="otp"  name="otp" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                                                <small id="passwordHelpInline" class="text-muted">
                                                  Must be 6 Digit long.
                                                </small>
                                              </div>
                                         <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                </form>
                            </div>
                         </div>
            </div>
            
</div>
    </section>  
   <?php  include "footer.php"   ?>
   
   
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fas fa-level-up-alt" aria-hidden="true"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- //move top -->

    <!-- common jquery plugin -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- //common jquery plugin -->

    <!-- theme switch js (light and dark)-->
    <script src="assets/js/theme-change.js"></script>
    <script>
        function autoType(elementClass, typingSpeed) {
            var thhis = $(elementClass);
            thhis.css({
                "position": "relative",
                "display": "inline-block"
            });
            thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
            thhis = thhis.find(".text-js");
            var text = thhis.text().trim().split('');
            var amntOfChars = text.length;
            var newString = "";
            thhis.text("|");
            setTimeout(function () {
                thhis.css("opacity", 1);
                thhis.prev().removeAttr("style");
                thhis.text("");
                for (var i = 0; i < amntOfChars; i++) {
                    (function (i, char) {
                        setTimeout(function () {
                            newString += char;
                            thhis.text(newString);
                        }, i * typingSpeed);
                    })(i + 1, text[i]);
                }
            }, 1500);
        }

        $(document).ready(function () {
            // Now to start autoTyping just call the autoType function with the 
            // class of outer div
            // The second paramter is the speed between each letter is typed.   
            autoType(".type-js", 200);
        });
    </script>
    <!-- //theme switch js (light and dark)-->

    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!--bootstrap-->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/notiflix-2.7.0.min.js" ></script>
<script src="assets/js/notiflix-aio-2.7.0.min.js" ></script>

<!-- Notiflix CSS -->

<link rel="stylesheet" href="assets/css/notiflix-2.7.0.min.css">   
<script>
 $('#membership-form').submit(function(e){
        e.preventDefault()
         var otp = $('#otp').val();
         if(otp == '')
          {
            Notiflix.Report.Failure( 'Failure', 'Input  OTP', 'Click' ); 
            return false;
          }
        else if(otp.toString().length == 5)
        {
             Notiflix.Report.Failure( 'Six Digit', 'OTP MUST BE SIX DIGIT', 'Click' ); 
             return false;
        }

        //start_load()
        Notiflix.Loading.Dots('Processing...');
     $('#msg').html('')
        $.ajax({
            url:'ajax.php?action=OTP_MEMBERSHIP',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp==1){
                   // toastr.success("Data successfully saved.")
                   Notiflix.Notify.Success("otp verified successfully");

                        setTimeout(function(){
                            window.location="connect.php"
                            
                            },1000)
                }else if(resp == 2){
                     Notiflix.Report.Warning( 'Wrong OTP', 'You Type Wrong Type', 'Click' );
                     Notiflix.Loading.Remove();

                }  
                
                else if(resp == 3){
                     Notify.Failure('The OTP expired');
                     Notiflix.Loading.Remove();

                }   
            }
        })
    })
</script>

<script>
var time = <?=$seconds;?>;
setInterval(function() {
  var seconds = time % 60;
  var minutes = (time - seconds) / 60;
  if (seconds.toString().length == 1) {
    seconds = "0" + seconds;
  }
  if (minutes.toString().length == 1) {
    minutes = "0" + minutes;
  }
  document.getElementById("time").innerHTML = minutes + ":" + seconds;
  time--;
  if (time == 0) {
    window.location.href = "membership.php";
  }
}, 1000);
</script>




    
</body>

</html>