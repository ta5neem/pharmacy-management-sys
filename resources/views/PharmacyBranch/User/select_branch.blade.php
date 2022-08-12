<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- start select -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <!-- end select -->

    <script src="https://kit.fontawesome.com/18695b64bb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/popper.min.js')}}"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>


    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/select_branch.css')}}">
    <title>Pharmacy</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">

</head>

<body>


        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

   @include('sidebar&navbar')



    <!-- Start Body -->

    <div class="body-page" id="body-page">
        <div class="select-branch">
            <div class="card">
                <div class="card-header d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        Select Branch For User : {{$user->name}}
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="user_list.html"><button type="button" class="btn btn-list"> <i class="fa fa-align-justify"></i> &nbsp;User List</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="/User/select/Branch/{{$user->id}}" method="POST">
                                @csrf
                                <div class="form-row" style="margin-top: 70px;" >
                                    <label for="branch" class="col-lg-2 label-input">Branch<i
                                            class="text-danger">
                                            * </i>:</label>
                                    <select class="selectpicker col-lg-7 branch" name="branch"
                                        data-live-search="true" required>
                                        <option value=""></option>
                                        @foreach($branches as $one)
                                        <option value="{{$one->id}}" name="branch">{{$one->name}}</option>
                                        @endforeach
                                    
                                    </select>
        
                                
                                </div>

                                <div class="col-lg-9">
                                    <button type="submit" class=" btn btn-list float-right add" style=" margin-top:50px">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 d-none d-xl-block d-lg-block">
                            <img src="{{asset('img/select_branch.jpg')}}" class="img-thumbnail">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script> -->


    <script src="{{asset('js/themes.js')}}"></script>

    <script src="{{asset('js/main.js')}}"></script>

</body>

</html>