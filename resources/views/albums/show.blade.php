@extends('layouts.app')
@section('title')
    home
@endsection
@section('content')
    <div class="container-fluid ">
        <h4>Edit Album <span style="color: red">{{$albums_images->name}}</span></h4>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="alert alert-danger" style="color: white">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="card-header pb-0 d-flex justify-content-between">
                        <div>
                            <button class="btn btn-success" data-toggle="modal"
                                    data-target="#AddModal{{$albums_images->id}}">Add Images
                            </button>
                        </div>
                        @include('albums.add_image_modal')
                        <div>
                            <form method="post" action="{{route('albums.update',$albums_images->id)}}">
                                @csrf
                                @method('PUT')
                                <label for="name">Album Name
                                    <button type="button" id='edit-btn' class="border-0"
                                            style="background: none; color: red">
                                        <ion-icon name="create-outline" class="fs-6"></ion-icon>
                                    </button>
                                </label>

                                <input class="form-control" name="name" id="name" value="{{$albums_images->name}}"
                                       readonly>
                                <button class="btn btn-success mt-2" id="submit_btn" type="submit"
                                        style="display: none">save
                                </button>
                            </form>
                        </div>
                        @include('albums.create')
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">

                        @if(session('success'))
                            <div class="alert alert-success my-2" style="color: white; padding: 12px">
                                {{ session('success') }}
                            </div>
                        @endif


                        <div class="table-responsive ">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Images</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($albums_images->images as $image)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$image->name}}</td>
                                        <td><img src="{{asset($image->path)}}" class="img-fluid"
                                                 style="width: 50px ;height: 50px;"></td>
                                        <td>

                                            <form style="display: contents;"
                                                  method="post" action="{{route('images.destroy')}}">
                                                @csrf
                                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                                <button type="submit"
                                                        style="  color: red;  background: none;border: none;">
                                                    <ion-icon name="trash-outline" class="fs-4"></ion-icon>
                                                </button>
                                            </form>
                                            <a href="{{asset($image->path)}}">
                                                <ion-icon class="fs-4" name="eye-outline"></ion-icon>
                                            </a>


                                        </td>
                                        {{--                                    @include('albums.delete')--}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        edit_btn = document.getElementById('edit-btn')
        edit_btn.addEventListener('click', function () {
            submit_btn = document.getElementById('submit_btn')
            name_input = document.getElementById('name')

            edit_btn.style.display = 'none'
            name_input.readOnly = false
            submit_btn.style.display = 'block'

        })

    </script>

@endsection
