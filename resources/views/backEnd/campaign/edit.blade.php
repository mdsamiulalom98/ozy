@extends('backEnd.layouts.master')
@section('title', 'Landing Page Edit')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
<style>
.backend-border {
    border: 3px solid #5b131975;
    padding: 22px;
    border-radius: 14px;
    background: #ffffff;
    margin: 10px 0px;
}
</style>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('campaign.index') }}" class="btn btn-primary rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Landing Page Edit</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('campaign.update') }}" method="POST" class="row" data-parsley-validate=""
                            enctype="multipart/form-data" name="editForm">
                            @csrf
                            <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="product_id" class="form-label">Products *</label>
                                    <select class="select2 form-control  @error('product_id') is-invalid @enderror"
                                        value="{{ old('product_id') }}" name="product_id" data-placeholder="Choose ...">
                                        <option value="">Select..</option>
                                        @foreach ($products as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Campaign Title *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $edit_data->name }}" id="name" required="">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="video" class="form-label">Main Video (optional)</label>
                                    <input type="text" class="form-control @error('video') is-invalid @enderror"
                                        name="video" value="{{ $edit_data->video }}" id="video">
                                    @error('video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="subtitle" class="form-label">Campaign Sub Title</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                        name="subtitle" value="{{ $edit_data->subtitle }}" id="subtitle">
                                    @error('subtitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->






                            <div class="backend-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="twotitle" class="form-label">Left Video Title</label>
                                            <input type="text" class="form-control @error('twotitle') is-invalid @enderror"
                                                name="twotitle" value="{{ $edit_data->twotitle }}" id="twotitle">
                                            @error('twotitle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="twovideo" class="form-label">Left Video (optional)</label>
                                            <input type="text" class="form-control @error('twovideo') is-invalid @enderror"
                                                name="twovideo" value="{{ $edit_data->twovideo }}" id="twovideo">
                                            @error('twovideo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                </div>
                            </div>

                             <div class="backend-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="threetitle" class="form-label">Right Video Title</label>
                                            <input type="text" class="form-control @error('threetitle') is-invalid @enderror"
                                                name="threetitle" value="{{ $edit_data->threetitle }}" id="threetitle">
                                            @error('threetitle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="threevideo" class="form-label">Right Video (optional)</label>
                                            <input type="text" class="form-control @error('threevideo') is-invalid @enderror"
                                                name="threevideo" value="{{ $edit_data->threevideo }}" id="threevideo">
                                            @error('threevideo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                </div>
                            </div>


                            
                            <div class="backend-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="best_title" class="form-label">Why Best Title</label>
                                            <input type="text" class="form-control @error('best_title') is-invalid @enderror"
                                                name="best_title" value="{{ $edit_data->best_title }}" id="best_title">
                                            @error('best_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="best_image" class="form-label">Why Best Image</label>
                                            <input type="file" class="form-control @error('best_image') is-invalid @enderror"
                                                name="best_image" value="{{ $edit_data->best_image }}" id="best_image">
                                            <img src="{{ asset($edit_data->best_image) }}" alt="" class="edit-image">
                                            @error('best_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-12 my-0">
                                        <div class="form-group">
                                            <label for="best_description" class="form-label">Why Best Description </label>
                                            <textarea name="best_description" rows="6"
                                                class="summernote form-control @error('best_description') is-invalid @enderror" >{!! $edit_data->best_description !!}</textarea>
                                            @error('best_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                </div>
                            </div>




                            <div class="backend-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="choose_title" class="form-label">Why Choose Title </label>
                                            <input type="text" class="form-control @error('choose_title') is-invalid @enderror"
                                                name="choose_title" value="{{ $edit_data->choose_title }}" id="choose_title">
                                            @error('choose_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="choose_image" class="form-label">Why Choose Image</label>
                                            <input type="file" class="form-control @error('choose_image') is-invalid @enderror"
                                                name="choose_image" value="{{ $edit_data->choose_image }}" id="choose_image">
                                            <img src="{{ asset($edit_data->choose_image) }}" alt="" class="edit-image">
                                            @error('choose_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-12 my-0">
                                        <div class="form-group">
                                            <label for="choose_description" class="form-label">Choose Description</label>
                                            <textarea name="choose_description" rows="6"
                                                class="summernote form-control @error('choose_description') is-invalid @enderror">{!! $edit_data->choose_description !!}</textarea>
                                            @error('choose_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                </div>
                            </div>



                            <div class="backend-border">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="useful_title" class="form-label">Useful Title </label>
                                            <input type="text" class="form-control @error('useful_title') is-invalid @enderror"
                                                name="useful_title" value="{{ $edit_data->useful_title }}" id="useful_title">
                                            @error('useful_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="useful_image" class="form-label">Useful Image</label>
                                            <input type="file" class="form-control @error('useful_image') is-invalid @enderror"
                                                name="useful_image" value="{{ $edit_data->useful_image }}" id="useful_image">
                                            <img src="{{ asset($edit_data->useful_image) }}" alt="" class="edit-image">
                                            @error('useful_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-12 my-0">
                                        <div class="form-group">
                                            <label for="useful_description" class="form-label">Useful Description</label>
                                            <textarea name="useful_description" rows="6"
                                                class="summernote form-control @error('useful_description') is-invalid @enderror">{!! $edit_data->useful_description !!}</textarea>
                                            @error('useful_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                </div>
                            </div>




                            <!-- <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="banner" class="form-label">Banner Image *</label>
                                    <input type="file" class="form-control @error('banner') is-invalid @enderror"
                                        name="banner" value="{{ $edit_data->banner }}" id="banner">
                                    <img src="{{ asset($edit_data->banner) }}" alt="" class="edit-image" required>
                                    @error('banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> -->
                            <!-- col end -->


                            <div class="backend-border">
                                <div class="row-container">
                                    <!-- Loop through each generalTable entry -->
                                    @foreach($campaign->generalTable as $general)
                                        <div class="row row-template">
                                            <!-- General Question and Answer Section -->
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="general_q" class="form-label">General Question</label>
                                                    <input type="text" class="form-control" name="general_q[]"
                                                           value="{{ old('general_q[]', $general->question) }}">
                                                </div>
                                            </div>
                                            <!-- col-end -->
                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label for="general_answer" class="form-label">General Answer</label>
                                                    <input type="text" class="form-control" name="general_answer[]"
                                                           value="{{ old('general_answer[]', $general->answer) }}">
                                                </div>
                                            </div>
                                            <!-- col-end -->
                                            <!--<div class="col-sm-1 d-flex align-items-center">-->
                                            <!--    <button type="button" class="btn btn-success btn-add-row">-->
                                            <!--        <i class="fa fa-plus"></i>-->
                                            <!--    </button>-->
                                            <!--    <button type="button" class="btn btn-danger btn-remove-row ms-2 d-none">-->
                                            <!--        <i class="fa fa-trash"></i>-->
                                            <!--    </button>-->
                                            <!--</div>-->
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            
                            
                            <div class="col-sm-12 mb-3">
                                <label for="image">Review Image (Optional)</label>
                                <div class="input-group control-group increment">
                                    <input type="file" name="image[]"
                                        class="form-control @error('image') is-invalid @enderror" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-success btn-increment" type="button"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="clone hide" style="display: none;">
                                    <div class="control-group input-group">
                                        <input type="file" name="image[]" class="form-control" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_img">
                                    @foreach ($edit_data->images as $image)
                                        <img src="{{ asset($image->image) }}" class="edit-image border"
                                            alt="" />
                                        <a href="{{ route('campaign.image.destroy', ['id' => $image->id]) }}"
                                            class="btn btn-xs btn-danger waves-effect waves-light"><i
                                                class="mdi mdi-close"></i></a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- col end -->
                           

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="status" class="d-block">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" name="status"
                                            @if ($edit_data->status == 1) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div>
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
@endsection



@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-pickers.init.js"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",
        });
    </script>
    <script type="text/javascript">
        document.forms['editForm'].elements['product_id'].value = "{{ $edit_data->product_id }}"
        $('.select2').select2();
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-increment").click(function() {
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });
            $('.select2').select2();
        });
    </script>
@endsection
