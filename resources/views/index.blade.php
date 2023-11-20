@extends('admin.layouts.main')

@section('title')
    Settings
@endsection


@push('style')
    <style>
        .mb20 {
            margin-bottom: 20px !important;
        }

        .small-image {
            width: 100px;
            height: 100px;
            margin: 10px auto;
        }

        .position-relative {
            position: relative;
        }

        .trashicon {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
@endpush

@push('script')
    <script>
        CKEDITOR.replace('message', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('note', {
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        function removeFile($value) {
            let url="{{ route('admin.settings.destroy',['setting'=>':setting']) }}";
            url = url.replace(':setting', $value);
            $.ajax({
                url: url,
                method: 'post',
                dataType: 'json',
                data: {
                    _token: '{{csrf_token()}}',
                    value: $value
                },
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                }
            });
        }
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">
                <div id="settings-profile"
                     aria-labelledby="settings-profile-tab">
                    <form method="POST"
                          action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <button class="btn btn-info btn-sm mb20" type="submit">
                            Update
                            <i class="fa fa-recycle"></i>
                        </button>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <h3>Logo & Favicon</h3>
                                            <hr>
                                        </div>
                                        <div class="settings-profile">
                                            <div class="row mt-4">
                                                <div class="col-12 col-md-6 mb20">
                                                    <div class="text-center position-relative">
                                                        <img class="small-image" alt="logo"
                                                             src="{{ imageExist(env('UPLOAD_SETTING'),$logo) }}">
                                                        <button onclick="removeFile('{{ $logo }}')" type="button"
                                                                class="btn btn-danger btn-sm position-absolute trashicon">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <label for="title" class="mb20 text-center d-block">logo</label>
                                                    <input id="logo" type="file" name="logo"
                                                           class="form-control">
                                                    @error('logo')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb20">
                                                    <div class="text-center position-relative">
                                                        <img class="small-image" alt="logo"
                                                             src="{{ imageExist(env('UPLOAD_SETTING'),$fav_icon) }}">
                                                        <button onclick="removeFile('{{ $fav_icon }}')" type="button"
                                                                class="btn btn-danger btn-sm position-absolute trashicon">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <label for="fav_icon" class="mb20 text-center d-block">favicon</label>
                                                    <input id="fav_icon" type="file" name="fav_icon"
                                                           class="form-control">
                                                    @error('fav_icon')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb20">
                                                    <div class="text-center position-relative">
                                                        <img class="small-image" alt="footer_logo"
                                                             src="{{ imageExist(env('UPLOAD_SETTING'),$footer_logo) }}">
                                                        <button onclick="removeFile('{{ $footer_logo }}')" type="button"
                                                                class="btn btn-danger btn-sm position-absolute trashicon">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <label for="footer_logo" class="mb20 text-center d-block">footer logo</label>
                                                    <input id="footer_logo" type="file" name="footer_logo"
                                                           class="form-control">
                                                    @error('footer_logo')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-6 mb20">
                                                    <div class="text-center position-relative">
                                                        <img class="small-image" alt="admin_avatar"
                                                             src="{{ imageExist(env('UPLOAD_SETTING'),$admin_avatar) }}">
                                                        <button onclick="removeFile('{{ $admin_avatar }}')" type="button"
                                                                class="btn btn-danger btn-sm position-absolute trashicon">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <label for="admin_avatar" class="mb20 text-center d-block">admin_avatar</label>
                                                    <input id="admin_avatar" type="file" name="admin_avatar"
                                                           class="form-control">
                                                    @error('admin_avatar')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <h3>General</h3>
                                            <hr>
                                        </div>
                                        <div class="settings-profile">
                                            <div class="row mt-4">
                                                <div class="col-12 mb20">
                                                    <label for="title">App Title</label>
                                                    <input id="title" type="text" name="title"
                                                           class="form-control"
                                                           value="{{ $title }}">
                                                    @error('title')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb20">
                                                    <label for="start_market">Start Market</label>
                                                    <input id="start_market" type="time" name="start_market"
                                                           class="form-control"
                                                           placeholder="title" value="{{ $start_market }}">
                                                    @error('start_market')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb20">
                                                    <label for="end_market">End Market</label>
                                                    <input id="end_market" type="time" name="end_market"
                                                           class="form-control"
                                                           value="{{ $end_market }}">
                                                    @error('end_market')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb20">
                                                    <label for="email">admin email</label>
                                                    <input id="email" type="email" name="email"
                                                           class="form-control"
                                                           value="{{ $email }}">
                                                    @error('email')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <h3>Colors & Design</h3>
                                            <hr>
                                        </div>
                                        <div class="settings-profile">
                                            <div class="row mt-4">
                                                <div class="col-md-6 mb20">
                                                    <label for="top_bar_color">Top Bar Color</label>
                                                    <input id="top_bar_color" type="color" name="top_bar_color"
                                                           class="form-control"
                                                           value="{{ $top_bar_color }}">
                                                    @error('title')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb20">
                                                    <label for="side_bar_color">Side Bar Color</label>
                                                    <input id="side_bar_color" type="color" name="side_bar_color"
                                                           class="form-control"
                                                           value="{{ $side_bar_color }}">
                                                    @error('side_bar_color')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <h3>Meta Setting</h3>
                                            <hr>
                                        </div>
                                        <div class="settings-profile">
                                            <div class="row mt-4">
                                                <div class="col-12 mb20">
                                                    <label for="meta_keywords">meta_keywords</label>
                                                    <input id="meta_keywords" type="text" name="meta_keywords"
                                                           class="form-control"
                                                           value="{{ $meta_keywords }}">
                                                    @error('meta_keywords')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb20">
                                                    <label for="meta_description">meta description</label>
                                                    <textarea id="meta_description" name="meta_description"
                                                              class="form-control">{{ $meta_description }}</textarea>
                                                    @error('meta_description')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb20">
                                                    <label for="end_market">robot_index</label>
                                                    <select id="end_market" name="robot_index"
                                                            class="form-control">
                                                        <option {{ $robot_index==0 ? 'selected' : '' }} value="0">
                                                            noindex,nofollow
                                                        </option>
                                                        <option {{ $robot_index==1 ? 'selected' : '' }} value="1">
                                                            index,follow
                                                        </option>
                                                    </select>
                                                    @error('end_market')
                                                    <p class="input-error-validate">
                                                        {{ $message }}
                                                    </p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

