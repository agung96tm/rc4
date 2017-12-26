# rc4
encrypt and decrypt using algoritm rc4



<h3>EXAMPLE USING RC4</h3>

require "src/crptoRC4.php";<br />
use agung96tm\rc4\crptoRC4;<br />
<br />

// include key<br />
$rc4_example = new crptoRC4('this_key');<br />
<br />

// -----------------------<br />
	// ENCRYPT<br />
// -----------------------<br />
<br />

// echo chiper<br />
$hasil = $rc4->encrypt('agung96tm');<br />
echo $hasil;<br />
<br />

// -----------------------<br />
	// DECRYPT<br />
// -----------------------<br />
<br />

// echo plain<br />
echo $rc4->decrypt($hasil);<br />
<br />

// I LEARN RC4 FROM THIS WEBSITE :<br />
// https://matriasiyas.wordpress.com/2014/01/19/pengertian-algoritma-rc4/<br />
// ENKRIPSI MENGGUNAKAN ALGORITMA RC4 (Arif Nur Afiati Rofi’ah)<br />
// thanks you
