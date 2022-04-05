<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel 8 Dynamic Dependent Dropdown using Jquery Ajax - XpertPhp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="form-group col-4">
                <label for="province">province:</label>
                <select id="province" name="category_id" class="form-control">
                    <option value="" selected disabled>Select province</option>
                    @foreach($provinces as $key => $province)
                        <option value="{{ $key }}"> {{ $province }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-4">
                <label for="municipality">municipality:</label>
                <select name="municipality" id="municipality" class="form-control"></select>
            </div>
            <div class="form-group col-4">
                <label for="barangay">barangay:</label>
                <select name="barangay" id="barangay" class="form-control"></select>
            </div>
        </div>
    </div>
    <script type=text/javascript>
        $('#province').change(function () {
            var provinceID = $(this).val();
            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getMunicipality') }}?province_id=" + provinceID,
                    success: function (res) {
                        if (res) {
                            $("#municipality").empty();
                            $("#municipality").append('<option>Select municipality</option>');
                            $.each(res, function (key, value) {
                                $("#municipality").append('<option value="' + key + '">' +
                                    value + '</option>');
                            });

                        } else {
                            $("#municipality").empty();
                        }
                    }
                });
            } else {
                $("#municipality").empty();
                $("#barangay").empty();
            }
        });
        $('#municipality').on('change', function () {
            var municipalityID = $(this).val();
            if (municipalityID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getBarangay') }}?municipality_id=" + municipalityID,
                    success: function (res) {
                        if (res) {
                            $("#barangay").empty();
                            $("#barangay").append('<option>Select barangay</option>');
                            $.each(res, function (key, value) {
                                $("#barangay").append('<option value="' + key + '">' +
                                    value + '</option>');
                            });

                        } else {
                            $("#barangay").empty();
                        }
                    }
                });
            } else {
                $("#barangay").empty();
            }

        });

    </script>
</body>

</html>
