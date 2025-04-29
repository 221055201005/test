<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="IT Developer Seatrium">
    <title><?php echo $meta_title ?></title>


    <link rel="shortcut icon" href="<?php echo base_url();?>img/favicon_seatrium.png"/>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/bootstrap.min.js"></script>
    <script>var _tooltip = jQuery.fn.tooltip;</script>

    <!-- Font Awasome -->
    <link href="<?php echo base_url();?>assets/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/datatables/buttons.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/buttons.flash.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/buttons.html5.min.js"></script>

    <!-- SweetAlert2 -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- JQUERY UI -->
    <link href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.min.js"></script>
    <script>jQuery.fn.tooltip = _tooltip;</script>

    <!-- CanvasJS -->
    <script src="<?php echo base_url();?>assets/canvasjs/canvasjs.min.js"></script>

    <!-- Highcharts -->
    <script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url();?>assets/highcharts/exporting.js"></script>

    <!-- DatePicker -->
    <link href="<?php echo base_url();?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Selct2 -->
    <link href="<?php echo base_url();?>assets/select2/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/select2/select2-bs4.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/select2/select2.min.js"></script>
    <script src="<?php echo base_url();?>assets/select2/select2.full.js"></script>
    <!-- Sidebar -->
    <link href="<?php echo base_url();?>assets/sidebar/style.css" rel="stylesheet">

    <!-- Bootstrap select -->
    <link href="<?php echo base_url();?>assets/bootstrap_select/bootstrap-select.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap_select/bootstrap-select.min.js"></script>

    <!-- Zebra -->
    <link href="<?php echo base_url();?>assets/dist_zebra_date_picker/css/default/zebra_datepicker.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/dist_zebra_date_picker/zebra_datepicker.min.js"></script>

    <!-- Floating Scroll -->
    <link href="<?php echo base_url();?>assets/floating-scroll/jquery.floatingscroll.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>assets/floating-scroll/jquery.floatingscroll.min.js"></script>

    <!-- Zebra -->
    <script type="text/javascript" src="<?= base_url() ?>assets/push-notif/push.js"></script>

    <!-- Zebra -->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>

    <!-- Freeze Table -->
    <script src="<?php echo base_url();?>assets/jquery-freeze-table-master/freeze-table.js"></script>

    <!-- Toast Notification -->
    <link href="<?php echo base_url();?>assets/toast/dist/toast.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/toast/dist/toast.min.js"></script>

    <!-- Socket -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>assets/socket/css/message.css"> -->
    <!-- <script src="<?php //echo base_url()?>assets/socket/js/message.js"></script> -->
    <!-- <script src="<?php //echo base_url()?>assets/socket/websocket/fancywebsocket.js"></script> -->
    <style>
      [type="checkbox"], label > span{
        vertical-align:middle;
      }

      #content{
        overflow: auto;
      }
      .bg-white{
        background: white;
      }
      .bg-aqua{
        background: #00c0ef;
      }
      .bg-yellow{
        background: #f39c12;
      }
      .bg-orange {
        background-color: #FF851B !important;
      }
      .bg-green-smoe{
        background-color: #003eff;
      }
      .bg-purple{
        background-color: #6610f2;
      }
      .bg-teal{
        background-color: #20c997;
      }
			.bg-gray-table {
				background-color: #d7dade;
			}
			.bg-seatrium-blue{
				background-color: #003eff !important;
			}
			.bg-blue {
      	background-color: #0031d1 !important;
		  }
		  .bg-green {
	      background-color: #00a65a !important;
		  }
		  .bg-orange {
	      background-color: #f39c12 !important;
		  }
		  .bg-red {
	      background-color: #d9534f !important;
		  }
		  .bg-red-2 {
	      background-color: #b80000 !important;
		  }

      .btn-flat{
        border-radius: 0px;
      }
      .btn-green-smoe{
        background-color:#003eff;
        border-color: #003eff;
      }
      .btn-green-smoe:hover{
        background-color:#012bb3;
        border-color: #012bb3;
      }
      .dropdown-toggle.collapsed::after{
        border-left: .3em solid;
        border-top: .3em solid transparent;
        border-right: 0;
        border-bottom: .3em solid transparent;
      }
      .font-size-9{
        font-size: 0.9rem;
      }
      .checkbox-big{
        width: 1.2rem;
        height: 1.2rem;
      }

      .table-min-width-200 th:not(.dismiss-200){
        min-width: 200px;
        white-space: nowrap!important;
      }

      table th.resizing {
        cursor: col-resize !important;
      }

      table th{
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
      }

      .select2 {
        width:100%!important;
      }
      .table-th-sticky th { 
        position: sticky; top: 0; z-index: 1;
      }
      
      .bg-alert-warning{
        background-color: #fff3cd!important;
        color: #856404!important;
      }

      .bg-alert-danger{
        background-color: #f8d7da!important;
        color: #721c24!important;
      }

      .select2-container--default .select2-selection--multiple .select2-selection__choice{
        margin-right: 2px;
      }

      select[readonly] {
        background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
        pointer-events: none;
        touch-action: none;
      }

      
      
      input.autoshow-calendar[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
      }
      
      select[readonly] {
        background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
        pointer-events: none;
        touch-action: none;
      }

      
      .select2-search__field {
        width: 100% !important;
      }
    </style>
    <style>
    .unread {
      background-color: #d9f2fa !important;
    }
  </style>
  </head>