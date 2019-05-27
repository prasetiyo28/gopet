@extends('admin.layouts.app')

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Form Edit PetShop</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.petshop') }}">PetShop</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Warning</h3>
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-success">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.petshop.update', $petshop->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 align-self-center">
                                        <div class="d-flex m-t-10 justify-content-end">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label for="input-file-now">Image <span
                                                                    class="text-danger">*</span></label>
                                                        <input name="image" data-max-file-size="1M" type="file"
                                                               data-default-file="{{ asset('/images/'.$petshop->image) }}"
                                                               id="input-file-now" class="dropify form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">PetShop <span
                                                        class="text-danger">*</span></label>
                                            <input name="name" required type="text" id="name" class="form-control"
                                                   value="{{ $petshop->name }}" placeholder="Enter petshop name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30"
                                                      rows="10" placeholder="Enter petshop description">{{ $petshop->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Street <span
                                                        class="text-danger">*</span></label>
                                            <input name="street" required type="text" id="street" class="form-control"
                                                   placeholder="Enter street of petshop" value="{{ $petshop->street }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Districts <span class="text-danger">*</span>
                                            </label>
                                            <input name="districts" required type="text" id="districts"
                                                   class="form-control" value="{{ $petshop->districts }}"
                                                   placeholder="Enter districts of petshop">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">City <span class="text-danger">*</span>
                                            </label>
                                            <div class="controls">
                                                <input type="text" required name="city" id="city" class="form-control"
                                                       placeholder="Enter city of petshop" value="{{ $petshop->city }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-outline-warning"><i class="fa fa-check"></i>
                                        Update
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <script src="{{ asset('backend/dark/js/validation.js') }}"></script>
    <script>
        !function (window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>
    <script src="{{ asset('backend/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
@endsection