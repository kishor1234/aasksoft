
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="hlogo.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> <?php echo $shopname; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
         
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="Home.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
               
              </ul>
            </li>
            <?php
               $mainMenuArray=[];
               $result=$mysqli_object->query("SELECT * FROM `modulemenu` where parent='self' and permission=0");
               $i=0;
               while($row=$result->fetch_assoc())
               {
                   $mainMenuArray[$i]=$row['menuname'];
                   $i++;
               }
               
               for($i=0;$i<count($mainMenuArray);$i++)
               {
                    echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>'.$mainMenuArray[$i].'</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a><ul class="treeview-menu">';
                $result=$mysqli_object->query("SELECT * FROM `modulemenu` where  permission=0");
                   while($row=$result->fetch_assoc())
                   {
                      
                        if(strcmp($mainMenuArray[$i],$row['parent'])==0)
                        {
                            echo'<li class=""><a href="'.$row['action'].'"><i class="fa fa-circle-o"></i> '.$row['menuname'].'</a></li>';
                        }
                   }
                   echo ' </ul>
            </li>';
               }
            ?>
           <li class=" treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Setting's</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li class=""><a href="#popup1"><i class="fa fa-circle-o"></i> Set Vat %</a></li>
               
              </ul>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
       
       </aside>