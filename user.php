<?php
include_once('user_include/header.php'); ?>


<style>
    .align {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        /* Set the number of columns you desire (e.g., 5 cards per row) */
        grid-gap: 20px;
        /* Adjust the gap between cards */
    }

    .card-container {
        display: inline-block;
        width: 100%;
        break-inside: avoid;
        /* Prevent cards from breaking across columns */
    }

    <?php
    $query = "SELECT * FROM announcement ORDER BY created_at DESC";
    $announcement = $db_connection->query($query);
    ?>
</style>


<h1 class="h3 mb-2 text-gray-800 ml-3">Announcements</h1>

<?php if ($announcement->num_rows > 0) { ?>

<?php } else { ?>
    <p style="color:red; font-weight:bold;" class="ml-4">No Announcements Yet!</p>
<?php } ?>
<div class="align">
    <?php while ($row = $announcement->fetch_assoc()) { ?>
        <div class="card-container">
            <div class="card border-success ml-4 mb-3" style="max-width: 18rem;">
                <div class="card-header bg-transparent border-success">
                    <?php echo $row['announcement_title']; ?>
                </div>
                <div class="card-body text-success">
                    <p class="card-text">
                        <?php echo $row['announcement']; ?>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <?php echo date("F j, Y h:i A", strtotime($row["created_at"])); ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>












<?php
include_once('user_include/footer.php');
?>