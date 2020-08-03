@extends('layouts.master_login')

@section('title','Signup')



@section('body')
	<div style= "text-align: center; font-size: 35px;font-family: Arial, Roboto, 'Times New Roman'; color: #1929A0;"> Fotobook Signup
	 		</div>
	 		<div style="background-color: #E1E1E1">
	 			<form class="p-4" id="form_signup" method="POST" action="{{url('register')}}" enctype="multipart/form-data">
	 				{{csrf_field()}}
	 				<div class="form-group">
					    <label for="exampleInputUserName">User Name</label>
					    <input type="text" class="form-control" id="exampleInputUserName" aria-describedby="firstNameHelp" placeholder="Enter UserName" name = "userName">
					    
					  </div>
					  <div class="form-group">
					    <label for="exampleInputFirstName">First Name</label>
					    <input type="text" class="form-control" id="exampleInputFirstName" aria-describedby="firstNameHelp" placeholder="Enter First" name = "firstName">
					    
					  </div>
					  <div class="form-group">
					    <label for="exampleInputLastName">Last Name</label>
					    <input type="text" class="form-control" id="exampleInputLastName" aria-describedby="lastNameHelp" placeholder="Enter Last Name" name="lastName">
					    
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail">Email</label>
					    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="EmailHelp" placeholder="Enter Email" name="email">
					    
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1"> Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
					    
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword2">Confirmation Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirmation Password" name="exampleInputPassword2">
					    
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
					  <div class="d-flex justify-content-center">
					  	<button type="submit" class="btn btn-primary">Submit</button>
					  </div>
					 
					</form>
	 		</div>
@endsection