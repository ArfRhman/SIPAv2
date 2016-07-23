 <footer class="app-footer">
  <div class="wrapper">
    <span class="pull-right">2.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
  </div>
</footer>
<!-- Javascript Libs -->
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/Chart.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/ace/ace.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/ace/mode-html.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/lib/js/ace/theme-github.js"></script>
<!-- Javascript -->
<script type="text/javascript" src="<?=base_url()?>assets/js/app.js"></script>
<script>
  $(document).ready(function(){  
  
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })   
  $('.datepicker').datepicker({       
    format:'dd M yyyy' , 
    autoclose: true,
    orientation: 'bottom'    
  }); 
});
</script>


</body>

</html>