 <section id="poster_info">
            <ul>
                <li>
                    <a href="user/<?php echo strtolower($username).'/'.$author_id?>">
                        <img src="images/avatars/<?php echo $avatar ?>" width="140" height="130" />
                    </a>
                </li>
                <li>
                   <?php echo Links::makeLink('user', array($username, $id), $username); ?>
                </li>
                <li><?php  echo $country ?></li>
                <li><?php // echo $profile->number_of_posts(); ?></li>
                <li id="online" title="User is online"></li>
            </ul>
        </section>  