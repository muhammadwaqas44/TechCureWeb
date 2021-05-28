<form action="{{route('insertData')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12">
        <input type="file" name="import_file" required>
        <button type="submit">Submit</button>
    </div>
</form>