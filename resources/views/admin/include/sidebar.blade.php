<aside class="app-side is-open" id="app-side" aria-expanded="true">
    <!-- BEGIN .side-content -->
    <div class="side-content ">
        <!-- BEGIN .side-nav -->
        <nav class="side-nav">
            <!-- BEGIN: side-nav-content -->
            <ul class="unifyMenu" id="unifyMenu">
                <li>
                    <a href="{{url('admin/dashboard')}}">
                      <span class="has-icon">
                         <i class="icon-dashboard"></i>
                     </span>
                        <span class="nav-title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/home-banner')}}">
                          <span class="has-icon">
                             <i class="icon-folder-images"></i>
                         </span>
                        <span class="nav-title">Home Banner</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/product-category')}}">
                          <span class="has-icon">
                             <i class="icon-format_indent_increase"></i>
                         </span>
                        <span class="nav-title">Product Categories</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/product')}}">
                          <span class="has-icon">
                             <i class="icon-shopping-cart"></i>
                         </span>
                        <span class="nav-title">Products</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/testimony')}}">
                          <span class="has-icon">
                             <i class="icon-comment"></i>
                         </span>
                        <span class="nav-title">Testimony</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/contact-details')}}">
                          <span class="has-icon">
                             <i class="icon-phone-hang-up"></i>
                         </span>
                        <span class="nav-title">Contact Details</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/social-media-links')}}">
                          <span class="has-icon">
                             <i class="icon-share3"></i>
                         </span>
                        <span class="nav-title">Social Media Links</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/newsletter-subscribers')}}">
                          <span class="has-icon">
                             <i class="icon-email"></i>
                         </span>
                        <span class="nav-title">Newsletter Subscribers</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/about-us')}}">
                          <span class="has-icon">
                             <i class="icon-user"></i>
                         </span>
                        <span class="nav-title">About Us</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/terms-and-conditions')}}">
                          <span class="has-icon">
                             <i class="fa fa-balance-scale"></i>
                         </span>
                        <span class="nav-title">Terms & Conditions</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/inquiries')}}">
                          <span class="has-icon">
                             <i class="icon-inbox2"></i>
                         </span>
                        @php $unreadInquiries = \App\Model\Inquiry::where('status', 'unread')->count(); @endphp
                        <span class="nav-title">Inquiries @if($unreadInquiries > 0)<span
                                    class="badge">{{$unreadInquiries}}</span>@endif</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/customers')}}">
                          <span class="has-icon">
                             <i class="icon-user-add"></i>
                         </span>
                        <span class="nav-title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
                    <span class="has-icon">
                       <i class="fa fa-amazon"></i>
                       </span>
                        <span class="nav-title">Orders</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{url('admin/orders/pending')}}">
                                  <span class="has-icon">
                                     <i class="fa fa-paper-plane"></i>
                                    </span>
                                <span class="nav-title">Pending </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('admin/orders/completed')}}">
                                  <span class="has-icon">
                                     <i class="fa fa-check"></i>
                                    </span>
                                <span class="nav-title">Completed </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('admin/orders/cancelled')}}">
                                  <span class="has-icon">
                                     <i class="fa fa-times"></i>
                                    </span>
                                <span class="nav-title">Cancelled </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>