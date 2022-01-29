    <?php
    include "db_conn.php"; // Using database connection file here

    $sql = "SELECT * FROM logement ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        ?>


    <table class="table table-dark table-striped">
        <tr>
            <th>Type de logement</th>
            <th>Adultes</th>
            <th>Animaux</th>
            <th>Prix</th>
            <th>Enfants</th>
            <th>Réserver</th>


        </tr>
        <?php // output data of each row
            ?>
        <?php while ($row = $result->fetch_assoc()) {
                ?> <tr>
            <td> <?php echo $row["type"]; ?></td>
            <td><?php echo $row["adult"]; ?> </td>
            <td> <?php echo $row["pet"]; ?> </td>
            <td><?php echo $row["price"]; ?> </td>
            <td> <?php echo $row["child"]; ?> </td>
            <td> <button><a href='book.php'>Réserver</a></button> </td>
            
        </tr>
        <?php
            } ?>
    </table>


    <?php
    } else { ?>
    0 results
    <?php }

    $conn->close();
    ?>
    
</body>
</html>

