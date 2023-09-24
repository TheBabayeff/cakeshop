@extends('frontend.layouts.app')

@section('title', $product->name)
@section('content')
    <!--product details start-->
    <div class="product_details" style="padding-top:120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="{{ asset("storage/".$product->preview_image) }}" data-zoom-image=""
                                     alt="big-1">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                @foreach($product->product_images AS $productImage)
                                    <li>
                                        <a href="#" class="elevatezoom-gallery active" data-update=""
                                           data-image="{{ asset("storage/".$productImage) }}"
                                           data-zoom-image="{{ asset("storage/".$productImage) }}">
                                            <img src="{{ asset("storage/".$productImage) }}" alt="zo-th-1"/>
                                        </a>

                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form action="#">

                            <h1>{{ $product->name }}</h1>
                            <div class="product_nav">
                                <ul>
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                            <div class=" product_ratting">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"> ( Müştəri məmnuniyyəti ) </a></li>
                                </ul>
                            </div>
                            <div class="product_meta">
                                <span>Kateqoriya: <a href="#">{{ $product->category->name }}</a></span>
                            </div>
                            <div class="product_price">
                                <span class="current_price">{{ $product->price }} &#8380;</span>
                            </div>
                            <div class="product_desc">
                                <p>{{ $product->description }}</p>
                            </div>

                            <div class="product_variant quantity">
                                <label>quantity</label>
                                <input min="1" max="100" value="1" type="number">
                                <button class="button" type="submit">Sifariş et</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product details end-->
@endsection
