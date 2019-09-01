<!DOCTYPE html>
<html>
<head>
    <title>Ajax Dynamic Dependent Dropdown in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
    </style>
</head>
<body>
<br/>
<div class="container box">
    <h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br/>
<div class="form form-group">
    <select name="kraju" id="kraju" class="form-control input-lg dynamic" data-dependent="wojewoda">
        <option value="">Select Country</option>
        @foreach($country_list as $country)
            <option value="{{$country->kraju}}">{{$country->kraju}}</option>
            @endforeach
    </select>
</div>
<br/>
<div class="form-group">
<select name="wojewoda" id="wojewoda" class="form-control input-lg dynamic" data-dependent="miasto">
    <option value="">Select State</option>
</select>
</div>
<br/>
<div class="form-group">
    <select name="miasto" id="miasto" class="form-control input-lg">
        <option value="">Select City</option>
    </select>
</div>
{{csrf_field()}}
<br/>
<br/>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('.dynamic').change(function(){

            if($('.dynamic').val() != '') {
                var select = $('.dynamic').attr("id");
                var value = $('.dynamic').val();
                var _token=$('input[name="_token"]').val();
                var dependent = $(this).data('dependent');

            $.ajax({
                url:"{{route('dynamic_dependent.fetch')}}",
                method:"POST",
                data:{select:select,value:value,_token:_token,dependent:dependent},
                success:function (result) {

                    $('#'+dependent).html(result);
                }
            })
        }
        })
        $('#country').change(function () {
            $('#state').val('');
            $('#city').val('');
        });
        $('#state').change(function () {
            $('#city').val('');
        })
    })
</script>