@extends('admin.front')
@section('content')
<div class="content">
    <a href="/admin/manage_shops/" class="btn btn-outline-dark btn-round m-1">Go back</a>

    <div class="row">

        <div class="col col-md-6">
            <div class="card mt-3">
                <div class="card-header ">
                    <h4 class="card-title">Edit shop information for {{ $shop->name }}</h4>
                </div>
                <div class="card-body ">
                    <form id="edit_form" method="POST" action="/admin/edit_shop_submit/" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  name="shop_id" value="{{ $shop->id }}">

                        <label>Shop name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="" name="shop_name" value="{{ $shop->name }}">
                        </div>
                        <label>Shop description</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="" name="shop_description" value="{{ $shop->description }}">
                        </div>
                           
                    <h4 class="card-title">Shop banner</h4>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail">
                        <img src="/paper_assets/img/image_placeholder.jpg" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div>
                        <span class="btn btn-rose btn-round btn-file">
                          <span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="shop_banner"/>
                        </span>
                        <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                      </div>
                    </div>

                        
                        <div class="form-check mt-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="is_active" type="checkbox" value="1"
                                        {{ ($shop->is_active) ? 'checked':'' }}>
                                    Mark as active
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="card-footer ">
                    <button type="submit" form="edit_form" class="btn btn-info btn-round">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
