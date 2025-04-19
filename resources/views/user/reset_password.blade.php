@include('user.top') 
<h2>Reset Password</h2>

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

<form action="{{ route('reset_password_submit',[$token,$email]) }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" placeholder="Password">
            </td>
        </tr>
        <tr>
            <td>Retype Password:</td>
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