<!DOCTYPE html>
<html >
<head>
    <?php
        include "config.php";
        if(isset($_GET['exit']))
        {
            session_unset();
        }
        if(isset($_SESSION['Teacher']))
        {
            if($_SESSION['Teacher'] > 0)
            {
                header('Location: editor.php');
            }
        }
    ?>
	<meta charset="UTF-8">
	<title>Flat Login Form</title>
  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<script src="js/jquery.js"></script>

	<link rel="stylesheet" href="css/style.css">
	
		<meta name="keywords" content="easydropdown, jquery, drop-down, bootstrap, front-end, css3, jquery, patrick kunka, barrel, new york, manhattan, mixitup"/>
		
		<link rel="shortcut icon" type="image/x-icon" href="http://kunkalabs.com/im/favicon.ico"/>
</head>

<body>
  
<div class="container">
  <div class="info">
    <h1>Библиотека ИнЕУ</h1><span></span>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
  <form class="register-form">
    <input type="text" name = 'NickName' placeholder="Имя"/>
	<input type="text" name = 'Surname' placeholder="Фамилия"/>
	<input type="text" name = 'Lastname' placeholder="Отчество"/>
	<!--<select class="dropdown" name="Faculty">
	<option value="0" class="label" value="">Выберите отделение</option>
	//<?php
		//$query = "SELECT * FROM Faculty";
		//$res=mysql_query($query);
		//while($row = mysql_fetch_assoc($res))
		//{
			//echo "<option value='".$row['ID']."'>".$row['Faculty']."</option>";
		//}
	//?>
	</select>
	<select class="dropdown" name="Group">
	<option value="0" class="label" value="">Выберите группу</option>
	</select>-->
    <input type="password" name = 'firstpassword' placeholder="Пароль"/>
	<input type="password" name = 'twopassword' placeholder="Повторите пароль"/>
    <input type="text" name = 'emailadress' placeholder="Адресс электронной почты"/>
    <button id = 'SinginButton'>Зарегистрироваться</button>
    <p class="message">Уже зарегистрированы? <a href="#">Войти</a></p>
  </form>
  <form class="login-form" action = "editor.php" method = "POST">
    <input type="text" name = 'Name' placeholder="Адресс электронной почты"/>
    <input type="password" name = 'Password' placeholder="Пароль"/>
    <?php
      if(isset($_GET['wrong']))
      {
        echo "<p style = 'color: #EF3B3A; font-size: 15px; font-weight: bold;'>Неверный логин или пароль!</p><Br>";
      }
      else if(isset($_GET['dostup']))
      {
        echo "<p style = 'color: #EF3B3A; font-size: 15px; font-weight: bold;'>Нет доступа!</p><Br>";
      }
    ?>      
    <button id = 'SingupButton'>Войти</button>
    <p class="message">Нет аккаунта? <a href="#">Зарегистрироваться</a></p>
  </form>
</div>
  <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

    <script src="js/index.js"></script>
    <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-39510854-3', 'patrickkunka.github.io');
		  ga('send', 'pageview');

    </script>
	<script>
        function AddGroup(data)
        {
            $('select[name=Group]').find('option').remove();
            $('select[name=Group]').append('<option value="0" class="label" value="">Выберите группу</option>');
            $('select[name=Group]').append(data);
        }
        $(document).ready(function()
        {
            /*$('select[name=Faculty]').change(function()
            {    
                $.ajax({
                    url: "changefaculty.php",
                    type: "POST",
                    data: ({faculty: $('select[name=Faculty]').val()}),
                    dataType: "html",
                    success: AddGroup
                });
            });*/
            $('#SingupButton').bind("click", function(event)
            {
                if($('input[name=Name]').val().length < 1) 
                {
                    event.preventDefault();
                    alert('Введите адресс электронной почты');     
                }
                else if($('input[name=Password]').val().length < 1) 
                {
                    event.preventDefault();
                    alert('Введите пароль');     
                }
            });
            $('#SinginButton').bind("click", function(event)
            {
                event.preventDefault();
                if($('input[name=NickName]').val().length < 1)
                {
                    alert('Введите имя');
                }
                else if($('input[name=Surname]').val().length < 1)
                {
                    alert('Введите фамилию');
                }
                else if($('input[name=Lastname]').val().length < 1)
                {
                    alert('Введите отчество');
                }
                else if($('input[name=firstpassword]').val().length < 1)
                {
                    alert('Введите пароль');
                }
                else if($('input[name=twopassword]').val().length < 1)
                {
                    alert('Повторите пароль');
                }  
                else if($('input[name=emailadress]').val().length < 1)
                {
                    alert('Введите адресс электронной почты');
                }      
                else if($('input[name=firstpassword]').val() != $('input[name=twopassword]').val())
                {
                    alert('Пароли не совпадают');
                }
                else
                {
                    $.ajax({
                        url: "registeraccount.php",
                        type: "POST",
                        data: ({Name: $('input[name=NickName]').val(), Surname: $('input[name=Surname]').val(), Lastname: $('input[name=Lastname]').val(), Firstpassword: $('input[name=firstpassword]').val(), Email: $('input[name=emailadress]').val()}),
                        dataType: "html",
                        success: function(data)
                        {
                            if(data == "0")
                            {
                                alert('Пользователь с таким адрессом электронной почты уже зарегистрирован.');    
                            }
                            else
                            {
                                alert('Вы успешно зарегистрировались. Сообщите администратору свой e-mail адресс.'); 
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
	</script>	

</body>
</html>
