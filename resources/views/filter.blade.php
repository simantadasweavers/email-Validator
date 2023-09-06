
<!doctype html>
<html lang="en">

<head id="head">

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1234567890123456" crossorigin="anonymous"></script>

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
                <form id="extractEmailForm">
                    @csrf
                <div class="mb-3">
  <label for="emailarea" class="form-label">Put Your Emails(single/bulk)</label>
  <textarea class="form-control" name="emailTextarea" id="emailTextarea" rows="20"></textarea>
  {{ csrf_field() }}
</div>
  <button type="button" id="extractButton" class="btn btn-primary">Submit</button>
</form>

        </div>
      <!-- emd of eamil extractor form -->
    </div>


    <!-- show result -->
    <div class="row">
      <p id="totalEmails" class="text-center fs-4"></p>

      <br>

      <p class="text-center" style="color:#F00000;font-size:20px;" id="waitMsg">Plz wait and don't page reload!!</p>
  
      <br>

    <div class="col">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">RESULT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td id="printMSG"></td>
    </tr>
  </tbody>
</table>
    </div>

    <br>
  </div>

  </div>


  
 

  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
 </body>

<!-- email extractor via jquery -->
<script>
let validCount=0,invalidCount=0,totalEmailCount=0;
var allEmail=0;
</script>

<script>
    $(document).ready(function() {

      $('#head').hide();

      $('#waitMsg').hide();

  $('#extractButton').click(function() {
    var textareaValue = $('#emailTextarea').val(); // Get the value of the textarea
    var emails = extractEmails(textareaValue); // Call the email extraction function
     console.log(emails); // Output the extracted emails to the console (you can modify this part to suit your needs)
    console.warn(emails.length);
    var allEmail = emails.length;

    sessionStorage.setItem('allEmailSubmitNumber',allEmail);

    document.getElementById("totalEmails").innerHTML = "<b>Total Emails Number: </b>"+allEmail; 
    $('#extractEmailForm').hide();
    $('#waitMsg').show();
    $('#head').show();
      
    emails.forEach(myFunction);
});
});

</script>


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
                console.log(data);
                
                const str = data;
                const substr = 'INVALID';
                console.log(str.includes(substr));

                if(str.includes(substr)){
                  invalidCount++;
                  totalEmailCount++;
                  console.error(invalidCount);

                  console.log(sessionStorage.getItem('allEmailSubmitNumber'));

                  if(sessionStorage.getItem('allEmailSubmitNumber') == totalEmailCount){
                    alert("ALL EMAIL PROPERLY FILTERED !!");
                  }

                }
                else{
                  validCount++;
                  totalEmailCount++;
                  console.warn(validCount);

                  console.log(sessionStorage.getItem('allEmailSubmitNumber'));

                  if(sessionStorage.getItem('allEmailSubmitNumber') == totalEmailCount){
                    alert("ALL EMAIL PROPERLY FILTERED !!");
                  }

                }

                document.getElementById("printMSG").innerHTML += data; 
                }
            });

            // if(allEmail == totalEmailCount){
            //   console.warn("all email counted!");
            // }

}
</script>


<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  
</html>
