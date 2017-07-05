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
                header('Location: admin.php?wrong=1');   
            }
            else
            {
                $row = mysql_fetch_assoc($res);
                $dostup = $row['LevelAcess'];
                if($row['LevelAcess'] > 0) $_SESSION['Teacher'] = $row['ID'];
                else header('Location: admin.php?dostup=1'); 
            }
        }
        else if(!isset($_SESSION['Teacher']))
        {
            header('Location: admin.php');
        }
    ?>
    <meta charset="UTF-8">
    <script src="js/jquery.js"></script>
    <script src = 'ckeditor/ckeditor.js'></script>
    <script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="jqueryui/jquery-ui.css" rel="stylesheet">
    <script src="jqueryui/jquery-ui.min.js"></script>
    <style type="text/css">
        #sort1 
        {
            list-style-type:none; 
            margin:0; 
            padding:0; 
            width:50%; 
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
            width:50%; 
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
        /*::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar:horizontal {
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            border-radius: 10px;
            height: 5px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
            height: 5px;
        }*/
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
           $("#sort1,#sort2").sortable();
           $("#sort1,#sort2").sortable({ delay:200 });
        });
    </script>
</head>
<body onkeyup="hotkey(event)">
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
        <div id="option"> 
            <div id = 'selectbook'>
                <label for 'selectbook'>Выберите учебник</label>
                <select size="1" name="bookselect">
                <option disabled>Выберите учебник</option>
                <?php
                    $query = "SELECT * FROM book WHERE TeacherID = ".$_SESSION['Teacher'];
                    $res=mysql_query($query);
                    while($row = mysql_fetch_assoc($res))
                    {
                        echo "<option value='".$row['ID']."'>".$row['Name']."</option>";
                    } 
                ?>
                </select>
               <a href = '#' id = 'bookadd'>Новый учебник</a>
            </div>
            <div id="selectsection">
                <ol id="sort1" class="ui-widget connect">
                   <?php
                        $query = "SELECT * FROM book WHERE TeacherID = ".$_SESSION['Teacher'];
                        $res=mysql_query($query);
                        $row = mysql_fetch_assoc($res);
                        $id = $row['ID'];
                        $query = "SELECT * FROM templates WHERE ID_Razdel = 0 AND ID_Book = ".$id;
                        $res=mysql_query($query);
                        while($row = mysql_fetch_assoc($res))
                        {
                            echo "<li>".$row['Razdel']."</li>";
                        } 
                        echo "<li>Новый раздел</li>";
                    ?>
                </ol>
                <br />
                <ol id="sort2" class="ui-widget connect">
                   <?php
                        $query = "SELECT * FROM book WHERE TeacherID = ".$_SESSION['Teacher'];
                        $res=mysql_query($query);
                        $row = mysql_fetch_assoc($res);
                        $idbook = $row['ID'];
                        $query = "SELECT * FROM `templates` WHERE ID_Razdel = 0 AND ID_Book = ".$idbook;
                        $res=mysql_query($query);
                        $row = mysql_fetch_assoc($res);
                        $id = $row['ID'];
                        $query = "SELECT * FROM `templates` WHERE `ID_Razdel` = '".$id."' AND `ID_Book` = ".$idbook;
                        $res=mysql_query($query);
                        if(mysql_num_rows($res) > 0)
                        {
                            while($row = mysql_fetch_assoc($res))
                            {
                                echo "<li>".$row['Razdel']."</li>";
                            } 
                        }
                    ?>
                </ol>
            </div>
            <a href = '#' id = 'bookaddsection' onclick= 'CKupdate();'>Добавить раздел</a>
            <a href = '#' id = 'bookdelsection'>Удалить раздел</a>
            <div id = 'titlebook'>
                <label for 'titlebook'>Заголовок раздела</label> 
                <input type = 'edit' id = 'titlebookedit'>  
            </div>
           <div id = 'editortext'><textarea name="editor1" id = 'editortextarea'></textarea></div>
           <!--<a href="#" class="button" id = 'buttonadd'/>Добавить</a>-->
        </div> 
    </div>
    <div id = 'popupcontent'>
            <div id = 'namebooks'>
                <label for 'namebooks'>Название учебника</label> 
                <input type = 'edit' id = 'namebookedit'>  
            </div>
            <div id = 'selectfaculty' class = 'selectbox'>
                <label for 'selectfaculty'>Выберите отделение</label>
                <select size="1" name="facultyselect">
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
            </div>
            <div id = 'selectgroup' class = 'selectbox selectboxgroup'>
                <label for 'selectgroup'>Выберите группу</label>
                <select size="15" name="selectgroupselect">
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
            </div>
            <div id = 'selectedgroup' class = 'selectbox selectboxgroup2'>
                <label for 'selectedgroup'>Выбранные группы</label>
                <select size="15" name="selectedgroupselect">
               </select>
            </div>
            <a href="#" class="button" id = 'buttonadd'/>Добавить группу</a>
            <a href="#" class="button" id = 'buttondelete'/>Удалить группу</a>
            <a href="#" class="button" id = 'buttoncreate'/>Создать учебник</a>
    </div> 
    <div id = 'closeicon'></div>
    <script>
        //CKEDITOR.config.height = document.body.scrollWidth/4;
        CKEDITOR.config.height  = '80%';
        CKEDITOR.config.resize_enabled = false;
        var editor1 = CKEDITOR.replace( 'editor1' );
        
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
        function CKupdate() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
        }
        function UpdateSortRoot()
        {
            var edit;
            $('#sort1').children("li").bind('click', function()
            {
                var str;
                $('#sort1').children("li").each(function()
                {
                    str = $(this).text(); 
                    if(str.indexOf('+') != -1) $(this).text(str.slice(2));
                });
                var s = $(this).text();
                if(s.indexOf('Новый раздел') == -1)
                {
                    $.ajax({
                        url: "selectpodrazdel.php",
                        type: "POST",
                        data: ({Section: s, Book: $('select[name=bookselect]').val()}),
                        dataType: "html",
                        beforeSend: function()
                        {
                            $('#sort2').find('li').remove();    
                        },
                        success: function(data)
                        {
                            $('#sort2').append(data);
                            UpdateSort();
                        }
                    });
                    /*$.ajax({
                        url: "editrazdel.php",
                        type: "POST",
                        data: ({Section: s, Book: $('select[name=bookselect]').val()}),
                        dataType: "html",
                        beforeSend: function()
                        {
                            for ( instance in CKEDITOR.instances )
                            {
                                CKEDITOR.instances[instance].updateElement();
                                CKEDITOR.instances[instance].setData('');
                            }
                        },
                        success: function(data)
                        {
                            for ( instance in CKEDITOR.instances ) 
                            {
                                CKEDITOR.instances[instance].updateElement();
                                CKEDITOR.instances[instance].setData(data);
                            }
                        }
                    });*/
                }
                else  $('#sort2').find('li').remove(); 
                $('#bookaddsection').text('Добавить раздел');
                for ( instance in CKEDITOR.instances )
                {
                    CKEDITOR.instances[instance].updateElement();
                    CKEDITOR.instances[instance].setData('');
                }  
                edit = false;
                var n = '+ ' + s;
                $(this).text(n);
            });   
        }
        function UpdateSort()
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
                /*$.ajax({
                    url: "editpodrazdel.php",
                    type: "POST",
                    data: ({Section: s, Book: $('select[name=bookselect]').val()}),
                    dataType: "html",
                    beforeSend: function()
                    {
                        for ( instance in CKEDITOR.instances )
                        {
                            CKEDITOR.instances[instance].updateElement();
                            CKEDITOR.instances[instance].setData('');
                        } 
                    },
                    success: function(data)
                    {
                        for ( instance in CKEDITOR.instances ) 
                        {
                            CKEDITOR.instances[instance].updateElement();
                            CKEDITOR.instances[instance].setData(data);
                        }
                        $('#bookaddsection').text('Редактировать');
                    }
                });*/ 
                for ( instance in CKEDITOR.instances )
                {
                    CKEDITOR.instances[instance].updateElement();
                    CKEDITOR.instances[instance].setData('');
                }  
                edit = false;
                $('#bookaddsection').text('Редактировать');
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
            edit = false;
            $('select[name=bookselect]').change(function()
            {
                $.ajax({
                    url: "changebook.php",
                    type: "POST",
                    data: ({Book: $('select[name=bookselect]').val()}),
                    dataType: "html",
                    beforeSend: function()
                    {
                        $('#sort1').find('li').remove(); 
                        $('#sort2').find('li').remove();  
                    },
                    success: function(data)
                    {
                        $('#sort1').append(data);
                        $('#sort1').append('<li>Новый раздел</li>');
                        UpdateSortRoot();
                    }
                });  
            });
            UpdateSort();
            UpdateSortRoot();
            $('#bookdelsection').bind("click", function(event)
            {
                event.preventDefault();
                var str, src;
                var str1 = "";
                var src1 = "";
                $('#sort1').children("li").each(function()
                {
                    str = $(this).text(); 
                    if(str.indexOf("+") != -1)
                    {
                        if(str.indexOf('+') != -1) src = str.slice(2);
                    }
                });
                $('#sort2').children("li").each(function()
                {
                    str1 = $(this).text(); 
                    if(str1.indexOf("+") != -1)
                    {
                        if(str1.indexOf('+') != -1) src1 = str1.slice(2);
                    }
                });
                if(src1.length < 1)
                {
                    if(src.indexOf('Новый раздел') == -1)
                    {
                        $.ajax({
                            url: "delrazdel.php?razdel",
                            type: "POST",
                            data: ({Section: src, Book: $('select[name=bookselect]').val()}),
                            dataType: "html",
                            success: function(data)
                            {
                                alert('Раздел успешно удален.');
                                location.reload();
                            }
                        });
                    }
                    else $('#sort2').find('li').remove(); 
                }
                else
                {
                    if(src.indexOf('Новый раздел') == -1)
                    {
                        $.ajax({
                            url: "delrazdel.php?podrazdel",
                            type: "POST",
                            data: ({Section: src, Podrazdel: src1, Book: $('select[name=bookselect]').val()}),
                            dataType: "html",
                            success: function(data)
                            {
                                alert('Раздел успешно удален.');
                                location.reload();
                            }
                        });
                    }
                    else $('#sort2').find('li').remove();       
                }
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
                if($('#namebookedit').val().length < 1)
                {
                    alert('Введите название.');
                }
                else
                {
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
                }
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
                if($('#bookaddsection').text() == 'Добавить раздел')
                {
                    $('#sort1').children("li").each(function()
                    {
                        str = $(this).text(); 
                        if(str.indexOf("+") != -1)
                        {
                            if(str.indexOf('+') != -1) src = str.slice(2);
                        }
                    });
                    if($('#titlebookedit').val().length < 1)
                    {
                        alert('Введите название раздела');
                    }
                    else
                    {
                        //alert(editor1.getData());
                        if(src.indexOf('Новый раздел') != -1) src = "";
                        $.ajax({
                            url: "addrazdel.php",
                            type: "POST",
                            data: ({Name: $('#titlebookedit').val(), Book: $('select[name=bookselect]').val(), Subsection: src, Text: editor1.getData()}),
                            dataType: "html",
                            success: function(data)
                            {
                                if(data == "2") alert('Подраздел добавлен.'); 
                                else alert('Раздел добавлен.'); 
                                location.reload();
                            }
                        });
                    }
                }
                else
                {
                    if(edit == false)
                    {
                        edit = true;
                        var str, src;
                        $('#sort2').children("li").each(function()
                        {
                            str = $(this).text(); 
                            if(str.indexOf("+") != -1)
                            {
                                if(str.indexOf('+') != -1) src = str.slice(2);
                            }
                        });     
                        $('#titlebookedit').val(src);
                        $.ajax({
                            url: "editpodrazdel.php?text",
                            type: "POST",
                            data: ({Section: src, Book: $('select[name=bookselect]').val()}),
                            dataType: "html",
                            beforeSend: function()
                            {
                                for ( instance in CKEDITOR.instances )
                                {
                                    CKEDITOR.instances[instance].updateElement();
                                    CKEDITOR.instances[instance].setData('');
                                } 
                            },
                            success: function(data)
                            {
                                for ( instance in CKEDITOR.instances ) 
                                {
                                    CKEDITOR.instances[instance].updateElement();
                                    CKEDITOR.instances[instance].setData(data);
                                }
                                $('#bookaddsection').text('Редактировать');
                            }
                        });
                    }
                    else
                    {
                        var str, src;
                        $('#sort2').children("li").each(function()
                        {
                            str = $(this).text(); 
                            if(str.indexOf("+") != -1)
                            {
                                if(str.indexOf('+') != -1) src = str.slice(2);
                            }
                        });  
                        edit = false;
                        $.ajax({
                            url: "edittextrazdel.php",
                            type: "POST",
                            data: ({Name: $('#titlebookedit').val(), Book: $('select[name=bookselect]').val(), Section: src, Text: editor1.getData()}),
                            dataType: "html",
                            success: function(data)
                            {
                                alert('Редактирование успешно.'); 
                                location.reload();
                            }
                        });                        
                    }
                }
            }); 
        });
    </script>
</body>
</html>