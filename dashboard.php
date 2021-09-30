<?php
require_once 'header.php';
require_once 'navbar.php';
require_once 'left-navbar.php';
 
    if(isset($_POST['send_sms']))
      { 
          $sms = test_input($_POST['gen_sms']);
          $numbers='';
          $sql="select  m.mob_no  from gym_member m";
          $result=$conn->query($sql);
          if($result->num_rows>0){
              while($row=$result->fetch_assoc())
              {
                  $numbers .= $row['mob_no'].',';
              }
              echo $numbers =  rtrim($numbers,",");
          }  
          // print_r(send_sms($numbers,$sms)); 
      } 
    $sql="SELECT count(id) as count from gym_member";
    if($result=$conn->query($sql)){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc())
            {
                $usersCount=$row['count'];
            }
        }
//        print_r($pending_orders);
    }
    $date = date('d/m/Y'); 
     
    $sql="select count(id) as count from mem_fees f where  STR_TO_DATE(f.last_date,'%d/%m/%Y') > STR_TO_DATE('$date','%d/%m/%Y')";
    if($result=$conn->query($sql)){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc())
            {
                $pCount=$row['count'];
            }
        } 
    }
    $sql="select count(id) as count from  mem_fees f where  STR_TO_DATE(f.last_date,'%d/%m/%Y') > STR_TO_DATE('$date','%d/%m/%Y') and STR_TO_DATE('$date','%d/%m/%Y') > DATE_SUB(STR_TO_DATE(f.last_date,'%d/%m/%Y'), INTERVAL 2 DAY)";
    if($result=$conn->query($sql)){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc())
            {
                $ndCount=$row['count'];
            }
        } 
    }
    $sql="select count(id) as count from mem_fees f where STR_TO_DATE(f.last_date,'%d/%m/%Y') < STR_TO_DATE('$date','%d/%m/%Y')";
    if($result=$conn->query($sql)){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc())
            {
                $dCount=$row['count'];
            }
        } 
    }
    $sql="SELECT count(id) as count from qna where answer=''";
    if($result=$conn->query($sql)){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc())
            {
                $NqCount=$row['count'];
            }
        }
//        print_r($pending_orders);
    }
      $sql="SELECT count(id) as count from qna where answer!=''";
    if($result=$conn->query($sql)){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc())
            {
                $AqCount=$row['count'];
            }
        }
 
    }
    
 
       
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number"><?=$usersCount?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Due Fee Members</span>
              <span class="info-box-number"><?=$dCount;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
             <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" style="font-size:13px">Pending Fee Members</span>
              <span class="info-box-number"><?=$ndCount?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
             <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" style="font-size:13px">Paid Fee Memebrs</span>
              <span class="info-box-number"><?=$pCount?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
   <!-- Content Header (Page header) -->
     

   
</section>
<section class="content">
    <form method="post">
        <div class="box">
            <div class="box-body" style="height: 280px;">  
                <h4>Send General SMS To Memebrs</h4>
                <textarea style="width: 100%;height:150px;resize:none" name="gen_sms" required></textarea> 
              <section class="content-header">
                  <ol class="breadcrumb">
                      <li>
                          <div class="pull-right">    
                              <button type="submit" class="btn btn-success" name="send_sms">Send Sms</button>   
                          </div>
                      </li>
                  </ol>
              </section>
            </div>
        </div>  
  </form>
</section>
 	   
  <div class="control-sidebar-bg"></div>
<?php
require_once 'js-links.php';
?>
<!-- ChartJS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot-old/jquery.flot.resize.min.js"></script>
 