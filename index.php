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
        .bookview
        {
            position: relative;
            top: 0%;
            left: 0%;
            width: 20%;
            height: 25%;
            background: #EF3B3A;
            margin-left: 4%;
            margin-top: 8%;
            float: left;
            box-shadow: 0 0 3px rgba(0,0,0,0.5); /* Параметры тени */
            border-radius: 25px; /* Уголки */
        }
        #bookimg
        {
            position: absolute;
            background: url(images/book.png);
            background-size: contain;
            width: 22%;
            height: 28%;
            left: 38%;
            top: 10%;
        }
        #titlebook 
        {
	        position: absolute;
            font-family: 'Roboto Slab', sans-serif;
            font-size: 20px;
            text-align: center;
            margin: 45% 10%;
        }
        .bookview:hover
        {
            cursor: pointer;
        }
        a
        {
            color: #000;    
        }
        #popupcontent
        {
            position: absolute;
            width: 60%;
            height: 10%;
            right: 0%;
            top: 0%;
            z-index: 9999;
            border-radius: 25px; /* Уголки */
        }
        #popupcontent select
        {
            padding: 10px;
            position: absolute;
            left: 10%;
            top: 25%;
        }
        #popupcontent select[name=selectgroup]
        {
            padding: 10px;
            position: absolute;
            left: 45%;
            top: 25%;
        }        
        #popupcontent select:focus{outline:none;}
        #buttonfilter
        {
            position: absolute;
            top: 8%;
            left: 70%;
            padding: 20 50px;
            background: #EF3B3A;
            text-decoration: none;
            font-family: 'Roboto Slab', sans-serif;
            font-size: 20px;
            text-align: center;
            border-radius: 15px; /* Уголки */
        }
    </style>
    <script src="js/jquery.js"></script>
</head>
<body>
    <div id="content">
        <div id="popupcontent">
            <select size="1" name="selectfaculty">
                <option disabled>Выберите отделение</option>     
                    <?php
                        $query = "SELECT * FROM Faculty";
                        $res=mysql_query($query);
                        while($row = mysql_fetch_assoc($res))
                        {
                            echo "<option value='".$row['ID']."'>".$row['Faculty']."</option>";
                        }
                    ?>
            </select> 
            <select size="1" name="selectgroup">
                <option disabled>Выберите группу</option>     
                    <?php
                        $query = "SELECT * FROM `group` WHERE `FacultyID` = 1";
                        $res=mysql_query($query);
                        while($row = mysql_fetch_assoc($res))
                        {
                            echo "<option value='".$row['ID']."'>".$row['Group']."</option>";
                        }      
                    ?>
            </select>
            <a href = '#' id = 'buttonfilter'>Выбрать</a> 
        </div>
           <?php
                $query = "SELECT * FROM book";
                $res=mysql_query($query);
                while($row = mysql_fetch_assoc($res))
                {
                    $row['Group'];
                    echo '<a class = "hrefview" href = "cviewbook.php?book='.$row['ID'].'"><div class = "bookview">
                 <div id="bookimg"></div>   
                 <div id="titlebook">'.$row['Name'].'</div>
                </div></a>';
                }
           ?>
    </div>
    <script>
        function AddGroup(data)
        {
            $('select[name=selectgroup]').find('option').remove();
            $('select[name=selectgroup]').append('<option disabled value="0" class="label" value="">Выберите группу</option>');
            $('select[name=selectgroup]').append(data);
        }
        $(document).ready(function()
        {
            $('select[name=selectfaculty]').change(function()
            {    
                $.ajax({
                    url: "changefaculty.php",
                    type: "POST",
                    data: ({faculty: $('select[name=selectfaculty]').val()}),
                    dataType: "html",
                    success: AddGroup
                });
            });
            $('#buttonfilter').bind("click", function(event)
            {
                event.preventDefault();
                $.ajax({
                    url: "changebookfilter.php",
                    type: "POST",
                    data: ({group: $('select[name=selectgroup]').val()}),
                    dataType: "html",
                    beforeSend: function()
                    {
                        $(".hrefview").remove();
                        $("div.bookview").remove();
                    },
                    success: function(data)
                    {
                        $( "#content" ).append(data);    
                    }
                }); 
            });
        });
    </script>
</body>
</html>