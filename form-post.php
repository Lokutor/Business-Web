<?php
    include_once "bd_connection.php";
    //Show a list of name from DB table 
    function getNameDB($result, $table_name){
        if($result->num_rows > 0){
            
            echo "<select class='custom-select mw-100 form-control' required name='".$table_name."'>";
            echo "<option value='' name=''>Select a ${table_name}</option>";
            while($row = $result->fetch_assoc()){
                
                echo "<option value=".$row['id']." >".$row['name']."</option>";
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
                <h1>Business Form</h1>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col mb-3">
                <h2>Insert a new business</h2>
            </div>
            <div class="col mb-3">
                <button type="button" class="btn btn-outline-light float-right mb-3" data-toggle="tooltip" data-placement="top" title="Light Mode" style="float:right">Light</button>
            </div>
        </div>
        
        <!--------------Start Form Store db.php------------->
            <form action="db.php" method="POST" class="form-db responsive">
                <div class="row">
                
                    <div class="col-md-6 col-sm-6">
                        <div class="input-group mb-2">
                            <div class='input-group-prepend w-30'>
                                <span class='input-group-text text-white' style="background:#17d2b8">Store</span>
                            </div>
                            <input type="text" class="form-control col-lg-6 col-md-5 col-6 mw-100" placeholder="Leroy-Merlin" name="store" >  
                            <button type="submit" value="submit" class="btn btn-outline-info col-lg-2 col-md-3 col-12 text-white" name="submit" data-toggle="tooltip" data-placement="top" title="Send Store">Submit</button>    
                        </div>
                    </div>
                    <div class="clearfix col-md-6 col-sm-6 circle" id="circle-store">

                    </div> <!--end .col-->
                </div> <!--end .row-->
            </form>
            <!--------------End Form Store db.php------------->
            <!--------------Start Form Configurator db.php------------->
            <form action="db.php" method="POST" class="form-db responsive">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="input-group mb-2">
                            <div class='input-group-prepend w-30 '>
                                <span class='input-group-text text-white' style="background:#17d2b8">Configurator</span>
                            </div>
                            <input type="text" class="form-control col-lg-6 col-md-5 col-6 mw-100" placeholder="Inferriate" name="configurator">
                            <button type="submit" value="submit" class="btn btn-outline-info col-lg-2 col-md-3 col-12 text-white" name="submit" data-toggle="tooltip" data-placement="top" title="Send Configurator">Submit</button>
                        </div>                
                    </div>
                    <div class="clearfix col-md-6 col-sm-6 circle " id="circle-configurator">
                        
                    </div> <!--end .col-->
                </div> <!--end .row-->
            </form>
            <!--------------End Form Configurator db.php------------->
            <!--------------Start Form City db.php------------->
            <form action="db.php" method="POST" class="form-db responsive">
                <div class="row">
                    <div class="col-md-6 col-sm-6 ">
                        <div class="input-group mb-2">
                            <div class='input-group-prepend w-30 '>
                                <span class='input-group-text text-white' style="background:#17d2b8">City</span>
                            </div>
                            <input type="text" class="form-control col-lg-6 col-md-5 col-6" placeholder="Ancona" name="pos">
                            <button type="submit" value="submit" class="btn btn-outline-info col-lg-2 col-md-3 col-12 text-white" name="submit" data-toggle="tooltip" data-placement="top" title="Send City">Submit</button>
                        </div>
                    </div>
                
                    <div class="clearfix col-md-6 col-sm-6 circle" id="circle-pos">
                        
                    </div> <!--end .col-->
                </div> <!--end .row-->
            </form>
        <!--------------End Form City db.php------------->

        <div class="row">
            <div class="col mb-3">
                <h2>Create or Update an URL business</h2>
            </div>
        </div> <!--end .row-->
        <!--------------Start Form file-post.php------------->
        <form action="file-post.php" method="POST" class="form-inline form-db needs-validation" novalidate>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="input-group mb-3">
                        
                        <div class='input-group-prepend w-30'>
                            <span class='input-group-text text-white' style="background:#17d2b8">Store</span>
                        </div>
                        <?php
                            $sql = "SELECT store.name, store.id ";
                            $sql .= "FROM store";
                            $result = $conn->query($sql);
                            echo getNameDB($result, "store");
                        ?>
                    </div>
                </div> <!--end .col-->
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="input-group mb-3">
                        
                        <div class='input-group-prepend w-30'>
                            <span class='input-group-text text-white' style="background:#17d2b8">Configurator</span>
                        </div>
                        <?php
                            $sql = "SELECT configurator.name, configurator.id ";
                            $sql .= "FROM configurator";
                            $result = $conn->query($sql);
                            echo getNameDB($result, "configurator");
                        ?>
                    </div>
                </div> <!--end .col-->
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="input-group mb-3">
                        
                        <div class='input-group-prepend w-30'>
                            <span class='input-group-text text-white' style="background:#17d2b8">City</span>
                        </div>
                        <?php
                            $sql = "SELECT pos.name, pos.id ";
                            $sql .= "FROM pos";
                            $result = $conn->query($sql);
                            echo getNameDB($result, "pos");
                        ?>
                    </div>
                </div> <!--end .col-->
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <div class="input-group">
                        <span class="input-group-text text-white" id="basic-addon3" style="background:#17d2b8">URL</span>
                        <input type="text" class="form-control mw-100" id="basic-url" aria-describedby="basic-addon3" placeholder="store-configurator-city.php" name="url" required>
                    </div>
                    
                </div> <!--end .col-->
            </div> <!--end .row-->

            <div class="row align-items-center">
                <div class="col-md-4 col-sm-6">
                    <button type="submit" value="submit" class="btn btn-outline-info mt-3 mb-3 text-white" name="submit" data-toggle="tooltip" data-placement="top" title="Send request">Submit</button>  
                </div> <!--end .col-->
            </div> <!--end .row-->
        </form>
        <!--------------End Form file-post.php------------->
    </div> <!--end .container-->
<?php include_once 'footer.php'; ?>
