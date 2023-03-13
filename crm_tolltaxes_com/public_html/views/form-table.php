<script type="text/javascript">
$(document).ready(function(){
 $('#dashboard').addClass('w3-blue');
});
</script>
<div class="w3-panel" style="margin-top: 20px;">
    <div class="w3-row-padding" style="margin:0 -16px;padding: 18px;padding-top: 0px;">
      <?php
      if ((isset($_GET['status'])) && ($_GET['status'] == 'process')) { ?>
        <div class="w3-bar w3-border w3-light-grey" id="stage_form">
          <a href="/dashboard.php?status=process" class="w3-bar-item w3-button">ALL</a>
          <?php
         $sql_filter = "SELECT * FROM `track_stages`";
         $result_filter = $conn->query($sql_filter);
         if ($result_filter->num_rows > 0) {
           while($row_filter = $result_filter->fetch_assoc()) {
             echo '<a href="/dashboard.php?status=process&track_stages_id='.urlencode($row_filter['id']).'" class="w3-bar-item w3-button '.((isset($_GET['track_stages_id']) && $row_filter['id'] == $_GET['track_stages_id']) ? 'w3-teal' :'').'">'.$row_filter['stage'].'</a>';
           }
         } else {
           echo '<a class="w3-bar-item w3-button"></a>';
         }
         ?>
      </div>
      <br>
      <script type="text/javascript" src="/assets/js/stage-active.js"></script>
    <?php } ?>
      <div class="w3-container w3-teal">
    <h5> Forms</h5>
    </div>
      <table class="w3-table-all w3-white w3-border">
        <tr>
          <th>Website</th>
          <th>Type</th>
          <th>Form name</th>
          <th>Applicant name</th>
          <th>Number</th>
          <th>Status</th>
          <th>Price</th>
          <th>Sales</th>
          <th>Process</th>
          <th>Track</th>
          <th>Date</th>
          <th>View</th>
        </tr>
        <?php
        date_default_timezone_set('Asia/Kolkata');
        error_reporting( E_ERROR );
        if (isset($_GET['track_stages_id'])) {
          $track_stages_id = mysqli_real_escape_string($conn,urldecode($_GET['track_stages_id']));
        }else {
           $track_stages_id = "ALL";
        }
        $search_query = 'ALL';
        if((isset($_GET['q'])) && ($_GET['q'] != '') && ($_GET['q'] != '')){
            $search_query = mysqli_real_escape_string($conn, $_GET['q']);
        }
        if((empty($_GET['to_limit']))&&($_GET['to_limit'] == "")) {

        $from_limit = 0 ; $to_limit = 30;
        if ($_GET['status'] == "filter" && $_GET['filter'] == "submit" && $_GET['fiter_limit'] != "ALL")
        {$to_limit = $_GET['fiter_limit'];}

        }else{$from_limit = $_GET['from_limit'] ; $to_limit = $_GET['to_limit'];}
        if ($_GET['status'] == "paid"){$user_data_form = get_form_data_num("ALL","Paid","ALL",$from_limit,$to_limit,$track_stages_id,$conn,"ALL");}
        else if ($_GET['status'] == "unpaid"){$user_data_form = get_form_data_num("ALL","Unpaid","ALL",$from_limit,$to_limit,$track_stages_id,$conn,"ALL");}
        else if ($_GET['status'] == "done"){$user_data_form = get_form_data_num("ALL","ALL","Done",$from_limit,$to_limit,$track_stages_id,$conn,"ALL");}
        else if ($_GET['status'] == "process"){$user_data_form = get_form_data_num("ALL","ALL","Process",$from_limit,$to_limit,$track_stages_id,$conn,"ALL");}
        else if ($_GET['status'] == "refund"){$user_data_form = get_form_data_num("ALL","ALL","Refund",$from_limit,$to_limit,$track_stages_id,$conn,"ALL");}
        else if ($_GET['status'] == "drop"){$user_data_form = get_form_data_num("ALL","ALL","Drop",$from_limit,$to_limit,$track_stages_id,$conn,"ALL");}
        else if ($_GET['status'] == "filter" && $_GET['filter'] == "submit"){$user_data_form = get_form_data_num_filter($_GET['fiter_web'],"ALL",$_GET['fiter_status'],$_GET['fiter_stage'],$_GET['fiter_price'],$_GET['fiter_orderby'],$_GET['fiter_assign'],$_GET['fiter_fromdate'],$_GET['fiter_todate'],$from_limit,$to_limit,$conn,"ALL");}
        else{$user_data_form = get_form_data_num("ALL","ALL","ALL",$from_limit,$to_limit,$track_stages_id,$conn,$search_query,"ALL");}
          while ($row = $user_data_form->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['web']."</td>
            <td>".$row['type']."</td>
            <td>".$row['form_name']."</</td>
            <td>".$row['name']."</td>
            <td>".$row['number']."</td>
            <td>".$row['status']."</td>
            <td>".$row['price']."</td>
            <td>".UserAssignForm($row['sales_id'],$conn)."</td>
            <td>".UserAssignForm($row['processor_id'],$conn)."</td>
            <td>".$row['track_status']."</td>
            <td>".$row['form_date']."</td>
            <td><a href='view-form.php?web=".$row['web']."&id=".$row['id']."'><button class='w3-button w3-teal'><i class='fa fa-share' aria-hidden='true'></i></button></a></td>";
            echo "</tr>";
          }
        ?>
      </table>
  </div>
</div>
