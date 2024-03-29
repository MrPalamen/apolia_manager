@extends('layouts.app')

@section('title', "Barème d'Amende")

@section('sidebar')
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('fine_scales_edit', $view->id) }}"><i class="fas fa-download fa-sm text-white-50"></i> Editer d'une amende</a>
@endsection

@section('content')
        <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-6">
                            <form class="form" method="" action="">
                                <div class="card ">
                                    <div class="card-header ">
                                        <div class="card-header">
                                            <h4 class="card-title">Edit Profile</h4>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-5 pr-1">
                                                <div class="form-group">
                                                    <label>Company (disabled)</label>
                                                    <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                                                </div>
                                            </div>
                                            <div class="col-md-3 px-1">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" placeholder="Username" value="michael23">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" placeholder="Company" value="Mike">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" placeholder="City" value="Mike">
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" placeholder="Country" value="Andrew">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input type="number" class="form-control" placeholder="ZIP Code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-header no-padding">
                                    <div class="card-image">
                                        <img src="../../assets/img/full-screen-image-3.jpg" alt="...">
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="author">
                                        <a href="#">
                                            <img class="avatar border-gray" src="../../assets/img/default-avatar.png" alt="...">
                                            <h5 class="card-title">Tania Keatley</h5>
                                        </a>
                                        <p class="card-description">
                                            michael24
                                        </p>
                                    </div>
                                    <p class="card-description text-center">
                                        Hey there! As you can see,
                                        <br> it is already looking great.
                                    </p>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="button-container text-center">
                                        <button href="#" class="btn btn-simple btn-link btn-icon">
                                            <i class="fa fa-facebook-square"></i>
                                        </button>
                                        <button href="#" class="btn btn-simple btn-link btn-icon">
                                            <i class="fa fa-twitter"></i>
                                        </button>
                                        <button href="#" class="btn btn-simple btn-link btn-icon">
                                            <i class="fa fa-google-plus-square"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

