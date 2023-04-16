<?php include_once("dbconnect.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        form {
            margin: 50px auto;
        }

        .form-row {
            margin-top: 10px;
        }

        fieldset {
            border: 1px solid #ddd !important;
            margin: 0;
            min-width: 0;
            padding: 30px;
            position: relative;
            border-radius: 4px;
            background-color: #fff;
            padding-left: 10px !important;
        }

        legend {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 0px;
            width: 35%;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 5px 5px 10px;
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-8">

                <?php
                if (isset($_POST['submit'])) {

                    $f1 = $_POST['f1'];
                    $f2 = $_POST['f2'];
                    $f3 = $_POST['f3'];
                    $f4 = $_POST['f4'];
                    $f5 = $_POST['f5'];

                    $query = "INSERT INTO tb1 (f1,f2,f3,f4,f5) VALUES ('$f1','$f2','$f3','$f4','$f5')";

                    $result = mysqli_query($conn, $query);
                    $student_id = $conn->insert_id;


                    foreach ($_POST['durchgefuhrte_arbeiten'] as $key => $value) {

                        $query1 = "INSERT INTO tb2(tb1_id,f1,f2,f3,f4)VALUES ('" . $student_id . "','" . $_POST['durchgefuhrte_arbeiten'][$key] . "','" . $_POST['von'][$key] . "','" . $_POST['bis'][$key] . "','" . $_POST['std'][$key] . "')";
                        mysqli_query($conn, $query1);
                    }


                    foreach ($_POST['mange'] as $key => $value) {

                        $query2 = "INSERT INTO tb3(tb1_id,f1,f2,f3)VALUES ('" . $student_id . "','" . $_POST['mange'][$key] . "','" . $_POST['bezeichnung'][$key] . "','" . $_POST['art_nr'][$key] . "')";
                        mysqli_query($conn, $query2);
                    }

                    foreach ($_POST['offene_pukte'] as $key => $value) {

                        $query3 = "INSERT INTO tb4(tb1_id,f1,f2)VALUES ('" . $student_id . "','" . $_POST['offene_pukte'][$key] . "','" . $_POST['intern'][$key] . "')";
                        mysqli_query($conn, $query3);
                    }
                }
                ?>


                <form action="" method="post" enctype="">

                    <fieldset>
                        <legend>ITC Form</legend>


                        <div class="form-row">

                            <div class="col">
                                <textarea class="form-control" name="f1" placeholder="Anschnh Kunde" rows="4"></textarea>
                            </div>

                            <div class="col"></div>

                            <div class="col">
                                <h2>ITC THIEL</h2>
                                <p>Weinsbergstr. 190 50825 Koln</p>
                                <p style="margin-top: -16px;">Tel: 0221 3795178</p>
                            </div>



                        </div><br><br>

                        <div class="form-row">
                            <div class="col">
                                <h4>Arbeitsprotokoll</h4>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="f3" placeholder="VOM">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="f4" placeholder="Die Arbeifen">
                            </div>
                        </div><br>

                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" name="f2">
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="f5" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Ja
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="f5" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Nein
                                    </label>
                                </div>
                            </div>
                        </div><br><br>



                        <div id="dynamic_field">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" name="durchgefuhrte_arbeiten[]" placeholder="Durchgefuhrte Arbeiten">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="von[]" placeholder="VON">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="bis[]" placeholder="BIS">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="std[]" placeholder="std">
                                </div>

                                <div class="col">
                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div>


                        <br>
                        <h5>Material:</h5>
                        <div id="dynamic_field2">
                            <div class="form-row">

                                <div class="col">
                                    <input type="text" class="form-control" name="mange[]" placeholder="mange">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="bezeichnung[]" placeholder="bezeichnung">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="art_nr[]" placeholder="art. nr">
                                </div>


                                <div class="col">
                                    <td><button type="button" name="add" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div>




                        <br>
                        <h5>Offene:</h5>
                        <div id="dynamic_field3">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" name="offene_pukte[]" placeholder="Offene punkte">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="intern[]" placeholder="Intern">
                                </div>

                                <div class="col">
                                    <td><button type="button" name="add" id="add3" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row"><br>
                            <div class="col">
                                <button type="submit" id='submit' name="submit" class="btn btn-primary " value="Save">Save the form data</button>
                            </div>
                        </div>
                        <br>
                </form>
                </fieldset>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div class="form-row" id="row' + i + '"> <div class="col"><input type="text" class="form-control" name="durchgefuhrte_arbeiten[]"> </div> <div class="col"> <input type="text" class="form-control" name="von[]"> </div> <div class="col"> <input type="text" class="form-control" name="bis[]"> </div> <div class="col"> <input type="text" class="form-control" name="std[]"> </div> <div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");

                $('#row' + button_id + '').remove();
            });



            $('#add2').click(function() {
                i++;
                $('#dynamic_field2').append('<div class="form-row"  id="row2' + i + '"> <div class="col"> <input type="text" class="form-control" name="mange[]"> </div> <div class="col"> <input type="text" class="form-control"  name="bezeichnung[]"> </div> <div class="col"> <input type="text" class="form-control" name="art_nr[]"> </div> <div class="col"> <td><button type="button" name="add" class="btn btn-danger btn_remove2" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
            });
            $(document).on('click', '.btn_remove2', function() {
                var button_id = $(this).attr("id");

                $('#row2' + button_id + '').remove();
            });


            $('#add3').click(function() {
                i++;
                $('#dynamic_field3').append('<div class="form-row" id="row3' + i + '"> <div class="col"> <input type="text" class="form-control"  name="offene_pukte[]"> </div> <div class="col"> <input type="text" class="form-control" name="intern[]"> </div> <div class="col"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa fa-trash"></i></button></td> </div> </div>');
            });
            $(document).on('click', '.btn_remove3', function() {
                var button_id = $(this).attr("id");

                $('#row3' + button_id + '').remove();
            });



        });
    </script>

</body>

</html>