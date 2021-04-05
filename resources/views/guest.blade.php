<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/ico" href="{{ asset('images/favicon.ico') }}"/>

        <title>O & B Services</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

        <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <style>
            .scrollToTopBtn {
                background-color: black;
                border: none;
                border-radius: 50%;
                color: white;
                cursor: pointer;
                font-size: 16px;
                line-height: 48px;
                width: 48px;
                
                /* place it at the bottom right corner */
                position: fixed;
                bottom: 30px;
                right: 30px;
                /* keep it at the top of everything else */
                z-index: 100;
                /* hide with opacity */
                opacity: 0;
                /* also add a translate effect */
                transform: translateY(100px);
                /* and a transition */
                transition: all .5s ease
            }

            .showBtn {
                opacity: 1;
                transform: translateY(0)
            }
        </style>
    </head>
    <body data-spy="scroll" data-target="#ftco-navbar" data-offset="1">
        <div class="wrap">
			<div class="container">
				<div class="row justify-content-between">
                    <div class="col-12 col-md d-flex align-items-center">
                        <p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+44 750 1763 143</a> or <span class="mailus">email us:</span> <a href="#">info@oandbservices.com</a></p>
                    </div>
                    <div class="col-12 col-md d-flex justify-content-md-end">
                        <div class="social-media">
                            <p class="mb-0 d-flex">
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            </p>
			            </div>
					</div>
				</div>
			</div>
		</div>

        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	        <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/dashboard-nav-72x72.png') }}" title="O & B Services"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                @if (Route::has('login'))
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        @auth
                        <li class="nav-item "><a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a></li>
                        @else
                        <li class="nav-item "><a href="{{ route('register') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Post a Job">Post a Job</a></li> 
                        <li class="nav-item "><a href="#footer" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="General Merchandise">General Merchandise</a></li> 
                        <li class="nav-item " style="border-left: solid yellow 2px;">
                            <a href="{{ route('login') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Login">
                                Login
                            </a>
                        </li>
                            @if (Route::has('register'))
                            <li class="nav-item "><a href="{{ route('register') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Register">Register</a></li>
                            @endif
                        <li class="nav-item ">
                            <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <!-- <a class="nav-link active" data-toggle="pill" href="#jobs">Jobs</a> -->
                                <a class="nav-link active" data-toggle="tooltip" href="{{ route('handyman-register') }}" data-placement="bottom" 
                                    title="Register as Handy Man" style="background-color: #2A97EF; border-radius:25px; padding:10px 25px; margin-top:20px; color:#ffffff">
                                    Become a Handy Man
                                </a>
                            </li>
                            </ul>
                        </li> 
                        @endauth
                    </ul>
                </div>
                @endif
            </div>
        </nav>
        <!-- END nav -->

        <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/obs_bg1.jpg') }}');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="col-md-6 ftco-animate">
                        <h2 class="subheading">Leave the house chores to us</h2>
                        <h1 class="mb-4">Let us do the dirty work, so you don't have to.</h1>
                        <p><a href="{{ url('/register') }}" class="btn btn-primary mr-md-4 py-2 px-4" data-toggle="tooltip" data-placement="bottom" title="Post a Job">Post a Job <span class="ion-ios-arrow-forward"></span></a></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
        <!-- about us -->
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex no-gutters">
                    <div class="col-md-6 d-flex">
                        <div class="img d-flex align-items-center justify-content-center py-5 py-md-0" style="background-image:url('{{ asset('images/obs_bg2.jpg') }}');">
                            <div class="time-open-wrap">
                                <div class="desc p-4">
                                    <h2>Business Hours</h2>
                            <div class="opening-hours">
                                <h4>Opening Days:</h4>
                                <p class="pl-3">
                                    <span><strong>Monday – Friday:</strong> 9am to 6pm</span>
                                    <span><strong>Saturday :</strong> 9am to 4pm</span>
                                </p>
                                <h4>Vacations:</h4>
                                <p class="pl-3">
                                    <span>All Sundays</span>
                                    <span>All Bank Holidays</span>
                                </p>
                            </div>
                                </div>
                                    <div class="desc p-4 bg-secondary">
                                        <h3 class="heading">For Emergency Cases</h3>
                                        <span class="phone">+44 750 1763 143</span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5 pt-md-5">
                        <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading">Welcome to O & B Services</span>
                            <h2 class="mb-4">Let's take care of your chores</h2>
                            <p>Need a handy man to do your chores?<br>We have got you covered by building a service that can take care of your house chores leaving you with no worries.</p>
                            <p>We have skilled workers with cscs card.</p>
                        </div>
                    </div>
                    <div class="row  py-5" id="section-counter">
                        <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 ftco-counter" style="padding: 20px">
                                <div class="text">
                                    <strong class="number" data-number="5">0</strong>
                                </div>
                                <div class="text">
                                    <span>Years of <br>Experienced</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="text">
                                    <strong class="number" data-number="2342">0</strong>
                                </div>
                                <div class="text">
                                    <span>Happy <br>Customers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="text">
                                    <strong class="number" data-number="30">0</strong>
                                </div>
                                <div class="text">
                                    <span>Building <br>Cleaned</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- end of about us -->
        
        <!-- how it works section -->
        <section class="ftco-section testimony-section ftco-bg-dark">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
                        <h2>How It Works</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12">
                        <div class="carousel-testimony owl-carousel ftco-owl">
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="text">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="user-img"><span class="material-icons" style="font-size:60px">post_add</span></div>
                                            <div class="pl-3">
                                                <p class="name">Post a Job for Free</p>
                                            </div>
                                        </div>
                                        <p class="mb-1">Talk to us about your home needs, let's help you out.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="text">
                                        <div class="d-flex align-items-center mb-4">
                                        <div class="user-img"><span class="material-icons" style="font-size:60px">how_to_reg</span></div>
                                        <div class="pl-3">
                                            <p class="name">We assign a handy man</p>
                                        </div>
                                    </div>
                                    <p class="mb-1">Once you post a job we will assign a handy man to you.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="text">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="user-img"><span class="material-icons" style="font-size:60px">insert_emoticon</span></div>
                                            <div class="pl-3">
                                                <p class="name">Rate and Review</p>
                                            </div>
                                        </div>
                                        <p class="mb-1">Once your job is completed, leave a feedback.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of how it works section -->

        <!-- our popular jobs -->
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>Our Popular Jobs</h2>
            </div>
            </div>
                <div class="row">
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                    <div class="icon d-flex justify-content-center align-items-center">
                        <!-- <span class="flaticon-pool"></span> -->
                        <span class="material-icons">carpenter</span>
                    </div>
                    <div class="media-body pl-3">
                        <h3 class="heading">Capenter</h3>
                        <p> Need to change your furnitures or fix a bad one. We got you covered. </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                <div class="icon d-flex justify-content-center align-items-center">
                        <!-- <span class="flaticon-pool"></span> -->
                        <span class="material-icons">cleaning_services</span>
                </div>
                <div class="media-body pl-3">
                    <h3 class="heading">Cleaning</h3>
                    <p>Stay away from dirt by hiring our cleaning service. Stay fresh stay clean</p>
                    
                </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                <div class="icon d-flex justify-content-center align-items-center">
                    <!-- <span class="flaticon-rug"></span> -->
                    <span class="material-icons">hail</span>
                </div>
                <div class="media-body pl-3">
                    <h3 class="heading">Labourer</h3>
                    <p>We have skiilled labourers that can do the job for you.</p>
                </div>
                </div> 
            </div>

            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                <div class="icon d-flex justify-content-center align-items-center">
                <span class="material-icons">agriculture</span>
                </div>
                <div class="media-body pl-3">
                    <h3 class="heading">Lawn mower</h3>
                    <p> Don't waste time trying to dig through. We are just a call away. </p>
                    
                </div>
                </div> 
            </div>

            <div class="col-md-6 col-lg-4 services ftco-animate">
                <div class="d-block d-flex">
                <div class="icon d-flex justify-content-center align-items-center">
                        <!-- <span class="flaticon-garden"></span> -->
                        <span class="material-icons">local_shipping</span>
                </div>
                <div class="media-body pl-3">
                    <h3 class="heading">Movers</h3>
                    <p>Leave the heavy lifting to us. We have the right service for you.</p>
                </div>
                </div>
            </div>
                <div class="col-md-6 col-lg-4 services ftco-animate">
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <!-- <span class="flaticon-balcony"></span> -->
                            <span class="material-icons">format_paint</span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading">Painter</h3>
                            <p>If you are ready to brighten your walls and make it look good, we have professionals for you. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 services ftco-animate">
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <!-- <span class="flaticon-balcony"></span> -->
                            <span class="material-icons">plumbing</span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading">Plumber</h3>
                            <p>With our experienced plumbers, we are on standby to give you the right services.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- end of our popular jobs -->

        <!-- why chose us -->
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2>Why O & B Services</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4 ftco-animate">
                        <div class="block-7">
                            <div class="text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="material-icons" style="font-size:60px; color:#ffffff">access_time</span>
                                </div>
                                <h4 class="heading-2">Save Time</h4>
                                <p>Do you feel like you are spending more time doing house chores when you are supposed to be doing more vital things. We are here to free up your time.</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 ftco-animate">
                        <div class="block-7">
                            <div class="text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="material-icons" style="font-size:60px; color:#ffffff">health_and_safety</span>
                                </div>
                                <h4 class="heading-2">Save Energy</h4>
                                <p>Save you energy for a more productive things like your having time with your family and loved ones. Leave us to save the day's energy for you. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 ftco-animate">
                        <div class="block-7">
                            <div class="text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="material-icons" style="font-size:60px; color:#ffffff">insert_emoticon</span>
                                </div>
                                <h4 class="heading-2">Good Experience</h4>
                                <p>We are here to give you a good experience that will make you have a relaxed mind and put a smile on your face. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of why choose us -->

         <!-- scroller -->
         <button class="scrollToTopBtn">☝️</button>

        <!-- footer -->
        <footer class="footer ftco-section" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                        <h2 class="footer-heading">O & B Services</h2>
                        <p>Our mission is to help customers meet their home needs without breaking their bank account.<br>
                        To connect our clients with the right handy person that suits your needs.
                            We aim to provide a constant source of income to self employed handy persons.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-4">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                        
                    <div class="col-md-6 col-lg-2 pl-lg-5 mb-4 mb-md-0">
                        <h2 class="footer-heading">Quick Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('login') }}" class="py-1 d-block">Post a Job</a></li>
                            <li><a href="{{ route('login') }}" class="py-1 d-block">Login</a></li>
                            <li><a href="{{ route('register') }}" class="py-1 d-block">Sign Up</a></li>
                            <li><a href="{{ route('reviews.create') }}" class="py-1 d-block">Review</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-4 pl-lg-5 mb-4 mb-md-0">
                        <h2 class="footer-heading">General Merchandise</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Barber</a></li>
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Hairdresser</a></li>
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Photographer</a></li>
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Catering</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Makeup Artist</a></li>
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Decorator</a></li>
                                    <li><a href="{{ route('gmerchandise.create') }}" class="py-1 d-block">Event Planner</a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                        <h2 class="footer-heading">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map-marker"></span><span class="text">44 Howard Street Birmingham, West Midlands, UK, B19 3HP</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+44 750 1763 143</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">info@oandbservices.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | O & B Services</p>
                    </div>
                </div>
            </div>
        </footer>
        </div>

        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen">
            <svg class="circular" width="48px" height="48px">
                <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
                <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
            </svg>
        </div>       

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        <script>
            // We select the element we want to target
            var target = document.querySelector(".container-fluid");

            var scrollToTopBtn = document.querySelector(".scrollToTopBtn")
            var rootElement = document.documentElement

            // Next we want to create a function that will be called when that element is intersected
            function callback(entries, observer) {
            // The callback will return an array of entries, even if you are only observing a single item
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                // Show button
                scrollToTopBtn.classList.add("showBtn")
                } else {
                // Hide button
                scrollToTopBtn.classList.remove("showBtn")
                }
            });
            }

            function scrollToTop() {
            rootElement.scrollTo({
                top: 0,
                behavior: "smooth"
            })
            }
            scrollToTopBtn.addEventListener("click", scrollToTop);
                
            // Next we instantiate the observer with the function we created above. This takes an optional configuration
            // object that we will use in the other examples.
            let observer = new IntersectionObserver(callback);
            // Finally start observing the target element
            observer.observe(target);
        </script>

        <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/scrollax.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/60424e5d385de407571cfc9b/1f01g4822';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>