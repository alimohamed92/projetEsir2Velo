 <link href="<?php echo base_url() ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
 <section class="col-sm-10">
          <div class="panel panel-default">
            <div class="panel-heading">
            <?php if(isset($historique)){?>
              <h3 class="panel-title">Mon historique du   <b><?php echo $date1.' au '.$date2;?> </h3>
            </div>
            <div class="panel-body">
              <table class="table table-bordered table-responsive table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Date</th> <th>Départ</th> <th>Arrivée</th> <th>Vitesse</th> <th>Distance</th><th>Durée(h)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                   $i = 0;
                    foreach ($historique as $rec) {?>
                      <tr  class ="<?php if ($i==0) echo "success"?>" > 
                        <td> <?php echo $rec['date'] ?> </td> <td><?php echo $rec['pointDepart'] ?></td> 
                        <td> <?php echo $rec['pointArrivee'] ?> </td> <td><?php echo $rec['vitesseMoy']?> </td>
                        <td><?php echo $rec['distancePar']?> </td><td><?php echo ($rec['distancePar']/$rec['vitesseMoy'])?> </td>
                      </tr>

                  <?php 
                  $i++;
                }
                  ?>
                
                </tbody>
              </table>
            </div>
            <?php 
          }  else {
            ?>
            <form method = "post" action = "<?php echo site_url('user/historique'); ?>" >
            Du :<input type = "date" name ="date1"/> Au :<input type = "date"name = "date2" /> 
            <input type = "submit" value ="OK"/>
            </form>
          <?php }?>
          </div>
          
</section>
