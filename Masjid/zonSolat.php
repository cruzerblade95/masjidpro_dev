<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.css" integrity="sha512-Mg1KlCCytTmTBaDGnima6U63W48qG1y/PnRdYNj3nPQh3H6PVumcrKViACYJy58uQexRUrBqoADGz2p4CdmvYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Zon Solat</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-auto">
            <select id="inputZone" class="form-control">

                    <option value="JHR01" class="hs">JHR01 - Pulau Aur dan Pulau Pemanggil </option>
                    <option value="JHR02" class="hs">JHR02 - Johor Bahru, Kota Tinggi, Mersing</option>
                    <option value="JHR03" class="hs">JHR03 - Kluang, Pontian</option>
                    <option value="JHR04" class="hs">JHR04 - Batu Pahat, Muar, Segamat, Gemas Johor</option>

                    <option value="KDH01" class="hs">KDH01 - Kota Setar, Kubang Pasu, Pokok Sena (Daerah Kecil)</option>
                    <option value="KDH02" class="hs">KDH02 - Kuala Muda, Yan, Pendang</option>
                    <option value="KDH03" class="hs">KDH03 - Padang Terap, Sik</option>
                    <option value="KDH04" class="hs">KDH04 - Baling</option>
                    <option value="KDH05" class="hs">KDH05 - Bandar Baharu, Kulim</option>
                    <option value="KDH06" class="hs">KDH06 - Langkawi</option>
                    <option value="KDH07" class="hs">KDH07 - Puncak Gunung Jerai</option>

                    <option value="KTN01" class="hs">KTN01 - Bachok, Kota Bharu, Machang, Pasir Mas, Pasir Puteh, Tanah Merah, Tumpat, Kuala Krai, Mukim Chiku</option>
                    <option value="KTN03" class="hs">KTN03 - Gua Musang (Daerah Galas Dan Bertam), Jeli, Jajahan Kecil Lojing</option>

                    <option value="MLK01" class="hs">MLK01 - SELURUH NEGERI MELAKA</option>

                    <option value="NGS01" class="hs">NGS01 - Tampin, Jempol</option>
                    <option value="NGS02" class="hs">NGS02 - Jelebu, Kuala Pilah, Port Dickson, Rembau, Seremban</option>

                    <option value="PHG01" class="hs">PHG01 - Pulau Tioman</option>
                    <option value="PHG02" class="hs">PHG02 - Kuantan, Pekan, Rompin, Muadzam Shah</option>
                    <option value="PHG03" class="hs">PHG03 - Jerantut, Temerloh, Maran, Bera, Chenor, Jengka</option>
                    <option value="PHG04" class="hs">PHG04 - Bentong, Lipis, Raub</option>
                    <option value="PHG05" class="hs">PHG05 - Genting Sempah, Janda Baik, Bukit Tinggi</option>
                    <option value="PHG06" class="hs">PHG06 - Cameron Highlands, Genting Higlands, Bukit Fraser</option>

                    <option value="PLS01" class="hs">PLS01 - Kangar, Padang Besar, Arau</option>

                    <option value="PNG01" class="hs">PNG01 - Seluruh Negeri Pulau Pinang</option>

                    <option value="PRK01" class="hs">PRK01 - Tapah, Slim River, Tanjung Malim</option>
                    <option value="PRK02" class="hs">PRK02 - Kuala Kangsar, Sg. Siput , Ipoh, Batu Gajah, Kampar</option>
                    <option value="PRK03" class="hs">PRK03 - Lenggong, Pengkalan Hulu, Grik</option>
                    <option value="PRK04" class="hs">PRK04 - Temengor, Belum</option>
                    <option value="PRK05" class="hs">PRK05 - Kg Gajah, Teluk Intan, Bagan Datuk, Seri Iskandar, Beruas, Parit, Lumut, Sitiawan, Pulau Pangkor</option>
                    <option value="PRK06" class="hs">PRK06 - Selama, Taiping, Bagan Serai, Parit Buntar</option>
                    <option value="PRK07" class="hs">PRK07 - Bukit Larut</option>

                    <option value="SBH01" class="hs">SBH01 - Bahagian Sandakan (Timur), Bukit Garam, Semawang, Temanggong, Tambisan, Bandar Sandakan, Sukau</option>
                    <option value="SBH02" class="hs">SBH02 - Beluran, Telupid, Pinangah, Terusan, Kuamut, Bahagian Sandakan (Barat)</option>
                    <option value="SBH03" class="hs">SBH03 - Lahad Datu, Silabukan, Kunak, Sahabat, Semporna, Tungku, Bahagian Tawau  (Timur)</option>
                    <option value="SBH04" class="hs">SBH04 - Bandar Tawau, Balong, Merotai, Kalabakan, Bahagian Tawau (Barat)</option>
                    <option value="SBH05" class="hs">SBH05 - Kudat, Kota Marudu, Pitas, Pulau Banggi, Bahagian Kudat</option>
                    <option value="SBH06" class="hs">SBH06 - Gunung Kinabalu</option>
                    <option value="SBH07" class="hs">SBH07 - Kota Kinabalu, Ranau, Kota Belud, Tuaran, Penampang, Papar, Putatan, Bahagian Pantai Barat</option>
                    <option value="SBH08" class="hs">SBH08 - Pensiangan, Keningau, Tambunan, Nabawan, Bahagian Pendalaman (Atas)</option>
                    <option value="SBH09" class="hs">SBH09 - Beaufort, Kuala Penyu, Sipitang, Tenom, Long Pa Sia, Membakut, Weston, Bahagian Pendalaman (Bawah)</option>

                    <option value="SGR01" class="hs">SGR01 - Gombak, Petaling, Sepang, Hulu Langat, Hulu Selangor, S.Alam</option>
                    <option value="SGR02" class="hs">SGR02 - Kuala Selangor, Sabak Bernam</option>
                    <option value="SGR03" class="hs">SGR03 - Klang, Kuala Langat</option>

                    <option value="SWK01" class="hs">SWK01 - Limbang, Lawas, Sundar, Trusan</option>
                    <option value="SWK02" class="hs">SWK02 - Miri, Niah, Bekenu, Sibuti, Marudi</option>
                    <option value="SWK03" class="hs">SWK03 - Pandan, Belaga, Suai, Tatau, Sebauh, Bintulu</option>
                    <option value="SWK04" class="hs">SWK04 - Sibu, Mukah, Dalat, Song, Igan, Oya, Balingian, Kanowit, Kapit</option>
                    <option value="SWK05" class="hs">SWK05 - Sarikei, Matu, Julau, Rajang, Daro, Bintangor, Belawai</option>
                    <option value="SWK06" class="hs">SWK06 - Lubok Antu, Sri Aman, Roban, Debak, Kabong, Lingga, Engkelili, Betong, Spaoh, Pusa, Saratok</option>
                    <option value="SWK07" class="hs">SWK07 - Serian, Simunjan, Samarahan, Sebuyau, Meludam</option>
                    <option value="SWK08" class="hs">SWK08 - Kuching, Bau, Lundu, Sematan</option>
                    <option value="SWK09" class="hs">SWK09 - Zon Khas (Kampung Patarikan)</option>

                    <option value="TRG01" class="hs">TRG01 - Kuala Terengganu, Marang, Kuala Nerus</option>
                    <option value="TRG02" class="hs">TRG02 - Besut, Setiu</option>
                    <option value="TRG03" class="hs">TRG03 - Hulu Terengganu</option>
                    <option value="TRG04" class="hs">TRG04 - Dungun, Kemaman</option>

                    <option value="WLY01" class="hs">WLY01 - Kuala Lumpur, Putrajaya</option>
                    <option value="WLY02" class="hs">WLY02 - Labuan</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <textarea id="csv" class="form-control" rows="20"></textarea>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.js" integrity="sha512-M40amBAeCw9I8KxDnJ4cQV8z8EBdAw+MD/zHy61tjdoc7UAhg/VTp2KsKRwzkJ7Lpmtfgg9QzUXRpbVRKLLFcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.js" integrity="sha512-nw7zwODD4UD9u/C/CO+03s7jXvOZDomBNFX3oOq7Xv0stAyxsxhJzVlxsRTgH3AxK3sK2ijMQou2aSIaorp19g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    //var zone = '"zon","nama_zon"'+"\n";
    var zone = '';
    $('#inputZone option').each(function() {
        zone += 'INSERT INTO zon_solat (zon_solat, nama_zon) VALUES (\''+$(this).val()+'\', \''+$(this).html().replace($(this).val()+' - ', '')+'\');'+ "\n";
        //zone += '"' + $(this).val() + '","' + $(this).html().replace($(this).val()+' - ', '') + '"' + "\n";
        $('#csv').val(zone);
    });

</script>
</body>
</html>