<a href="{{ route('home') }}">Home</a> | <a href="{{ route('about') }}">About</a> | <a href="{{ route('login') }}">Login</a> | <a href="{{ route('registration') }}">Register</a> 
<h2>Registration Page</h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

@if(session('success'))
    {{ session('success') }}
@endif

@if(session('error'))
    {{ session('error') }}
@endif

<form action="{{ route('registration_submit') }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" placeholder="Name">
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" placeholder="Email">
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" placeholder="Password">
            </td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Submit</button>
            </td>
        </tr>
    </table>
</form>