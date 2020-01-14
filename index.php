<!Doctype HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>R.A.G.E.S</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
	<link href="..\CSS2\categories.css" rel="stylesheet" type="text/css">
	<style>
		.creatori{
		margin-left:0.35em;
		margin-top:10%;
		font-weight:bold;
		text-align:center
		}
	</style>
  </head>
  <body>
  <script type="text/JavaScript">
	var telefoane = [];
	var contor = [];
	var i ,k = 0;
	function aranjare_modele(nume_model){
		var ok = 1;
		for (i = 0 ; i < k ; i++){
			if(telefoane[i] == nume_model){
				contor[i]++;
				ok = 0;
				break;
			}
		}
		if(ok){
			telefoane[k] = nume_model;
			contor[k] = 1;
			k++;
		}
	}
	function afisare(){
		for(i = 0 ; i < k ; i++){
			document.write(telefoane[i]);
			document.write(contor[i]);
		}
	}
  </script>
  <?php 
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$con = mysqli_connect('localhost', 'root', '', 'bazadateproiect','3306');
	$selectare = mysqli_query($con,"SELECT * FROM bazadate");
	/*$selectare2 = mysqli_query($con,"SELECT Phone_Brand, count(*) as phone from bazadate group by Phone_Brand" );
	while($row = $selectare2->fetch_row()){
		echo ucfirst(strtolower($row[0])).' '.$row[1].' ';
	}*/
	/*$data = mysqli_fetch_assoc($selectare2)
	foreach($data as $row)
	{
		echo $row['phone'];
		echo $row['Phone_Brand'];
	}*/
	$numar = mysqli_num_rows($selectare);
	?>
    <aside class="side-nav" id="show-side-navigation1">
      <i class="fa fa-bars close-aside hidden-sm hidden-md hidden-lg" data-close="show-side-navigation1"></i>
      <div class="heading">
        <img src="logo.png" alt="">
        <div class="info">
          <h3><a href="#">R.A.G.E.S</a></h3>
          <p>Un site creat pentru telefonul tau!</p>
        </div>
      </div>
      <ul class="categories">
        <li><i class="fa fa-home fa-fw"></i><a href="#">ACASA</a></li>
	  </ul>
    </aside>
    <section id="contents">
      
      <section class="charts">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="chart-container">
                <h3 align = "center" style="font-weight:bold;">CELE MAI UTILIZATE BRAND-URI</h3>
                <canvas id="chart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </section>
	  <section class="charts">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="chart-container">
                <h3 align = "center" style="font-weight:bold;">SPECIFICATIILE TELEFOANELOR REGASITE IN BAZA DE DATE</h3>
                <iframe style = "width:100%;height:50em;" frameborder="0" src = "Grafic.html"></iframe>
              </div>
            </div>
          </div>
        </div>
      </section>
	  <section class='statis text-center'>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="box danger">
                  <i class="fa fa-user-o"></i>
                  <h3><?php echo $numar; ?></h3>
                  <p class="lead">Telefoane inregistrate</p>
                </div>
              </div>
            </div>
          </div>
        </section>
      <section class="admins">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="box" style="padding-top:5em;">
                <h3 align="center">Creator aplicatie</h3>
                <div class="admin">
                  <div class="img">
                    <img class="img-responsive" src="mihai.jpg" alt="admin">
                  </div>
                  <div class="info">
                    <h1 class = "creatori" data-heading="Mihai Andrei-Daniel">Mihai Andrei-Daniel</h1>
                  </div>
                </div>
				<h3 align = "center">Creator Site</h3>
                <div class="admin">
                  <div class="img">
                    <img class="img-responsive" src="sebi.jpg" alt="admin">
                  </div>
                  <div class="info">
                    <h1 class = "creatori" data-heading="Serban Marin-Eusebiu">Serban Marin-Eusebiu</h1>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="box">
                <h3 align ="center">Colectare Date</h3>
                <div class="admin">
                  <div class="img">
                    <img class="img-responsive" src="silviu.jpg" alt="admin">
                  </div>
                  <div class="info">
                    <h1 class = "creatori" data-heading="Patrascu Bolovan Silviu">Patrascu Bolovan Silviu</h1>
                  </div>
                </div>
				<div class="admin">
                  <div class="img">
                    <img class="img-responsive" src="ebi.jpg" alt="admin">
                  </div>
                  <div class="info">
                    <h1 class = "creatori" data-heading="Ceolca Paul-Robert">Ceolca Paul-Robert</h1>
                  </div>
                </div>
                <div class="admin">
                  <div class="img">
                    <img class="img-responsive" src="bustan.jpg" alt="admin">
                  </div>
                  <div class="info">
                    <h1 class = "creatori" data-heading="Bustan Gabriel">Bustan Gabriel</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </section>
      </section>
      <script src='http://code.jquery.com/jquery-latest.js'></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
	  <script type="text/javascript">
	  function capitalizeFLetter() { 
          var input = document.getElementById("input"); 
          var x = document.getElementById("div"); 
          var string = input.value; 
          x.innerHTML = string[0].toUpperCase() +  
            string.slice(1); 
        } 
	  $(document).ready(function(){
		$.ajax({
		url: "http://localhost/date.php",
		method: "GET",
		success: function(data) {
		  console.log(data);
		  var model = [];
		  var numar = [];

		  for(var i in data) {
			var model1 = data[i].Phone_Brand.toLowerCase();
			const nameCapitalized = model1.charAt(0).toUpperCase() + model1.slice(1)
			model.push(nameCapitalized);
			numar.push(data[i].phone);
		  }
	
      var data = {
		labels: model,
	  datasets: [{
		label: "Numar Dispozitive",
		backgroundColor: "rgba(255,99,132,0.2)",
		borderColor: "rgba(255,99,132,1)",
		borderWidth: 2,
		hoverBackgroundColor: "rgba(255,99,132,0.4)",
		hoverBorderColor: "rgba(255,99,132,1)",
		data: numar,
	  }]
	};
	
	var options = {
	  maintainAspectRatio: true,
	  scales: {
		yAxes: [{
		  stacked: true,
		  gridLines: {
			display: true,
			
			color: "rgba(255,99,132,0.2)"
		  }
		}],
		xAxes: [{
		  gridLines: {
			display: false
		  }
		}]
	  }
	};

	Chart.Bar('chart', {
	  options: options,
	  data: data
	});
	}
		});
	  });
  </script>
      </body>
    </html>