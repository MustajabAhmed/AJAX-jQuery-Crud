<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <!-- Button trigger modal -->

  
  <!-- Student Add Modal -->
  <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form id="addform"> --}}

            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <input type="text" class="form-control" name="course" id="course">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="adddata();" type="button" class="btn btn-primary">Save student data</button>
            </div>
        {{-- </form> --}}
      </div>
    </div>
  </div>
  {{-- End of add Student data --}}


  <!-- Student Edit Modal -->
  <div class="modal fade" id="studenteditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit data of student using AJAX jQuery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form id="addform"> --}}
            
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="ename" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="eemail" placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" name="phone"  id="ephone">
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <input type="text" class="form-control" name="course"  id="ecourse">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="adddata();" type="button" class="btn btn-primary">Save changes</button>
            </div>
        {{-- </form> --}}
      </div>
    </div>
  </div>
  {{-- end of edit student data form --}}


    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <h1>Laravel CRUD - AJAX jQuery using Bootstrao modal</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        Add Student Data
                  </button>
            </div>
            <br>
            <table class="table table-bordered table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Course</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($students))
                    @foreach($students as $student)
             
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->course }}</td>
                            <td>
                                <a href="{{ url('/index/edit/{id}') }}" onclick="return editdata();" class="btn btn-secondary editbtn">Edit</a>
                                <a href="#" class="btn btn-danger editbtn">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function editdata()
        {
            $('#studenteditmodal').modal('show');
            $tr = $(this).closest('tr');
            var data=$tr.children('td').map(function(){
                return $(this).text();
            }).get();
            consol.log(data);

            $('#eid').val(data[0]);
            $('#ename').val(data[1]);
            $('#eemail').val(data[2]);
            $('#ephone').val(data[3]);
            $('#ecourse').val(data[4]);
        }
    </script>

    <script>
        function adddata()
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "post",
                url: "{{ url('/add') }}",
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    course: $('#course').val(),
                },
                success: function (response) {
                    console.log(response);
                    $('#studentaddmodal').modal('hide');
                    alert("Data Saved Successfully......");
                    // location.reload();
                }
            });
        }
    </script>















    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</body>
</html>