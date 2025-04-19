@include('user.top')
<h2>Dashboard Page</h2>
<p>
    Welcome {{ Auth::guard('web')->user()->name }} to your dashboard.
</p>