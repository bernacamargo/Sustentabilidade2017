<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['default'] = [ 'bootstrap', 'font-awesome', 'plugins_js', 'site'];

$config['jquery'] = [
    'js'  => [ site_url('assets/jquery/dist/jquery.min.js') ]
];

$config['bootstrap'] = [
    'css' => [ 
        site_url('assets/bootstrap/dist/css/bootstrap.min.css'),
        site_url('assets/bootstrap/dist/css/bootstrap-social.css')
        ],
    'js'  => [ site_url('assets/bootstrap/dist/js/bootstrap.min.js') ]
];

$config['plugins_js'] = [
    'js'   => [
        site_url('assets/js/jquery.countTo.js'),
        site_url('assets/input-mask/jquery.inputmask.js')
    ]
];

$config['font-awesome'] = [
    'css' => [ site_url( 'assets/font-awesome-4.7.0/css/font-awesome.min.css' ) ]
];

$config['home'] = [
    'css' => [ site_url( 'assets/css/home.css' ),
                'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700',
                site_url('assets/crew-template/css/animate.css'),
                site_url('assets/crew-template/css/icomoon.css'),
                site_url('assets/crew-template/css/simple-line-icons.css'),
                site_url('assets/crew-template/css/owl.carousel.min.css'),
                site_url('assets/crew-template/css/owl.theme.default.min.css'),
                site_url('assets/crew-template/css/bootstrap.css')
     ],
     'js' => [ 
                site_url('assets/crew-template/js/jquery.easing.1.3.js'),
                site_url('assets/crew-template/js/jquery.waypoints.min.js'),
                site_url('assets/crew-template/js/owl.carousel.min.js'),
                site_url('assets/crew-template/js/main.js')
      ]
];

$config['signup'] = [
    'css' => [ site_url( 'assets/css/signup.css' ) ]
];

$config['dashboard'] = [
    'css' => [ site_url( 'assets/css/dashboard.css' ) ]
];

$config['anuncios'] = [
    'css' => [ site_url( 'assets/css/anuncios.css' ) ]
];

$config['cobrancas'] = [
    'css' => [ site_url( 'assets/css/cobrancas.css' ) ]
];

$config['conversa'] = [
    'css' => [ site_url( 'assets/css/conversa.css' ) ]
];

// Ultimo módule a ser carregado
$config['site'] = [
    'css' => [  
        site_url( 'assets/css/navbar.css' ),
        site_url( 'assets/css/style.css' ),
        site_url('assets/crew-template/css/turquoise.css'),
        'https://fonts.googleapis.com/css?family=Varela+Round'
    ],
    'js' => [ site_url('assets/js/functions.js') ]
];
