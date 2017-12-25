# rc4
encrypt and decrypt using algoritm rc4



<h3>EXAMPLE USING RC4</h3>

require "src/crptoRC4.php";<br />
use agung96tm\rc4\crptoRC4;<br />
<br />

// include key<br />
$rc4_example = new crptoRC4('123123');<br />
<br />

// if you want to change key<br />
// $rc4_example->setKey('321321');<br />
<br />

// -----------------------<br />
	// ENCRYPT<br />
// -----------------------<br />
<br />

// echo chiper<br />
$result = $rc4_example->getChiper('helo world');<br />
echo $result;<br />
<br />

// alternative<br />
// echo $rc4_example->getChiperText();<br />
<br />

// -----------------------<br />
	// DECRYPT<br />
// -----------------------<br />
<br />

// echo plain<br />
echo $rc4_example->getPlain($result);<br />
<br />

// alternative<br />
// echo $rc4_example->getPlainText();<br />
<br />


// I LEARN RC4 FROM THIS WEBSITE :<br />
// https://matriasiyas.wordpress.com/2014/01/19/pengertian-algoritma-rc4/<br />
// thanks you matriasiyas :D
