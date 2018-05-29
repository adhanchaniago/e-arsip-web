<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php if($page_title!=" "){echo $page_title." | ";} ?> E-ARSIP </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="" />
    <!--  Social tags      -->
    <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard, premiu material design admin">
    <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="#">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="#">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="#" />
    <meta property="og:image" content="#" />
    <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link rel="stylesheet" href="<?php echo base_url('assets/css/material-dashboard.min790f.css?v=2.0.1') ;?>">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url()?>assets/assets-for-demo/demo.css" rel="stylesheet"/>
    <script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
    <script type="text/javascript">
        if (document.readyState === 'complete') {
            if (window.location != window.parent.location) {
              const elements = document.getElementsByClassName("iframe-extern");
              while (elemnts.lenght > 0) elements[0].remove();
                // $(".iframe-extern").remove();
            }
        };
    </script>
    <?php if ($this->session->userdata('status_login')=="login" and $this->session->userdata('level_user')!="admin" and $this->session->userdata('level_user')!="sekertaris") { ?>
    <script>
    $("document").ready(function(){
        var base_url="<?php echo base_url(); ?>";
        var x = document.getElementById("myAudio");

        function enableAutoplay() { 
            x.autoplay = true;
            x.load();
        }
        function load_unseen_notification(view = ''){
            $.ajax({
                url:base_url+"awal/notification",
                method:"POST",
                data:{baca:view},
                dataType:"json",
                xhrFields: { withCredentials: true }, 
                crossDomain: true, 
                success:function(data){
                    $('.data_notifikasi').html(data.notification);
                    if(data.unseen_notification > 0){
                        $('#jml_notifikasi').html(data.unseen_notification);
                        $('.popupnotifikasi').html(data.notificationpopup);
                        $.ajax({
                            url:base_url+"awal/notification",
                            method:"POST",
                            data:{popup:view},
                            dataType:"json",
                        });  
                    }else{
                        $('.data_notifikasi').html(data.no_notif);
                    }
                    if (data.jmlpopup > 0) {
                        enableAutoplay();
                    }
                }
            });
        }
     
        load_unseen_notification("");
         
        setInterval(function(){ 
            load_unseen_notification(""); 
        }, 7000);
    });
    </script>
    <?php } ?>