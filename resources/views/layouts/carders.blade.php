<div class="product-style-area pt-20 pb-30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="container">
                <div class="section-title-furits text-center mb-95">
                    <img src="assets/img/icon-img/49.png" alt="">
                    <h2>Fresh Products</h2>
                </div>
                <div class="row">
                      @foreach($allProducts as $product)
                            @include('product._single_product')
                        @endforeach
                   
                </div>
            </div>
        </div>