<?php
foreach ($database as $name => $table)
{
  ?>
  <table id="<?php echo $name; ?>">
    <caption><?php echo $name; ?></caption>
    <tr>
      <?php
        foreach ($table[0] as $col_name => $var){
          ?><th><?php echo $col_name; ?></th><?php
        }
      ?>
      <th class="options"></th>
      <th class="options"></th>
    </tr>
    <?php
      for ($i = 0; $i < count($table); $i++)
      {
        ?>
        <tr id="<?php echo $name.'_'.$table[$i]['id']; ?>">
          <?php
            foreach ($table[$i] as $key => $value) {
              ?><td id="<?php echo $name.'_'.$table[$i]['id'].'_'.$key?>" contenteditable="false" spellcheck="false"><?php echo $value; ?></td><?php
            }
          ?>
          <td class="options delete"><i class="fas fa-trash-alt"></i></td>
          <td class="options update"><i class="fas fa-edit"></i></i></td>
        </tr>
        <?php
      }
    ?>
  </table>
  <?php
}