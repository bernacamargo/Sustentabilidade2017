
<style>
    body, html {
        overflow-x: hidden;
    }
</style>

    <script src="<?php echo site_url('assets/crew-template/js/modernizr-2.6.2.min.js') ?>"></script>

    <?php $template->print_component('header.php') ?>

    <div id="slider" data-section="home">
        <div class="owl-carousel owl-carousel-fullwidth">
            
            <div class="item" style="background-image:url(<?php echo site_url('assets/img/wall1.jpg')?>); background-position: center center;">
                <div class="overlay"></div>
                <div class="container" style="position: relative;">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <div class="fh5co-owl-text-wrap">
                                <div class="fh5co-owl-text">
                                    <?php 
                                        if($template->guard->logged()){
                                            $link_anuncios = site_url('anuncios');
                                            $link_profissionais = site_url('profissionais');
                                        }
                                        else {
                                            $link_anuncios = site_url('signup/profissional');
                                            $link_profissionais = site_url('signup/contratante');
                                        }
                                     ?>
                                    <h1 class="fh5co-lead to-animate">Work for All</h1>
                                    <h2 class="fh5co-sub-lead to-animate">O que você precisa?</h3>
                                    <p class="to-animate-2">
                                        <a href="<?php echo $link_anuncios ?>" class="btn btn-primary btn-lg">Encontrar trabalho</a>
                                        &ensp;&ensp; 
                                        <a href="<?php echo $link_profissionais?>" class="btn btn-primary btn-lg">Contratar profissionais</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- You may change the background color here.  -->
            <div class="item" style="background-image:url(<?php echo site_url('assets/img/wall6.jpg')?>); ">
                <div class="overlay"></div>
                <div class="container" style="position: relative;">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 ">
                            <div class="fh5co-owl-text-wrap">
                                <div class="fh5co-owl-text">
                                    <h1 class="fh5co-lead to-animate">Ainda não possui uma conta?</h1>
                                    <h2 class="fh5co-sub-lead to-animate">Registre-se gratuitamente e começe a procurar pelo o que você precisa!</h2>
                                    <p class="to-animate-2">
                                        <a href="<?php echo site_url('signup') ?>" class="btn btn-primary btn-lg">
                                        Cadastre-se</a>
                                        &ensp;&ensp;
                                        <a href="#" data-nav-section="about" class="btn btn-default btn-lg">
                                        Ver mais</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <div id="fh5co-about-us" data-section="about">
        <div class="container">
            <div class="row row-bottom-padded-lg" id="about-us">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">Sobre nós</h2>
                    <div class="row">
                        <div class="col-md-12 to-animate text-justify">
                            <h4>&ensp;&ensp;&ensp;&ensp;Pensado após analisar a situação vivida por refugiados haitianos na cidade de Sorocaba, foi criado em 2017 o site “Work for All”, uma ferramenta pública que atua junto aos refugiados e outros estrangeiros vítimas de migrações forçadas no Brasil, a fim de reduzir os obstáculos que enfrentam para sua efetiva reintegração na sociedade.
                                <br>
                            &ensp;&ensp;&ensp;&ensp;Para colocar em prática sua missão, o site funciona junto ao ENACTUS, organização não governamental internacional e estudantil, dedicada a criar oportunidade de negócios através de projetos sociais, trabalhando internamente dentro das comunidades e abrigos de refugiados.

                            <h4>
                        </div>
                    </div>
                </div>
<div class="clearfix"></div>
<!--            <div class="col-md-1 to-animate">                
                    <span class="glyphicon glyphicon-pushpin" aria-hidden="true" style="color: #00b8a9; font-size: 30px"></span>
                </div>
                <div class="col-md-11 to-animate">
                    <p class="welcome center" style="text-align: justify;">
                        <span style="color: #00b8a9; font-size: 15px"><b>Missão:</b></span>
                         Ajudar a suprir algumas dificuldades passadas pelas comunidades refugiadas residentes, não só em Sorocaba, mas nas demais localidades
                    </p>
                </div>
                <div class="clearfix"></div>
            <div class="col-md-1 to-animate">                
                    <span class="glyphicon glyphicon-search" aria-hidden="true" style="color: #00b8a9; font-size: 30px;"></span>
                </div>
                <div class="col-md-11 to-animate">
                    <p class="welcome center" style="text-align: justify;">
                        <span style="color: #00b8a9; font-size: 15px"><b>Nossa Visão:</b></span>
                         ser a primeira opção de serviço de contratação e busca de empregos para refugiados no Brasil.
                    </p>
                </div>
             <div class="clearfix"></div>
                <div class="col-md-1 to-animate">                
                    <span class="glyphicon glyphicon-briefcase" aria-hidden="true" style="color: #00b8a9; font-size: 30px"></span>
                </div>
                <div class="col-md-11 to-animate">
                    <p class="welcome center" style="text-align: justify;">
                        <span style="color: #00b8a9; font-size: 15px"><b>Nossos Valores:</b></span>
                         Ética, pioneirismo, inovação, parceiros e clientes em primeiro lugar.
                    </p>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-1 to-animate">                
                    <span class="glyphicon glyphicon-home text-primary" aria-hidden="true" style="color: #00b8a9; font-size: 30px"></span>
                </div> -->   
                <div class="col-md-11 to-animate">
                    <p class="welcome center" style="text-align: justify;">
                        <span style="color: #00b8a9; font-size: 15px"><b>Categorias de serviços:</b></span>
                         Cuidador de Idosos, Babás, Domésticas, Faxineiras, Caseiros, Cozinherias, Dogwalkers, Governantas, Jardineiros, Motoristas e Piscineiros. 
                    </p>
                </div>

            </div>
    
        </div>
    </div>

<?php 
    $total_curriculos = $template->item('total_curriculos');
    $total_anuncios = $template->item('total_anuncios');
    $total_usuarios = $template->item('total_usuarios');
?>

<div class="container-fluid">
    <div class="row funfacts" style="background: #223">
        <div style="width: 85%; margin: 0 auto;">
            <div class="col-md-4">
                <div class="funfact">
                    <div class="st-funfact-icon"><i class="fa fa-briefcase"></i></div>
                    <div class="st-funfact-counter" ><span class="st-ff-count" data-from="0" data-to="<?php echo $total_anuncios; ?>" data-runit="1">0</span></div>
                    <strong class="funfact-title">Anúncios publicados</strong>
                </div><!-- .funfact -->
            </div>
            <div class="col-md-4">
                <div class="funfact">
                    <div class="st-funfact-icon"><i class="fa fa-address-card-o"></i></div>
                    <div class="st-funfact-counter" ><span class="st-ff-count" data-from="0" data-to="<?php echo $total_curriculos; ?>" data-runit="1">0</span></div>
                    <strong class="funfact-title">Currículos publicados</strong>
                </div><!-- .funfact -->
            </div>
            <div class="col-md-4">
                <div class="funfact">
                    <div class="st-funfact-icon"><i class="fa fa-users"></i></div>
                    <div class="st-funfact-counter" ><span class="st-ff-count" data-from="0" data-to="<?php echo $total_usuarios; ?>" data-runit="1">0</span></div>
                    <strong class="funfact-title">Usuários cadastrados</strong>
                </div><!-- .funfact -->
            </div>
        </div>
    </div>

</div>


    <div id="fh5co-testimonials" data-section="testimonials" hidden>       
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">O que nossos clientes dizem</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext to-animate">
                            <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <p class="author">John Doe, CEO <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span></p>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.&rdquo;</p>
                        </blockquote>
                        <p class="author">John Doe, CEO <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span></p>
                    </div>
                    
                    
                </div>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                        </blockquote>
                        <p class="author">John Doe, Founder <a href="#">FREEHTML5.co</a> <span class="subtext">Creative Director</span></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-pricing" data-section="pricing" hidden>
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="single-animate animate-pricing-1">Planos</h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext single-animate animate-pricing-2">
                            <h3>Para conseguir tirar 100% de aproveitamente da nossa plataforma, assine um dos planos abaixo.</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="price-box to-animate">
                        <h2 class="pricing-plan">Starter</h2>
                        <div class="price"><sup class="currency">$</sup>7<small>/mo</small></div>
                        <p>Basic customer support for small business</p>
                        <hr>
                        <ul class="pricing-info">
                            <li>10 projects</li>
                            <li>20 Pages</li>
                            <li>20 Emails</li>
                            <li>100 Images</li>
                        </ul>
                        <a href="#" class="btn btn-default btn-sm">Get started</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="price-box to-animate">
                        <h2 class="pricing-plan">Regular</h2>
                        <div class="price"><sup class="currency">$</sup>19<small>/mo</small></div>
                        <p>Basic customer support for small business</p>
                        <hr>
                        <ul class="pricing-info">
                            <li>15 projects</li>
                            <li>40 Pages</li>
                            <li>40 Emails</li>
                            <li>200 Images</li>
                        </ul>
                        <a href="#" class="btn btn-default btn-sm">Get started</a>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 to-animate">
                    <div class="price-box popular">
                        <div class="popular-text">Best value</div>
                        <h2 class="pricing-plan">Plus</h2>
                        <div class="price"><sup class="currency">$</sup>79<small>/mo</small></div>
                        <p>Basic customer support for small business</p>
                        <hr>
                        <ul class="pricing-info">
                            <li>Unlimitted projects</li>
                            <li>100 Pages</li>
                            <li>100 Emails</li>
                            <li>700 Images</li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-sm">Get started</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="price-box to-animate">
                        <h2 class="pricing-plan">Enterprise</h2>
                        <div class="price"><sup class="currency">$</sup>125<small>/mo</small></div>
                        <p>Basic customer support for small business</p>
                        <hr>
                        <ul class="pricing-info">
                            <li>Unlimitted projects</li>
                            <li>Unlimitted Pages</li>
                            <li>Unlimitted Emails</li>
                            <li>Unlimitted Images</li>
                        </ul>
                        <a href="#" class="btn btn-default btn-sm">Get started</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    
    <div class="contact" id="contact" data-section="contact">
        <div class="container">
        <div class="row">
            <div class="col-md-12 section-heading text-center">
                <h2 class="single-animate animate-pricing-1">Contato</h2>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 subtext single-animate animate-pricing-2">
                        <h3>Dúvidas, críticas e sugestões serão sempre bem vindas!</h3>
                    </div>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form id="form_contato" method="POST" action="<?php site_url('email_contato/enviar_email') ?>" class="contact-form" role="form">
                        <input type="text" class="form-control input-lg" id="fname" name="nome" placeholder="Nome completo">
                        <input type="email" class="form-control input-lg" id="email" name="email" placeholder="E-mail">
                        <input type="text" class="form-control input-lg" id="subj" name="assunto" placeholder="Assunto">
                        <textarea id="mssg" name="mensagem" placeholder="Mensagem" class="form-control input-lg" rows="10"></textarea>
                        <button class="btn btn-primary btn-lg" type="button" onclick="enviar_email()" id="send" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Sending..."><i class="fa fa-paper-plane "></i> Enviar</button>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="alerta_contato" class="alert">
                                
                            </div>
                        </div>
                    </div>

                    <script>

                        function enviar_email(){

                            var data = $('#form_contato').serialize();

                            $.ajax({
                                url: '<?php echo site_url("email_contato/enviar_email") ?>',
                                type: 'POST',
                                data: data,
                                beforeSend: function(){
                                    $(this).html("<i class='fa fa-spinner fa-spin'></i> Sending...");
                                }
                            })
                            .done(function(data) {
                                $('#alerta_contato').html(data);
                                console.log("success");
                            })
                            .fail(function() {
                                $('#alerta_contato').html("Não foi possivel se conectar com o banco de dados, tente novamente mais tarde.");
                                console.log("error");
                            })
                            .always(function() {
                                console.log("complete");
                                $(this).html("<i class='fa fa-paper-plane'></i> Enviar");
                            });

                        }

                    </script>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" role="contentinfo">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-12">
                    <p class="copyright text-center">&copy; <?php echo date('Y') ?> <a href="index.html">Work for All</a>. Todos os direitos reservados.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="social social-circle">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    