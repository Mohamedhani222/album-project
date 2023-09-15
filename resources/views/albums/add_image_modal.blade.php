
<!-- Modal -->
<div class="modal fade" id="AddModal{{$albums_images->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('images.store')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" name="album_id" value="{{$albums_images->id}}" required>

                    <label for="images"> Images </label>
                    <input type="file" accept="image/*" name="images[]" class="form-control" multiple>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
