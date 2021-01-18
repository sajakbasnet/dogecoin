<script>
ClassicEditor.create( document.querySelector('.editor' ))
    .then( editor => {
        editor.ui.view.editable.element.style.height = '200px';
    } )
    .catch( error => {
        console.error( error );
    } );
</script>