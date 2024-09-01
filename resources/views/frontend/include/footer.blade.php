<footer id="ui-footer" class="ui-footer ui-footer-wrapper  ui-footer-background-version5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 newsletter-section">
                <p class="newsletter-note">Keep Posted & Updated. Subscribe Our Newsletter.</p>

                <form action="" class="form-horizontal" id="newsletterForm">
                    <div class="form-group" style="display: flex; justify-content: center;">
                        <input type="email" required value="" class="form-control newsletter-subscriber-email" placeholder="Your Email">

                        <input type="submit" value="Subscribe">
                    </div>
                    <i class="fa fa-spin fa-spinner"></i>
                </form>
            </div>

            <div class="quick-links">
                <div class="col-md-3 col-sm-6">
                    <p><i class="fa fa-link"></i> Quick Links</p>
                    <div class="gradient-div">
                        <p class="gradient"></p>
                    </div>
                    <a href="{{url('/')}}"><i class="fa fa-angle-double-right"></i> Home</a>
                    <a href="{{url('about-us')}}"><i class="fa fa-angle-double-right"></i> About</a>
                    <a href="{{url('contact-us')}}"><i class="fa fa-angle-double-right"></i> Contact</a>
                </div>
            </div>


            @php $footerCategory = \App\Model\ProductCategory::where('category_status', 'active')->has('product')->inRandomOrder()->take(3)->get(); @endphp
            @if(isset($footerCategory) && $footerCategory->count() > 0)
                <div class="browse-category">
                    <div class="col-md-3 col-sm-6">
                        <p><i class="fa fa-align-right"></i> Top Categories</p>
                        <div class="gradient-div">
                            <p class="gradient"></p>
                        </div>
                        @foreach($footerCategory as $cat)
                                <a href="{{url('category/'.$cat->slug)}}"><i class="fa fa-angle-double-right"></i> {{$cat->category_title}}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            @php $contactDetails = \App\Model\ContactDetail::first(); @endphp
            @if(isset($contactDetails) && $contactDetails != null)
                <div class="browse-category">
                    <div class="col-md-3 col-sm-6">
                        <p><i class="fa fa-phone-square"></i> Contact Details</p>
                        <div class="gradient-div">
                            <p class="gradient"></p>
                        </div>
                        <a href="javascript:void(0)"><i class="fa fa-phone"></i> {{$contactDetails->phone}}</a>
                        <a href="javascript:void(0)"><i class="fa fa-envelope"></i> {{$contactDetails->email}}</a>
                        <a href="javascript:void(0)"><i class="fa fa-home"></i> {{$contactDetails->address}}</a>
                    </div>
                </div>
            @endif

            <div class="follow-us">
                <div class="col-md-3 col-sm-6">
                    <p><i class="fa fa-thumbs-up"></i> Follow Us</p>
                    <div class="gradient-div">
                        <p class="gradient"></p>
                    </div>
                    @php $socialMediaLinks = \App\Model\SocialMedaiLinks::first(); @endphp
                    <div class="social-media-icons">
                        <a href="{{isset($socialMediaLinks) && $socialMediaLinks != null && $socialMediaLinks->facebook != null ? $socialMediaLinks->facebook : 'javascript:void(0)'}}" target="{{isset($socialMediaLinks) && $socialMediaLinks != null && $socialMediaLinks->facebook != null ? '_blank' : ''}}"><i class="fa fa-facebook-square"></i></a>
                        <a href="{{isset($socialMediaLinks) && $socialMediaLinks != null && $socialMediaLinks->twitter != null ? $socialMediaLinks->twitter : 'javascript:void(0)'}}" target="{{isset($socialMediaLinks) && $socialMediaLinks != null && $socialMediaLinks->twitter != null ? '_blank' : ''}}"><i class="fa fa-twitter-square"></i></a>
                        <a href="{{isset($socialMediaLinks) && $socialMediaLinks != null && $socialMediaLinks->instagram != null ? $socialMediaLinks->instagram : 'javascript:void(0)'}}" target="{{isset($socialMediaLinks) && $socialMediaLinks != null && $socialMediaLinks->instagram != null ? '_blank' : ''}}"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="container">
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog newsletter-modal-dialog">

                <!-- Modal content-->
                <div class="modal-content newsletter-modal-content">
                    <div class="modal-body">
                        <div class="image">
                            <img src="{{asset('images/nl.png')}}" alt="newsletter banner" class="img img-responsive">
                        </div>
                        <div class="message">
                            <h3 class="text-center">Thank you !</h3>
                            <p class="ajax-text"></p>
                            <p class="auto-text">Please visit the email you submitted and activate your subscription. We will keep you posted and updated.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="copyright-section">
        <p>Kankai.com &copy; 2019</p>
    </div>
</footer>