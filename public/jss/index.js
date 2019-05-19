tinymce.init({
  selector: 'textarea',
  height: 400,
  menubar: true,
  plugins: [
    'fullpage advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks advcode fullscreen',
    'insertdatetime media table contextmenu'
  ],
  toolbar: 'code fullpage',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});