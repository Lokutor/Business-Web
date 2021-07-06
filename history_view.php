<?php
    include_once "bd_connection.php";
    //Show a list of name from DB table 
    function getNameDB($result, $table_name){
        if($result->num_rows > 0){
            
            echo "<select class='custom-select col-lg-7 col-12 mw-100 form-control' name='".$table_name."'>";
            echo "<option value='' name=''></option>";
            while($row = $result->fetch_assoc()){
                
                echo "<option value=".$row['id']." class=''>".$row['name']."</option>";
            }
            echo "</select>";
            
        }
        else{
            echo "";
        }
    }
?>


<?php include_once 'header.php';?>
    
    <div class="container mt-3">
        <div class="row">
            <div class="col mb-3 text-center">
                <h1>History View</h1>
            </div>
        </div> <!--end .row-->
        <!----------Start Form history_db.php------------>
        <form action="history_db.php" method="POST" class="form-inline form-db responsive needs-validation" novalidate>
            <div class="row clearfix">
                <div class="col mb-3">
                    <h2>Select a Date and Fields range</h2>
                </div>
                <!--Buttons-->
                <div class="col-md-4 col-sm-6 col-6">
                    <button type="button" class="btn btn-outline-light mb-3" data-toggle="tooltip" data-placement="top" title="Light Mode">Light</button>
                    <button type="submit" value="submit" class="btn btn-outline-info btn-submit text-white float-right mb-3" name="submit" data-toggle="tooltip" data-placement="top" title="Start Search">Submit</button>  
                </div>
                
            </div> <!--end .row-->

            <div class="row">
                <!--Store Field-->
                <div class="col-md-4 col-sm-6">
                    <div class="input-group mb-3">
                        <div class='input-group-prepend w-30 col-lg-5 col-12'>
                            <span class="input-group-text text-white ">Store</span>
                            <!--<label class='input-group-text text-white w-100'>Store</label>-->
                        </div>
                        <?php
                            $sql = "SELECT store.name, store.id ";
                            $sql .= "FROM store";
                            $result = $conn->query($sql);
                            echo getNameDB($result, "store");
                        ?>
                    </div>
                </div> 
                <!--Configurator Field-->
                <div class="col-md-4 col-sm-6">
                    <div class="input-group mb-3">
                        <div class='input-group-prepend w-30 col-lg-5 col-12'>
                            <span class="input-group-text text-white">Configurator</span>
                        </div>
                        <?php
                            $sql = "SELECT configurator.name, configurator.id ";
                            $sql .= "FROM configurator";
                            $result = $conn->query($sql);
                            echo getNameDB($result, "configurator");
                        ?>
                    </div>
                </div>
                <!--City Field-->
                <div class="col-md-4 col-sm-6">
                    <div class="input-group mb-3">
                        <div class='input-group-prepend w-30 col-lg-5 col-12'>
                            <span class="input-group-text text-white">City</span>
                        </div>
                        <?php
                            $sql = "SELECT pos.name, pos.id ";
                            $sql .= "FROM pos";
                            $result = $conn->query($sql);
                            echo getNameDB($result, "pos");
                        ?>
                    </div>
                </div>
            </div> <!--end .row-->

            <div class="row">
                <!--First Date-->
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="input-group mb-3">
                        <div class='input-group-prepend w-30 col-lg-5 col-md-5 col-12'>
                            <span class="input-group-text  text-white">First Date</span>
                        </div>
                        <input type="date" name="firstDate" class="border-0 col-lg-7 col-md-7 col-12 mw-100 form-control" required>
                    </div>
                </div>
                <!--Last Date-->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="input-group mb-3">
                        <div class='input-group-prepend w-30 col-lg-5 col-md-5 col-12'>
                            <span class="input-group-text  text-white">Last Date</span>
                        </div>
                        <input type="date" name="lastDate" class="border-0 col-lg-7 col-md-7 col-12 mw-100 form-control" required>
                    </div>
                </div>
            </div> <!--end .row-->
        </form>
        <!----------End Form history_db.php------------>

        <!--Table to view history's company-->
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Store</th>
                        <th scope="col">Configurator</th>
                        <th scope="col">City</th>
                    </tr>
                </thead>
        
                <tbody class="history-body">
                    <!--Result inserted with js-->
                    
                </tbody>
                
            </table>
        </div>
        <!--Loading animation-->
        <div class="loader invisible">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>
    </div>
    
<?php include_once 'footer.php'; ?>