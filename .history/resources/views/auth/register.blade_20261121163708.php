<div>
    <form method="POST" action="{{ route('register.store') }}">
    @csrf
    <input name="name">
    <input name="email" type="email">
    <input name="password" type="password">
    <input name="password_confirmation" type="password">

</div>
