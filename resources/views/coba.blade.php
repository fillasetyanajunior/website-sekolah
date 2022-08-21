<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="">
    <style>
        body {
    background: url("bg.png");
    font-size: 14px;
    font-family: "Verdana", sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    width: 730px;
    margin: 0 auto;
}

#header {
    margin-top: 50px;
    margin-bottom: 10px;
}

#header:after,
#header:before {
    display: table;
    content: "";
}

#header:after {
    clear: both;
}

#header img {
    float: left;
}

#header h1 {
    color: #fff;
    text-shadow: 1px 1px 0px #333, 2px 2px 0px #666;
}

#header p {
    font-weight: 900;
    color: #ddd;
}

.form-container {
    background: #fbfbfb;
    padding: 20px;
    border: 1px solid #aaa;
    position: relative;
    box-shadow: 0 0 3px rgba(0, 0, 0, .2);
    border-radius: 3px;
    margin-bottom: 30px;
}

.form-container:after,
.form-container:before {
    background: #fbfbfb;
    border: 1px solid #aaa;
    bottom: -8px;
    content: '';
    height: 100%;
    left: 4px;
    position: absolute;
    width: 100%;
    z-index: -10;
    box-shadow: 0 0 3px rgba(0, 0, 0, .2);
    border-radius: 3px;
}

.form-container:before {
    bottom: -14px;
    left: 8px;
    width: 100%;
    border-radius: 3px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
}

fieldset {
    border: 3px solid #bbb;
    border-radius: 3px;
    margin-bottom: 30px;
}

legend {
    padding-right: 20px;
    padding-left: 20px;
    font-weight: 900;
    color: #bbb;
    /* text-shadow: 1px 1px 0 #fff; */
    margin-bottom: 20px;
}

.form-grup {
    margin-bottom: 20px;
    margin-right: 20px;
}

.form-grup:after,
.form-group:before {
    display: table;
    content: "";
}

.form-grup:after {
    clear: both;
}

.label {
    float: left;
    width: 30%;
    border: 0;
    font-weight: 900;
    color: #777;
    font-size: 12px;
}

.label label {
    display: inline-block;
    vertical-align: -webkit-baseline-middle;
}

.input {
    float: left;
    width: 70%;
    border: 0;
}

input[type=text],
select,
input[type=password],
input[type=url],
input[type=email],
input[type=number],
input[type=date],
textarea {
    border: 2px solid #bbb;
    padding: 8px;
    border-radius: 3px;
    background: #fff;
    width: 100%;
    font-family: inherit;
    background-color: #713333;
    color: #efff00;
}

input[type=text]:focus,
select:focus,
input[type=password]:focus,
input[type=url]:focus,
input[type=email]:focus,
input[type=number]:focus,
input[type=date]:focus,
textarea:focus {
    border: 2px solid #87bed8;
}

input[type="text"] {
    width: 100px;
}

select {
    width: inherit;
}

input[type="radio"] {
    -webkit-appearance: none;
    appearance: none;
    width: 15px;
    height: 15px;
    border: 3px solid #999;
    border-radius: 50%;
    background-color: #ebebeb;
    outline: 0;
}

input[type="radio"]:checked {
    background-color: #666;
}

input[type="checkbox"] {
    margin-bottom: -2px;
    -webkit-appearance: none;
    appearance: none;
    width: 15px;
    height: 15px;
    border: 3px solid #999;
    border-radius: 3px;
    background-color: #ebebeb;
    outline: 0;
}

input[type="checkbox"]:checked {
    background-color: #666;
}

input[type="file"] {
    display: none;
}

.upload-foto {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}

button[type=submit] {
    background: #3498db;
    border-radius: 28px;
    font-family: Arial;
    color: #ffffff;
    font-size: 20px;
    padding: 10px 20px 10px 20px;
    text-decoration: none;
    float: right;
}

button[type=submit]:hover {
    background: #3cb0fd;
    text-decoration: none;
}

footer {
    background: #fbfbfb;
    padding: 10px;
    font-weight: bold;
    color: #999;
    text-align: center;
}

input.footer.hello.text1 {
    background: #fff !important;
}

@media (max-width: 480px) {
    .container {
        width: 100%;
        margin: 0 auto;
    }

    .label {
        float: none;
        width: 100%;
    }

    .input {
        float: none;
        width: 100%;
    }
}

@media (min-width: 480px) and (max-width: 768px) {
    .container {
        width: 100%;
        margin: 0 auto;
    }
}

    </style>
    <title>Membuat Desain Form Pendaftaran Responsive HTML dan CSS</title>
  </head>
  <body>
    <div class="container">
      <div id="header">
        <img src="logo.png">
        <h1>Form Pendaftaran</h1>
        <p>Silakan isi form secara lengkap</p>
      </div>

      <div class="form-container" style="top: 100px;left: 200px;margin-top: 30px;border-top-width: 10px;border-left-width: 10px;border-right-width: 10px;padding-top: 40px;width: 900px;height: 1200px;">
        <form action="action.php" method="post" autocomplete="on" id="form1">
          <fieldset>
          <legend>Informasi Primer</legend>
          <div class="form-grup">
            <div class="label">
              <label>Nama Lengkap</label>
            </div>
            <div class="input">
              <input type="text" name="nama" placeholder="Isikan nama lengkap Anda" maxlength="20" autofocus style="width: 300px;height: 100px;">
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Email</label>
            </div>
            <div class="input">
              <input type="email" name="email" placeholder="mis. email@gmail.com" maxlength="20" autocomplete="off">
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Password</label>
            </div>
            <div class="input">
              <input type="password" name="password" placeholder="Password dengan huruf, angka dan symbol">
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Asal Kota</label>
            </div>
            <div class="input">
              <select name="kota">
                <option value="malang" selected>Malang</option>
                <option value="ponorogo" selected>Ponorogo</option>
                <option value="surabaya" selected>Surabaya</option>
              </select>
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Gender</label>
            </div>
            <div class="input">
              <input type="radio" name="gender" value="1"> Laki-laki <br>
              <input type="radio" name="gender" value="2"> Perempuan
            </div>
          </div>
          </fieldset>



          <fieldset>
          <legend>Informasi Sekunder</legend>
          <div class="form-grup">
            <div class="label">
              <label>Alamat</label>
            </div>
            <div class="input">
              <textarea name="alamat" placeholder="Isi alamat lengkap Anda" rows="6"></textarea>
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Kendaraan</label>
            </div>
            <div class="input">
              <input type="checkbox" name="kendaraan" value="mobil"> Mobil <br>
              <input type="checkbox" name="kendaraan" value="motor"> Sepeda Motor <br>
              <input type="checkbox" name="kendaraan" value="sepeda"> Sepeda <br>
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Alamat Website</label>
            </div>
            <div class="input">
              <input type="url" name="website" placeholder="mis. http://websitesaya.com">
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Tanggal lahir</label>
            </div>
            <div class="input">
              <input type="date" name="tgl_lahir">
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Jumlah Anak</label>
            </div>
            <div class="input">
              <input type="number" name="anak" value="0" min="0" max="10">
            </div>
          </div>
          <div class="form-grup">
            <div class="label">
              <label>Foto Anda</label>
            </div>
            <div class="input">
              <label for="file-upload" class="upload-foto">
                Upload Foto
              </label>
              <input id="file-upload" type="file" name="foto">
            </div>
          </div>
          </fieldset>
          <div class="form-grup">
            <button type="submit"><img src="buttonsubmit.png"> KIRIM</button>
          </div>
          <div class="form-grup">
          <hr>
            <input type="checkbox" name="subscribe" value="1" form="form1"> Subscribe notifikasi ke email Anda (jika tidak, silakan kosongi)<br>
            <input type="checkbox" name="subscribe" value="2" form="form1"> Subscribe postingan dari website
          </div>
        </form>
      </div>


    </div>

    <footer>
        <p>Copyright &copy; Junior Dev by Sofyan Setiawan 2016</p>
      </footer>
  </body>
</html>
