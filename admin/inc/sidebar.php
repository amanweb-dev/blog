<div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                                
                            </ul>
                        </li>
						
                         <li><a class="menuitem">Pages</a> 
                            <ul class="submenu">
                                <li><a href="addPage.php">Add Page</a></li>
                                  <?php 
                                        $query = "select * from pages ";
                                        $pages_result = $db->select($query);
                                        if ($pages_result) {
                                            while ($row = $pages_result->fetch_assoc()) {
                                                $page_id = $row['page_id'];
                                                $page_name = $row['page_name'];
                                                $page_body = $row['page_body'];
                                            ?>
                                            <li><a href="pages.php?pg_id=<?php echo $page_id; ?>"><?php echo $page_name; ?></a></li>                

                                        <?php

                                            }

                                        }
                                ?>
                               
                            </ul>                           
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>