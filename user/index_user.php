<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinuser"]) || $_SESSION["loggedinuser"] !== true){
    header("location: login_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>DCOMPUTER | Home</title>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DCOMPUTER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="index_user.php">Home <span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="histori_transaksi.php">Transaksi</a>
        </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="biodata_user.php" class="dropdown-item">Biodata</a>
                        <a href="logout_user.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
            <div class="col-lg-8">
                <select id='NamaKategori' name='nama_kategori'>
                    <option id="0">All Product</option>
                </select>
                &nbsp; &nbsp; &nbsp;
                <input type="text" class="form-control" placeholder="Cari.." aria-label="Search" id="mySearch" style="width:70%;display:inline-block;">
                <br><br>
                <div class="row produk">
                </div>  
                <div class="row deskripsi">
                </div>  
            </div>
            <div class="col-lg-4">
            <h1>Keranjang Anda</h1>
            <h4></h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
							<th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cartContainer">

                    </tbody>
                    <thead class="table-info">
                        <tr>
                            <th>Total Pembayaran:</th>
                            <th></th>
                            <th>Rp. <span id="totalPembayaran">0</span></th>
							<th><button class="btn btn-success" data-toggle="modal" data-target="#doTransaksi"><i class="fas fa-shopping-cart"></i></button>&nbsp;<button class="btn btn-danger" onclick="deleteCart('All');"><i class="fas fa-trash"></i></button></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
<div class="modal fade" id="editCart">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="cartName"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Qty: <input type="number" class="form-control" id="formQty" min="0" max="1000">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" id="buttonEdit" data-dismiss="modal" onclick="editCart(this.value);">Edit</button>
      </div>
    </div>
  </div>
</div>   

<div class="modal fade" id="doTransaksi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="transaksiName">Confirm Transaksi</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Tekan tombol Buy jika anda sudah yakin dengan pembelian anda.</p>
        <div id="caraTransaksi">
            <strong>Pilih Cara Transaksi:</strong>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio1" id="cash">Cash
                </label><br>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio1" id="ovo">OVO
                </label>
            </div>
        </div><br>
        <div id="caraPengiriman">
            <strong>Pilih Cara Pengiriman:</strong>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio2" id="jne">JNE
                </label><br>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio2" id="tiki">TIKI
                </label><br>
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optradio2" id="jt">J&T Express
                </label>
            </div>
        </div>
        <br>
        <div id="alamat">
            <strong>Alamat pengiriman:</strong>
            <input type="text" class="form-control" id="alamatForm" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" id="buttonBuy" onclick="generateTransaksi();" data-dismiss="modal">Buy</button>
      </div>
    </div>
  </div>
</div>   

    <!-- yang belum dilakukan
    1. add produk kalau sama akan nambah stock
    2. edit produk kategori belum bisa ambil dari database
    3. gambar nya masih ada 1 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
        var status = 0;
        var isiCart = 0;
        var name=""; 
        var idForEdit="";

        function ShowProduk(){
            $(".produk").html("");
            $(".deskripsi").html("");
            var str = "<div class='col-md-6'>";
            str += "<div id='slides' class='carousel slide' data-ride='carousel'>";
            str += "<ul class='carousel-indicators'>";
            str += "<li data-target='#slides' data-slide-to='0' class='active'></li>";
            str += "<li data-target='#slides' data-slide-to='1'></li>";
            str += "<li data-target='#slides' data-slide-to='2'></li></ul>";
            str += "<div class='carousel-inner'>";
            str += "<div class='carousel-item active'>";
            str += "<img src='#' id='picture0' style='width:100%;height:25rem; object-fit: cover;'></div>";
            str += "<div class='carousel-item'>";
            str += "<img src='#' id='picture1' style='width:100%;height:25rem; object-fit: cover;'></div>";
            str += "<div class='carousel-item'>";
            str += "<img src='#' id='picture2' style='width:100%;height:25rem; object-fit: cover;'></div></div>";
            str += "<a class='carousel-control-prev' href='#slides' data-slide='prev'><span class='carousel-control-prev-icon'></span></a>"
            str += "<a class='carousel-control-next' href='#slides' data-slide='next'><span class='carousel-control-next-icon'></span></a></div>"
            $(".produk").html(str);
            var str1 = "<div class='col-md-6'>";
            str1 += "<form id='form1' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>";
            str1 += "<br><h4 id='nama'></h4><br>";
            str1 += "<div style='padding:10px;'><h3 id='harga'></h3></div><br><br>";
            str1 += "<label for='kuantitas'>kuantitas</label>";
            str1 += "<input id='kuantitas' type='number' min='1' max='1000' value='1' name='kuantitas' style='margin-left:50px; width:30%;'><br><br><br>";
            str1 += "<button type='button' class='btn btn-primary' id='Submit'><i class='fas fa-cart-plus'></i>&nbsp;Masukkan Keranjang</button></div>";
            $(".produk").append(str1);
            var desc = "<div class='container-fluid'>";
            desc += "<div class='col'>";
            desc += "<form><br><br><h4>Spesifikasi Produk</h4>";
            // desc += "<label for='kategori'>Kategori</label>";
            // desc += "<p id='kategori'></p>";
            desc += "<div class='row'>";
            desc += "<div class='col-md-2'>";
            desc += "<h6 style='color:grey;'>Merek</h6><br>";
            desc += "<h6 style='color:grey;'>Stock</h6><br>";
            desc += "<h6 style='color:grey;'>Deskripsi</h6><br>";
            desc += "<h6 id='deskripsi'></h6></div>";
            desc += "<div class='col-md-10'>";
            desc += "<h6 id='merek'></h6><br>";
            desc += "<h6 id='stock'></h6><br></div>";
            desc += "</div></form></div></div>";
            $(".deskripsi").html(desc);
        }

        function editCart(id) {
            var qty = $("#formQty").val();
            $.ajax({
                url: "edit_cart.php",
                type: "POST",
                data: {
                    id:id,
                    qty:qty
                },
                success:function(data) {
                    console.log(data);
                    getCart();
                },
                error:function(data) {
                    console.log(data);
                    alert("show ERROR");
                }
            });
        }
		
		function deleteCart(id) {
			$.ajax({
                url: "delete_cart.php",
                type: "get",
                data: {
                    id:id
                }, 
                success:function(data) {
                    console.log(data);
                    getCart();
                },
                error: function(data) {
                    console.log(data);
                    alert("show ERROR");
                }
            });
		}

        var ajaxcall2;
        function getCart(){
            if(ajaxcall2 != null) {
                ajaxcall2.abort(); //menghapus ajax call supaya tidak potensi kedouble-an -> memastikan panggil ajax 1x
            }
            ajaxcall2 = $.ajax({
                url: "show_cart.php",
                type: "get",
                dataType: "json",
                success:function(data) {
                    var total = 0;
                    isiCart = 0;
                    var dataShow = $("#cartContainer");
                    dataShow.html("");
                    for (var i = 0;i<data.length;i++){
                    dataShow.append("<tr>" +
                    "<td>" + data[i].nama + "</td>" +
                    "<td>" + data[i].jumlah + "</td>" +
                    "<td>Rp. " + data[i].cart_harga + "</td>" +
					"<td><button class='btn btn-warning' data-toggle='modal' data-target='#editCart' onclick=\"showmodal('" + data[i].nama + "', " + data[i].id_produk + ", " + data[i].jumlah + ");\"><i class='fas fa-edit'></i></button>&nbsp;<button class='btn btn-danger' onclick='deleteCart(" + data[i].id_produk + ");'><i class='fas fa-trash'></i></button></td>" +
                    "</tr>");
                    total += parseInt(data[i].cart_harga);
                    isiCart++;
                    }
                    $("#totalPembayaran").html(total);
                },
                error: function(data) {
                    console.log(data);
                    alert("show ERROR");
                }
            });
        }

        function showmodal(nama, id, qty) {
            $("#cartName").html(nama);
            $("#formQty").val(qty);
            $("#buttonEdit").val(id);
        }

        function generateTransaksi() {
            var counterMetode = 0;
            if (document.getElementById('cash').checked || document.getElementById('ovo').checked) {
                counterMetode++;
            }
            if (document.getElementById('jne').checked || document.getElementById('tiki').checked || document.getElementById('jt').checked) {
                counterMetode++;
            }
            var alamat = $("#alamatForm").val();
            if(alamat != "") {
                counterMetode++;
            }
            if(isiCart == 0 || counterMetode < 3) {
                alert("Tidak ada item yang dipilih / Belum memilih metode pengiriman / Belum memilih metode pembayaran");
            }
            else {
                $.ajax({
                    url: "add_transaksi.php",
                    type: "get",
                    success:function(data) {
                        getCart();
                        RefreshData("");
                    },
                    error: function(data) {
                        console.log(data);
                        alert("show ERROR");
                    }
                });
            }
        }

        function getInfoProduk(search){
            if(ajaxcall != null) {
                ajaxcall.abort(); 
            }
            ajaxcall = $.ajax({
                url: "search_item.php",
                type: "get",
                data: {
                    n:search
                },
                dataType: "json",
                success:function(result) {
                    console.log(result);
                    data = result;
                    var source = "../admin/upload/" + data[0].gambar0;
                    var source1 = "../admin/upload/" + data[0].gambar1;
                    var source2 = "../admin/upload/" + data[0].gambar2;
                    ShowProduk();
                    $("#nama").text(data[0].nama);
                    $("#merek").text(data[0].merek);
                    $("#harga").text("Rp" + data[0].harga);
                    $("#stock").text(data[0].stock);
                    $("#deskripsi").text(data[0].deskripsi);
                    $("#picture0").attr("src", source);
                    $("#picture1").attr("src", source1);
                    $("#picture2").attr("src", source2);
                    $("#Submit").click(function(){
                        var kuantitas = $("#kuantitas").val();
                        var cart_harga = data[0].harga * kuantitas;
                        var status_cart = 0;
                        var id_produk = data[0].id_produk;
                        var stock = data[0].stock;
                            $.ajax({
                            url: 'add_cart.php',
                            type: 'POST',
                            data: {
                                cart_harga:cart_harga, 
                                status_cart:status_cart, 
                                id_produk:id_produk, 
                                kuantitas:kuantitas,
                                stock:stock
                            },        
                            success: function(data)   
                            {
                                console.log(data);
                                getCart();
                            }
                            });
                    });
                },
                error: function(result) {
                    //alert("edit ERROR");
                }
            })
        }

        function getData(){
            $.ajax({
                url: 'get_kategori.php',
                type: 'GET',
                dataType: 'json',
                success: function(result){
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

        var ajaxcall;
        function RefreshData(search){
            var nama = $("#NamaKategori").val();
            //alert(nama);
            if(ajaxcall != null) {
                ajaxcall.abort(); //menghapus ajax call supaya tidak potensi kedouble-an -> memastikan panggil ajax 1x
            }
            ajaxcall = $.ajax({
                url: "search_produk.php",
                type: "get",
                data: {
                    n:search,
                    nama:nama
                },
                dataType: "json",
                success:function(result) {
                    $(".deskripsi").html("");
                    var data = result;
                    var hasil = $(".produk");
                    hasil.html("");
                    var idtitle = "title" + i;
                    //card
                    for (var i = 0;i<data.length;i++){
                        var source = "../admin/upload/" + data[i].gambar0; 
                        //alert(source);
                        var idtitle = "title" + i;
                        var str = "<div class='col-md-3'>";
                        if (i < 4 == 0 && i != 0){
                            str += "<br>";
                        }
                        str += "<div class='card'>";
                        str += "<img class='card-img-top' src='"+source+"'id='picture' alt='Card image' style='width:100%;height:12.5rem; object-fit: cover;'>";
                        str += "<div class='card-body'>";
                        str += "<h4 class='card-title text-primary' id='"+idtitle+"'><a href='#' id='getNama'>" + data[i].nama + "</a></h4>";
                        str += "<h5>" + data[i].harga + "</h5>";
                        str += "</div>";
                        str += "</div></div>";
                        hasil.append(str);
                    }
                    $(".produk").on("click", "#getNama", function(){
                        name = $(this).text();
                        getInfoProduk(name);
                    });
                },
                error: function(result) {
                    console.log(result);
                    alert("show ERROR");
                }
            })
        }

        var timer;
        var div = $(".produk");
        window.onload = function() {
            RefreshData("");
            getData();
            getCart();
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
        }
    </script>
    </body>
</html>