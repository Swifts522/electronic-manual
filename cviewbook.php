<html>
<head>
    <meta charset="UTF-8">
    <?php
        include "config.php"; 
    ?>
        <title></title>
        <style>
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed, 
        figure, figcaption, footer, header, hgroup, 
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure, 
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        body
        {
            background: #ccc;
        }
        @import url('https://fonts.googleapis.com/css?family=Oswald|Roboto+Slab');
        #content
        {
            width: 80%;
            height: 100%;
            position: absolute;
            left: 10%;
            top: 0%;
            background: rgb(255,255,255);
            box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Параметры тени */
        }
        #readbook
        {
            position: absolute;
            width: 86%;
            height: 71%;
            top: 20%;
            left: 5%;
            overflow-y: auto;
            box-shadow: 0 0 3px rgba(0,0,0,0.5); /* Параметры тени */
            padding: 2%;
        }
        @media (max-width: 1368px) 
        {
            #readbook
            {
                position: absolute;
                width: 86%;
                height: 67%;
                top: 24%;
                left: 5%;
                overflow-y: auto;
                box-shadow: 0 0 3px rgba(0,0,0,0.5); /* Параметры тени */
                padding: 2%;
            }     
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
            left: 5%;
            width: 480px;
            height: 120px;
            box-shadow: 0 0 2px rgba(0,0,0,0.5);
            padding-left: 25px;
            padding-top: 10px; 
            overflow: auto;
        }  
        #backbutton
        {
            position: absolute;
            top: 5%;
            right: 5%;
            padding: 20px 30px;
            background: #EF3B3A;
            font-family: 'Roboto Slab', sans-serif;
            font-size: 20px;
            text-decoration: none;
            color: black;
            border-radius: 15px; /* Уголки */
        }
    </style>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           $("#sort1,#sort2").sortable();
           $("#sort1,#sort2").sortable({ delay:200 });
        });
    </script>
</head>
<body>
    <div id="content">
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
        <a href = 'index.php' id = 'backbutton'>Сменить учебник</a>
        <div id="readbook">
            <?php
                $query = "SELECT * FROM templates WHERE ID_Book = ".$_GET['book'];
                $res=mysql_query($query);
                $row = mysql_fetch_assoc($res);
                echo $row['Text'];
            ?>  
        </div>
    </div>
    <script>
        function AddGroup(data)
        {
            $('select[name=selectgroupselect]').find('option').remove();
            $('select[name=selectgroupselect]').append('<option disabled value="0" class="label" value="">Выберите группу</option>');
            $('select[name=selectgroupselect]').append(data);
        }
        function SelectPodrazdel()
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
                        $('#readbook').empty();    
                    },
                    success: function(data)
                    {
                        $('#readbook').html(data);
                    }
                });   
                var n = '+ ' + s;
                $(this).text(n);
            });   
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
                        SelectPodrazdel();
                    }
                });
                $.ajax({
                    url: "selectrazdel.php",
                    type: "POST",
                    data: ({Section: s, Book: bookdata}),
                    dataType: "html",
                    beforeSend: function()
                    {
                        $('#readbook').empty();    
                    },
                    success: function(data)
                    {
                        $('#readbook').html(data);
                    }
                });   
                var n = '+ ' + s;
                $(this).text(n);
            });
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