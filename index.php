<html>

<head>
  <title>Table</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/form.css" rel="stylesheet" />
  <!-- like font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Favorite Baby Names</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Names</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Subscribe</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Masthead-->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">Welcome</h1>
        <h2 class="text-white-50 mx-auto mt-2 mb-5">This page provides some insight on popular baby names based on your opinion.</h2>
        <a class="btn btn-primary js-scroll-trigger" href="#projects">Get Started</a>
      </div>
    </div>
  </header>
  <!-- Projects-->
  <section class="projects-section bg-light" id="projects">
    <?php
    include 'db_connect.php';

    $sqlget = "SELECT DISTINCT a.Names
                      FROM BABYNAMES a
                      LIMIT 20";
    $sqldata = mysqli_query($db_link, $sqlget) or die("error creating");
    //$row = mysqli_fetch_array($sqldata);
    //print_r($sqldata);

    //like button fuctionality
    if (isset($_POST['liked'])) {
      $postid = $_POST['postid'];
      $result = mysqli_query($db_link, "SELECT * FROM  userbbnameinput WHERE id=$postid");
      $row = mysqli_fetch_array($result);
      $n = $row['likes'];

      mysqli_query($db_link, "INSERT INTO likes (userid, bbnameid) VALUES ($postid, $postid)");
      mysqli_query($db_link, "UPDATE userbbnameinput SET likes=$n+1 WHERE id=$postid");

      echo $n + 1;
      exit();
    }
    if (isset($_POST['unliked'])) {
      $postid = $_POST['postid'];
      $result = mysqli_query($db_link, "SELECT * FROM userbbnameinput WHERE id=$postid");
      $row = mysqli_fetch_array($result);
      $n = $row['likes'];

      mysqli_query($db_link, "DELETE FROM likes WHERE bbnameid=$postid AND bbnameid=$postid");
      mysqli_query($db_link, "UPDATE userbbnameinput SET likes=$n-1 WHERE id=$postid");

      echo $n - 1;
      exit();
    }

    ?>

    <div class="container">
      <!--First table-->

      <div class="col">
        <div class='scrollable'>
          <table class='table table-bordered text-center'>

            <thead>
              <th>2016 Baby Names</th>
            </thead>

            <?php
            //$datas = array();
            //while($rows = mysqli_fetch_array($sqldata))
            //{ 
            //   $datas[] = $rows;
            //}
            //print_r($datas);

            //foreach($datas as $data)
            //{
            //    //echo "<tbody> <tr> <td>";
            //    //echo $data['Names'];
            //    //echo"</td> </tr> </tbody>";
            // }
            while ($row = mysqli_fetch_assoc($sqldata)) {
              echo "<tbody> <tr> <td>";
              echo $row['Names'];
              echo "</td> </tr> </tbody>";
            }
            ?>
          </table>
        </div>
      </div>



      <!--  Second table -->

      <div class="col">
        <div class='scrollable'>
          <form method='post' action='BBinsert.php' class='Form'>
            <?php
            $sqlget = "SELECT * FROM users u LEFT JOIN userbbnameinput l ON u.userid = l.id";

            $sqldata = mysqli_query($db_link, $sqlget) or die("error creating");
            ?>

            <table class='table table-bordered text-center'>

              <thead>
                <th>User Input</th>
              </thead>

              <?php
              while ($row = mysqli_fetch_array($sqldata)) {
              ?>
                <tbody>
                  <tr>
                    <td>
                      <?php
                      //prints the users input baby names
                      echo $row['bbname'];

                      // determine if user has already liked this post
                      $likes = $row['likes'];

                      if ($likes == 1) : ?>
                        <!-- user already likes post -->
                        <span class="unlike fa fa-thumbs-down" data-id="<?php echo $row['id']; ?>"></span>

                      <?php else : ?>
                        <!-- user has not yet liked post -->
                        <span class="like fa fa-thumbs-up" data-id="<?php echo $row['id']; ?>"></span>
                      <?php endif ?>

                      <span class="likes_count"><?php echo $row['likes']; ?> likes</span>

                    </td>
                  </tr>
                </tbody>
              <?php
              }
              ?>
            </table>
          </form>
        </div>
      </div>

    </div>


    <form method="post" action="BBinsert.php" class="form2">

      <div class="form-control">
        Select a gender:
        <select name="gender">
          <option value="Boy">Boy</option>
          <option value="Girl">Girl</option>
        </select>
      </div>

      <div class="form-control">
        <input type="text" placeholder="Enter your favorite baby name:" class="form-control-plaintext" name="bbnames" />
      </div>
      <div class="form-control">
        <input type="text" placeholder="Enter your first name:" class="form-control-plaintext" name="firstname" />
      </div>
      <div class="form-control">
        <input type="text" placeholder="Enter your last name:" class="form-control-plaintext" name="lastname" />
      </div>

      <input type="submit" class="btn btn-primary mb-2" name="submit" id="SubBtn" />
    </form>

  </section>


  <!-- Signup-->
  <section class="signup-section" id="signup">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto text-center">
          <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
          <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
           <form method="post" class="myform form-inline d-flex" action="contact_me.php">
            <input  method="post" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="email" name="email"  placeholder="Enter email address..." />
            <button method="post" class="btn btn-primary mx-auto" type="submit">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer-->
  <footer class="footer bg-black small text-center text-white-50">
    <div class="container">Copyright © Myron Zambrano 2020</div>
  </footer>


  <!-- Add Jquery to page -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
 
  <script src="bootstrap-4.2.1/dist/js/bootstrap.min.js"></script>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- subscribe form submit -->
  <script src="js/subscribe.js"></script>
  <!-- for likes -->
  <script src="js/likes.js"></script>
</body>

</html>