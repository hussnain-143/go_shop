

<template>

    <Layout>
        <template v-slot:content>
            <main>
                <!-- breadcrumb-area -->
                <section class="breadcrumb-area breadcrumb-bg" data-background="/front-end/img/bg/breadcrumb_bg01.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="breadcrumb-content">
                                    <h2>Shop Sidebar</h2>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- breadcrumb-area-end -->

                <!-- shop-area -->
                <section class="shop-area pt-100 pb-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-9 col-lg-8">
                                <div class="shop-top-meta mb-35">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="shop-top-left">
                                                <ul>
                                                    <li><a href="#"><i class="flaticon-menu"></i> FILTER</a></li>
                                                    <li>Showing 1–9 of 80 results</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="shop-top-right">
                                                <form action="#">
                                                    <select name="select">
                                                        <option value="">Sort by newness</option>
                                                        <option>Free Shipping</option>
                                                        <option>Best Match</option>
                                                        <option>Newest Item</option>
                                                        <option>Size A - Z</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-xl-4 col-sm-6 " v-for="product in Product" :key="product.id">
                                        <div class="new-arrival-item text-center mb-50">
                                            <div class="thumb mb-25">
                                                <a href="shop-details.html"><img
                                                        :src=" product.image || '/front-end/img/product/n_arrival_product01.jpg'" alt="" style="width: 100%; height: 280px;"></a>
                                                <div class="product-overlay-action">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="far fa-heart"></i></a></li>
                                                        <li><a href="shop-details.html"><i class="far fa-eye"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h5><a href="shop-details.html">{{ product.name }}</a></h5>
                                                <span class="price">PKR {{ product.product_attribute[0].price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pagination-wrap">
                                    <ul>
                                        <li class="prev"><a href="#">Prev</a></li>
                                        <li><a href="#">1</a></li>
                                        <li class="active"><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">10</a></li>
                                        <li class="next"><a href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <aside class="shop-sidebar">
                                    <div class="widget side-search-bar">
                                        <form action="#">
                                            <input type="text">
                                            <button><i class="flaticon-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="widget">
                                        <h4 class="widget-title">Product Categories</h4>
                                        <div class="shop-cat-list">
                                            <ul>
                                                <li v-for="item in Categories" :key="item.id"><a
                                                                href="javascript:void(0)">
                                                                {{ item.name }}
                                                </a><span>(6)</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="widget">
                                        <input type="hidden" name="high-price" id="high-price" v-model="HighPrice">
                                        <input type="hidden" name="low-price" id="low-price" v-model="LowPrice">
                                        <h4 class="widget-title">Price Filter</h4>
                                        <div class="price_filter">
                                            <div id="slider-range"></div>
                                            <div class="price_slider_amount">
                                                <span>Price :</span>
                                                <input type="text" id="amount" name="price"
                                                    placeholder="Add Your Price" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget">
                                        <h4 class="widget-title">Product Brand</h4>
                                        <div class="sidebar-brand-list">
                                            <ul>
                                                <li v-for="item in Brand" :key="item.id" v-on:click ="addDataAttr('brand', item.id)" ><a :class="this.brand.includes(item.id) ? 'CateBrand'  : ''" href="javascript:void(0)">{{ item.name }}<i
                                                            class="fas fa-angle-double-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="widget has-border">
                                        <div class="sidebar-product-size mb-30">
                                            <h4 class="widget-title">Product Size</h4>
                                            <div class="shop-size-list">
                                                <ul>
                                                    
                                                    <li v-for="item in Sizes"  :key="item.id" v-on:click ="addDataAttr('size', item.id)" class="m-0 mb-2 mx-1 "><a :class="this.size.includes(item.id) ? 'brandSize'  : ''" href="javascript:void(0)">{{ item.text }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="sidebar-product-color">
                                            <h4 class="widget-title">Color</h4>
                                            <div class="shop-color-list">
                                                <ul>
                                                    <li v-for="item in Colors" :key="item.id"  :style="{ backgroundColor: item.value }" v-on:click ="addDataAttr('color', item.id)"  :class="this.color.includes(item.id) ? 'brandColor'  : ''" ></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <button class="my-2 btn btn-sm">Apply Filter</button>
                                    </div>
                                    <div class="widget">
                                        <h4 class="widget-title">Top Items</h4>
                                        <div class="sidebar-product-list">
                                            <ul>
                                                <li>
                                                    <div class="sidebar-product-thumb">
                                                        <a href="#"><img src="/front-end/img/product/sidebar_product01.jpg"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="sidebar-product-content">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <h5><a href="#">Woman T-shirt</a></h5>
                                                        <span>$ 39.00</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sidebar-product-thumb">
                                                        <a href="#"><img src="/front-end/img/product/sidebar_product02.jpg"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="sidebar-product-content">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <h5><a href="#">Slim Fit Cotton</a></h5>
                                                        <span>$ 39.00</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="sidebar-product-thumb">
                                                        <a href="#"><img src="/front-end/img/product/sidebar_product03.jpg"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="sidebar-product-content">
                                                        <div class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <h5><a href="#">Fashion T-shirt</a></h5>
                                                        <span>$ 39.00</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- shop-area-end -->

            </main>
        </template>
    </Layout>
    
</template>

<script>
import Layout from './layout.vue';
import getUrl from '../provider.js';
import axios from 'axios';

export default {
  name: "Category",
  components: {
    Layout
  },
  data() {
    return {
      slug: '',
      Categories: [],
      Brand: [],
      Product: [],
      Sizes: [],
      Colors: [],
      LowPrice: 0,
      HighPrice: 0,
      Attributes: [],
      brand:[],
      size:[],
      color:[],
      CateBrand : 'CateBrand',
      brandSize : 'brandSize',
      brandColor : 'brandColor',
    };
  },
  watch: {
    '$route'() {
      this.slug = this.$route.params.slug;
      this.getCategoryData();
    }
  },
  mounted() {
    this.slug = this.$route.params.slug;

    if (!this.slug) {
      this.$router.push({ name: 'Index' });
    } else {
      this.getCategoryData();
    }
  },
  methods: {
    async getCategoryData() {
      try {
        const response = await axios.get(getUrl().getCategoryData + this.slug);
        const data = response.data.data;

        this.Product = data.product.data;
        this.Categories = data.cat;
        this.Brand = data.brands;
        this.Sizes = data.size;
        this.Colors = data.color;
        this.LowPrice = data.lowPrice;
        this.HighPrice = data.highPrice;
        this.Attributes = data.attributes;

      } catch (error) {
        console.error('Error fetching category data:', error);
      }
    },

    addDataAttr(type , value ){

        if(type == 'brand'){

            if(this.checkArray(type, value)){
                this.brand.splice(this.brand.indexOf(value),1)
            }
            else{
                this.brand.push(value);
            }

        }
        else if ( type == 'color'){

            
            if(this.checkArray(type, value)){
                this.color.splice(this.color.indexOf(value),1)
            }
            else{
                this.color.push(value);
            }

        }
        else if ( type == 'size' ){

            
            if(this.checkArray(type, value)){
                this.size.splice(this.size.indexOf(value),1)
            }
            else{
                this.size.push(value);
            }

        }

    },

    checkArray( type , value ){
        if(type == 'brand'){
            return this.brand.includes(value)
        }
        else if ( type == 'color'){
            return this.color.includes(value)
        }
        else if ( type == 'size' ){
            return this.size.includes(value)
        }
    },

  }
};
</script>
<style scoped>

.CateBrand::before{
    background-color: #ff5400;
}

.brandSize{
    background-color:#ff9f6f ;
    border: 3px solid #ff5400;
    color: white;
}

.brandColor::before{
    content: '\2713';           
    display: inline-block;
    color: #ff5400;           
    padding: 0 4px ;        
    font-size: 16px;          
    font-weight: bold;        
}

</style>
