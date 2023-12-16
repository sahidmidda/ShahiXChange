<?php
    session_start();
    include('../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Page Queries | SubuWorks</title>
  <!-- Material CDN -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  <link rel="stylesheet" href="./contact-page.css" />
</head>

<body>
    <?php
        if(!isset($_SESSION['adminEmail']))
        {
            $_SESSION['alertMessage'] = "Only admin can access this page, Please login as an Admin!";
            $_SESSION['alertType'] = "warning";
            header("Location: ../index.php");
            return;
        }
    ?>
  <div class="table-widget">
    <span class="caption-container">
      <span class="table-title">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmls="https://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M11.6775 1.3486C10.9695 2.1636 10.6875 7.2886 11.5105 8.1126C12.3335 8.9346 17.2785 8.5186 18.4665 7.5836C21.3245 5.3326 13.9375 -1.2534 11.6775 1.3486Z"
            stroke="#272727" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M16.1372 11.79C17.2212 12.874 14.3472 19.054 8.65122 19.054C4.39722 19.054 0.949219 15.606 0.949219 11.353C0.949219 6.053 6.17822 2.663 7.67722 4.162C8.54022 5.025 7.56822 9.086 9.11622 10.635C10.6642 12.184 15.0532 10.706 16.1372 11.79Z"
            stroke="#272727" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Contact Queries
      </span>
      <?php
        $dbobj = new connectDB();
        $result= $dbobj->getAllContactRequest();
      ?>
      <span class="table-row-count"><?php echo mysqli_num_rows($result); ?></span>
    </span>
    <div class="table-wrapper">
      <!-- generate table here -->
      <table>
        <thead>
            <tr>
                <th class="sticky-left"Ticker>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th class='sticky-right'>Action</th>
                <th class="sticky-right">Status</th>
            </tr>
        </thead>
        <tbody id="table-row">
        <?php
        while ($rec= mysqli_fetch_row($result))
        {
            echo "
            <tr>
                <td class='sticky-left'>$rec[1]</td>
                <td>$rec[2]</td>
                <td>$rec[3]</td>
                <td>$rec[4]</td>
                <td>$rec[5]</td>
                <td class='sticky-right'><a href='../operations.php?action=toggleContactRequest&contID=$rec[0]&check=$rec[6]'><button class='btn btn--primary'>Change Status</button></a></td>
                <td class='sticky-right'>
                ";
                    if($rec[6]=='0')
                    {
                        echo "Unattended";
                    } 
                    else
                    {
                        echo "Attended";
                    }
                "
                </td>
            </tr>";
        }
        if (mysqli_num_rows($result)===0)
        {
            echo "
            <tr>
                <td colspan='6'>No Records Found</td>
            </tr>";
        }
    ?>
    </tbody>
    </table>
    </div>
  </div>

</body>

</html>