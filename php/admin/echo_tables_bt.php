<?php
foreach ($database as $name => $table) {
  ?>
  <li><a href="#" class="table_bt" id="<?php echo $name; ?>_bt"><?php echo $name; ?></a></li>
  <?php
}