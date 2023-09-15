<!-- Modal -->
<div class="modal fade" id="deleteModal{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">delete album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('albums.destroy',$album->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label>Select Action:</label>
                        <select class="form-control actionSelect" name="actionSelect">
                            <option value="delete">Delete Album and all pictures in album</option>
                            @if(count($albums) > 1)
                                <option value="move">Delete Album and Move pictures to another album</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group moveAlbum" style="display: none">
                        <label>Select Destination Album:</label>
                        <select class="form-control" name="new_album">
                            <option disabled selected>Choose one ...</option>
                            @foreach($albums as $otherAlbum)
                                @if($otherAlbum->id != $album->id)
                                    <option value="{{ $otherAlbum->id }}">{{ $otherAlbum->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        const actionSelects = document.querySelectorAll('.actionSelect');
        const moveAlbumDivs = document.querySelectorAll('.moveAlbum');

        actionSelects.forEach((actionSelect, i) => {
            actionSelect.addEventListener('change', function () {
                if (this.value === 'move') {
                    moveAlbumDivs[i].style.display = 'block';
                } else {
                    moveAlbumDivs[i].style.display = 'none';
                }
            });
        });

    </script>

@endsection
