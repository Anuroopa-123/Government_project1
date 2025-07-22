<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    license_key: 'gpl',
    skin: 'oxide-dark',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough fontfamily blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false,
    height: 300
  });
</script>