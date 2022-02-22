<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap Cdn Links --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">Navbar</span>
    </nav>

    <div class="container">

        <div class="row col-lg-12 pt-4 pb-4">
            <div class="row col-lg-10">
                <div class="h4">User Record</div>
            </div>
            <div class="row col-lg-2">
                <div class="col-lg-12 btn btn-success" data-toggle="modal" data-target="#addNewUserModal">Add New</div>
            </div>
        </div>

        {{-- Table --}}

        <table class="table">
            <thead>
              <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Experience</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($customerData as $item)
     
                    <tr>
                        <td><img src="{{URL::asset('/images/'.$item->avatar)}}" alt="Avatar" class="rounded-circle" style="object-fit:cover; height:50px; width:50px;"></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->total_experience}}</td>
                        <td><a href="{{URL::to('customer/delete/'.$item->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Remove</a></td>
                    </tr>
                  @endforeach
              
            </tbody>
        </table>

        {{-- Add new user Modal --}}
        <div class="modal fade" id="addNewUserModal" tabindex="-1" role="dialog" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addNewUserModalLabel">Add New Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('customer/insert')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>
                        </div>
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Eg. John Doe" required>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="joiningDate"  class="col-sm-2 col-form-label">Date of Joining</label>
                            <div class="col-sm-10">
                                <input type="date" name="joining_date" class="form-control col-lg-6" id="joiningDate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leavingDate" class="col-sm-2 col-form-label">Date of Leaving</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control col-lg-6" name="leaving_date" id="leavingDate">
                                <input type="checkbox" name="working" id="working" value="1"> Still Working
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-sm-2 col-form-label">Upload Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="avatar" id="image" accept="image/*">
                            </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-success col-lg-12">Sign in</button>
                          </div>
                        </div>
                      </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>

    </div>

    <script >
        var working = 0;
        $("#working").click(function(){
            if(working == 0)
            {
                $("#leavingDate").prop('disabled', true);
                working = 1;
            }
            else
            {
                $("#leavingDate").prop('disabled', false);
                working = 0; 
            }
        });

       var leavingDate =  $("#leaving_date").value;
       console.log(leavingDate);
    </script>
</body>
</html>