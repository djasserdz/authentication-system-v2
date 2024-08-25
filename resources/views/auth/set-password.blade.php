<x-layout>
    <h1>Setting a Password</h1>
    <p>set a password</p>
    <form action="{{route('set.password')}}" method="post">
        @csrf
        <div>
            <label for="">Password</label>
            <input type="text" name="password">
            @error('password')
                <p>{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Confirm Password</label>
            <input type="text" name="password_confirmation">
            @error('password_confirmation')
                <p>{{$message}}</p>
            @enderror
        </div>
        <button type="">set</button>
    </form>
</x-layout>
