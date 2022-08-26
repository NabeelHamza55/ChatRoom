@extends('dashboard.sidebar')
@if (!empty($data))
    @section('title', 'Edit Suggestion')
@else
    @section('title', 'Add Suggestions')
@endif
@section('main_content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Suggestion</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-muted font-weight-bold mr-4">{{ isset($data) ? 'Edit' : 'Add' }}</span>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ route('SuggestionList') }}" class="btn btn-light-warning font-weight-bolder btn-sm">List</a>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-custom py-4 alert-notice alert-light-success bg-white fade show" role="alert">
                    <div class="alert-icon"><span class="svg-icon svg-icon-primary svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span></div>
                    <div class="alert-text"><strong>{{ session()->get('success') }}</strong></div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
            @endif
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap py-5">
                    <div class="card-title">
                        @if (!empty($data))
                            <h3 class="card-label">Edit Suggestion</h3>
                        @else
                            <h3 class="card-label">Add Suggestion</h3>
                        @endif
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('SuggestionList') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Back To List</a>
                        <!--end::Button-->
                    </div>
                </div>
                <!--begin::Form-->
                @if (empty($data))
                    <form action="{{ route('SuggestionCreate') }}" method="post" class="form">
                    @else
                        <form action="{{ route('SuggestionUpdate', encrypt($data->id)) }}" method="post" class="form">
                            @method('PUT')
                @endif
                <form action="{{ route('SuggestionCreate') }}" method="post" class="form">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="suggestion">Suggestion</label>
                                    <textarea disabled rows="1" name="suggestion" class="form-control @error('suggestion') is-invalid @enderror">{{ !empty($data) ? $data->description : old('suggestion') }}</textarea>
                                    @if ($errors->has('suggestion'))
                                        @error('suggestion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option selected disabled value="">Select</option>
                                        <option value="1">Approve</option>
                                        <option value="0">Reject</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div> --}}
                        </div>
                        <div class="row alig-items-center">
                            <div class="col-6">
                                <div class="form-group mt-5">
                                    <span class="switch switch-sm ">
                                        <label class="col-form-label px-1">Reject/Approve: </label>
                                        <label class="px-1">
                                            <input type="checkbox"
                                                {{ !empty($data) && $data->status == 1 ? 'checked' : (old('status') == 1 ? 'checked' : '') }}
                                                value="1" name="status" />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="{{ route('SuggestionList') }}" type="reset" class="btn btn-secondary">Back</a>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection
