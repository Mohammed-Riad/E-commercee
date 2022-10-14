
<?php require_once("../connection.php");?>
<?php require_once("../");?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="icon" type="image/png" href="Images/carts.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   
    <a class='back-to-top-btn float-right' id="scroll-btn" role='button' aria-label='back to top button'>
        <img src="Images/up-green.png" alt="goto top" role="icon" aria-label='back to top image'>
    </a>

    <!-- Start of FAQ section -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-3">
            <li class="breadcrumb-item"><a class='text-dark text-decoration-none' href="index.html">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a class='active text-decoration-none'
                    href="#">FAQ</a></li>
        </ol>
    </nav>

    <div class="main-container2">
        <aside class='left-main-container'>
            <div class="issue-type">
                <h5 class="mb-4">TYPE OF ISSUE</h5>
                <p>Help with your Issues</p>
                <p>Help with your Order</p>
                <p>Help with other Issues</p>
            </div>
            <div class="help-topics mt-lg-3">
                <h5 class="mb-4">HELP TOPICS</h5>
                <p>Order wintter</p>
                <p>Order Status</p>
                <p>Order date</p>
                <p>Payment Mode</p>
                <p>Shopping</p>
                <p>Delivery Options</p>
                <p>Return Policy</p>
                <p>Wallet</p>
                <p>Cancellations</p>
                <p>Other</p>
            </div>
        </aside>
        <div class="right-main-container">
            <h4>HELP WITH YOUR ORDER</h4>
            <div class="accordion mt-4" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                            <button type="button" class="btn btn-block text-left d-flex flex-row-reverse align-items-center justify-content-between collapsed" data-toggle="collapse" data-target="#collapseOne"><i
                                    class="fa fa-plus"></i> Do I need to create an
                                    account in order to shop with
                                    you?</button>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p>Yes, you need to create an account. But you can browse as a guest every time
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                            <button type="button" class="btn btn-block text-left d-flex flex-row-reverse align-items-center justify-content-between collapsed" data-toggle="collapse"
                                data-target="#collapseTwo"><i class="fa fa-plus"></i> How do I create an account?</button>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <p> It's as simple as clicking the sign in button which opens up a modal
                                containing a create account tab. Fill your details and enter create account and that's it!</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                            <button type="button" class="btn btn-block text-left d-flex flex-row-reverse align-items-center justify-content-between collapsed" data-toggle="collapse"
                                data-target="#collapseThree"><i class="fa fa-plus"></i> How do I order?</button>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <p>It is very easy, but only in entering the order information such as the desired quantity and the discount coupon in case, and the address and phone number to contact you later
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                            <button type="button" class="btn btn-block text-left d-flex flex-row-reverse align-items-center justify-content-between collapsed" data-toggle="collapse"
                                data-target="#collapseFour"><i class="fa fa-plus"></i> I have problems adding items to my
                                shopping cart</button>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <p> Kindly contact our customer care executive from 9Am to 9PM on all days or email us on customer.dreem@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                            <button type="button" class="btn btn-block text-left d-flex flex-row-reverse align-items-center justify-content-between collapsed" data-toggle="collapse"
                                data-target="#collapseFive"><i class="fa fa-plus"></i> I have not receieved my order yet. Who can I contact about this?</button>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <p> If you wish to initiate the return and refund process, you can do so by contacting our Customer Service Officer from 9 am to 9 pm on all days or email us at customer.dreem@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                            <button type="button" class="btn btn-block text-left d-flex flex-row-reverse align-items-center justify-content-between collapsed" data-toggle="collapse"
                                data-target="#collapseSix"><i class="fa fa-plus"></i> I want to return a product and get refund. What is the procedure? </button>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <p> Your order status will be visible in our track order page. If you have want to initiate a return and refund, you can do that in the my orders page. If you have any issues, kindly contact our customer care executive from 9Am to 9PM on all days or email us on customer.dreem@gmail.com.in
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Start of Payment and Help -->

    <section class='payment-help mt-5' aria-label='payments and help section'>
        <div class="container-fluid w-75">
            <div class="row">
                <div
                    class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="Images/secure-pay.png" alt="securepay" role="img" aria-label='secure pay image'>
                    <h2>free delivery</h2>
                    <p>Free delivery for our special customers</p>
                </div>
                <div
                    class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="Images/trust-pay.png" alt="trustpay" role="img" aria-label='trust pay image'>
                    <h2>TRUST PAY</h2>
                    <p>The safest way to pay and get a tax exemption for submitting an order</p>
                </div>
                <div
                    class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="Images/help-center.png" alt="helpcenter" role="img" aria-label='help center image'>
                    <h2>HELP CENTER</h2>
                    <p>Get fast technical support at all times</p>
                </div>
                <div
                    class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="Images/shop-on-go.png" alt="shopongo" role="img" aria-label='shop on go image'>
                    <h2>SHOP ON THE GO</h2>
                    <p>Shop freely and get the best benefits in terms of convenience and ease, in addition to tax exemptions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- End of Payments and Help -->
    
    <!-- Start of Footer -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="Javascript/index.js"></script>
    <script src="Javascript/jQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script>
        window.onload = function () {
            cart_num = JSON.parse(localStorage.getItem("Products_IDs")).length;
            document.querySelector('#cart-badge').innerHTML = cart_num;
            wishlist_num = JSON.parse(localStorage.getItem("Wishlist_IDs")).length;
            document.querySelector('#wishlist-badge').innerHTML = wishlist_num;
        }
    </script>
    <br><br><br>
            <?php require_once("../footer.php");?> 

</body>
</html>