

<template>

    <Layout>
        <template v-slot:content>
            <main>

<!-- slider-area -->
<section class="slider-area position-relative">
    <div class="third-slider-active">
        <div class="third-slider-item third-slider-bg" data-background="/front-end/img/slider/third_slider_bg.jpg" v-for="(banner, index) in homeBanner" :key="banner.id" >
            <div class="container custom-container-two">
                <div class="third-slider-wrap">
                    <div class="row align-items-center" >
                        <div class="col-lg-6">
                            <div class="slider-content">
                                <h3 class="sub-title" data-animation-in="fadeInUp" data-delay-in=".2"
                                    data-duration-in="1.5">best offer !</h3>
                                <h2 class="title" data-animation-in="fadeInUp" data-delay-in=".4"
                                    data-duration-in="1.5">{{ banner.text }}</h2>
                                <p data-animation-in="fadeInUp" data-delay-in=".6" data-duration-in="1.5">Get up
                                    to 50% off Today Only</p>
                                <a href="shop-sidebar.html" class="btn" data-animation-in="fadeInUp"
                                    data-delay-in=".8" data-duration-in="1.5">Shop now</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="third-slider-img">
                                <div class="img-shape" data-background="/front-end/img/slider/third_slide_shape.png"
                                    data-animation-in="zoomIn" data-delay-in="1" data-duration-in="1.5"></div>
                                <img :src=" banner.image ?  banner.image  :  '/front-end/img/slider/third_slider_img01.png'" alt="" class="main-img"
                                    data-animation-in="slideInRight2" data-delay-in="1" data-duration-in="1.5" width="537" height="560"  >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider-area-end -->

<!-- shoes-category-area -->
<div class="shoes-category-area pt-80 pb-30">
    <div class="container custom-container-two">
        <div class="row justify-content-center" >
            <div class="col-lg-4 col-md-6 col-sm-9" v-for="(category) in setShortArray( 3 )" :key="category.id">
                <div class="shoes-cat-item mb-50">
                    <div class="thumb mb-30">
                        <a href="shop-sidebar.html"><img :src=" category.image ? category.image : '/front-end/img/images/shoes_cat_img01.jpg'" width="503" height="300" alt=""></a>
                    </div>
                    <div class="content">
                        <ul>
                            <li><a href="shop-sidebar.html">{{ category.name }}</a></li>
                            <li><span>18</span></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- shoes-category-area-end -->

<!-- trending-product-area -->
<section class="trending-product-area trending-product-two gray-bg pt-95 pb-100">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="section-title title-style-two text-center mb-50">
                    <h3 class="title">Trending Products</h3>
                </div>
            </div>
        </div>
        <div class="row no-gutters trending-product-grid">
            <div class="col-2">
                <div class="trending-products-list">
                    <h5>Categories</h5>
                    <ul class="nav nav-tabs" id="trendingTab" role="tablist" >

                        <li class="nav-item" role="presentation"  v-for="(catItem, index) in setShortArray( 6 )" :key="catItem.id">
                            <a :class="'nav-link'  +showactiveclass(1,index)" :id="'cat_tab'+catItem.id" data-toggle="tab"
                                :href="'#cat_'+catItem.id" role="tab" :aria-controls="'cat_'+catItem.id"
                                aria-selected="false">{{ catItem.name }}</a>
                        </li>
                    </ul>
                    <p class="offer"><a href="#">Limited-Time Offer!</a></p>
                </div>
            </div>
            <div class="col-10">
                <div class="tab-content tp-tab-content" id="trendingTabContent">
                    <div  v-for="(catItem, index) in setShortArray( 6 )" :key="catItem.id" :class="'tab-pane'  +showactiveclass(2,index)"  :id="'cat_'+catItem.id" role="tabpanel"
                        :aria-labelledby="'cat_tab'+catItem.id">
                        <div class="trending-products-banner banner-animation">
                            <a href="shop-sidebar.html"><img :src="catItem.image || '/front-end/img/images/trending_banner03.jpg'" alt=""></a>
                        </div>
                        <div class="row trending-product-active"  v-if="catItem.products.length > 0">
                            <div class="col" v-for="product in catItem.products">
                                <div class="features-product-item">
                                    <div class="features-product-thumb">
                                        <!-- <div class="discount-tag">-20%</div> -->
                                        <a href="shop-details.html">
                                            <img :src=" product.image ||'/front-end/img/product/shoes_product01.jpg'" alt="" style="width: 266px; height: 235px;">
                                        </a>
                                        <div class="product-overlay-action">
                                            <ul>
                                                <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                <li><a href="shop-details.html"><i class="far fa-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="features-product-content">
                                        <div class="rating">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <h5><a href="shop-details.html">{{ product.name }}</a></h5>
                                        <p class="price">PKR {{ product.product_attribute[0].price }}</p>
                                        <div class="features-product-bottom">
                                            <ul>
                                                <li class="color-option">
                                                    <span class="gray"></span>
                                                    <span class="cyan"></span>
                                                    <span class="orange"></span>
                                                </li>
                                                <li class="limited-time"><a href="#">Limited-Time Offer!</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="features-product-cart"><a href="cart.html">add to cart</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- trending-product-area-end -->

<!-- new-arrival-area -->
<section class="new-arrival-area pt-95 pb-45">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="section-title title-style-two text-center mb-45">
                    <h3 class="title">New Arrival Collection</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="new-arrival-nav mb-35">
                    <button v-for="(catItem, index) in setShortArray( 6 )" :key="catItem.id" :class="''+showactiveclass(1,index)" :data-filter="'.cat-'+catItem.id">{{ catItem.name }}</button>
                </div>
            </div>
        </div>
        <div class="row new-arrival-active">
            <div v-for="item in homeProduct" :class="'col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-'+item.category_id"  >
                <div class="new-arrival-item text-center mb-50">
                    <div class="thumb mb-25">

                        <a href="shop-details.html"><img :src="item.image ||'/front-end/img/product/shoes_arrival_product01.jpg'"
                            style="width: 296px; height: 334px;"  alt=""></a>
                        <div class="product-overlay-action">
                            <ul>
                                <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                <li><a href="shop-details.html"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="content">
                        <h5><a href="shop-details.html">{{ item.name }}</a></h5>
                        <span class="price">PKR {{ item.product_attribute[0].price }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- new-arrival-area-end -->

<!-- shoes-banner-area -->
<section class="shoes-banner-area">
    <div class="container">
        <div class="shoes-banner-active">
            <div class="shoes-banner-bg" data-background="/front-end/img/bg/shoes-banner_bg.jpg">
                <div class="row">
                    <div class="col-12">
                        <div class="shoes-banner-content">
                            <h6>Athletes Shoes</h6>
                            <h2>9 Best <span>Shoes for</span> Standing All Day Review 2020</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shoes-banner-bg" data-background="/front-end/img/bg/shoes-banner_bg.jpg">
                <div class="row">
                    <div class="col-12">
                        <div class="shoes-banner-content">
                            <h6>Athletes Shoes</h6>
                            <h2>3 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shoes-banner-bg" data-background="/front-end/img/bg/shoes-banner_bg.jpg">
                <div class="row">
                    <div class="col-12">
                        <div class="shoes-banner-content">
                            <h6>Athletes Shoes</h6>
                            <h2>8 Best <span>Shoes for</span> Standing All Day Review 2021</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shoes-banner-area-end -->

<!-- promo-services -->
<section class="promo-services pt-70 pb-25">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="promo-services-item mb-40">
                    <div class="icon"><img src="/front-end/img/icon/promo_icon01.png" alt=""></div>
                    <div class="content">
                        <h6>payment & delivery</h6>
                        <p>Delivered, when you receive arrives</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="promo-services-item mb-40">
                    <div class="icon"><img src="/front-end/img/icon/promo_icon02.png" alt=""></div>
                    <div class="content">
                        <h6>Return Product</h6>
                        <p>Retail, a Product Return Process</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="promo-services-item mb-40">
                    <div class="icon"><img src="/front-end/img/icon/promo_icon03.png" alt=""></div>
                    <div class="content">
                        <h6>money back guarantee</h6>
                        <p>Options Including 24/7</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="promo-services-item mb-40">
                    <div class="icon"><img src="/front-end/img/icon/promo_icon04.png" alt=""></div>
                    <div class="content">
                        <h6>Quality support</h6>
                        <p>Support Options Including 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- promo-services-end -->

<!-- instagram-post-area -->
<div class="instagram-post-area">
    <div class="container-fluid p-0 fix">
        <div class="row no-gutters insta-active " v-for="(brand, index) in homeBrand" :key="brand.id">
            <div class="col">
                <div class="insta-post-item">
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                        <img :src=" brand.image ? brand.image : '/front-end/img/instagram/s_insta_post01.jpg'" width="385" height="350" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- instagram-post-area-end -->

</main>
        </template>
    </Layout>
    
</template>

<script>
import Layout from './layout.vue';
import getUrl from '../provider.js'

export default {
  name: "Index",
  components: {
    Layout
  },
    data() {
        return {
            homeBanner:[],
            homeCategory:[],
            homeBrand:[],
            homeProduct:[],
        };
    },
    mounted() {

        this.getHomeData();
        
    },
    methods: {
        async getHomeData() {
            const response = await axios.get(getUrl().getHomeData);
            
            this.homeBanner = response.data.data.banner;
            this.homeCategory = response.data.data.category;
            this.homeBrand = response.data.data.brands;
            this.homeProduct = response.data.data.product;
        },
        setShortArray(size){
            return this.homeCategory.slice(0, size);
        },
        showactiveclass(type, index) {
            if( type == 1 && index == 0){
                return ' active';
            }
            else if(type == 2 && index == 0){
                return ' show active';
            }
            else{
                return '';
            }
        },
        
    },
}
</script>
