@foreach( $users as $user)
<h1>{$user->email} {$user->password} </h1>

<a href='http://localhost/MVC_PiePHP/user/{$user->id}'><button>Show</button></a> 
<a href='http://localhost/MVC_PiePHP/user/delete/{$user->id}'><button>Delete</button></a> 
@endforeach