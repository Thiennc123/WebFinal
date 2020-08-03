@extends('layouts.master_login')

@section('title','Login111')

@section('body')

		
	<div class="row">

	 			<div style= "text-align: center; font-size: 35px;font-family: Arial, Roboto, 'Times New Roman'; color: #1929A0;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Fotobook Login
	 			</div>
	 		</div>
	 		
	 		
	 		<div style="background-color: #E1E1E1">
				<div class=" pt-5 d-flex justify-content-center">
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRwcJ6SdMb4PjPEVJsOLa798_0BzbeglCUHSg&usqp=CAU" class="d-flex justify-content-center rounded-circle " style="width: 100px;">
				</div>
				<div>
					<form class="p-4" id="form_signup" method="POST" action="{{url('postInfo')}}">
						{{csrf_field()}}
					  <div class="form-group">
					    <label for="exampleInputEmail">Email</label>
					    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="EmailHelp" placeholder="Enter Email" name="email">
					    

					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
					    
					  </div>

					  @if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <p>{{ $error }}</p>
						            @endforeach
						        </ul>
						    </div>
						@endif

						@if(isset($info))
							<div class="alert alert-danger">
						        <p>{{$info}}</p>
						    </div>
						@endif
					  
					  <div class="d-flex justify-content-center">
					  	<button type="submit" class="btn btn-primary">Login</button>
					  </div>
					 
					</form>
					<a href="{{route('signup')}}" class="d-flex justify-content-center">Create acount??</a>
				</div>
	 			
	 		</div>
@endsection



