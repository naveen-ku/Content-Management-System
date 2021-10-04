<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home Page</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $sql = mysqli_query($connection, $query);
                // console_log($sql);
                // print_r($sql);
                while ($row = mysqli_fetch_assoc($sql)) {
                    $cat_title = $row['cat_title'];
                    echo "<li><a href = '#'>{$cat_title}</a></li>";
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!isset($_SESSION['username']) || $_SESSION['username'] == "" || empty($_SESSION['username'])) {
                ?>
                    <li class="nav-item ml-auto"><a href="login.php">Login</a></li>
                    <li class="nav-item ml-auto"><a href="registration.php">Register</a></li>
                <?php
                }
                ?>
                <?php
                if (isset($_SESSION['username'])) {
                ?>
                    <li><a href="admin">Admin</a></li>
                <?php
                }
                ?>
                <?php
                if (isset($_SESSION['user_role'])) {
                    if ($_SESSION['user_role'] == 'admin') {
                        if (isset($_GET['p_id'])) {
                            $post_id = $_GET['p_id'];
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>