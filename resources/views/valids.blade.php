
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Valid Mails Lists</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/email.jpeg" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<style>
  .animate-top{
    position:relative;
    animation:animatetop 0.4s
}
@keyframes animatetop{
    from{top:-300px;opacity:0} 
    to{top:0;opacity:1}
}
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.275);
}

.modal-content {
  margin: 5% auto;
  width: 500px;
  max-width: 90%;
  background-color: #fff;
  border: 1px solid rgba(0, 0, 0, 0.175);
  border-radius: .3rem;
  outline: 0;
}
.modal-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem;
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    margin-top: 0;
    font-size: 1.25rem;
    color:red;
}
.modal-header .close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
    padding: 1rem;
    margin: -1rem -1rem -1rem auto;
    background-color: transparent;
    border: 0;
}
.close:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.modal-body {
    flex: 1 1 auto;
    padding: 1rem;
}
.modal-body p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.modal-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid #e9ecef;
}
.modal-footer>*{
    margin: 5px;
}

/* buttons */
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    cursor: pointer;
}
.btn:focus, .btn:hover {
    text-decoration: none;
}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}
.btn-secondary {
    color: #fff;
    background-color: #7c8287;
    border-color: #7c8287;
}
.btn-secondary:hover {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}
</style>

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

        <br>
        <br>
        <br>
        <br>

        <table class="table">
  <thead>
    <tr>
      
    <th scope="col">
        <a href="{{url('/')}}/validmailspdf">
        <button class="btn btn-success">Export PDF</button>
        </a>
      </th>
    
      <th scope="col">
        <a href="{{url('/')}}/validmailsxls">
        <button class="btn btn-dark">Export XLS</button>
        </a>
      </th>
    

      <th scope="col">
      <button class="btn btn-danger" type="button" id="mbtn">Trash All</button>
      </th>
    </tr>
  </thead>
</table>


    <!-- The Modal -->
    <div id="modalDialog" class="modal">
    <div class="modal-content animate-top">
        <div class="modal-header">
            <h5 class="modal-title">Delete Alert!!</h5>
            <button type="button" class="close">
                <span aria-hidden="true">x</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are You want to delete all emails at-once! These emails can't recoverred anymore !!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close">Close</button>
          <a href="{{url('/')}}/deletevalidEmailAll"><button type="button" class="btn btn-danger">Delete</button></a>  
        </div>
    </div>
</div>

<br>



        <!-- invalid emails lists -->
        <table class="table">
  <thead>
    <tr>
      <!-- <th scope="col">Enroll No</th> -->
      <th scope="col">Email</th>
      <th scope="col">Submission Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
  @foreach($mail as $mail)
    <tr>
      <!-- <th scope="row">{{$mail->id}}</th> -->
      <td>{{$mail->name}}</td>
      <td>{{$mail->created_at}}</td>
      <td> <form action="{{url('/')}}/deletevalidEmail" method="POST"> @csrf <input type="hidden" name="emailid" value="{{$mail->id}}" required> <button class="btn btn-warning" style="color:black;" type="submit">Delete</button> </form> </td>
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

<script>
var modal = $('#modalDialog');
var btn = $("#mbtn");
var span = $(".close");

$(document).ready(function(){
    btn.on('click', function() {
        modal.show();
    });
    span.on('click', function() {
        modal.fadeOut();
    });
});

$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.fadeOut();
    }
});
</script>

</html>
