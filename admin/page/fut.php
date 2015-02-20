      <hr>

      <footer>
        <p>&copy; Company "eLogic" 2013-<?echo date('Y');?></p>
        
        
       
        
      </footer>

    
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    window.jQuery || document.write('<script type="text/javascript" src="../js/jquery-1.8.3.min.js"><\/script>');
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-notify.js"></script>
    <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="js/ckfinder/ckfinder.js" type="text/javascript"></script>
    <script src="js/script.js"></script>
    <link href="css/jquery.spellchecker.css" rel="stylesheet" />
    <script src="js/jquery.spellchecker.js"></script>

<script type="application/javascript">      var spellchecker = new $.SpellChecker('textarea', {
        lang: 'en',
        parser: 'text',
        webservice: {
            path: 'webservices/php/SpellChecker.php',
            driver: 'pspell'
        },
        suggestBox: {
            position: 'above'
        },
        incorrectWords: {
            container: '#incorrect-word-list'
        }
    });

    // Bind spellchecker handler functions
    spellchecker.on('check.success', function() {
        alert('Некоректно введених слів немає.');
    });

    // Check the spelling
    $("button#check").click(function(e){
        spellchecker.check();
    }); </script>
<div class="notifications top-right"></div>
<div class="notifications top-left"></div>
<div class="notifications bottom-left"></div>
<div class="notifications bottom-right"></div>

  </body>
</html>
