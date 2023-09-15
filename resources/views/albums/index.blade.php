@extends('layouts.app')
@section('title')
    home
@endsection
@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Albums table</h6>
                        <div> <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                Create Album
                            </button>
                        </div>
                        @include('albums.create')
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color: white">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @if(session('success'))
                            <div class="alert alert-success" style="color: white">
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
                    @foreach($albums as $album)

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$album->name}}</td>
                            <td>{{$album->images_count}}</td>
                            <td>
                                <a href="{{route('albums.show' , $album->id)}}"><ion-icon class="fs-4" name="eye-outline"></ion-icon></a>
                                <a type="button" data-toggle="modal" data-target="#deleteModal{{$album->id}}"><ion-icon name="trash-outline" class="fs-4"></ion-icon></a>
                            </td>
                            @include('albums.delete')
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
