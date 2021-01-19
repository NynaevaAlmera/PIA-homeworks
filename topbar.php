<div class="container-fullwidth">
    <nav class="navbar navbar-inverse">
        <a href="https://www.animefreak.tv/" class="logo"></a>
        <div class="container-fluid">

            <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="filmlist.php">
                    <img src="pics/imdblogo.png" style="height: 20px;">
                </a>
            </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-align-justify">  <span style="font-family: Arial, Helvetica, sans-serif;">Administrator</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="animelist.php">Anime List</a class="dropdown-item"></li>
                        <li class="divider"></li>
                        <li><a class="dropdown-item" href="search.php">Search</a class="dropdown-item"></li>
                        <li class="divider"></li>
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
                if(empty($_SESSION["userid"])) {
                    echo('<li><a href="management/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li><li><a href="management/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>');
                    }
                else{
                    echo('<li><a href="management/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>');
                }
                ?>
            </ul>
        </div>
    </nav>
        
    </div>
