 <?php

if(isset($_POST['med_search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function to join string to search efficiently
    $query = "SELECT * FROM `comp_data` WHERE CONCAT(`comp_name`, `address`,`contact_no`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `comp_data`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "med.directory");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Medicine Search</title>
	
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
         <ul class= "head">
         <li><a href="index.php">Medical Inventory</a>
         </li>
     </ul>
        <form action="comp.search.php" method="post">
            <div class="input-group">
                <input type="text" name="valueToSearch" placeholder="Search"><br><br> </div>
            <div class="input-group">
                <input type="submit" name="med_search" value="Search"><br><br></div>
            
            <table>
                <tr>
                    
                    <th>Company Name</th>
                    <th>Address </th>
                    <th>Phone</th>
                    
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                   
                    
                    <td><?php echo $row['comp_name'];?></td>
                     <td><?php echo $row['address'];?></td>
                    <td><?php echo $row['contact_no'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>
