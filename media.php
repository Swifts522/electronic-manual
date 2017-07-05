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
    <style>
        .file_upload{
            position: relative;
            overflow: hidden;
            font-size: 1em;        /* example */
            height: 2em;           /* example */
            line-height: 2em;       /* the same as height */
            width: 18em;
            top: 10%;
        }
        .file_upload > button{
            float: right;
            width: 8em;            /* example */
            height: 100%
        }
        .file_upload > div{
            padding-left: 1em      /* example */
        }
        @media only screen and ( max-width: 500px ){  /* example */
            .file_upload > div{
                display: none
            }
            .file_upload > button{
                width: 100%
            }
        }
        .file_upload input[type=file]{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            transform: scale(20);
            letter-spacing: 10em;     /* IE 9 fix */
            -ms-transform: scale(20); /* IE 9 fix */
            opacity: 0;
            cursor: pointer
        }
        .file_upload{
            display: block;
            position: relative;
            overflow: hidden;
            font-size: 1em;              /* example */
            height: 2em;                 /* example */
            line-height: 2em;             /* the same as height */
        }
        .file_upload .button, .file_upload > mark{
            display: block;
            cursor: pointer              /* example */
        }
        .file_upload .button{
            float: right;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            width: 8em;                  /* example */
            height: 100%;
            text-align: center           /* example */
        }
        .file_upload > mark{
            background: transparent;     /* example */
            padding-left: 1em            /* example */
        }
        .file_upload input[type=file]{
            position: absolute;
            top: 0;
            opacity: 0
        }
        .file_upload input[type=file]{
            position: absolute;
            top: 0;
            visibility: hidden
        }
        .file_upload{
            border: 1px solid #ccc;
            border-radius: 3px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            transition: box-shadow 0.1s linear
        }
        .file_upload.focus{
            box-shadow: 0 0 5px rgba(227, 24, 24, 0.4)
        }
        .file_upload > button{
            background: #EF3B3A;
            transition: background 0.2s;
            border: 1px solid rgba(0,0,0,0.1);
            border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
            border-radius: 2px;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
            color: #fff;
            text-shadow: #cb1c1b 0 -1px 0;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis
        }
        .file_upload:hover > button{
            background: #eb1b1a;
            text-shadow: #cb1c1b 0 -1px 0;
            cursor: pointer;
        }
        .file_upload:active > button{
            background: #eb1b1a;
            box-shadow: 0 0 3px rgba(0,0,0,0.3) inset
        }
        #filesdiv
        {
            position: absolute;
            top: 2%;
            left: 0%;
            width: 300px;
            height: 120px;
            box-shadow: 0 0 2px rgba(0,0,0,0.5);
            padding-left: 25px;
            padding-top: 10px;
        }
        #imgadd
        {
            position: absolute;
            top: 60%;
            right: 27%;
            width: 100px;
            height: 25px;
            text-decoration: none;
            color: #000;
            font-family: 'Francois One', sans-serif;
            font-size: 12px;
            font-weight: bold;   
            background: #EF3B3A;
            padding-top: 15px;
            padding-left: 40px;
            -webkit-border-radius:30px;
             -moz-border-radius:30px; 
             border-radius: 30px; 
             -webkit-box-shadow:0px 0px 2px #ffffff, inset 0px 0px 1px #fff0f0; 
             -moz-box-shadow: 0px 0px 2px #ffffff,  inset 0px 0px 1px #fff0f0;  
             box-shadow:0px 0px 2px #ffffff, inset 0px 0px 1px #fff0f0;   
             border:solid 1px #ffffff; 
        }
        #imgadd:hover
        {
            color: #fff;
        }
        #filesview
        {
            position: absolute;
            width: 90%;
            height: 70%;
            top: 20%;
            padding: 20px;
            overflow-y: auto;
            box-shadow: 0 0 2px rgba(0,0,0,0.5);
        }
        .imgview
        {
            float: left;
            padding: 20px;
        }
        .imgview:hover
        {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.2);
        }
        .selectview
        {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.3);
        }
        #addfolder
        {
            position: absolute;
            top: 17%;
        }
        #deletefolder
        {
            position: absolute;
            top: 16.5%;
            left: 4%;
        }
        #backfolder
        {
            position: absolute;
            top: 16.8%;
            left: 8.2%;
        } 
        @media (max-width: 1368px) 
        {
            #filesview
            {
                position: absolute;
                width: 90%;
                height: 70%;
                top: 23%;
                padding: 20px;
                overflow-y: auto;
                box-shadow: 0 0 2px rgba(0,0,0,0.5);
            }  
            #addfolder
            {
                position: absolute;
                top: 19.5%;
            }
            #deletefolder
            {
                position: absolute;
                top: 19%;
                left: 4%;
            }
            #backfolder
            {
                position: absolute;
                top: 19.2%;
                left: 8.2%;
            } 
        }
        #popupcontent
        {
            position: fixed;
            top: 20%;
            height: 15%;
        }
        #buttoncreate
        {
            top: 10%;
        }
        #namebooks
        {
            top: 8%;
        }
    </style>
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
            <div id="filesdiv">
                <div class="file_upload">
                    <button type="button">Выбрать</button>
                    <div>Файл не выбран</div>
                    <input type="file" multiple="multiple" accept="image/*">
                </div>
                <a href = '#' id = 'imgadd'>Загрузить</a>
            </div>
            <a href = '#' id = 'addfolder'><img alt = 'Добавить папку' src = 'images/icons/addfolder.ico' width="20px" height="20px"></a>
            <a href = '#' id = 'deletefolder'><img alt = 'Удалить папку' src = 'images/icons/Deletefolder.png' width="25px" height="25px"></a>
            <a href = '#' id = 'backfolder'><img alt = 'Назад' src = 'images/icons/back.png' width="22px" height="22px"></a>
            <div id="filesview">
                <div class="imgview">
                    <img src = 'images/Geometric/1.jpg' width="100px" height="100px">
                    <p style = 'text-align: center; margin-top: 10px;'>book.png</p>
                </div> 
            </div>
            <div class="ajax-respond"></div>
        </div>
    </div>
    <div id = 'popupcontent'>
            <div id = 'namebooks'>
                <label for 'namebooks'>Название папки</label> 
                <input type = 'edit' id = 'namebookedit'>  
            </div>
            <a href="#" class="button" id = 'buttoncreate'>Создать папку</a>
    </div>
    <div id = 'closeicon'></div>
    <script>
        $(document).ready(function()
        {
            $.ajax({
                url: "mediamanager.php?refresh",
                type: "POST",
                dataType: "html",
                beforeSend: function()
                {
                    $(".imgview").remove();
                },
                success: function(data)
                {
                    $( "#filesview" ).append(data);  
                }
            }); 
        });
        var selectfiles = [];
        var currentdirectory = 'uploads';
        document.oncontextmenu = function (){return false};
        $('#backfolder').bind("click", function(event)
        {
            event.preventDefault();
            if(currentdirectory != 'uploads' && currentdirectory != 'uploads/')
            {
                $strArray = currentdirectory.split('/');
                $strSrc = '';
                currentdirectory = '';
                for(var i = 0; i < $strArray.length-1; i++)
                {
                    if(i == $strArray.length-2)
                    {
                        $strSrc += $strArray[i];
                    }
                    else $strSrc += $strArray[i] + '/';
                }
                currentdirectory = $strSrc;
                $.ajax({
                    url: "mediamanager.php?opendir",
                    type: "POST",
                    dataType: "html",
                    data: {Folder: currentdirectory},
                    beforeSend: function()
                    {
                        $(".imgview").remove();
                    },
                    success: function(data)
                    {
                        $( "#filesview" ).append(data); 
                    }
                }); 
            }
        });
        $(document).delegate( ".imgview", "click", function() 
        {
            if($(this).hasClass('folder')) 
            {
                currentdirectory += '/'+$(this).children('p').html(); 
                $.ajax({
                    url: "mediamanager.php?opendir",
                    type: "POST",
                    dataType: "html",
                    data: {Folder: currentdirectory},
                    beforeSend: function()
                    {
                        $(".imgview").remove();
                    },
                    success: function(data)
                    {
                        $( "#filesview" ).append(data); 
                    }
                });          
            }
            else
            {
                location.href = currentdirectory+'/'+$(this).children('p').html();
            }
        });
        $(document).delegate( ".imgview", "contextmenu", function() 
        {
            if($(this).hasClass('selectview')) 
            {
                $(this).removeClass('selectview');  
                var j;
                for (var i = 0; i < selectfiles.length; i++)
                {
                    if(selectfiles[i] == $(this).children('p').html())
                    {
                        j = selectfiles[selectfiles.length-1];
                        selectfiles[selectfiles.length-1] = selectfiles[i];
                        selectfiles[i] = j;
                        selectfiles.pop();
                        break;
                    }
                }
                //alert(selectfiles.length);
            }
            else 
            {
                $(this).addClass('selectview');
                selectfiles.push($(this).children('p').html());
                //alert(selectfiles.length);
            }
            
        });
        $('#deletefolder').bind("click", function(event)
        {
            event.preventDefault();
            $.post("mediamanager.php?deletefolder",
               {'folder[]': selectfiles, 'CurrentDir': currentdirectory},
               function(result)
               {
                 location.reload();
              }
            );
        });
        var files;
        var $popupcontent = $('#popupcontent'),
        $content = $('#content'),
        $closeicon = $('#closeicon'),
        $allcontent = $('#allcontent');
        $closeicon.bind("click", function(event)
        {
            event.preventDefault();
            $content.removeClass('is-hidden');
            $popupcontent.removeClass('is-visible');
            $allcontent.removeClass('is-visible');
            $closeicon.removeClass('is-visible');
        });
        $('input[type=file]').change(function(){
            files = this.files;
        });
        $('#addfolder').click(function(event)
        {
            event.preventDefault();
            $content.addClass('is-hidden');
            $popupcontent.addClass('is-visible');
            $allcontent.addClass('is-visible');
            $closeicon.addClass('is-visible');  
        });
        $('#buttoncreate').click(function(event)
        {
            event.preventDefault();
            $.ajax({
                url: "mediamanager.php?createfoolder",
                type: "POST",
                data: ({Name: $('#namebookedit').val(), CurrentDir: currentdirectory}),
                dataType: "html",
                success: function(data)
                {
                    alert('Папка создана');
                    $content.removeClass('is-hidden');
                    $popupcontent.removeClass('is-visible');
                    $allcontent.removeClass('is-visible');
                    $closeicon.removeClass('is-visible');
                    location.reload();
                }
            });
        });
        $('#imgadd').click(function( event ){
            event.stopPropagation(); // Остановка происходящего
            event.preventDefault();  // Полная остановка происходящего

            // Создадим данные формы и добавим в них данные файлов из files
        
            var data = new FormData();
            $.each( files, function( key, value ){
                data.append( key, value );
            });
            
            // Отправляем запрос
            
            var s = 'submit.php?curdirectory='+currentdirectory;
            
            $.ajax({
                url: s,
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Не обрабатываем файлы (Don't process the files)
                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                success: function( respond, textStatus, jqXHR ){

                    // Если все ОК

                    if( typeof respond.error === 'undefined' )
                    {
                        location.reload();
                    }
                    else{
                        console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    console.log('ОШИБКИ AJAX запроса: ' + textStatus );
                }
            });


        });
        var wrapper = $( ".file_upload" ),
            inp = wrapper.find( "input" ),
            btn = wrapper.find( "button" ),
            lbl = wrapper.find( "div" );
        btn.focus(function(){
            inp.focus()
        });
        // Crutches for the :focus style:
        inp.focus(function(){
            wrapper.addClass( "focus" );
        }).blur(function(){
            wrapper.removeClass( "focus" );
        });
        btn.add( lbl ).click(function(){
                inp.click();
            });
       btn.focus(function(){
            wrapper.addClass( "focus" );
        }).blur(function(){
            wrapper.removeClass( "focus" );
        });
        var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;

            inp.change(function(){
                var file_name;
                var filess = this.files;
                if( file_api && inp[ 0 ].files[ 0 ] )
                    file_name = inp[ 0 ].files[ 0 ].name;
                else
                    file_name = inp.val().replace( "C:\\fakepath\\", '' );

                if( ! file_name.length )
                    return;

                if( lbl.is( ":visible" ) ){
                    lbl.text( "Выбрано " + filess.length + " файлов" );
                    btn.text( "Выбрать" );
                }else
                    btn.text(  "Выбрано " + filess.length + " файлов" );
            }).change();
        $( window ).resize(function(){
            $( ".file_upload input" ).triggerHandler( "change" );
        });
    </script>
</body>
</html>