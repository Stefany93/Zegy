<?Php //cho $_SERVER['REQUEST_URI'];?>
<div class="auction">
                        <img src="images/x.png" class="cansel" alt="" class="cansel_button" style="border-image:none;">
                        <?php if($_SERVER['REQUEST_URI'] == '/edit-art.php' 
                        or $_SERVER['REQUEST_URI'] == '/edit-art.php?sucess'
                        or  $_SERVER['REQUEST_URI'] == '/projects/vughs/edit-art.php') {?>
                        <a href="delete.php?id_to_be_deleted=<?php echo $id ?>" onclick="javascript: if(confirm('Are you sure you want to delete this artwork?') === false){return false;}">
                            Delete
                        </a>
                         <a href="achterdeur.php?id_to_be_edited=<?php echo $id ?>" style="float:right">
                            Edit
                        </a>

                        <?php } ?>
                    <a href="#" class="auction_title"> 
                        <?php  echo $title; ?> 
                        <br>
                        <?php echo $category_name ?>
                   </a>
                    <a href="#" class="auction_title">
                        <img src="images/330-250px/<?php echo $image_name; ?>" alt="" width="300" height="220" class="auction_image" id="small" />
                        <img src="images/<?php echo $image_name; ?>" alt="" width="300" height="220" class="auction_image" id="big" />
                    </a>

                    <p>  <?php echo $description; ?></p>
            </div>