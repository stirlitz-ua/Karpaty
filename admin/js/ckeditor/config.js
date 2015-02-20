CKEDITOR.editorConfig = function( config ) {
	 config.language = 'ru';
     config.toolbar = 'Full';
     config.entities = false;
     CKEDITOR.on( 'dialogDefinition', function( ev ){
	   var dialogName = ev.data.name;
	   var dialogDefinition = ev.data.definition;
	   if ( dialogName == 'link' ){dialogDefinition.removeContents( 'advanced' );dialogDefinition.removeContents( 'target' );}
	   if ( dialogName == 'image' ){dialogDefinition.removeContents( 'advanced' );dialogDefinition.removeContents( 'Link' );}
	   if ( dialogName == 'flash' ){dialogDefinition.removeContents( 'advanced' );}
       
            
  });
};
