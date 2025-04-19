@include('admin.top')
<h2>Admin Profile Page</h2>

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

<form action="{{ route('admin_profile_submit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>Existing Photo:</td>
            <td>
                @if(Auth::guard('admin')->user()->photo == null)
                    No Photo Found
                @else
                <img src="{{ asset('uploads/'.Auth::guard('admin')->user()->photo) }}" alt="" style="width:100px;height:auto;">
                @endif
            </td>
        </tr>
        <tr>
            <td>Change Photo:</td>
            <td>
                <input type="file" name="photo">
            </td>
        </tr>
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}">
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" value="{{ Auth::guard('admin')->user()->email }}">
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
                <button type="submit">Update</button>
            </td>
        </tr>
    </table>
</form>