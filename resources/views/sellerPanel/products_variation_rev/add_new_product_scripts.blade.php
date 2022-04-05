<script>
        var product_variation_container = document.getElementById("product_variation_container").style.display = "none";
        var product_reg_container = document.getElementById("reg_product_container");

        // regular product price change log mar 18 2022
        var regular_product_wholesale_container = document.getElementById("wholesale_product_container").style.display = "initial";

        function changeProductVariationDisplay() {
            var product_variation_container = document.getElementById("product_variation_container");
            var is_have_variation = document.getElementById("ishaveProductVariation");
            var is_product_varitaion_check = document.getElementById("switch_is_product_variation");
            var is_product_have_variation_value = document.getElementById("ishaveProductVariation");
            var product_reg_container = document.getElementById("reg_product_container");

            if (is_product_varitaion_check.checked == true) {
                product_variation_container.style.display = "initial";
                is_product_have_variation_value.value = "yes";
                product_reg_container.style.display = "none";
            } else {
                product_variation_container.style.display = "none";
                is_product_have_variation_value.value = "no";
                product_reg_container.style.display = "initial";
            }

        }

        function onchangeIsProductWholesaleReg(){
            // container 
            var regular_product_wholesale_container = document.getElementById("wholesale_product_container");
            var isRegularProductHaveWholeSalePrice = document.getElementById("isRegularProductHaveWholeSalePrice");
            var switch_is_reg_has_whole_sale = document.getElementById("switch_is_reg_has_whole_sale");
                // togglebox regular is wholesale
                if(switch_is_reg_has_whole_sale.checked == true){
                    // perform hide the regular wholesale product container
                    console.log("hidden");
                    regular_product_wholesale_container.style.display = "none";
                }else{
                    regular_product_wholesale_container.style.display = "initial";

                }
        }

        function changeProductIsProductHasVariationPrice(){

          
        }
    </script>