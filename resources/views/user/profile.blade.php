@include('user.top')
<h2>Profile Page</h2>

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

<form action="{{ route('profile_submit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>Existing Photo:</td>
            <td>
                @if(Auth::guard('web')->user()->photo == null)
                    No Photo Found
                @else
                <img src="{{ asset('uploads/'.Auth::guard('web')->user()->photo) }}" alt="" style="width:100px;height:auto;">
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
                <input type="text" name="name" value="{{ Auth::guard('web')->user()->name }}">
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" value="{{ Auth::guard('web')->user()->email }}">
            </td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>
                <input type="text" name="phone" value="{{ Auth::guard('web')->user()->phone }}">
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>
                <input type="text" name="address" value="{{ Auth::guard('web')->user()->address }}">
            </td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>
                <input type="text" name="country" value="{{ Auth::guard('web')->user()->country }}">
            </td>
        </tr>
        <tr>
            <td>State:</td>
            <td>
                <input type="text" name="state" value="{{ Auth::guard('web')->user()->state }}">
            </td>
        </tr>
        <tr>
            <td>City:</td>
            <td>
                <input type="text" name="city" value="{{ Auth::guard('web')->user()->city }}">
            </td>
        </tr>
        <tr>
            <td>Zip:</td>
            <td>
                <input type="text" name="zip" value="{{ Auth::guard('web')->user()->zip }}">
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