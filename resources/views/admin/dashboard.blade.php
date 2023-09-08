<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}

.pdf{
  background-color:green;
  color:white;
  padding:15px;
  font-size:20px;
}
.excel{
  background-color:blue;
  color:white;
  padding:15px;
  font-size:20px;
}
.csv{
  background-color:black;
  color:white;
  padding:15px;
  font-size:20px;
}
</style>

</head>
<body>

<div class="sidebar">
  <a class="active" href="#home">Home</a>
  <!-- <a href="#news">News</a>
  <a href="#contact">Contact</a> -->
  <a href="#about">Logout</a>
</div>

<div class="content">
  <h2>Welcome Admin</h2>
 
  <p>
  <div style="overflow-x:auto;">
  <table>
    <tr>
    <th>Users</th>
      <th>All Emails</th>
      <th>Valids</th>
      <th>Invalids</th>
    </tr>
    <tr>
        <td>{{$visitor}}</td>
        <td style="color:blue;">{{$all}}</td>
        <td style="color:green;">{{$valid}}</td>
        <td style="color:red;">{{$invalid}}</td>
    </tr> 
  </table>
</div>
  </p>

  <br>
  <div style="overflow-x:auto;">
    <table>
        <tr>
            <th>
                <a href="{{url('/')}}/admin_pdf_export">
                <button type="button" class="pdf">PDF</button>
                </a>
            </th>
          
            <th>
               <a href="{{url('/')}}/admin_csv_export">
               <button type="button" onclick="exportTasks(event.target);" class="csv">CSV</button>
               </a> 
            </th>
        </tr>
    </table>
  </div>
  <br>

  <p>
  <div style="overflow-x:auto;">
  <table>
    <tr>
      <th>Email</th>
      <th>Valids</th>
    </tr>
    @foreach($mail as $mail)
    <tr>
        <td>{{$mail->name}}</td>
        <td>{{$mail->updated_at}}</td>
    </tr> 
    @endforeach
  </table>
</div>
  </p>

</div>

</body>

<script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>


</html>
