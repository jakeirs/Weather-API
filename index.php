<?php
    
    $weather = "";
    $error = "";
    
    if ($_GET['city']) {
       
        $cityName = str_replace(' ', '_', $_GET['city']);
        
        $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$cityName."&appid=7f1b93df8a974caa97479241ecf96d21");  

        $weatherArray = (json_decode($urlContents, true));
        
       
        
        if (($weatherArray['cod']) === 200) {
         
        $temperature = floor($weatherArray['main']['temp'] - 273);
        
        $description = $weatherArray['weather'][0]['description'];
        
        $city = $weatherArray['name'];
        
        $wind = $weatherArray['wind']['speed'];
        
        $clouds = $weatherArray['clouds']['all'];
        
        $humidity = $weatherArray['main']['humidity'];
        
        $weather = "Aktualna pogoda w <strong>".$city."</strong> jest dla tych co znają angielski  " . $description . " ";
        
        $weather .= "<br>Temperatura to ".$temperature."&deg;C ";
        
        $weather .= "<br> Prędkość wiatru ".$wind."m/s ";
        
        $weather .= "<br> Zachmurzenie na poziomie ".$clouds."% ";
        $weather .= "<br> Wilgotność na poziomie ".$humidity."% ";
        } else {
            $error = "Nie można znaleźć miasta - spróbuj ponownie Janek";
        }
    
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
      <style type="text/css">
      
      html { 
          background: url(background.jpeg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              
          }
          
          .container {
              
              text-align: center;
              margin-top: 100px;
              width: 450px;
              
          }
          
          input {
              
              margin: 20px 0;
              
          }
          
          #weather {
              
              margin-top:15px;
              
          }
         
      </style>
      
  </head>
  <body>
    
      <div class="container">
      
          <h1>Jaką mamy pogodę?</h1>
          
          <form>
  <fieldset class="form-group">
    <label for="city">Podaj nazwę miasta:</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php echo $_GET['city']; ?>">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Wyślij</button>
</form>
      
          <div id="weather"><?php 
              
              if ($weather) {
                  
                  echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
                  
              } else if ($error) {
                  
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                  
              }
              
              ?></div>
      </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>