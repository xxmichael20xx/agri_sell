@extends('admin.front')
@section('content')
<div class="content">
<div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">Form Elements</h4>
              </div>
              <div class="card-body ">
                <form method="get" action="https://demos.creative-tim.com/" class="form-horizontal">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">With help</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control">
                        <span class="form-text">A block of help text that breaks onto a new line.</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="password" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Placeholder</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="placeholder">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Disabled</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control" value="Disabled input here.." disabled="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Static control</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <p class="form-control-static"><a href="https://demos.creative-tim.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="660e030a0a092605140307120f10034b120f0b4805090b">[email&nbsp;protected]</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Checkboxes and radios</label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-sign"></span>
                          First Checkbox
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-sign"></span>
                          Second Checkbox
                        </label>
                      </div>
                      <div class="form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadioz" id="exampleRadios11" value="option1">
                          First Radio
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                      <div class="form-check-radio">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="exampleRadioz" id="exampleRadios12" value="option2" checked="">
                          Second Radio
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Inline checkboxes</label>
                    <div class="col-sm-10">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-sign"></span>
                          a
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-sign"></span>
                          b
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-sign"></span>
                          c
                        </label>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
</div>

@endsection