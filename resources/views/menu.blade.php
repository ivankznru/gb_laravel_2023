<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('news.index') }}">{{ __('News') }}</a>
</li>
@guest
<li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">{{ __('Sign in') }}</a>
</li>
<li class="nav-item">
        <a class="nav-link" href="{{ route('socAuth','github') }}">{{ __('Authorize via GitHub') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Sign up') }}</a>
    </li>
@else
    @if (Auth::user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">{{ __('Admin area') }}</a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('updateProfile') }}">Profile</a>
    </li>
@endguest
<li class="nav-item">
    <a class="nav-link" href="{{ route('comments.index') }}">{{ __('Comments') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('comments.create') }}">Create a comments</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('requestInfo.index') }}">{{ __('RequestInfo') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('requestInfo.create') }}">Create a requestInfo</a>
</li>
