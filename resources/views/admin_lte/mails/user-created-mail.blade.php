<h1>Welcome to {{settings('site_name')}}</h1>

<p>Hi {{$user->name}}</p>

<p>We welcome you to our website and you can login to the application by clickig on this
    <a href="{{url('login')}}">URL</a> or you can paste this link below on your brower:</p>

<p>{{url('login')}}</p>

<p>You can login with this password <strong>{{$pass}}</strong>. We recommend you change this password as soon as possible. This is a system generated password which we don't store on our server in clear text. But still...</p>
