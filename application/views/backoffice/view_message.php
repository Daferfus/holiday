
<!DOCTYPE HTML>

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">


    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/backoffice/img/favicon.png">
    <link href="<?php echo base_url(); ?>assets/backoffice/css/view_message.css" rel="stylesheet">


    <script type="text/javascript" src="<?php echo base_url(); ?>tinymce/tinymce.min.js"></script>
    <script type="text/javascript">


        tinymce.init({
            selector: "textarea",
            language: 'es',
            /*heigth: 400,*/
            encoding: 'UTF-8',
            branding: false,
            allow_html_in_named_anchor: true,
            convert_fonts_to_spans: false,
            element_format: 'html',
            extended_valid_elements: 'img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]',
            elementpath: false,
            toolbar: 'insert',
            insert_button_items: 'image link | inserttable',
            /*max_height: 200,
            max_width: 400,*/
            menu: {
                file: {title: 'File', items: 'newdocument'},
                edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
                insert: {title: 'Insert', items: 'link media | template hr'},
                view: {title: 'View', items: 'visualaid'},
                format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
                table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
                tools: {title: 'Tools', items: 'spellchecker code'}

            },
            toolbar1: 'undo redo | styleselect | bold italic | link image',
            toolbar2: 'alignleft aligncenter alignright',
            /*width: 800,*/
            menubar: 'file edit insert view format table tools',
            removed_menuitems: 'undo, redo',
            resize: 'both',
            plugins: "fullscreen, link, image, table",
            theme_advanced_buttons1: "bold, italic, underline, separator, justifyleft, justifycenter, justifyright, justifyfull ",
            theme_advanced_buttons2: "bullist,numlist,separator,outdent,indent,separator,undo,redo",
            theme_advanced_buttons3: "image, link, fullscreen",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left"





        });
    </script>

</head>


<body>
    <div class="area">
        <?php if (!empty($messages)) { ?>
            <form method="POST" action="<?php echo site_url('backoffice/send_mail_user'); ?>">


                <?php foreach ($messages as $message) { ?>

                    <input type="hidden" name="to" value="<?php echo $message->mail_to; ?>"><br>
                    <input type="hidden" name="from" value="<?php echo $message->mail_from; ?>"><br>
                    <input type="hidden" name="subject" value="<?php echo $message->mail_subject; ?>"><br>
                <?php } ?>
                <textarea name="Cuerpo"  id="cuerpo" rows="10" cols="100">
                </textarea><br><br>

                <input  class="boton" type="submit" value="Responder"  name="aceptar"/>


            </form>
        <?php } else { ?>

            <h2> No hay mensajes encontrados.</h2>



        <?php } ?>

    </div>
    <?php if (!empty($messages)) { ?>
        <?php foreach ($messages as $message) {
            ?>

            <ul id="mensajes">
                <li>

                    <a href='<?php echo site_url('backoffice/read_mail_user/' . $message->mail_id); ?>'>
                        <span class="subject" id="asunto"><b>Asunto:</b><?php echo $message->mail_subject; ?></span><br>
                        <span class="message" id="mensaje"><b>Mensaje:</b><br><br>
                            <?php echo $message->mail_body; ?></span>
                    </a>
                </li>

            </ul>

        <?php } ?>

    <?php } else { ?>

        <h2> No hay mensajes encontrados.</h2>
        <p> La bandeja de entrada esta vacía </p>


    <?php } ?>
</body>

<footer>
    <p>&copy; 2017 HolidayApartment.online<p>
</footer>