<!DOCTYPE html>
<html>
<head>
    <title>Sykes Cottages</title>
</head>
<style>
    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}

    #list_table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #list_table td, #list_table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #list_table tr:nth-child(even){background-color: #f2f2f2;}

    #list_table tr:hover {background-color: #ddd;}

    #list_table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<body>

<h2>Sykes Cottages</h2>
<form action="/">
    <input type="submit" value="Search new location" />
</form>
<table id="list_table">
    <tr>
        <th>Property</th>
        <th>Pet friendly</th>
        <th>Near the beach</th>
        <th>Minimum number of guest</th>
        <th>Number of beds</th>
        <th>Status</th>
    </tr>
    <?php if(!empty($tbody)):?>
        <?php foreach ($tbody as $key => $value):?>
            <tr>
                <td><?php echo $value['name'];?></td>
                <td><?php echo $value['pet_stat'];?></td>
                <td><?php echo $value['beach_stat'];?></td>
                <td><?php echo $value['sleeps'];?></td>
                <td><?php echo $value['beds'];?></td>
                <td><?php echo $value['status'];?></td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <tr>
            <td colspan="6"> No Data </td>
        </tr>
    <?php endif;?>

  
</table>
<?php if($page_count != 0):?> 
    <div class="pagination">
        <a href="/property-list?page=1">&laquo;</a>
            <?php for($i=1; $i <= $page_count; $i++):?>
                <a href="/property-list?page=<?php echo $i;?>"><?php echo $i;?></a>
            <?php endfor;?>
        <a href="/property-list?page=<?php echo $page_count;?>">&raquo;</a>
    </div>
<?php endif;?>


</body>
</html>