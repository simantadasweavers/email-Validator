<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Valids Emails Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
   

  <br>
  <br>


  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Enroll No</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
  @foreach($mail as $mail) 
  <tr>
      <th scope="row">{{$mail->id}}</th>
      <td>{{$mail->name}}</td>
      <td>{{$mail->created_at}}</td>
    </tr>
   @endforeach
  </tbody>
</table>

    </div>
    <div class="col-1"></div>
  </div>
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>