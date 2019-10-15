<form action="https://payments.ipayafrica.com/v3/ke" method="post">

    {{ csrf_field()  }}

    @foreach($some_data as $key => $value)

<input type="" name="{{$key}}" value="{{$value}}">
    @endforeach
    <input name="hsh" type="text" value="{{ $generated_hash }}">
    <button type="submit">Lipa</button>
</form>
