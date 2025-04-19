<h2>Admin Login</h2>

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

<form action="{{ route('admin_login_submit') }}" method="post">
    @csrf
    <table>
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
            <td></td>
            <td>
                <button type="submit">Login</button>
                <div>
                    <a href="{{ route('admin_forget_password') }}">Forget Password</a>
                </div>
            </td>
        </tr>
    </table>
</form>