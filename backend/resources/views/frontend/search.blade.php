@extends('frontend.layouts.app')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('welcome') }}">Ana səhifə</a></li>
                            <li>></li>
                            <li>Bütün məhsullar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--shop  area start-->
    <div class="shop_area shop_reverse">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!--shop wrapper start-->

                    <!--shop tab product start-->
                    <div class="tab-content">
                        <div class="tab-pane grid_view fade show active" id="large" role="tabpanel">
                            <div class="row">
                                @if($searchProducts->isNotEmpty())
                                    @foreach($searchProducts AS $searchProduct)
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="single_product" style="background-color: transparent">
                                                <div class="product_thumb">
                                                    <a class="primary_img"
                                                       href="{{ route('productShow' , $searchProduct->id) }}"><img
                                                            src="{{ asset("storage/".$searchProduct->preview_image) }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="product_content">
                                                    <div class="tag_cate">
                                                        <a href="{{ route('categoryShow', $searchProduct->category->id) }}">{{ $searchProduct->category->name }}</a>
                                                    </div>
                                                    <h3>
                                                        <a href="{{ route('productShow' , $searchProduct->id) }}">{{ $searchProduct->name }}</a>
                                                    </h3>
                                                    <div class="price_box">
                                                        <span class="current_price">{{ $searchProduct->price }} 	&#8380;</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    
                                        <h3>Axtardığınız nəticə tapılmadı</h3>
                                   
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--shop tab product end-->
                    <!--shop toolbar start-->
                    {{ $searchProducts->withQueryString()->links('pagination::bootstrap-5') }}
                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection
