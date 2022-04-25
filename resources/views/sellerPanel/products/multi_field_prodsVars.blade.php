<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style type="text/css">
    .field_wrapper {
    width: 80% !important;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    var x = 0; //Initial field counter is 1

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    
    var wrapper = $('.field_wrapper'); //Input field wrapper

    var fieldHTML = '';
    
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x = x+1;
        fieldHTML = `<div class="row">
                        <div class="col-md-12 col-12 m-4">
                            <div class="row">
                            <label class="col-md-3 col-form-label">Variation name</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required type="text" class="form-control"
                                           name="variation_name[]"
                                           placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Price</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#retail_container`+x+`" role="tablist">
                                    <i class="now-ui-icons objects_umbrella-13"></i>
                                        Retail
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#wholesale_container`+x+`" role="tablist">
                                        <i class="now-ui-icons shopping_shop"></i>
                                        Wholesale
                                    </a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content tab-space tab-subcategories">
                            <div class="tab-pane active" id="retail_container`+x+`">
                                <!-- retail container -->
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Retail price</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input  type="text" class="form-control" name="retail_price[]" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            <!-- end retail container -->
                            </div>
                            <div class="tab-pane" id="wholesale_container`+x+`">
                                <!-- Wholesale container-->                                    
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Wholesale price</label>
                                    <div class="col-md-9">
                                        <div class="form-group"> 
                                            <input type="text" class="form-control" name="wholesale_price[]" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 col-form-label">Wholesale min quantity</label>
                                    <div class="col-md-9">
                                        <div class="form-group"> 
                                            <input type="text" class="form-control" name="wholesale_min_qty[]" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>     
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Product sold per </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="variation_sold_per[]"> 
                                            <option value="kilo">Kilo</option>
                                            <option value="sacks">Sacks</option>
                                            <option value="box">Box</option>
                                            <option value="piece">Piece</option>
                                            <option value="kaing">Kaing</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Standard net weight</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control mb-2" name="standard_net_weight[]" placeholder="">
                                        <select class="form-control" name="standard_net_weight_unit[]"> 
                                            <option value="gram">Gram</option>
                                            <option value="kilogram">Kilogram</option>
                                        </select>
                                    </div>
                                </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Stocks</label>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="stocks[]" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
<a href="javascript:void(0);" class="btn btn-danger remove_button">Remove</a>
                                        </div>
                                        </div>

                        </div>`; //New input field html 
            $(wrapper).append(fieldHTML); //Add field html

        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>


