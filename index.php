
<html>
<head>
<title>Table</title>
<!--Bootstrap CSS -->
    <link rel = "stylesheet" href="bootstrap-4.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="StyleSheet.css" />
</head>

<body>

  <header>           
        <h1> Babynames </h1>        
  </header>

 <section>    
          
        <?php     
            include 'db_connect.php';

            $sqlget ="SELECT DISTINCT a.Names
                      FROM BABYNAMES a
                      LIMIT 20";
            $sqldata = mysqli_query($db_link,$sqlget) or die ("error creating");
            //$row = mysqli_fetch_array($sqldata);
             //print_r($sqldata);
         ?>

    
    
       <div class="container"> 
         <!--First table-->
             
            <div class="col">          
            <div class = 'scrollable'>
            <table class = 'table table-bordered text-center'>

            <thead><th>2016 Baby Names</th></thead>

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
                while($row = mysqli_fetch_assoc($sqldata))
                { 
                    echo "<tbody> <tr> <td>";
                    echo $row['Names'];
                    echo"</td> </tr> </tbody>";
                }
                ?>
                </table>
            </div></div>
        

        
       <!--  Second table -->
                  
           <div class="col">         
           <div class = 'scrollable'>
           <form method='post' action='BBinsert.php' class='Form'>
        <?php
            $sqlget = "SELECT DISTINCT a.name
                       FROM UserBBnames a";

            $sqldata = mysqli_query($db_link,$sqlget) or die ("error creating");
        ?>

            <table class = 'table table-bordered text-center'>

            <thead><th>User Input</th></thead>

            <?php
            while($row = mysqli_fetch_array($sqldata))
            {
            ?>
                <tbody> <tr> <td>
                <?php echo $row['name']; ?>
                </td> </tr> </tbody>
            <?php
            }
            ?>
           </table>    
           </form> 
           </div></div>

     </div>    
    </section>
  


        <form method="post" action="BBinsert.php" class="form2">

          <div class="form-control"> 
            Select a gender:
            <select name="gender">
                <option value="Boy">Boy</option>
                <option value="Girl">Girl</option>
            </select>
          </div>

          <div class="form-control"> 
            <input type="text" placeholder="Enter your favorite baby name:" class="form-control-plaintext" name="bbnames"/>    
          </div>  
            <input type="submit" class="btn btn-primary mb-2" name="submit"/> 
        </form>
   

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.2.1/dist/js/bootstrap.min.js"></script>

</body>

</html>