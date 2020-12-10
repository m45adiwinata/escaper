<form action="{{route('setlunas')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$id}}" />
    Please type your password here for verification
    <input type="password" name="password">
    <button class="btn" type="submit">CONFIRM</button>
</form>