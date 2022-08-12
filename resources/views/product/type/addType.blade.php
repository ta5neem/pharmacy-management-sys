<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <script src="https://kit.fontawesome.com/18695b64bb.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/popper.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/add_type.css')}}">

    <title>Pharmacy</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">

</head>

<body>


@include('sidebar&navbar')

{{--    @if(Session::has('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            <strong>Success!</strong> {{Session::get('success')}}.--}}
{{--        </div>--}}
{{--    @endif--}}

<div class="body-page" id="body-page">
    <div class="add-type">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    Add Type
                    <a href="/type/all"><button type="button" class="btn btn-list">
                            <i class="fa fa-align-justify"></i> &nbsp;Type List</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 ">
                        <form class="needs-validation" novalidate method="POST" action="{{route('type.store')}}">
                            @csrf
                            <div class="col">
                                <input type="text" class="form-control input" name="name_type" required>
                                @error('name_type')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                                <span class="focus-input" data-placeholder="Type Name"></span>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-list float-right">Add</button>
                        </form>

                    </div>
                    <div class="col-lg-6 d-none d-xl-block d-lg-block">

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('img/add_type11.jpg')}}" class="d-block w-100 ">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('img/add_type22.jpg')}}" class="d-block w-100 ">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{asset('img/add_type33.jpg')}}" class="d-block w-100 ">
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
<!-- End Body -->



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>


<script>
    (function () {

        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // $(document).ready(function () {
    //     $('.form-control').on('focus',function(){
    //         $('.needs-validation').removeClass('was-validated');
    //     })
    // });

</script>




<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/themes.js')}}"></script>
</body>

</html>




