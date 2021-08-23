<div class="col-md-4">

    <!-- Blog Search Well -->
    <?php include "search_form.php" ?>

    <!-- Blog Categories Well -->
    <div class="well">
        <?php
        $query = "SELECT * FROM categories";
        $sql = mysqli_query($connection, $query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($sql)) {
                        $cat_title = $row['cat_title'];
                        echo "<li><a href = '#'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>