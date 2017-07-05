<html>
<head>
    <title>Электронный учебник</title>
    <?php
        include "config.php";
        if(isset($_POST['Name'])) 
        {
            $query = "SELECT * FROM `accounts` WHERE `Email` = '".$_POST['Name']."' AND `Password` = '".$_POST['Password']."'";
            $res= mysql_query($query);
            if(mysql_num_rows($res) < 1)
            {
                header('Location: index.php?wrong=1');   
            }
            else
            {
                $row = mysql_fetch_assoc($res);
                $dostup = $row['LevelAcess'];
                if($row['LevelAcess'] > 0) $_SESSION['Teacher'] = $row['ID'];
                else header('Location: index.php?dostup=1'); 
            }
        }
        else if(!isset($_SESSION['Teacher']))
        {
            header('Location: index.php');
        }
    ?>
    <meta charset="UTF-8">
    <script src="js/jquery.js"></script>
    <script src = 'ckeditor/ckeditor.js'></script>
    <script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="jqueryui/jquery-ui.css" rel="stylesheet">
    <script src="jqueryui/jquery-ui.min.js"></script>
    <link href="jqueryui/jquery-ui.css" rel="stylesheet">
    <script src="jqueryui/jquery-ui.min.js"></script>    
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Oswald|Roboto+Slab');
        #textbox
        {
            position: absolute;
            background: rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            width: 70%;
            height: 50%;
            left: 27%;
            top: 42%;
            overflow-y: auto;
        }
        #titlebox
        {
            position: absolute;
            background: rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            width: 70%;
            height: 10%;
            left: 27%;
            top: 28%;
        }        
        .buttonread
        {
            position: absolute;
            right: 0%;
            top: -1%;
            width: 20%;
            height: 102%;
            background: #EF3B3A;
            display: block;
        }
        .bookahref
        {
            color: #000;
            text-decoration: none;
        }
        #titletext
        {
            position: absolute;
            top: 30%;
            left: 5%;
            font-family: 'Roboto Slab', sans-serif;
            font-size: 25px;
            text-align: center;
        }
        #texttext
        {
            position: absolute;
            width: 90%;
            top: 5%;
            left: 5%;
            font-family: 'Roboto Slab', sans-serif;
            font-size: 20px;    
        }
        #sort1 
        {
            list-style-type:none; 
            margin:0; 
            padding:0; 
            width:45%; 
            float: left;
            top: 1%;
        }
        #sort1 li 
        { 
            //margin:2px;
            padding: 0.4em; 
            border-style:solid; 
            //border-width:1px;
            height: 38px; 
            background-color:#fff;
        }
        #sort2 
        {
            position:absolute;
            top: 5%;
            left:260px;
            list-style-type:none; 
            margin:0; 
            padding:0; 
            width:45%; 
        }
        #sort2 li 
        { 
            padding: 0.4em; 
            border-style:solid; 
            //border-width:1px;
            height: 38px; 
            background-color:#fff;
        }
        #sort1 li:hover
        {
            cursor: pointer;
        }
        #sort2 li:hover
        {
            cursor: pointer;
        }  
        #selectsection
        {
            position: absolute;
            top: 2%;
            left: 27%;
            width: 480px;
            height: 200px;
            box-shadow: 0 0 2px rgba(0,0,0,0.5);
            padding-left: 25px;
            padding-top: 10px; 
            overflow: auto;
        }
        @media (max-width: 1368px) 
        {
            #selectsection
            {
                position: absolute;
                top: 2%;
                left: 27%;
                width: 480px;
                height: 180px;
                box-shadow: 0 0 2px rgba(0,0,0,0.5);
                padding-left: 25px;
                padding-top: 10px; 
                overflow: auto;
            }   
        }
        #hidenbook
        {
            display: none;
        }
    </style>
</head>
<body>
    <div id = 'allcontent'></div>
    <div id = 'content'>
        <div id="sidebar">
           <div id = 'logo'></div>
            <ul id = 'sidebarmenu'>
                <li><a href = 'editor.php' class = 'sd_icon sd_add'>Добавить материал</a></li>
                <li><a href = 'view.php' class = 'sd_icon sd_book'>Мои материалы</a></li>
                <li><a href = 'media.php' class = 'sd_icon sd_information'>Медиа-менеджер</a></li>
                <li><a href = 'admin.php?exit=1' class = 'sd_icon sd_exit'>Выход</a></li>
            </ul>   
        </div> 
        <Br>
        <div id="hidenbook">
            <?php
                echo $_GET['book'];
            ?>
        </div>
        <div id="selectsection">
            <ol id="sort1" class="ui-widget connect">
               <?php
                    $query = "SELECT * FROM templates WHERE ID_Razdel = 0 AND ID_Book = ".$_GET['book'];
                    $res=mysql_query($query);
                    while($row = mysql_fetch_assoc($res))
                    {
                        echo "<li>".$row['Razdel']."</li>";
                    } 
                ?>
            </ol>
            <br />
            <ol id="sort2" class="ui-widget connect">
               <?php
                    $query = "SELECT * FROM templates WHERE ID_Razdel = 0 AND ID_Book = ".$_GET['book'];
                    $res=mysql_query($query);
                    $row = mysql_fetch_assoc($res);
                    $id = $row['ID'];
                    $query = "SELECT * FROM `templates` WHERE `ID_Razdel` = '".$id."' AND `ID_Book` = ".$_GET['book'];
                    $res=mysql_query($query);
                    if(mysql_num_rows($res))
                    {
                        while($row = mysql_fetch_assoc($res))
                        {
                            echo "<li>".$row['Razdel']."</li>";
                        } 
                    }
                ?>
            </ol>
        </div>
        <div id="titlebox">
            <div id="titletext">
                <?php
                    $query = "SELECT * FROM templates WHERE ID_Book = ".$_GET['book'];
                    $res=mysql_query($query);
                    $row = mysql_fetch_assoc($res);
                    echo $row['Razdel'];
                ?>
            </div>
        </div>
        <div id="textbox">
            <div id="texttext">
                <?php
                    $query = "SELECT * FROM templates WHERE ID_Book = ".$_GET['book'];
                    $res=mysql_query($query);
                    $row = mysql_fetch_assoc($res);
                    echo $row['Text'];
                ?>
            </div>
        </div> 
    </div>    
    <script>
        function AddGroup(data)
        {
            $('select[name=selectgroupselect]').find('option').remove();
            $('select[name=selectgroupselect]').append('<option disabled value="0" class="label" value="">Выберите группу</option>');
            $('select[name=selectgroupselect]').append(data);
        }
        function hotkey(event) 
        {
            if(event.keyCode == 73)
            {
                alert(document.body.scrollWidth+'x'+document.body.scrollHeight);
            }
        }
        $(document).ready(function()
        {
            var $menuitem = $('#sidebar').children("ul").children("li").children("a"),
            $popupcontent = $('#popupcontent'),
            $content = $('#content'),
            $closeicon = $('#closeicon'),
            $allcontent = $('#allcontent');
            $('#sort1').children("li").bind('click', function()
            {
                var str;
                $('#sort1').children("li").each(function()
                {
                    str = $(this).text(); 
                    if(str.indexOf('+') != -1) $(this).text(str.slice(2));
                });
                var s = $(this).text();
                var bookdata = "<?php echo $_GET['book']; ?>";
                $.ajax({
                    url: "selectpodrazdel.php",
                    type: "POST",
                    data: ({Section: s, Book: bookdata}),
                    dataType: "html",
                    beforeSend: function()
                    {
                        $('#sort2').find('li').remove();    
                    },
                    success: function(data)
                    {
                        $('#sort2').append(data);
                    }
                });
                $.ajax({
                    url: "selectrazdel.php",
                    type: "POST",
                    data: ({Section: s, Book: bookdata}),
                    dataType: "html",
                    beforeSend: function()
                    {
                        $('#texttext').empty();    
                    },
                    success: function(data)
                    {
                        $('#texttext').html(data);
                    }
                });   
                $('#titletext').empty();  
                $('#titletext').html(s);
                var n = '+ ' + s;
                $(this).text(n);
            });
            var timerId = setTimeout(function tick() 
            {
                    $('#sort2').children("li").bind('click', function()
                    {
                        var str;
                        $('#sort2').children("li").each(function()
                        {
                            str = $(this).text(); 
                            if(str.indexOf('+') != -1) $(this).text(str.slice(2));
                        });
                        var s = $(this).text();
                        var bookdata = "<?php echo $_GET['book']; ?>";
                        $.ajax({
                            url: "selectrazdel.php",
                            type: "POST",
                            data: ({Section: s, Book: bookdata}),
                            dataType: "html",
                            beforeSend: function()
                            {
                                $('#texttext').empty();    
                            },
                            success: function(data)
                            {
                                $('#texttext').html(data);
                            }
                        });   
                        $('#titletext').empty();  
                        $('#titletext').html(s);
                        var n = '+ ' + s;
                        $(this).text(n);
                    });
                    timerId = setTimeout(tick, 1000);
            }, 1000);
            $('#buttoncreate').bind("click", function(event)
            {
                event.preventDefault();
                var src = "";
                $('select[name=selectedgroupselect] option').each(function()
                {
                    src = src+this.value+',';
                });
                $.ajax({
                    url: "createbook.php",
                    type: "POST",
                    data: ({Name: $('#namebookedit').val(), Group: src.substring(0, src.length - 1)}),
                    dataType: "html",
                    success: function(data)
                    {
                        if(data == "0")
                        {
                            alert("Учебник с таким названием уже существует.");
                        }
                        else
                        {
                            alert("Учебник успешно создан.");
                            location.reload();
                        }
                    }
                });
            });
            $('#buttonadd').bind("click", function(event)
            {
                event.preventDefault();
                var n = false;
                $('select[name=selectedgroupselect] option').each(function()
                {
                    if(this.text == $("select[name=selectgroupselect] :selected").text()) 
                    {
                        n = true;
                        alert("Группа уже выбрана");
                    }
                });
                if(!n)
                {
                    $('select[name=selectedgroupselect]').append('<option value="'+$("select[name=selectgroupselect] :selected").val()+'" class="label" value="">'+$("select[name=selectgroupselect] :selected").text()+'</option>');  
                }
            });
            $('#buttondelete').bind("click", function(event)
            {
                event.preventDefault();
                $("select[name=selectedgroupselect] :selected").remove();
            });
            $('select[name=facultyselect]').change(function()
            {    
                $.ajax({
                    url: "changefaculty.php",
                    type: "POST",
                    data: ({faculty: $('select[name=facultyselect]').val()}),
                    dataType: "html",
                    success: AddGroup
                });
            });
            $menuitem.bind("mouseenter", function(event)
            {
                $(this).addClass('sd_animicon');
                $(this).removeClass('sd_animiconreset');
            });
            $menuitem.bind("mouseleave", function(event)
            {
                $(this).removeClass('sd_animicon');
                $(this).addClass('sd_animiconreset');
            });
            $closeicon.bind("click", function(event)
            {
                event.preventDefault();
                $content.removeClass('is-hidden');
                $popupcontent.removeClass('is-visible');
                $allcontent.removeClass('is-visible');
                $closeicon.removeClass('is-visible');
            });
            $('#bookadd').bind("click", function(event)
            {
                event.preventDefault();
                $content.addClass('is-hidden');
                $popupcontent.addClass('is-visible');
                $allcontent.addClass('is-visible');
                $closeicon.addClass('is-visible');
            });
            $('#bookaddsection').bind("click", function(event)
            {
                event.preventDefault();
                var str, src;
                $('#sort1').children("li").each(function()
                {
                    str = $(this).text(); 
                    if(str.indexOf("+") != -1)
                    {
                        src = str.replace("+", "");  
                    }
                });
                //alert(CKEDITOR.instances.editor.getData());
                $.ajax({
                    url: "addrazdel.php",
                    type: "POST",
                    data: ({Name: $('#titlebookedit').val(), Book: $('select[name=bookselect]').val(), Subsection: src}),
                    dataType: "html",
                    success: function(data)
                    {
                        alert('Раздел добавлен.'); 
                        location.reload();
                    }
                });
            }); 
        });
    </script>
</body>
</html>