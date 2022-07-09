<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
       .footer-bs h2{
        font-family: 'Lobster', cursive;
       }
       .footer-bs {
    background-color: #3c3d41;
	padding: 60px 40px;
	color: rgba(255,255,255,1.00);
	margin-bottom: 20px;
	border-bottom-right-radius: 6px;
	border-top-left-radius: 0px;
	border-bottom-left-radius: 6px;
}
.footer-bs .footer-brand, .footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { padding:10px 25px; }
.footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { border-color: transparent; }
.footer-bs .footer-brand h2 { margin:0px 0px 10px; }
.footer-bs .footer-brand p { font-size:12px; color:rgba(255,255,255,0.70); }

.footer-bs .footer-nav ul.pages { list-style:none; padding:0px; }
.footer-bs .footer-nav ul.pages li { padding:5px 0px;}
.footer-bs .footer-nav ul.pages a { color:rgba(255,255,255,1.00); font-weight:bold; text-transform:uppercase; }
.footer-bs .footer-nav ul.pages a:hover { color:rgba(255,255,255,0.80); text-decoration:none; }
.footer-bs .footer-nav h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
	margin-bottom:10px;
}

.footer-bs .footer-nav ul.list { list-style:none; padding:0px; }
.footer-bs .footer-nav ul.list li { padding:5px 0px;}
.footer-bs .footer-nav ul.list a { color:rgba(255,255,255,0.80); }
.footer-bs .footer-nav ul.list a:hover { color:rgba(255,255,255,0.60); text-decoration:none; }

.footer-bs .footer-social ul { list-style:none; padding:0px; }
.footer-bs .footer-social h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
}
.footer-bs .footer-social li { padding:5px 4px;}
.footer-bs .footer-social a { color:rgba(255,255,255,1.00);}
.footer-bs .footer-social a:hover { color:rgba(255,255,255,0.80); text-decoration:none; }

.footer-bs .footer-ns h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
	margin-bottom:10px;
}
.footer-bs .footer-ns p { font-size:12px; color:rgba(255,255,255,0.70); }

@media (min-width: 768px) {
	.footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { border-left:solid 1px rgba(255,255,255,0.10); }
}
    </style>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<footer class="footer-bs" > <!--style="background-color:#99d3df "-->
      <div class="row">
        <div class="col-md-6 footer-brand animated fadeInLeft">
            <h2>Peek-A-Book</h2>
        <p> Experience Online Book Purchase Like Nowhere else</p>
              <p>© 2020, All rights reserved</p>
          </div>
        <div class="col-md-4 footer-nav animated fadeInUp">
            <div class="col-md-6">
                  <ul class="list">
                      <li><a href="AboutUs.php">About Us</a></li>
                      <li><a href="ContactUs.php">Contacts</a></li>
                      <li><a href="#">Terms & Condition</a></li>
                      <li><a href="#">Privacy Policy</a></li>
                  </ul>
              </div>
          </div>
        <div class="col-md-2 footer-social animated fadeInDown">
            <h4>Follow Us</h4>
            <ul>
                <li><a href="https://www.facebook.com/">Facebook</a></li>
                <li><a href="https://twitter.com/">Twitter</a></li>
                <li><a href="https://www.linkedin.com/">LinkedIn</a></li>
                <li><a href="https://www.instagram.com/">Instagram</a></li>
              </ul>
          </div>

      </div>
  </footer>
    <!-- Optional JavaScript , dont put anything after this section-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>