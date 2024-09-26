 <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('home')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('page.index')}}">
                <i class="bi bi-card-text"></i>
                <span>Pages</span>
                </a>
        </li> 
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('admin.header.menu')}}">
                <i class="bi bi-grid"></i>
                <span>Solution Menu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('displaysolution.index')}}">
                <i class="bi bi-building"></i><span>Solution Page</span></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('professionalDisplay.index')}}">
                <i class="bi bi-building"></i><span>Professional Display Solution</span></i>
            </a>
        </li> --}}
        <!-- End Dashboard Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed"   href="{{route('casestudy.index')}}">
                <i class="bi bi-newspaper"></i><span>Case Studies</span>
            </a>
        </li>   --}}

        

        <!-- <li class="nav-item">
            <a class="nav-link collapsed"  data-bs-target="#header-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-border-top"></i><span>Header</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="header-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('admin.header.menu')}}">
                        <i class="bi bi-circle"></i><span>Menu</span>
                    </a>
                </li>
            </ul>
        </li> --><!-- End Forms Nav -->

        <!-- <li class="nav-item">
            <a class="nav-link collapsed"  data-bs-target="#footer-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-border-bottom"></i><span>Footer</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="footer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('admin.footer.sociallinks')}}">
                        <i class="bi bi-circle"></i><span>Social links</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.footer.copyright')}}">
                        <i class="bi bi-circle"></i><span>Copyright</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.footer.menu')}}">
                        <i class="bi bi-circle"></i><span>Menu</span>
                    </a>
                </li>
            </ul>
        </li> --><!-- End Forms Nav -->

        <!-- <li class="nav-item">
            <a class="nav-link collapsed"  data-bs-target="#contact-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-telephone"></i><span>Contact Us</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="contact-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('contact.settings')}}">
                        <i class="bi bi-circle"></i><span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('contact.list')}}">
                        <i class="bi bi-circle"></i><span>Entries</span>
                    </a>
                </li>
            </ul>
        </li> --><!-- End Forms Nav -->
      
        <li class="nav-item">
            <a class="nav-link collapsed"   data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-briefcase"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="product-nav" class="nav-content collapse " data-bs-parent="#product-nav">
                <li>
                    <a href="{{route('productCategory.index')}}">
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('productSeries.index')}}">
                        <i class="bi bi-circle"></i><span>Series</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('productVariantList.index')}}">
                        <i class="bi bi-circle"></i><span>Variant</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('product.index')}}">
                        <i class="bi bi-circle"></i><span>Products</span>
                    </a>
                </li>
            </ul>
        </li> 

        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('industry.index')}}">
                <i class="bi bi-building"></i><span>Industry</span></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('successstory.index')}}">
                <i class="bi bi-building"></i><span>Success Story</span></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('newsroom.index')}}">
                <i class="bi bi-building"></i><span>News & Blogs</span></i>
            </a>
        </li>
        
        {{-- <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('product.index')}}">
                <i class="bi bi-building"></i><span>Products</span></i>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('slider.index')}}">
                <i class="bi bi-building"></i><span>Slider</span></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('content.index')}}">
                <i class="bi bi-building"></i><span>Content</span></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link collapsed"  href="{{route('industryBlog.index')}}">
                <i class="bi bi-building"></i><span>Industry Blog</span></i>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link collapsed"   data-bs-target="#home-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-briefcase"></i><span>Home</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="home-nav" class="nav-content collapse " data-bs-parent="#product-nav">
                
                <li>
                    <a href="{{route('video.index')}}">
                        <i class="bi bi-circle"></i><span>Video Upload</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('videoLink.index')}}">
                        <i class="bi bi-circle"></i><span>Video Link</span>
                    </a>
                </li>
            </ul>
        </li> <!-- End Forms Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed"  data-bs-target="#contact-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-telephone"></i><span>Contact Us</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="contact-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('contact.settings')}}">
                        <i class="bi bi-circle"></i><span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('sociallinks')}}">
                        <i class="bi bi-circle"></i><span>Social Links</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('contact.list')}}">
                        <i class="bi bi-circle"></i><span>Entries</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link collapsed"   data-bs-target="#news-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-newspaper"></i><span>Newsroom</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="news-nav" class="nav-content collapse " data-bs-parent="#product-nav">
                <li>
                    <a href="{{route('newsroom.banner')}}">
                        <i class="bi bi-circle"></i><span>Banner image</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('newsroom.index')}}">
                        <i class="bi bi-circle"></i><span>Newsrooms</span>
                    </a>
                </li>
            </ul>
        </li> --><!-- End Forms Nav -->

        <!-- <li class="nav-item">
            <a class="nav-link collapsed"   href="{{route('casestudy.index')}}">
                <i class="bi bi-newspaper"></i><span>Case Study</span>
            </a>
        </li> --><!-- End Forms Nav -->
    </ul>

  </aside><!-- End Sidebar-->