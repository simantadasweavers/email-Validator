
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Emails filter page ~ Email Validator</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/email.jpeg" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <script src="jquery.js"></script>

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

      <div class="container-fluid">


        <div class="row">
                <!--  email extractor -->
                <form>
                    @csrf
                <div class="mb-3">
  <label for="emailarea" class="form-label">Put Your Emails(single/bulk)</label>
  <textarea class="form-control" name="emailTextarea" id="emailTextarea" rows="20"></textarea>
  {{ csrf_field() }}
</div>
  <button type="button" id="extractButton" class="btn btn-primary">Submit</button>
</form>

        </div>



    </div>
  </div>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
 </body>

<!-- email extractor via jquery -->
<script>
    function extractEmails(text) {
  var regex = /[\w\.-]+@[\w\.-]+\.\w+/g; // Regular expression to match email patterns
  var emails = text.match(regex); // Extract emails using regex
  return emails || []; // Return the extracted emails (or an empty array if no emails were found)
}

function myFunction(item,index){
    // prints each email by their index assending
    console.log(item);

    var email = item;
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{route('checkemail')}}",
        method:"POST",
        data: {email: email, _token:_token},
        success:function(data){
                // if(data){
                //     alert('This email id already exist!! Please provide your another email-id');
                // }else{
                //     console.log('email not exist!!');
                // }
                console.log(data);
              }
            });


}
</script>
<script>
    $(document).ready(function() {
  $('#extractButton').click(function() {
    var textareaValue = $('#emailTextarea').val(); // Get the value of the textarea
    var emails = extractEmails(textareaValue); // Call the email extraction function
    console.log(emails); // Output the extracted emails to the console (you can modify this part to suit your needs)
    emails.forEach(myFunction);
});
});

</script>

</html>
