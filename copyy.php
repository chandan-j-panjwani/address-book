<?php
require_once "includes/functions.php";
//dd(db_select("SELECT * FROM contacts"));
?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!--Import Csutom CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!--NAVIGATION BAR-->
    <nav>
        <div class="nav-wrapper">
            <!-- Dropdown Structure -->
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!">Profile</a></li>
                <li><a href="#!">Signout</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo center">Contact Info</a>
                    <ul class="right hide-on-med-and-down">

                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i
                                    class="material-icons right">more_vert</i></a></li>
                    </ul>
                </div>
            </nav>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <!--/NAVIGATION BAR-->

    <!-- Add a New Contact Link-->
    <div class="row mt50">
        <div class="col s12 right-align">
            <a class="btn waves-effect waves-light blue lighten-2" href="add-contact.html"><i
                    class="material-icons left">add</i> Add
                New</a>
        </div>
    </div>
    <!-- /Add a New Contact Link-->

    <!-- Table of Contacts -->
    <div class="row">
        <div class="col s12">
            <table class="highlight centered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Date Of Birth</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

<?php
            //HANDLING PAGINATION 

            $page = 1;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            $no_of_records_per_page = 5;
            $start = ($page-1) * $no_of_records_per_page;

            $result = db_select("SELECT COUNT(*) AS total FROM contacts");
            if(!$result){
                dd(db_error());
            }
            $total_count = $result[0]['total'];
            $total_pages = ceil($total_count/ $no_of_records_per_page);

            if($page > $total_pages){
                //LOAD page 404
                dd("jow the fuck you reached here");
            }
            $query = "SELECT * FROM contacts LIMIT $start,$no_of_records_per_page";
            $result = db_select($query);
            if(!$result){
                dd(db_error());
            }?>
            
<?php
            foreach($result as $row):

?>
                    <tr>
                        <td><img class="circle" src="images/users/<?= $row ['image_name'];?>" alt="" height="60%"></td>
                        <td><?= $row['first_name'] ." ". $row['last_name']; ?> </td>
                        <td><?= $row['email'];?></td>
                        <td><?= $row['birthdate'];?></td>
                        <td><?= $row['telephone'];?></td>
                        <td><?= $row['address'];?></td>
                        <td><a class="btn btn-floating green lighten-2"><i class="material-icons">edit</i></a></td>
                        <td><a class="btn btn-floating red lighten-2 modal-trigger" href="#deleteModal"><i class="material-icons">delete_forever</i></a>
                        </td>
                    </tr>

                    <?php
                        endforeach;
?>                        
                   
                </tbody>
            </table>
        </div>
    </div>
    <!-- /Table of Contacts -->
    <!-- Pagination -->
    <div class="row">
        <div class="col s12">
            <ul class="pagination">
                <li class="<?= $page==1 ? 'disabled':'waves-effect';?>">
                <a href="" id="Toleftpage">
                <i class="material-icons">chevron_left</i></a>
            </li>
                <?php
                        for($i=1; $i<=$total_pages; $i++):
                ?>
                <li class="waves-effect <?= $page==$i ? 'active' : '';?>">
                <a class="pagination-link" id="<?=$i?>" href="?page=<?= $i;?>"><?=$i;?></a>
            </li>

<?php
                        endfor;
?>
        <li class="<?= $page==$total_pages? 'disabled':'waves-effect';?>">
                <a href="" class="pagination-link">
                <i class="material-icons">chevron_right</i></a>
            </li>
            </ul>
        </div>
    </div>
    <!-- /Pagination -->
    <!-- Footer -->
    <footer class="page-footer p0">
        <div class="footer-copyright ">
            <div class="container">
                <p class="center-align">Â© 2020 Study Link Classes</p>
            </div>
        </div>
    </footer>
    <!-- /Footer -->
    <!-- Delete Modal Structure -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h4>Delete Contact?</h4>
            <p>Are you sure you want to delete the record?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close btn blue-grey lighten-2 waves-effect">Cancel</a>
            <a href="#!" class="modal-close btn waves-effect red lighten-2">Agree</a>
        </div>
    </div>
    <!-- /Delete Modal Structure -->
    <!--JQuery Library-->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--Include Page Level Scripts-->
    <script src="js/pages/home.js"></script>
    <!--Custom JS-->
    <script src="js/copy.js" type="text/javascript"></script>
</body>

</html>