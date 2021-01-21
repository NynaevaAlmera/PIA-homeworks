<div class="container-fullwidth">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">

            <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="filmlist.php">
                    <img src="pics/imdblogo.png" style="height: 20px;">
                </a>
            </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-align-justify"></span>  <span style="font-family: Arial, Helvetica, sans-serif;">Administrator</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="adminCreate.php">Create film</a class="dropdown-item"></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form class="navbar-form navbar-left" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                session_start();
                echo('<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout User: ' . $_SESSION['userdict']['username'] . '</a></li>');
                    
                ?>
            </ul>
        </div>
    </nav>
        
    </div>
