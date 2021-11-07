@extends('main.theme')
@section('content')

<div class="container py-5">
  <div class="row">
     <div class="col-md-12 ">
         <div id="successmessage"></div>
        <div class="card " >
           <div class="card-header "  >
               <h4 class="">Students Data
                   <a href="" class="btn btn-primary float-end btn-sm " data-bs-toggle="modal" data-bs-target="#exampleModal" > Add Student</a>
               </h4>
           </div>
            <div class="card-body ">
               <table class=" table table-bordered table-striped">
                <thead>
                    <tr>
                     
                      <th>id</th>
                          
                      <th>name</th>
                      <th>email</th>
                      <th>phone</th>
                      <th>course</th>
                      <th>Edit</th>
                      <th>Delete</th>
               
                       
                    </tr>
                  </thead>
                  <tbody>
           
             

                  </tbody>

               </table>
            </div>
       
       
          </div>


     </div>


  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
   <form action="" method="post" id="reset">
        <div class="modal-body">
            <ul id="errorlist"></ul>
          <div class="form-group mb-3">
              <label for=""> Student Name</label>
              <input type="text"  name="name" class=" name form-control">
              
          </div>
          
          <span class="form-group" id="errorname"></span>
          <br><br>
          <div class="form-group mb-3">
            <label for=""> Student Email</label>
            <input type="text"  name="email" class=" email form-control">
        </div>
        <span class="form-group" id="erroremail"></span>
        <br><br>
       
        
        <div class="form-group mb-3">
            <label for=""> Student Phone</label>
            <input type="text"   name="phone" class=" phone form-control">
        </div>
        <span class="form-group" id="errorphone"></span>
        <br><br>
        <div class="form-group mb-3">
            <label for=""> Student Course</label>
            <input type="text"  name="course" class=" course form-control">

        </div>
        <span class="form-group" id="errorcourse"></span>
        <br><br>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-primary add-student" data-bs-dismiss="modal">Add Student</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')

<script>
$(document).ready(function(){
    fetchstudent();
    function fetchstudent(){
         $.ajax({
         type:"get",
         url:"{{route('show')}}",
         dataType:"json",
         success: function(response){
                $.each(response.students,function(key,item){
                  $('tbody').append('<tr>\
                    <td>'+item.id+'</td>\
                    <td>'+item.name+'</td>\
                    <td>'+item.email+'</td>\
                    <td>'+item.phone+'</td>\
                    <td>'+item.course+'</td>\
                    <td><button type="button" value="'+item.id+'" class="btn btn-primary add-student" data-bs-dismiss="modal">Edit</button></td>\
                    <td><button type="button" value="'+item.id+'" class="btn btn-primary add-student" data-bs-dismiss="modal">Delete</button></td>\
                    <td></td>\
                    </tr>');
                });
         }
         });
    }



     $(document).on('click','.add-student', function(e){
       e.preventDefault();
   
      var data={
       'name':$('.name').val(),
       'email':$('.email').val(),
        'phone':$('.phone').val(),
        'course':$('.course').val(),

      }
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     // console.log(data);

     $.ajax({
         type:"POST",
         url:"{{route('store')}}",
         data: data,
         dataType:"json",
         success:function(response){
            //  console.log(response.errors.name);
            if(response.status=="400"){
                $('#errorname').html("");
                $('#errorname').addClass('alert alert-danger');
                $('#erroremail').addClass('alert alert-danger');
                $('#errorphone').addClass('alert alert-danger');
                $('#errorcourse').addClass('alert alert-danger');
                $.each(response.errors.name,function(key,err_values){
                  $("#errorname").append(err_values);
                });
                $.each(response.errors.email,function(key,err_values){
                  $("#erroremail").append(err_values);
                });
                $.each(response.errors.email,function(key,err_values){
                  $("#errorphone").append(err_values);
                });
                $.each(response.errors.course,function(key,err_values){
                  $("#errorcourse").append(err_values);
                });
            }
            else{
                $('#successmessage').addClass('alert alert-success');
                $('#successmessage').text(response.message);
            }
         }
         
     });
     $("#reset").html('');
     fetchstudent();
     });
    
});


</script>


@endsection