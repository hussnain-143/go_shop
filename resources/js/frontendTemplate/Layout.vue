<template>
    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header class="header-style-two">
        <div id="sticky-header" class="main-header transparent-header menu-area">
            <div class="container custom-container-two">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav show">
                                <div class="logo">
                                    <a href="index.html" class="main-logo"><img src="/front-end/img/logo/fw_logo.png"
                                            alt="Logo"></a>
                                    <a href="index.html" class="sticky-logo"><img src="/front-end/img/logo/logo.png"
                                            alt="Logo"></a>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li class="has--mega--menu" v-for="cat_item in headerCategory"
                                            :key="cat_item.id"><a href="#">{{ cat_item.name }}</a>
                                            <ul class="mega-menu">
                                                <li class="mega-menu-wrap">
                                                    <ul class="mega-menu-col">
                                                        <li class="mega-title"><a href="shop.html">SUB CATEGORIES</a>
                                                        </li>
                                                        <li v-for="sub_cat_item in cat_item.sub_category"
                                                            :key="sub_cat_item.id"> <router-link
                                                                :to="'/category/' + cat_item.slug">
                                                                {{ sub_cat_item.name }}
                                                            </router-link></li>
                                                    </ul>
                                                    <ul class="mega-menu-col sub-cat-post">
                                                        <li>
                                                            <router-link
                                                                :to="'/category/' + cat_item.slug">

                                                                <img :src="cat_item.image ? cat_item.image : '/front-end/img/product/sub_menu_img01.jpg'"
                                                                    alt="" width="296" height="344" />
                                                                <span class="btn">{{ cat_item.name }}</span>
                                                            </router-link>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li class="menu-item-has-children"><a href="#">blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Our Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="header-action d-none d-md-block">
                                    <ul>
                                        <li class="header-search"><a href="#" data-toggle="modal"
                                                data-target="#search-modal"><i class="flaticon-search"></i></a></li>
                                        <li class="header-shop-cart"><a href="#"><i
                                                    class="flaticon-shopping-bag"></i><span>0</span></a>
                                            <ul class="minicart">
                                                <li class="d-flex align-items-start">
                                                    <div class="cart-img">
                                                        <a href="#"><img src="/front-end/img/product/cart_p01.jpg"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h4><a href="#">Exclusive Winter Jackets</a></h4>
                                                        <div class="cart-price">
                                                            <span class="new">$229.9</span>
                                                            <span><del>$229.9</del></span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon">
                                                        <a href="#"><i class="far fa-trash-alt"></i></a>
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-start">
                                                    <div class="cart-img">
                                                        <a href="#"><img src="/front-end/img/product/cart_p02.jpg"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h4><a href="#">Winter Jackets For Women</a></h4>
                                                        <div class="cart-price">
                                                            <span class="new">$229.9</span>
                                                            <span><del>$229.9</del></span>
                                                        </div>
                                                    </div>
                                                    <div class="del-icon">
                                                        <a href="#"><i class="far fa-trash-alt"></i></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="total-price">
                                                        <span class="f-left">Total:</span>
                                                        <span class="f-right">$239.9</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="checkout-link">
                                                        <a href="#">Shopping Cart</a>
                                                        <a class="black-color" href="#">Checkout</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="header-profile"><a href="#"><i class="flaticon-user-profile"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <div class="close-btn"><i class="flaticon-targeting-cross"></i></div>
                            <nav class="menu-box">
                                <div class="nav-logo"><a href="index.html"><img src="/front-end/img/logo/logo.png" alt=""
                                            title=""></a>
                                </div>
                                <div class="menu-outer">
                                    <ul class="navigation">
                                        <li class="active menu-item-has-children"><a href="#">Home</a>
                                            <ul class="submenu">
                                                <li><a href="index.html">Home One</a></li>
                                                <li><a href="index-2.html">Home Two</a></li>
                                                <li class="active"><a href="index-3.html">Home Three</a></li>
                                                <li><a href="index-4.html">Home Four</a></li>
                                                <li><a href="index-5.html">Home Five</a></li>
                                                <li><a href="index-6.html">Home Six</a></li>
                                                <li><a href="index-7.html">Home Seven</a></li>
                                                <li><a href="index-8.html">Home Eight</a></li>
                                                <li><a href="index-9.html">Home Nine</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#">Shop</a>
                                            <ul class="submenu">
                                                <li><a href="shop.html">Shop Page</a></li>
                                                <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                                <li><a href="shop-details.html">Shop Details</a></li>
                                                <li><a href="cart.html">Cart Page</a></li>
                                                <li><a href="cart.html">Checkout Page</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li class="menu-item-has-children"><a href="#">blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Our Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Search -->
        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form>
                        <input type="text" placeholder="Search here...">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Search-end -->

        <!-- off-canvas-start -->
        <div class="sidebar-toggle-btn d-flex align-items-center justify-content-center"><a href="#"
                class="navSidebar-button"><img src="/front-end/img/icon/sidebar_toggle_icon.png" alt=""></a></div>
        <div class="sidebar-off-canvas info-group">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-widget scroll">
                <div class="sidebar-widget-container">
                    <div class="off-canvas-heading">
                        <a href="#" class="close-side-widget">
                            <span class="flaticon-targeting-cross"></span>
                        </a>
                    </div>
                    <div class="sidebar-textwidget">
                        <div class="sidebar-info-contents">
                            <div class="content-inner">
                                <div class="logo mb-30">
                                    <a href="index.html"><img src="/front-end/img/logo/logo.png" alt=""></a>
                                </div>
                                <div class="content-box">
                                    <p>WooCommerce and WordPress are both free, open source software reasons many ...
                                    </p>
                                </div>
                                <div class="contact-info">
                                    <h4 class="title">CONTACT US</h4>
                                    <ul>
                                        <li><span class="flaticon-phone-call"></span><a href="tel:123456789">+9 325 444
                                                0000</a></li>
                                        <li><span class="flaticon-email"></span><a
                                                href="mailto:adara@info.com">adara@info.com</a></li>
                                        <li><span class="flaticon-place"></span>71 Park Lan Street 2355 NY</li>
                                    </ul>
                                </div>
                                <div class="oc-newsletter">
                                    <h4 class="title">NEWSLETTER</h4>
                                    <p>Fill your email below to subscribe to my newsletter</p>
                                    <form action="#">
                                        <input type="email" placeholder="Email...">
                                        <button class="btn">Subscribe</button>
                                    </form>
                                </div>
                                <div class="oc-social">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google"></i></a></li>
                                    </ul>
                                </div>
                                <div class="oc-bottom">
                                    <div class="currency">
                                        <form action="#">
                                            <label>Currency</label>
                                            <select name="select">
                                                <option value="">USD</option>
                                                <option value="">AUE</option>
                                                <option value="">SAR</option>
                                                <option value="">INR</option>
                                                <option value="">BDT</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="language">
                                        <form action="#">
                                            <label>Language</label>
                                            <select name="select">
                                                <option value="">English</option>
                                                <option value="">Spanish</option>
                                                <option value="">Turkish</option>
                                                <option value="">Russian</option>
                                                <option value="">Chinese</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- off-canvas-end -->

    </header>
    <!-- header-area-end -->

    <!-- main-area -->

    <slot name="content">

    </slot>
    <!-- main-area-end -->


    <!-- footer-area -->
    <footer class="dark-bg pt-55 pb-80">
        <div class="container">
            <div class="footer-top-wrap">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-logo">
                            <a href="index.html"><img src="/front-end/img/logo/w_logo.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-middle-wrap">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-link-wrap">
                            <nav class="menu-links">
                                <ul>
                                    <li><a href="about-us.html">About us</a></li>
                                    <li><a href="shop-sidebar.html">Store</a></li>
                                    <li><a href="contact.html">Locations</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="contact.html">Support</a></li>
                                    <li><a href="#">Policy</a></li>
                                    <li><a href="#">Faqs</a></li>
                                </ul>
                            </nav>
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="copyright-text">
                            <p>&copy; 2021 <a href="index.html">adara</a>. All Rights Reserved | Ph (+09) 456 457869</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pay-method-img">
                            <img src="/front-end/img/images/payment_method_img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="script"></div>
    <!-- footer-area-end -->
</template>
<script>
import axios from 'axios';
import getUrl from '../provider.js'

export default {
    name: 'Layout',

    data() {
        return {
            headerCategory: [],
        };
    },

    mounted() {
        var src = ['/front-end/js/vendor/jquery-3.5.0.min.js',
            '/front-end/js/popper.min.js',
            '/front-end/js/bootstrap.min.js',
            '/front-end/js/isotope.pkgd.min.js',
            '/front-end/js/imagesloaded.pkgd.min.js',
            '/front-end/js/jquery.magnific-popup.min.js',
            '/front-end/js/jquery.mCustomScrollbar.concat.min.js',
            '/front-end/js/bootstrap-datepicker.min.js',
            '/front-end/js/jquery.nice-select.min.js',
            '/front-end/js/jquery.countdown.min.js',
            '/front-end/js/swiper-bundle.min.js',
            '/front-end/js/jarallax.min.js',
            '/front-end/js/slick.min.js',
            '/front-end/js/wow.min.js',
            '/front-end/js/nav-tool.js',
            '/front-end/js/plugins.js',
            '/front-end/js/main.js'];
        for (var i = 0; i < src.length; i++) {
            var script = document.createElement('script');
            script.src = src[i];
            script.async = false;
            document.getElementById('script').appendChild(script);

        };

        this.getHeaderCategory();
    },
    methods: {
        async getHeaderCategory() {
            try {
                let data = await axios.get(getUrl().getHeaderCategoryData);

                if (data.status == 200) {
                    this.headerCategory = data.data.data;

                } else {
                    console.log('Error fetching header categories:', data.statusText);
                }

            } catch (error) {
                console.log('Error fetching header categories:', error);

            }
        },
    },


}

</script>