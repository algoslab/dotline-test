
<form action="{{ route('test_submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required  />
    <button type="submit" >Save</button>
</form>

