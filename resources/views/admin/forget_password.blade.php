<h2>Admin Forget Password</h2>

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

<form action="{{ route('admin_forget_password_submit') }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" placeholder="Email">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Submit</button>
                <div>
                    <a href="{{ route('admin_login') }}">Back to Login Page</a>
                </div>
            </td>
        </tr>
    </table>
</form>