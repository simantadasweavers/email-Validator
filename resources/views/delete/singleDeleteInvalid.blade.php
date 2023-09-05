
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Single Email Delete</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/email.jpeg" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->

    <x-navbar />

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <!-- <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a> -->
            </li>
          </ul>

          <x-profile />


        </nav>
      </header>
      <!--  Header End -->

      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">

        <table class="table">
  <thead>
    <tr>
      <th scope="col">Enroll No</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <font>hello</font>

  @foreach($email as $email)
    <tr>
      <th scope="row">{{$email->id}}</th>
      <td colspan="2">{{$email->name}}</td>
      <td>{{$email->date}}</td>
      <td> <form action="{{url('/')}}/deleteInvalidEmail_req" method="POST"> @csrf <input type="hidden" name="mailid" value="{{$email->id}}" required> <button class="btn btn-danger" type="submit">Delete</button> </form> </td>
    </tr>
    @endforeach

</tbody>
</table>

        </div>
        <div class="col-1"></div>
      </div>


    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>


