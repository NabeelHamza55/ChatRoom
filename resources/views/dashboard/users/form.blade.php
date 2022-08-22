@extends('dashboard.sidebar')
@section('title', 'User | ')
@section('main_content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Boosters</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-muted font-weight-bold mr-4">
                    @if (isset($item))
                        Edit
                    @else
                        Add
                    @endif
                </span>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ route('UserList') }}" class="btn btn-light-warning font-weight-bolder btn-sm">List</a>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            @if (isset($item))
                                Edit
                            @else
                                Add
                            @endif Booster
                            <i class="mr-2"></i>
                            <small class="">Enter Booster information below</small>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('UserList') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                            <i class="fa fa-long-arrow-left icon-sm"></i>Back</a>
                        <div class="btn-group">
                            <button id="kt_submit" onclick="document.getElementById('kt_form').submit();" type="button"
                                class="btn btn-primary font-weight-bolder">
                                <i class="fa fa-check icon-sm"></i>Save Form</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Form-->
                    @if (isset($item))
                        <form method="post" class="form" action="{{ route('UserUpdate', Crypt::encrypt($item->id)) }}"
                            id="kt_form" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                        @else
                            <form method="post" class="form" action="{{ route('UserCreate') }}" id="kt_form"
                                enctype="multipart/form-data">
                                @csrf
                    @endif

                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="my-5">
                                <h3 class="text-dark font-weight-bold mb-10">Booster Info:</h3>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="">Name:</label>
                                            <input name="name"
                                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                                type="text"
                                                value="{{ isset($item) ? old('name', $item->name) : old('name') }}" />
                                            @if ($errors->has('name'))
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="">Username:</label>
                                            <input name="username"
                                                class="form-control form-control-solid @error('username') is-invalid @enderror"
                                                type="text"
                                                value="{{ isset($item) ? old('username', $item->username) : old('username') }}" />
                                            @if ($errors->has('username'))
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="">Email:</label>
                                            <input name="email"
                                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                                type="email" placeholder="@example.com"
                                                value="{{ isset($item) ? old('email', $item->email) : old('email') }}" />
                                            @if ($errors->has('email'))
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="">Date of birth:</label>
                                            <input name="birthday"
                                                class="form-control form-control-solid @error('birthday') is-invalid @enderror"
                                                type="date"
                                                value="{{ isset($item) ? old('birthday', $item->birthday) : old('birthday') }}" />
                                            @if ($errors->has('birthday'))
                                                @error('birthday')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="password">Password:</label>
                                            <input name="password"
                                                class="form-control form-control-solid @error('password') is-invalid @enderror"
                                                type="password"
                                                value="{{ isset($item) ? old('password') : old('password') }}" />
                                            @if ($errors->has('password'))
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="passwordConfirmation">Confirm Password:</label>
                                            <input name="passwordConfirmation"
                                                class="form-control form-control-solid @error('passwordConfirmation') is-invalid @enderror"
                                                type="password"
                                                value="{{ isset($item) ? old('passwordConfirmation', $item->passwordConfirmation) : old('passwordConfirmation') }}" />
                                            @if ($errors->has('passwordConfirmation'))
                                                @error('passwordConfirmation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-2">About Me:</label>
                                    <div class="col-10">
                                        <textarea name="about" class="form-control form-control-solid" type="text">{{ isset($item) ? old('about', $item->about) : old('about') }}</textarea>
                                        @if ($errors->has('about'))
                                            @error('about')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-10"></div>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <div class="form-group row align-items-center">
                                            <label class="col-3">Image:</label>
                                            <div class="col-9">
                                                <input id="avatar"
                                                    class="btn btn-light-primary font-weight-bolder btn-sm @error('image') is-invalid @enderror"
                                                    name="image" type="file" oninput='UpdatePreview()' />
                                                @if ($errors->has('image'))
                                                    @error('image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img id="frame" class="img-fluid" src="" alt="Preview"
                                            srcset="">
                                        <span id="thumbnail_text" class="form-text text-center text-muted d-none">Double
                                            click to
                                            remove Thumnail</span>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="form-group col-4">
                                        <span class="switch switch-sm ">
                                            <label class="col-form-label px-1">Status: </label>
                                            <label class="px-1">
                                                <input type="checkbox" value="1" name="status"
                                                    {{ (isset($item) && $item->status == 0 ? 'unchecked' : old('status') == '0') ? 'unchecked' : 'checked' }} />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <div class="form-group col-4">
                                        <span class="switch switch-sm ">
                                            <label class="col-form-label px-1">Freeze?: </label>
                                            <label class="px-1">
                                                <input type="checkbox" value="1" name="status"
                                                    {{ (isset($item) && $item->status == 1 ? 'unchecked' : old('status') == '1') ? 'unchecked' : 'checked' }} />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
