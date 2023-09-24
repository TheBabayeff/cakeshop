@extends('frontend.layouts.app')
@section('content')
    <!--slider area start-->
    <div class="slider_area slider_black owl-carousel">
        <div class="single_slider" data-bgimg="{{ asset('assets/img/slider/7.jpg') }}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content">
                            <p>Eksklyuziv olaraq -20% yalnız bu həftə üçün</p>
                            <h1>Macarons</h1>
                            <span>U-Boat watches are a lot like classic American Muscle cars </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider" data-bgimg="{{ asset('assets/img/slider/6.jpg') }}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="slider_content">
                            <p>exclusive offer -40% off this week</p>
                            <h1>breguet watches</h1>
                            <span>Made in a limited edition of 300 sets in the  </span>
                            <p class="slider_price">starting at <span>$2.199.oo</span></p>
                            <a class="button" href="shop.html">Daha ətraflı</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider area end-->

    <!--product section area start-->
    <section class="product_section p_section1 product_black_section bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Ən gözəl kateqoriyalar</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_area">
                        <div class="product_container bottom">
                            <div class="row product_row1">
                                @foreach($categories AS $category)
                                    <div class="custom-col-5">

                                        <div class="single_product">
                                            <div class="product_thumb">
                                                <a class="primary_img"
                                                   href="{{ route('categoryShow', $category->id) }}"><img
                                                        src="{{ asset('storage/'.$category->image) }}" alt=""></a>
                                                <a class="secondary_img"
                                                   href="{{ route('categoryShow', $category->id) }}" tabindex="0"><img
                                                        src="{{ asset('assets/img/logo/logo-3.png') }}" alt=""></a>
                                            </div>
                                            <div class="product_content">
                                                <h3><a href="{{ route('categoryShow', $category->id) }}"
                                                       style="display: flex; !important font-size: 14px;">{{ $category->name }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->

    <!--banner area start-->
    <section class="banner_section home_banner_two home_banner9">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 col-md-6">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="{{ asset('assets/img/slider/6.jpg') }}" alt=""></a>
                            <div class="banner_content">
                                <p>Design Creative</p>
                                <h2>Modern and Clean</h2>
                                <span>From $60.99 – Sale 20%</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="{{ asset('assets/img/slider/6.jpg') }}" alt=""></a>
                            <div class="banner_content">
                                <p>Bestselling Products</p>
                                <h2>Jewelry and Diamonds</h2>
                                <span>Only from $89.00</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--banner area end-->

    <!--product section area start-->
    <section class="product_section p_section1 product_black_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_container">
                        <div class="row ">
                            @foreach($products AS $product)
                                <div class="col-6 col-md-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img"
                                                href="{{ route('productShow' , $product->id) }}">
                                                <img src="storage/{{ $product->preview_image }}" alt="">
                                            </a>
                                        </div>
                                        <div class="product_content">
                                            <div class="tag_cate" style="color: #F195B2;">
                                                <a href="#" tabindex="0">{{ $product->category->name }}</a>
                                            </div>
                                            <h3><a href="{{ route('productShow' , $product->id) }}"
                                                    tabindex="0">{{ $product->name }}</a></h3>
                                            <div class="price_box">
                                                <span class="current_price">{{ $product->price }} 	.00 &#8380;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->


    <!--product section area start-->
    <section class="product_section p_section1 product_black_section bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Ən çox sifariş olunanlar</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_area">
                        <div class="product_container bottom">
                            <div class="row product_row1">
                                @foreach($bestSelling AS $product)
                                    <div class="custom-col-5">
                                        <div class="single_product">
                                            <div class="product_thumb">

                                                <a class="primary_img" href="{{ route('productShow' , $product->id) }}"><img
                                                        src="storage/{{ $product->preview_image }}" alt=""></a>

                                                <a class="secondary_img"
                                                   href="{{ route('productShow' , $product->id) }}"><img
                                                        src="{{ asset('assets/img/logo/logo-3.png') }}" alt=""></a>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->

@endsection
