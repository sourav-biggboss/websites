<div class="w3-panel" style="margin-top: 20px;">
  <div class="w3-row-padding" style="margin:0 -16px;padding: 18px;padding-top: 0px;">
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
        if((empty($_GET['to_limit']))&&($_GET['to_limit'] == "")) { $from_limit = 0 ; $to_limit = 30;}else{$from_limit = $_GET['from_limit'] ; $to_limit = $_GET['to_limit'];}
        $user_data_form = get_complaint_data_num("ALL","Paid","ALL",$from_limit,$to_limit,$conn);
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
