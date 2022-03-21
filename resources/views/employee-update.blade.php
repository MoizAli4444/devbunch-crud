<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title> Update </title>
  </head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" > 
    DevBunch
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
     
     </ul>
    <form class="form-inline my-2 my-lg-0">
      
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          <a href="{{route('log-out')}}" >Logout</a>
      </button>
    </form>
  </div>
</nav>
  <body>
  
  <h2 class="text-center">{{ $title }}</h2>

  <form class="container" method="post" action="{{route('employee.update',['id' => $employee->employee_id])}}">
      @csrf
     
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text"  name="name" value="{{ $employee->name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <span class="text-danger">
                @error('name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" value="{{ $employee->email }}"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <span class="text-danger">
                @error('email')
                    {{$message}}
                @enderror
            </span>
        </div>

        
<input type="hidden" name="hashpassword" value="{{ $employee->password }}"  class="form-control" id="exampleInputPassword1" placeholder="Password">
            
        <div class="form-group">
            <label for="exampleInputPassword1">Old Password</label>
            <input type="password" name="oldpassword"   class="form-control" id="exampleInputPassword1" placeholder="Password">
            <span class="text-danger">
                @if ( @$notmatch == 'xx' )
                    Old Password Not Matched
                @endif
            </span>
        </div>
        
        <div class="form-group">
            <label for="exampleInputPassword1">New Password</label>
            <input type="password" name="password"   class="form-control" id="exampleInputPassword1" placeholder="Password">
            <small class="text-danger">password must have 1 capital and small letter, 1 special character , 1 number and min length of 6 digits</small>
            <span class="text-danger">
                @error('password')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="cpassword"  class="form-control" id="exampleInputPassword1" placeholder="Password">
            <span class="text-danger">
                @error('cpassword')
                    {{$message}}
                @enderror
            </span>
        </div>

        <span>Address : </span> <input type="text" class="form-control" name="address" value="{{ $employee->address }}" >
        <br>
        <span>Status : </span> 
        <select name="status" value="{{ $employee->status }}" class="form-control">
            <option value="1">Active</option>
            <option value="0">In-active</option>
        </select>
        <br>
        <span>Gender : </span> 
        <input type="radio" name="gender" value="M" id="male" {{$employee->gender == "M" ? "checked" : ""}} >Male
        <input type="radio" name="gender" value="F" id="female" {{$employee->gender == "F" ? "checked" : ""}}>Female
        <input type="radio" name="gender" value="O" id="other" {{$employee->gender == "O" ? "checked" : ""}}>Other
       
       
        <br>

       <div class="text-center">
        <button type="submit" class="btn btn-primary text-center">Update</button>
       </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>