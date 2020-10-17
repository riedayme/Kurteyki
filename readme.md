# Kurteyki App :trophy:

Aplikasi ini adalah hasil dari pembelajaran codeigniter 3. 

## Fitur Umum yang tersedia

Fitur Umum yang tersedia
* 3 Hak Akses terdiri dari App (admin), Instructor (LMS), dan User (LMS)
* Sitemap Otomatis
* Feeds
* Meta Tags dan Schema Otomatis
* Pengaturan robots.txt
* Pengaturan ads.txt
* Pengaturan Tampilan situs dilakukan dihalaman app
* Halaman Statis
* Registrasi User dengan validasi email

Fitur LMS yang tersedia
* Masuk / Daftar User menggunakan akun sosial
* Pengaturan dilakukan di halaman app (admin)
* Filter pencarian
* Memberi ulasan pada materi
* Dapat menandai materi pembelajaran yang sudah selesai
* Wishlist (daftar keinginan) untuk User
* Pembayaran dilakukan secara manual / menggunakan payment gateway (midtrans)
* Mengubah kode template langsung melalui halaman app

Fitur Blog yang tersedia
* Pemberian kategori dan tags langsung dihalaman post
* Terdapat 2 Template yang dapat digunakan
* Pengaturan Widget melalui halaman app 
* Memasukan kode iklan melalui halaman app 
* Komentar disqus / sistem (bawaan)
* Mengubah kode template langsung melalui halaman app

## Langkah Awal Memulai

### Persyaratan
[CodeIgniter Server Requirements](https://codeigniter.com/userguide3/general/requirements.html)

Intruksi dibawah ini akan ***mengarahkan anda untuk menjalankan project pada komputer anda (local)*** dan ditujukan hanya untuk melakukan development dan testing saja.

### Konfigurasi
1. Rename / Copy **config.example.php** menjadi **config.php**
2. Atur konfigurasi sesuai yang diperlukan.

### Menjalankan Aplikasi
#### Menjalankan Aplikasi Menggunakan XAMPP

1. Pastikan anda sudah menjalankan module xampp yaitu apache server dan mysql.
2. Unduh projek ini dan _extract_ ke folder htdocs yang ada pada xampp.
3. Buat _database_ dengan nama **kurteyki**.
4. Import ***kurteyki.sql*** ke dalam _database_ **kurteyki**.
5. Akses aplikasi melalui [http://localhost/kurteyki](http://localhost/kurteyki)


#### Menjalankan Aplikasi Menggunakan DOCKER
```
docker-compose up -d --build
```

Akses aplikasi melalui:

[http://localhost:8080/](http://localhost:8080/) untuk aplikasi

[http://localhost:8080/phpmyadmin](http://localhost:8080/phpmyadmin) untuk akses _database_ melalui _phpmyadmin_


### Lain-lain
#### Cron untuk kirim email

```
*/2 * * * * /usr/local/bin/php /home/cpanelusername/public_html/index.php my_jobs listen
```

#### Pengaturan .htaccess
```
.htaccess.dev = untuk development
.htaccess.run = untuk production

***htaccess ini penting untuk noindex dan caching.***
```

### Informasi App

```
# Default App login
username: kurteyki
password: kurteyki

# Akses DB melalui phpmyadmin (untuk docker)
username: app
password: app

```


## Sumber Inspirasi

* CiFireCMS (module blog dan pengaturan situs)
* Academy by Creativeitem (module lms)
* buildwithangga.com (module pembayaran manual)
* skillacademy.com (template lms)
* cms.botble.com (module pengaturan smtp dan statistik visitor)


## Bug Aplikasi

* beberapa bagian bahasa masih menggunakan Inggris
* not perfect payment gateway
* login phpmyadmin dengan docker tidak redirect langsung ke phpmyadmin


## Change Log

**v1.0**
* Release

**v1.5**
* Change Logic

**V1.6**
* add instructor
* Login using social account
* Review user
* Cookies notification
* Manual Payment
* Register with Vertification Email (queue system)
* add Captcha on register page
* Delete table tb_site_meta (merge data to tb_site)

## Lisensi

[![License: CC BY 4.0](https://i.creativecommons.org/l/by/4.0/88x31.png)](https://creativecommons.org/licenses/by/4.0/)<br/>
This work is licensed under a [Creative Commons Attribution 4.0 International License](http://creativecommons.org/licenses/by/4.0/).
