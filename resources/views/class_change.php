<div class="modal-spacing">
  <form method="post" action="<?php echo url('dashboard/setClass')?>">
    <input type="password" value="" name="lock_key" placeholder="Password Halaqah" style="width: 100%;text-align: center;">
    <br><br>
    <input type="submit" class="btn btn-primary btn-green" value="Konfirmasi"/>
    <input type="hidden" value="<?php echo $id_class?>" name="id_class">
  </form>
</div>
