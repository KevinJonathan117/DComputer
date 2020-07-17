<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinadmin"]) || $_SESSION["loggedinadmin"] !== true){
    header("location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>DCOMPUTER | Admin Menu</title>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DCOMPUTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="index_admin.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="admin.php">Menu</a> <span class="sr-only">(current)</span> </a>
        </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="biodata_admin.php" class="dropdown-item">Biodata</a>
                        <a href="logout_admin.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </li>
           
        </ul>
    </div>
    </nav>

    <br><br>
    <div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <select id='NamaKategori' name='nama_kategori'>
                    <option id="0">All Product</option>
                </select>
                &nbsp; 
                <input type="text" class="form-control" placeholder="Cari.." aria-label="Search" id="mySearch" style="width:70%;">
            </div>
            <div class="col-md-4">
                <button type='button' class='btn btn-primary Add'><i class='fa fa-plus'></i>Add Product</button>
                <button type='button' class='btn btn-primary AddKategori'><i class='fa fa-plus'></i>Add Kategori</button>
                <button type='button' class='btn btn-danger DeleteKategori'><i class='fa fa-trash'></i>Delete Kategori</button>
            </div>
        </div>
        <br><br>
        <div class="row produk">
        </div>  
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .Add,.Delete,.Edit{
            margin-left:3%;
        }
        .kategori, #mySearch{
            display:inline-block;
            vertical-align:middle;
        }
    </style>
    <script type="text/javascript">
        var status = 0;
        var name=""; 
        var idForEdit="";
        function getData(){
            $.ajax({
                url: 'get_id.php',
                type: 'GET',
                dataType: 'json',
                success: function(result){
                    $("#NamaKategori").html("<option id='0' selected='selected'>All Product</option>");
                    for (var prop in result){
                        idkategori = result[prop].id_kategori;
                        var data = result[prop].nama_kategori;
                        $("#NamaKategori").append("<option id='" + idkategori + "'>" + data + "</option>");
                    }
                },
                error:function(xhr, textStatus, errorThrown){
                    alert("ERROR");
                }
            })
        }

        function getData1(){
            $.ajax({
                url: 'get_id.php',
                type: 'GET',
                dataType: 'json',
                success: function(result){
                    for (var prop in result){
                        idkategori = result[prop].id_kategori;
                        var data = result[prop].nama_kategori;
                        $("#NamaKategori1").append("<option id='" + idkategori + "'>" + data + "</option>");
                    }
                },
                error:function(xhr, textStatus, errorThrown){
                    alert("ERROR");
                }
            })
        }

        function getData2(id){
            $.ajax({
                url: 'get_kategori.php',
                type: 'GET',
                data: {
                    id:id
                },
                dataType: 'json',
                success: function(result){
                    for (var prop in result){
                        idkategori = result[prop].id_kategori;
                        var data = result[prop].nama_kategori;
                        $("#NamaKategori1").append("<option id='" + idkategori + "'>" + data + "</option>");
                    }          
                },
                error:function(result){
                    console.log(result);
                    alert("ERROR");
                }
            })
        }

        function addKategori(){
            var str = "<div class='col-md-12'>";
            str += "<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>";
            str += "<h2>Add Kategori</h2>";
            str += "<label for='nama'>Nama Kategori</label>";  //nama
            str += "<input type='text' class='form-control' id='nama' name='nama'><br>";
            str += "<button class='btn btn-primary' type='submit' id='tambahKategori'>Submit</button>";
            str += "</form></div>";
            $(".produk").html(str);
        }
        
        function AddForm(){
            var str = "<div class='col-md-12'>";
            str += "<form id='form2' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' enctype='multipart/form-data'>";
            str += "<h2>Add New Produk</h2>";
            str += "<label for='nama'>Nama</label>";  //nama
            str += "<input type='text' class='form-control' id='nama' name='nama'><br>";
            str += "<label for='merek'>Merek</label>"; //merek
            str += "<input type='text' class='form-control' id='merek' name='merek'><br>";
            str += "<label for='harga'>Harga</label>";  //harga
            str += "<input type='number' class='form-control' id='harga' name='harga' min='0'><br>";
            str += "<label for='stock'>Stock</label>";  //stock
            str += "<input type='number' class='form-control' id='stock' name='stock' min='0' max='1000'><br>";
            str += "<label for='foto'>Foto</label><br>";  //foto1
            str += "<input type='file' name='profilepic0' id='foto0'><br>";
            str += "<label for='foto2'>Foto</label><br>";  //foto2
            str += "<input type='file' name='profilepic1' id='foto1'><br>";
            str += "<label for='foto3'>Foto</label><br>";  //foto3
            str += "<input type='file' name='profilepic2' id='foto2'><br>";
            str += "<br><label for='deskripsi'>Deskripsi</label>";  //Deskripsi
            str += "<textarea class='form-control' id='deskripsi' rows='3' name='deskripsi'></textarea><br><br>";
            str += "<label for='kategori'>Kategori</label><br>"; //kategori
            str += "<select id='NamaKategori1' name='nama_kategori'></select><br><br>";
            str += "<button class='btn btn-primary' type='submit' id='tambah'>Submit</button>";
            str += "</form></div>";
            $(".produk").html(str);
        }

        function EditForm(){
            var str = "<div class='col-md-12'>";
            str += "<form id='form1' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' enctype='multipart/form-data'>";
            str += "<h2>Edit Produk</h2>";
            str += "<input type='hidden' name='hid' id='hid'>";
            str += "<label for='nama'>Nama</label>";  //nama
            str += "<input type='text' class='form-control' id='nama' name='nama'><br>";
            str += "<label for='merek'>Merek</label>"; //merek
            str += "<input type='text' class='form-control' id='merek' name='merek'><br>";
            str += "<label for='harga'>Harga</label>";  //harga
            str += "<input type='number' class='form-control' id='harga' name='harga' min='0'><br>";
            str += "<label for='stock'>Stock</label>";  //stock
            str += "<input type='number' class='form-control' id='stock' name='stock' min='0' max='1000'><br>";
            str += "<label for='foto'>Foto</label><br>";  //foto
            str += "<input type='file' name='profilepic0' id='foto0'><br>";
            str += "<img src='#' id='picture0' alt='Card image' style='width:200px;height:200px;'>";
            str += "<br><label for='foto2'>Foto</label><br>";  //foto2
            str += "<input type='file' name='profilepic1' id='foto1'><br>";
            str += "<img src='#' id='picture1' alt='Card image' style='width:200px;height:200px;'>";
            str += "<br><label for='foto3'>Foto</label><br>";  //foto3
            str += "<input type='file' name='profilepic2' id='foto2'><br>";
            str += "<img src='#' id='picture2' alt='Card image' style='width:200px;height:200px;'>";
            str += "<br><label for='deskripsi'>Deskripsi</label>";  //Deskripsi
            str += "<textarea class='form-control' id='deskripsi' rows='3' name='deskripsi'></textarea><br><br>";
            str += "<label for='kategori'>Kategori</label><br>"; //kategori
            str += "<select id='NamaKategori1' name='nama_kategori'></select><br><br>";
            str += "<button class='btn btn-primary' type='submit' id='ganti'>OK</button>";
            str += "</form></div>";
            $(".produk").html(str);
        }

        function getCardInfo(search){
            if(ajaxcall != null) {
                ajaxcall.abort(); 
            }
            ajaxcall = $.ajax({
                url: "search_produk.php",
                type: "get",
                data: {
                    n:search
                },
                dataType: "json",
                success:function(result) {
                    console.log(result);
                    data = result;
                    var source = "upload/" + data[0].gambar0;
                    var source1 = "upload/" + data[0].gambar1;
                    var source2 = "upload/" + data[0].gambar2;
                    EditForm();
                    $("#nama").val(data[0].nama);
                    $("#merek").val(data[0].merek);
                    $("#harga").val(data[0].harga);
                    $("#stock").val(data[0].stock);
                    $("#deskripsi").html(data[0].deskripsi);
                    $("#picture0").attr("src", source);
                    $("#picture1").attr("src", source1);
                    $("#picture2").attr("src", source2);
                    $("#hid").val(data[0].id_produk);
                    //alert(data[0].id_produk);
                    getData2(data[0].id_kategori);
                    $("form#form1").submit(function(event){
                            event.preventDefault();
                            $.ajax({
                                url: 'edit_produk.php',
                                type: 'POST',
                                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                contentType: false,       // The content type used when sending data to the server.
                                cache: false,             // To unable request pages to be cached
                                processData:false,        // To send DOMDocument or non processed data file it is set to false
                                success: function(data)   // A function to be called if request succeeds
                                {
                                    //console.log(data);
                                    RefreshData("");
                                }
                            })
                        });
                },
                error: function(result) {
                    alert("edit ERROR");
                }
            })
        }

        function DeleteCard(search){
            $.ajax({
                url: "delete_produk.php",
                type: "POST",
                data:{
                    name:name
                },
                success: function(result){
                    RefreshData("")
                }  
            })
        }

        var ajaxcall;
        function RefreshData(search){
            var nama = $("#NamaKategori").val();
            //alert(nama);
            if(ajaxcall != null) {
                ajaxcall.abort(); //menghapus ajax call supaya tidak potensi kedouble-an -> memastikan panggil ajax 1x
            }
            ajaxcall = $.ajax({
                url: "search_foredit.php",
                type: "get",
                data: {
                    n:search,
                    nama:nama
                },
                dataType: "json",
                success:function(result) {
                    var data = result;
                    var hasil = $(".produk");
                    hasil.html("");
                    //card
                    for (var i = 0;i<data.length;i++){
                        var source = "upload/" + data[i].gambar0; 
                        var idtitle = "title" + i;
                        var idEdit = "Edit" + i;
                        var idDelete = "Delete" + i;
                        var str = "<div class='col-lg-3'>";
                        if (i < 4 == 0 && i != 0){
                            str += "<br>";
                        }
                        str += "<div class='card'>";
                        str += "<img class='card-img-top' src='"+source+"'id='picture' alt='Card image' style='width:100%;height:15rem; object-fit: cover;'>";
                        str += "<div class='card-body'>";
                        str += "<h4 class='card-title text-primary' id='"+idtitle+"'>" + data[i].nama + "</h4>";
                        str += "<h5>" + data[i].harga + "</h5>";
                        str += "</div>";
                        str += "<div class='card-footer'>";
                        str += "<button type='button' class='btn btn-warning' id='"+idEdit+"'><i class='fa fa-pen'></i>Edit</button>&nbsp;";
                        str += "<button type='button' class='btn btn-danger' id='"+idDelete+"'><i class='fa fa-trash'></i>Delete</button>";
                        str += "</div></div></div>";
                        hasil.append(str);
                    }
                    $(".btn-warning").click(function() {
                        name = $(this).parent().parent().children(".card-body").children(".card-title").text();
                        getCardInfo(name);
                    });
                    $(".btn-danger").click(function() {
                        name = $(this).parent().parent().children(".card-body").children(".card-title").text();
                        DeleteCard(name);
                    });
                },
                error: function(result) {
                    console.log(result);
                }
            })
        }

        var timer;
        var div = $(".produk");
        window.onload = function() {
        RefreshData("");
        getData();
        var s = $("input[id=mySearch]");
        s.on("input", function() { //ketika isi search berubah
            clearTimeout(timer);
            timer = setTimeout(function(){
                RefreshData(s.val());
            }, 500); //500ms kemudian baru functionnya di panggil
        });
        
        $("#NamaKategori").change(function(){
            var nama = $(this).val();
            RefreshData(s.val());
        });

        var add = $(".Add");
        add.click(function(){
            div.html("");
            AddForm();
            getData1();
            if (ajaxcall != null){
                ajaxcall.abort();
            }
            $("form#form2").submit(function(event){
            event.preventDefault();
            ajaxcall = $.ajax({
                url: 'add_produk.php',
                type: 'POST',
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: function(data)   // A function to be called if request succeeds
                {
                    RefreshData("");
                }
            })
            });
        });

        var addKat = $(".AddKategori");
        addKat.click(function(){
            div.html("");
            addKategori();
            $("#tambahKategori").click(function(){
                var nama = $("#nama").val();
                $.ajax({
                    url: 'add_kategori.php',
                    type: 'POST',
                    data: {
                        nama:nama
                    },        
                    success: function(data)   
                    {
                        RefreshData("");
                    }
                })
            });
        });

        var delKat = $(".DeleteKategori");
        delKat.click(function(){
            var nama = $("#NamaKategori").val();
			if(nama != "All Product") {
				$.ajax({
					url: 'delete_kategori.php',
					type: 'POST',
					data: {
						nama:nama
					},
					success: function(data)   
					{
						console.log(data);
                        getData();
                        RefreshData("");
					}
				})
			}
        });

        }
    </script>
    </body>
</html>