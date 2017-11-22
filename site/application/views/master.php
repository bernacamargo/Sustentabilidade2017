<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?PHP $template->print_title(); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbd6Mt0LXQDaGuAcdDrmUIu6ip_-RljAk&libraries=places"></script>
        <script src="<?php echo site_url('assets/crew-template/js/jquery.min.js') ?>"></script>

        <script>
            var SiteUrl = "<?php echo site_url(); ?>";
            var BaseUrl = "<?php echo base_url(); ?>";
        </script>

        <?PHP $template->print_css(); ?>
    </head>
    <body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=112430766139075";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

        <?PHP $template->print_page(); ?>
        <?PHP $template->print_js(); ?>
    </body>
</html>