<?php
ob_start();
session_start();

//If user log in then this page will not working
if (isset($_SESSION['login_id'])) 
    {
       header("Location: index.php"); 
      exit(); 
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

    
    
    <!-- inner banner -->
    <section class="inner-banner">
        <div class="w3l-breadcrumb py-5">
            <div class="container py-xl-5 py-md-4 mt-5">
                <h4 class="inner-text-title font-weight-bold mb-sm-2 pt-5">Hosla Membership</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><span class="fa fa-chevron-right mx-2" aria-hidden="true"></span>Hosla Membership</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->



    <!-- services -->
       <section class="w3l-features-7 py-5">
        <div class="container py-md-5 py-4">
            <div class="title-heading-w3 mx-auto text-center mb-5 pb-xl-4">
                <h3 class="title-main"> Hosla Membership Form </h3>
            </div>
            
            <div align="justify"> Call Hosla <a href="tel:+91 7811009309">+91 7811 009 309</a> to take care of you as extended family member.<br>
            ভরসা রাখুন, যেকোনো প্রয়োজনে পাশে থাকবে Hosla. আমাদের কোনো Delivery / Service চার্জ নেই|<br>
            Please note, there is no (hidden) charges for Hosla. We believe and thrive only on trust through quality service.<br>
            For more details please connect with founding team (<a href="tel:+91 7811009309">+91 7811 009 309</a>).
            </div>
            <br><br>
            <div class="row features-top ">
                         <div class="col-lg-12 col-sm-12 col-md-12  ">
                           <div class="features-top-left ">
                           <form id="membership-form">
                                
                                    <div class="form-group">
                                            <label for="inputAddress">Name *</label>
                                            <input type="text" class="form-control" id="name" placeholder="Your Name" name="name">
                                          </div>
                                          <div class="form-group">
                                            <label for="inputAddress2">Mobile / WhatsApp Number * </label>
                                            <input type="number" class="form-control" id="mobile" placeholder="Mobile / WhatsApp Number" name="mobile">
                                          </div>
                                        
                                          <div class="form-group">
                                            <label for="inputAddress2">Address *</label>
                                            <input type="text" class="form-control" id="address" placeholder="Your Address" name="address">
                                          </div>
                                        
                                         <div class="form-group">
                                            <label for="inputAddress2">Why do you want to be Hosla member? &nbsp;||  আপনি কি কি সার্ভিস এর জন্য Hosla-র মেম্বার হতে চান? </label>
                                            <input type="text" class="form-control" id="resaon" placeholder="Reason" name="resaon">
                                          </div>
                                        
                                        
                                          <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                            </div>
                            </div>
                            
                             </div>
            
        </div>
    </section>



    <!-- bg with video icon -->
    <section class="w3l-covers-14 py-5">
        <div class="container py-md-5 py-4">
            <div class="banner-play-w3 covers14-text text-center mx-auto py-lg-5" style="max-width:780px">
                <h4>We Are Here To Manage
                    Quality Consulting Service</h4>
            </div>
        </div>
    </section>
    <!-- //bg with video icon -->



    <!-- footer -->
<?php  include "footer.php"   ?>
    <!-- //footer -->

    <!-- Js scripts -->
    <!-- move top -->
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
    <!-- //bootstrap-->
    <!-- //Js scripts -->
    
    
    
       
<!-- notiflix js  -->
<script src="assets/js/notiflix-2.7.0.min.js" ></script>
<script src="assets/js/notiflix-aio-2.7.0.min.js" ></script>

<!-- Notiflix CSS -->

<link rel="stylesheet" href="assets/css/notiflix-2.7.0.min.css">   
    <script>
 $('#membership-form').submit(function(e){
        e.preventDefault()

         var name = $('#name').val();
         var mobile = $('#mobile').val();
         var address = $('#address').val();
         var phoneNo = document.getElementById('mobile');
         if(mobile == '' || name == '' || address == ''  )
        {
        //notificationme(); 
        //toastr.error("please Fill up");
        Notiflix.Report.Failure( 'Failure', 'Please Input Mobile and Name and Address', 'Click' ); 
           return false;
        }
        else if(phoneNo.value == "" || phoneNo.value == null)
        {
           Notiflix.Report.Failure( 'Failure', 'Please enter your Mobile No.', 'Click' ); 
           return false;
        }
        else if ((phoneNo.value.length < 10 || phoneNo.value.length > 10))
        {
              Notiflix.Report.Failure( 'Failure', 'Mobile No. is not valid, Please Enter 10 Digit Mobile No.', 'Click' ); 
              return false;
        }
    
        //start_load()
        Notiflix.Loading.Dots('Processing...');
       $('#msg').html('')
        $.ajax({
            url:'ajax.php?action=new_membership',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp==1){
                   // toastr.success("Data successfully saved.")
                   Notiflix.Notify.Success("OTP Send To your Mobile Number");

                        setTimeout(function(){
                           // window.location="connect.php"
                            window.location="otp_check.php"
                            },1000)
                }else if(resp == 2){
                    Notiflix.Report.Warning( ' Warning', 'This Mobile Number has a two Membership', 'Click' );
                    Notiflix.Loading.Remove();

                }
                
                else if(resp == 3){
                    Notiflix.Report.Success( 'OTP', 'OTP already Sent ', 'Verify',  function cb() {
                    //page redirect after View order
	               window.location ="otp_check.php"
                     }); 
                   // Notiflix.Report.Warning( ' Warning', 'This Mobile Number has a two Membership', 'Click' );
                    Notiflix.Loading.Remove();

                }
            }
        })
    })


</script>
    
  
</body>

</html>