 <link href="<?php echo base_url() ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
 <section class="col-sm-10">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Notes et résultats <?php echo $filiere['filiere'];?> </h3>
            </div>
            <div class="panel-body">
              <?php 
                for ($i=1;$i<=$semestre;$i++) { ?>
                  <a href="<?php echo site_url('etudiant/note'); ?>?semestre=<?php echo $i;?>"> Semestre <?php echo $i.' spécialité '.$filiere['spec'].' option '.$filiere['option'];?></a><br>
         <?php  }
              ?>
              <a href="C:/wamp/www/CodeIgniter/application/data/cours/PFE2.pdf">Analyse1 </a>
            </div>
          </div>
</section>
<script src="<?php echo base_url() ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
            initEventModals();
        });
  </script>