@extends('sellerPanel.front')
@section('content')
@php
    $first = $product->prod_variation[0];
    $featured_id = 0;

    if ( $product->prod_variation->count() >= 2 ) {
        $firstVariant = $product->prod_variation[1];
    }

    foreach ( $product->images_data as $index => $image ) {
        if ( $image->is_featured ) $featured_id = $image->id;
    }
@endphp
    <div class="content">
        <a href="/sellerpanel/products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
        <div class="row">
            <div class="col col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update {{ $product->name }}</h4>
                    </div>
                    <div class="container">
                        <div class="row">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('update_product_v2')}}" id="update_product_v2">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="shop_id" value="{{ Auth::user()->shop->id }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="removed_images" id="removed_images">
                                <input type="hidden" name="featured_index" id="featured_index" value="{{ $featured_id }}">
                                <input type="hidden" name="featured_type" id="featured_type" value="old">
                                <input type="hidden" name="removed_variants" id="removed_variants">

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Product category</label>
                                        <div class="col-md-9">
                                            @php
                                                $product_categories = App\Category::all();
                                            @endphp
                                            <select class="selectpicker w-100" data-style="btn btn-primary btn-round" title="Select product category" name="category_id">
                                                @foreach ( $product_categories as $product_category )
                                                    @php
                                                        $isSelected = $product->category_id == $product_category->id ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $product_category->id }}" {{ $isSelected }}>{{ $product_category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ( $errors->has( 'category_id' ) )
                                                <span class="text-danger">{{ $errors->first( 'category_id' ) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Product name</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="product_name" value="{{ $product->name }}">
                                                @if ( $errors->has( 'product_name' ) )
                                                    <span class="text-danger">{{ $errors->first( 'product_name' ) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Product description</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" name="product_desc" value="{{ $product->description }}">{{ $product->description }}</textarea>
                                                <small>(Note: Please indicate the detailed size if your product is sold per KAING or BOX)</small>
                                                @if ( $errors->has( 'product_desc' ) )
                                                    <span class="text-danger">{{ $errors->first( 'product_desc' ) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="row mb-2">
                                        <label class="col-md-3 col-form-label">Product images</label>
                                        <div class="col-md-9">
                                            <div class="custom-file h6 mt-2">
                                                <input type="file" class="custom-file-input" id="images" name="images[]" accept="image/*" multiple>
                                                <label class="custom-file-label text-muted" id="images--label" for="images">Choose an images</label>
                                            </div>
                                            <small class="text-secondary">Note: Click on a image to set it as the featured image</small>
                                            @if ( $errors->has( 'images' ) )
                                                <span class="text-danger d-block">{{ $errors->first( 'images' ) }}</span>
                                            @endif
                                            <div class="form-group row mt-3" id="current_images">
                                                @foreach ( $product->images_data as $index => $image )
                                                    <div class="col-md-3" id="image--{{ $image->id }}">
                                                        <img class="img-fluid clickable image--featured old--images {{ $image->is_featured ? 'is-featured' : '' }}" data-index="{{ $image->id }}" src="/storage/{{ $image->image }}">
                                                        <label class="d-block text-right clickable file--image-remove old--images" data-index="{{ $image->id }}">Remove</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group row mt-3 border-top pt-3" id="image_preview"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row variants--container">
                                        <div class="col">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="has_vartiants" id="has_vartiants" {{ $product->has_variants ? 'checked': '' }}>
                                                <label class="custom-control-label" for="has_vartiants">Product has variants?</label>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="form-group row {{ $product->has_variants ? '': 'd-none' }} variant--input-container">
                                        <div class="col-12">
                                            <div class="border-top border-bottom py-2" id="variant--0">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label text-dark">Variant details</label>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label class="col-form-label text-dark">Name<span class="text-primary font-weight-bold">*</span></label>
                                                            @if ( isset( $firstVariant ) )
                                                                <input type="text" class="form-control" name="variant_names[]" value="{{ $firstVariant ? $firstVariant->variation_name : '' }}">
                                                                <input type="hidden" class="form-control" name="variant_id[]" value="{{ $firstVariant ? $firstVariant->id : '' }}">
                                                            @else
                                                                <input type="text" class="form-control" name="variant_names[]">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-3"></div>
                                                    <div class="col-9">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label text-dark">Sold Per<span class="text-primary font-weight-bold">*</span></label>
                                                                @php
                                                                    $soldPerOptions = [ 'kilo', 'sacks', 'box', 'piece', 'kaing' ];
                                                                @endphp
                                                                <select class="form-control variant_soldper" name="variant_soldper[]" data-id="variant_standard_net_weight_unit_0"> 
                                                                    <option selected disabled>Select option</option>
                                                                    @foreach ( $soldPerOptions as $soldPerOption )
                                                                        @php
                                                                            $selectedSoldPer = ( $firstVariant && $firstVariant->variation_sold_per == $soldPerOption ) ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $soldPerOption }}" {{ $selectedSoldPer }}>{{ ucfirst( $soldPerOption ) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-3"></div>
                                                    <div class="col-9">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label text-dark">Product Size</label>
                                                                @php
                                                                    $productSizes = [ 'Small', 'Medium', 'Large', 'Extra Large' ];
                                                                @endphp
                                                                <select class="form-control" name="variant_product_size[]"> 
                                                                    <option selected disabled>Select option (optional)</option>
                                                                    @foreach ( $productSizes as $productSize )
                                                                        @php
                                                                            $selectedProductSize = ( $firstVariant && $firstVariant->product_size == $productSize ) ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $productSize }}" {{ $selectedProductSize }}>{{ ucfirst( $productSize ) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-3"></div>
                                                    <div class="col-9">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label text-dark">Standard net weight<span class="text-primary font-weight-bold">*</span> (for shipping details)</label>
                                                                <div class="row">
                                                                    <div class="col collapse">
                                                                        <select class="form-control custom--disabled" name="variant_standard_net_weight_unit[]" id="variant_standard_net_weight_unit_0" readonly>
                                                                            <option selected disabled>Select option</option>
                                                                            <option value="gram" {{ $firstVariant && $firstVariant->variation_net_weight_unit == 'gram' ? 'selected' : '' }}>Gram</option>
                                                                            <option value="kilogram" {{ $firstVariant && $firstVariant->variation_net_weight_unit == 'kilogram' ? 'selected' : '' }}>Kilogram</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" class="form-control mb-2" name="variant_standard_net_weight[]" value="{{ $firstVariant && $firstVariant->variation_net_weight }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Price</label>
                                                                    @if ( isset( $firstVariant ) )
                                                                        <input type="number" class="form-control" name="variant_prices[]" value="{{ $firstVariant ? $firstVariant->variation_price_per : '' }}">
                                                                    @else
                                                                        <input type="number" class="form-control" name="variant_prices[]">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">Stocks</label>
                                                                    @if ( isset( $firstVariant ) )
                                                                        <input type="number" class="form-control" name="variant_stocks[]" value="{{ $firstVariant ? $firstVariant->variation_quantity : '' }}">
                                                                    @else
                                                                        <input type="number" class="form-control mb-2" name="variant_stocks[]">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-3"></div>
                                                    <div class="col-9">
                                                        <div class="form-group row wholesale--container-global wholesale--container-variant-0">
                                                            <div class="col">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input is_wholesale-variant" name="variant_is_wholesale[]" id="is_wholesale-variant-0" data-id="variant-0" {{ $firstVariant && $firstVariant->is_variation_wholesale == 'yes' ? 'checked' : '' }}>
                                                                    <label class="custom-control-label text-dark" for="is_wholesale-variant-0">Product has wholesale?<span class="text-primary font-weight-bold">*</span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                        <div class="form-group row {{ $firstVariant && $firstVariant->is_variation_wholesale == 'yes' ? '' : 'd-none' }} wholesale--input-variant-0 border-top pt-2">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label text-dark font-weight-bold">Wholesale Details</label>
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <label class="col-form-label text-dark">Price*</label>
                                                                        <div class="form-group">
                                                                            @if ( isset( $firstVariant ) )
                                                                                <input type="number" class="form-control" name="variant_wholesale_price[]" value="{{ $firstVariant ? $firstVariant->variation_wholesale_price_per : '' }}">
                                                                            @else
                                                                                <input type="number" class="form-control" name="variant_wholesale_price[]">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="col-form-label text-dark">Minimum quantity*</label>
                                                                        <div class="form-group"> 
                                                                            @if ( isset( $firstVariant ) )
                                                                                <input type="number" class="form-control" name="variant_wholesale_min_qty[]" value="{{ $firstVariant ? $firstVariant->variation_min_qty_wholesale : '' }}">
                                                                            @else
                                                                                <input type="number" class="form-control" name="variant_wholesale_min_qty[]">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12 text-right">
                                                        <button type="button" class="btn btn-primary add--more-variant">
                                                            <i class="nc-icon nc-simple-add"></i> Add More
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="more--variants">
                                                @if ( $product->prod_variation->count() > 2 )
                                                    @foreach ( $product->prod_variation as $key => $variant )
                                                        @if ( $key > 1 )
                                                            <div class="border-top border-bottom py-2" id="variant--old-{{ $variant->id }}">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 col-form-label text-dark">Variant details</label>
                                                                    <div class="col-md-9">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label text-dark">Name<span class="text-primary font-weight-bold">*</span></label>
                                                                            @if ( isset( $variant ) )
                                                                                <input type="text" class="form-control" name="variant_names[]" value="{{ $variant ? $variant->variation_name : '' }}">
                                                                                <input type="hidden" class="form-control" name="variant_id[]" value="{{ $variant ? $variant->id : '' }}">
                                                                            @else
                                                                                <input type="text" class="form-control" name="variant_names[]">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="form-group row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-9">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="col-form-label text-dark">Sold Per<span class="text-primary font-weight-bold">*</span></label>
                                                                                @php
                                                                                    $soldPerOptions = [ 'kilo', 'sacks', 'box', 'piece', 'kaing' ];
                                                                                @endphp
                                                                                <select class="form-control variant_soldper" name="variant_soldper[]" data-id="variant_standard_net_weight_unit_{{ $variant->id }}"> 
                                                                                    <option selected disabled>Select option</option>
                                                                                    @foreach ( $soldPerOptions as $soldPerOption )
                                                                                        @php
                                                                                            $selectedSoldPer = ( $variant && $variant->variation_sold_per == $soldPerOption ) ? 'selected' : '';
                                                                                        @endphp
                                                                                        <option value="{{ $soldPerOption }}" {{ $selectedSoldPer }}>{{ ucfirst( $soldPerOption ) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="form-group row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-9">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="col-form-label text-dark">Product Size</label>
                                                                                @php
                                                                                    $productSizes = [ 'Small', 'Medium', 'Large', 'Extra Large' ];
                                                                                @endphp
                                                                                <select class="form-control" name="variant_product_size[]"> 
                                                                                    <option selected disabled>Select option (optional)</option>
                                                                                    @foreach ( $productSizes as $productSize )
                                                                                        @php
                                                                                            $selectedProductSize = ( $variant && $variant->product_size == $productSize ) ? 'selected' : '';
                                                                                        @endphp
                                                                                        <option value="{{ $productSize }}" {{ $selectedProductSize }}>{{ ucfirst( $productSize ) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="form-group row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-9">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label class="col-form-label text-dark">Standard net weight<span class="text-primary font-weight-bold">*</span> (for shipping details)</label>
                                                                                <div class="row">
                                                                                    <div class="col collapse">
                                                                                        <select class="form-control custom--disabled" name="variant_standard_net_weight_unit[]" id="variant_standard_net_weight_unit_{{ $variant->id }}" readonly>
                                                                                            <option selected disabled>Select option</option>
                                                                                            <option value="gram" {{ $variant && $variant->variation_net_weight_unit == 'gram' ? 'selected' : '' }}>Gram</option>
                                                                                            <option value="kilogram" {{ $variant && $variant->variation_net_weight_unit == 'kilogram' ? 'selected' : '' }}>Kilogram</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <input type="number" class="form-control mb-2" name="variant_standard_net_weight[]" value="{{ $variant && $variant->variation_net_weight }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="form-group row">
                                                                    <div class="col-md-3"></div>
                                                                    <div class="col-md-9">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label class="col-form-label">Price</label>
                                                                                    @if ( isset( $variant ) )
                                                                                        <input type="number" class="form-control" name="variant_prices[]" value="{{ $variant ? $variant->variation_price_per : '' }}">
                                                                                    @else
                                                                                        <input type="number" class="form-control" name="variant_prices[]">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label class="col-form-label">Stocks</label>
                                                                                    @if ( isset( $variant ) )
                                                                                        <input type="number" class="form-control" name="variant_stocks[]" value="{{ $variant ? $variant->variation_quantity : '' }}">
                                                                                    @else
                                                                                        <input type="number" class="form-control mb-2" name="variant_stocks[]">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="form-group row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-9">
                                                                        <div class="form-group row wholesale--container-global wholesale--container-variant-{{ $variant->id }}">
                                                                            <div class="col">
                                                                                <div class="custom-control custom-switch">
                                                                                    <input type="checkbox" class="custom-control-input is_wholesale-variant" name="variant_is_wholesale[]" id="is_wholesale-variant-{{ $variant->id }}" data-id="variant-{{ $variant->id }}" {{ $variant && $variant->is_variation_wholesale == 'yes' ? 'checked' : '' }}>
                                                                                    <label class="custom-control-label text-dark" for="is_wholesale-variant-{{ $variant->id }}">Product has wholesale?<span class="text-primary font-weight-bold">*</span></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                
                                                                        <div class="form-group row {{ $variant && $variant->is_variation_wholesale == 'yes' ? '' : 'd-none' }} wholesale--input-variant-{{ $variant->id }} border-top pt-2">
                                                                            <div class="col-md-12">
                                                                                <label class="col-form-label text-dark font-weight-bold">Wholesale Details</label>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-6">
                                                                                        <label class="col-form-label text-dark">Price*</label>
                                                                                        <div class="form-group">
                                                                                            @if ( isset( $variant ) )
                                                                                                <input type="number" class="form-control" name="variant_wholesale_price[]" value="{{ $variant ? $variant->variation_wholesale_price_per : '' }}">
                                                                                            @else
                                                                                                <input type="number" class="form-control" name="variant_wholesale_price[]">
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label class="col-form-label text-dark">Minimum quantity*</label>
                                                                                        <div class="form-group"> 
                                                                                            @if ( isset( $variant ) )
                                                                                                <input type="number" class="form-control" name="variant_wholesale_min_qty[]" value="{{ $variant ? $variant->variation_min_qty_wholesale : '' }}">
                                                                                            @else
                                                                                                <input type="number" class="form-control" name="variant_wholesale_min_qty[]">
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-12 text-right">
                                                                        <button type="button" class="btn btn-primary add--more-variant">
                                                                            <i class="nc-icon nc-simple-add"></i> Add More
                                                                        </button>
                                                                        <button type="button" class="btn btn-secondary delete--more-variant old--variant" data-id="{{ $variant->id }}">
                                                                            <i class="nc-icon nc-simple-minus"></i> Remove
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="form-group row hide-if-variants" style="display: {{ $product->has_variants ? 'none' : 'block' }}">
                                        <label class="col-md-3 col-form-label">Product sold per</label>
                                        <div class="col-md-9">
                                            @php
                                                $soldPerOptions = [ 'kilo', 'sacks', 'box', 'piece', 'kaing' ];
                                            @endphp
                                            <select class="form-control" name="sold_per" id="sold_per"> 
                                                <option selected disabled>Select option</option>
                                                @foreach ( $soldPerOptions as $soldPerOption )
                                                    @php
                                                        $isSelected = $first->variation_sold_per == $soldPerOption ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $soldPerOption }}" {{ $isSelected }}>{{ ucfirst( $soldPerOption ) }}</option>
                                                @endforeach
                                            </select>
                                            @if ( $errors->has( 'sold_per' ) )
                                                <span class="text-danger">{{ $errors->first( 'sold_per' ) }}</span>
                                            @endif
                                        </div>
                                    </div>
                            
                                    <div class="form-group row hide-if-variants" style="display: {{ $product->has_variants ? 'none' : 'block' }}">
                                        <label class="col-md-3 col-form-label">Standard net weight</label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-control custom--disabled" name="standard_net_weight_unit" id="standard_net_weight_unit" readonly>
                                                        <option selected disabled>Select option</option>
                                                        <option value="gram" {{ $first->variation_net_weight_unit == 'gram' ? 'selected': '' }}>Gram</option>
                                                        <option value="kilogram" {{ $first->variation_net_weight_unit == 'kilogram' ? 'selected': '' }}>Kilogram</option>
                                                    </select>
                                                    @if ( $errors->has( 'standard_net_weight_unit' ) )
                                                        <span class="text-danger">{{ $errors->first( 'standard_net_weight_unit' ) }}</span>
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="form-control mb-2" name="standard_net_weight" value="{{ $first->variation_net_weight }}">
                                                    @if ( $errors->has( 'standard_net_weight' ) )
                                                        <span class="text-danger">{{ $errors->first( 'standard_net_weight' ) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row hide-if-variants" style="display: {{ $product->has_variants ? 'none' : 'block' }}">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Price</label>
                                                        <input type="number" class="form-control" name="retail_price" value="{{ $first->variation_price_per }}">
                                                        @if ( $errors->has( 'retail_price' ) )
                                                            <span class="text-danger">{{ $errors->first( 'retail_price' ) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Stocks</label>
                                                        <input type="number" class="form-control" name="stocks" value="{{ $first->variation_quantity }}">
                                                        @if ( $errors->has( 'stocks' ) )
                                                            <span class="text-danger">{{ $errors->first( 'stocks' ) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row wholesale--container hide-if-variants" style="display: {{ $product->has_variants ? 'none' : 'block' }}">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_wholesale" id="is_wholesale" {{ $product->is_whole_sale ? 'checked': '' }}>
                                                <label class="custom-control-label" for="is_wholesale">Is Wholesale?</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if ( $product->is_whole_sale )
                                        <div class="form-group row wholesale--input">
                                            <label class="col-md-12 col-form-label font-weight-bold">Wholesale</label>
                                            <label class="col-md-3 col-form-label">Price</label>
                                            <div class="col-md-9">
                                                <div class="form-group"> 
                                                    <input type="number" class="form-control" name="wholesale_price" value="{{ $first->variation_wholesale_price_per }}">
                                                    @if ( $errors->has( 'wholesale_price' ) )
                                                        <span class="text-danger">{{ $errors->first( 'wholesale_price' ) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="form-group row wholesale--input">
                                            <label class="col-md-3 col-form-label">Minimum quantity</label>
                                            <div class="col-md-9">
                                                <div class="form-group"> 
                                                    <input type="text" class="form-control" name="wholesale_min_qty" value="{{ $first->variation_min_qty_wholesale }}">
                                                    @if ( $errors->has( 'wholesale_min_qty' ) )
                                                        <span class="text-danger">{{ $errors->first( 'wholesale_min_qty' ) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                            
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="submit" value="save" class="btn btn-primary" />
                                        </div>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
<script>
    let _temp_files = [],
        _selected_files = 0

    window.onload = () => {
        $( document ).on( 'change', '#sold_per', function() {
            const val = $( this ).val()
            const weightOptionSelector = '#standard_net_weight_unit'
            let weightOptionValue = 'kilogram'

            if ( val == 'piece' ) weightOptionValue = 'gram'
            $( weightOptionSelector ).val( weightOptionValue ).trigger( 'change' )
        } )

        $( document ).on( 'change', '.variant_soldper', function() {
            const val = $( this ).val()
            const weightOptionSelector = '#' + $( this ).data( 'id' )
            console.log( weightOptionSelector )
            let weightOptionValue = 'kilogram'

            if ( val == 'piece' ) weightOptionValue = 'gram'
            $( weightOptionSelector ).val( weightOptionValue ).trigger( 'change' )
        } )

        $( document ).on( 'click', '#is_wholesale,#has_vartiants', function() {
            const isChecked = $( this ).is( ':checked' )
            const selectors = $( this ).attr( 'id' ) == 'is_wholesale' ? '.wholesale--input' : '.variant--input-container'
            const inputs = $( selectors )
            const willHide = $( '.hide-if-variants' )

            if ( isChecked ) {
                inputs.each( function() {
                    $( this ).removeClass( 'd-none' )
                } )

                willHide.each( function() {
                    $( this ).hide()
                } )
            } else {
                inputs.each( function() {
                    $( this ).addClass( 'd-none' )
                } )

                willHide.each( function() {
                    $( this ).show()
                } )
            }
        } )

        $( document ).on( 'click', '.is_wholesale-variant', function() {
            const isChecked = $( this ).is( ':checked' )
            const selectors = '.wholesale--input-' + $( this ).data( 'id' )
            const inputs = $( selectors )

            if ( isChecked ) {
                inputs.each( function() {
                    $( this ).removeClass( 'd-none' )
                } )
            } else {
                inputs.each( function() {
                    $( this ).addClass( 'd-none' )
                } )
            }
        } )

        $( document ).on( 'click', '.add--more-variant', function() {
            let variantsCount = $( '#more--variants .more--variants' ).length
            if ( variantsCount < 1 ) {
                variantsCount = 1
            } else {
                variantsCount++
            }

            let moreVariant = `
                <div class="border-top border-bottom py-2 more--variants" id="variant--${variantsCount}">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-dark">Variant details</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-form-label text-dark">Name<span class="text-primary font-weight-bold">*</span></label>
                                <input type="text" class="form-control" name="variant_names[]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-form-label text-dark">Sold Per<span class="text-primary font-weight-bold">*</span></label>
                                    @php
                                        $soldPerOptions = [ 'kilo', 'sacks', 'box', 'piece', 'kaing' ];
                                    @endphp
                                    <select class="form-control variant_soldper" name="variant_soldper[]" data-id="variant_standard_net_weight_unit_${variantsCount}"> 
                                        <option selected disabled>Select option</option>
                                        @foreach ( $soldPerOptions as $soldPerOption )
                                            <option value="{{ $soldPerOption }}">{{ ucfirst( $soldPerOption ) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-form-label text-dark">Product Size</label>
                                    @php
                                        $productSizes = [ 'Small', 'Medium', 'Large', 'Extra Large' ];
                                    @endphp
                                    <select class="form-control" name="variant_product_size[]"> 
                                        <option selected disabled>Select option (optional)</option>
                                        @foreach ( $productSizes as $productSize )
                                            <option value="{{ $productSize }}">{{ ucfirst( $productSize ) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-form-label text-dark">Standard net weight<span class="text-primary font-weight-bold">*</span> (for shipping details)</label>
                                    <div class="row">
                                        <div class="col collapse">
                                            <select class="form-control custom--disabled" name="variant_standard_net_weight_unit[]" id="variant_standard_net_weight_unit_${variantsCount}" readonly>
                                                <option selected disabled>Select option</option>
                                                <option value="gram">Gram</option>
                                                <option value="kilogram">Kilogram</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control mb-2" name="variant_standard_net_weight[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label text-dark">Price<span class="text-primary font-weight-bold">*</span></label>
                                        <input type="number" class="form-control mb-2" name="variant_prices[]">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label text-dark">Stocks<span class="text-primary font-weight-bold">*</span></label>
                                        <input type="number" class="form-control mb-2" name="variant_stocks[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <div class="form-group row wholesale--container-global wholesale--container-variant-${variantsCount}">
                                <div class="col">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input is_wholesale-variant" name="variant_is_wholesale[]" id="is_wholesale-variant-${variantsCount}" data-id="variant-${variantsCount}">
                                        <label class="custom-control-label text-dark" for="is_wholesale-variant-${variantsCount}">Product has wholesale?<span class="text-primary font-weight-bold">*</span></label>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="form-group row d-none wholesale--input-variant-${variantsCount} border-top pt-2">
                                <div class="col-md-12">
                                    <label class="col-form-label text-dark font-weight-bold">Wholesale Details</label>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label text-dark">Price*</label>
                                            <div class="form-group"> 
                                                <input type="number" class="form-control" name="variant_wholesale_price[]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label text-dark">Minimum quantity*</label>
                                            <div class="form-group"> 
                                                <input type="text" class="form-control" name="variant_wholesale_min_qty[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-primary add--more-variant">
                                <i class="nc-icon nc-simple-add"></i> Add More
                            </button>
                            <button type="button" class="btn btn-secondary delete--more-variant" data-id="${variantsCount}">
                                <i class="nc-icon nc-simple-minus"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            `

            $( '#more--variants' ).append( moreVariant )
        } )

        $( document ).on( 'click', '.delete--more-variant', function() {
            const id = $( this ).data( 'id' )
            const isOldVariant = $( this ).hasClass( 'old--variant' )
            let selector = `#variant--`

            if ( isOldVariant ) {
                setRemovedIds( id, 'removed_variants' )
                selector += `old-${id}`
            } else {
                selector += id
            }

            $( selector ).remove()
        } )

        $( document ).on( 'click', '.file--image-remove', function() {
            const index = $( this ).data( 'index' )
            const indexInput = $( '#featured_index' )
            const isOldImages = $( this ).hasClass( 'old--images' )
            let files = document.getElementById( "images" ).files
            let newFiles = Array.from( files )

            newFiles.splice( index, 1 )
            document.getElementById( "images" ).files = new FileListItems( newFiles )
            $( `#image--${index}` ).remove()
            $( `#addl--images-${index}` ).remove()
            if ( _selected_files > 0 ) {
                _selected_files = _selected_files - 1
                updateFilesCount()
            }

            if ( index == indexInput.val() ) indexInput.val( '' )
            if ( isOldImages ) setRemovedIds( index, 'removed_images' )
        } )

        $( document ).on( 'click', '.image--featured', function() {
            clearFeatured()

            const index = $( this ).data( 'index' )
            const isOldImages = $( this ).hasClass( 'old--images' )

            $( this ).addClass( 'is-featured' )
            $( `#featured_index` ).val( index )
            $( `#featured_type` ).val( isOldImages ? 'old' : 'new' )
        } )

        $( document ).on( 'submit', '#update_product_v2', function( e ) {
            const indexInput = $( '#featured_index' )

            if ( indexInput.val() == '' ) {
                e.preventDefault()
                Swal.fire({
                    icon: 'info',
                    title: 'No featured image',
                    text: 'Please select a featured image'
                })
            }
        } )

        $( document ).on( 'change', '#images', function() {
            load_photos( this, 'div.preview' )
        } )

        function load_photos( input, ImagePreview ) {
            let files = input.files
            let filesArr = Array.prototype.slice.call( files )
            _selected_files = _selected_files + files.length
            updateFilesCount()

            if ( files.length == 1 && $( '#featured_index' ).val() == '' ) {
                $( '#featured_index' ).val( 0 )
                is_featured = ' is-featured'
            }

            filesArr.forEach( function( f, i ) {
                if ( ! f.type.match( "image.*" ) ) {
                    return
                }

                let reader = new FileReader()
                reader.onload = function(e) {
                    appendImageView( i, e.target.result )
                    $( $.parseHTML( `<input type="hidden" name="addl_images[]" id="addl--images-${i}">` ) ).attr( 'value', e.target.result ).appendTo( $ ( '#image_preview' ) )
                };
                reader.readAsDataURL( f )
            } )
        }

        function updateFilesCount() {
            let count = $( '#images--label' )
            count.text( `Selected ${_selected_files} images` )
        }
    }

    function appendImageView( i, file ) {
        const image = `
            <div class="col-md-3" id="image--${i}">
                <img class="img-fluid clickable image--featured" data-index="${i}" src="${file}">
                <label class="d-block text-right clickable file--image-remove" data-index="${i}">Remove</label>
            </div>
        `
        $( '#image_preview' ).append( image )
    }

    function setRemovedIds( index, id ) {
        const removedImages = $( `#${id}` )
        let newVal = []
        let oldVal = removedImages.val()

        if ( oldVal == '' ) {
            newVal = [ index ]
        } else {
            newVal = newVal.concat( oldVal.split( ',' ), [index] )
        }

        newVal = newVal.join( ',' )
        removedImages.val( newVal )
    }
    
    function clearFeatured() {
        const newImages = $( '.image--featured' )
        newImages.each( function() { $( this ).removeClass( 'is-featured' ) } )
    }

    /**
     * @params {File[]} files Array of files to add to the FileList
     * @return {FileList}
     */
    function FileListItems( files ) {
        let b = new ClipboardEvent( "" ).clipboardData || new DataTransfer()
        for ( let i = 0, len = files.length; i<len; i++ ) b.items.add( files[i] )
        return b.files
    }

    function preview_images() {
        let total_file = document.getElementById("images").files.length;
        let is_featured = ''

        for ( let i = 0; i < total_file; i++ ) {
            if ( total_file == 1 && $( '#featured_index' ).val() == '' ) {
                $( '#featured_index' ).val( i )
                is_featured = ' is-featured'
            }
            
            const image = `
                <div class="col-md-3" id="image--${i}">
                    <img class="img-fluid clickable image--featured${is_featured}" data-index="${i}" src="${URL.createObjectURL(event.target.files[i])}">
                    <label class="d-block text-right clickable file--image-remove" data-index="${i}">Remove</label>
                </div>
            `
            $( '#image_preview' ).append( image )
        }
    }

    function changeIsProductSaleStatus() {
        var checkBoxIsProductSale = document.getElementById("switch_is_prod_sale")
        if (checkBoxIsProductSale.checked == true) {
            document.getElementById('isSaleValueSetter').value = "1";
        } else {
            document.getElementById('isSaleValueSetter').value = "0";
        }
    }

    function changeIsProductPreSaleStatus() {
        var checkBoxIsProductPreSale = document.getElementById("switch_is_prod_presale")
        if (checkBoxIsProductPreSale.checked == true) {
            document.getElementById('isPreSaleValueSetter').value = "1";
        } else {
            document.getElementById('isPreSaleValueSetter').value = "0";
        }
    }
</script>
@endsection