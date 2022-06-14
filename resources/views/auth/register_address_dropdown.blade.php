<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<div class="row">
    <div class="col col-lg-4">
        <label>Province</label>
    <select id="province" class="form-control" disabled="disabled" onload="setProvince()">
        <option value="" disabled>Select province</option>

    </select>
    </div>
    <div class="col col-lg-4">
    <label>Municipality/City</label>
        <select id="municipality" class="form-control" onchange="setTown()">
            <option value="" selected disabled>Select municipality</option>

        </select>
    </div>
    <div class="col col-lg-4">
        <label>Barangay</label>
        <select id="barangay" class="form-control input-lg"  onchange="setBarangay()">
            <option value="" disabled selected>Select barangay</option>
        </select>
    </div>
</div>
<script>
    function setTown() {
        $("#townval").val($("#municipality option:selected").text());
    }
    function setBarangay() {
        // alert($("#barangay option:selected").text());
        $("#brgyval").val($("#barangay option:selected").text());
    }

    function setProvince() {
        $("#provval").val($("#province option:selected").text());
        $( '#barangay' ).trigger( 'change' )
    }
    $(document).ready(function () {

        load_json_data('province');

        setTimeout(() => {
            $( '#municipality' ).trigger( 'change' )
            $( '#barangay' ).trigger( 'change' )
        }, 2000);

        function load_json_data(id, parent_id) {
            var html_code = '';
            $.getJSON('/province_municipality_barangay.json', function (data) {
                html_code += '<option value="">Select ' + id + '</option>';
                $.each(data, function (key, value) {
                    if (id == 'province') {
                        if (value.parent_id == '0') {
                            html_code += '<option value="' + value.id + '" selected>' + value.name +
                                '</option>';
                        }
                    } else {
                        if (value.parent_id == parent_id) {
                            html_code += '<option value="' + value.id + '">' + value.name +
                                '</option>';
                        }
                    }
                });
                $('#' + id).html(html_code);
            });
        }

        $( document ).ready(function() {
            var province_id = $(this).val();
            var province_id = '1';

            if (province_id != '') {
                load_json_data('municipality', province_id);
            } else {
                $('#municipality').html('<option value="" disabled selected>Select municipality</option>');
                $('#barangay').html('<option value="" disabled selected>Select barangay</option>');
            }
        });
        $(document).on('load', '#province', function () {
            var province_id = $(this).val();
            var province_id = '1';
            if (province_id != '') {
                load_json_data('municipality', province_id);
            } else {
                $('#municipality').html('<option value="" disabled selected>Select municipality</option>');
                $('#barangay').html('<option value="" disabled selected>Select barangay</option>');
            }
        });
        $(document).on('change', '#municipality', function () {
            var municipality_id = $(this).val();

            if (municipality_id != '') {
                load_json_data('barangay', municipality_id);
            } else {
                $('#barangay').html('<option value="" disabled selected>Select barangay</option>');
            }


        });
    });
</script>
