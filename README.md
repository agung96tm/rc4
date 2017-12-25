# rc4
encrypt and decrypt using algoritm rc4

require "src/crptoRC4.php";
use agung96tm\rc4\crptoRC4;

// EXAMPLE USING RC4

$rc4_example = new crptoRC4('123123');

// IF YOU WANT TO CHANGE PASSWORD
// $rc4_example->setKey('321321');


// -----------------------
	// ENCRYPT
// -----------------------

// ECHO CHIPER
$result = $rc4_example->getChiper('helo world');
echo $result;

// ALTERNATIVE
// echo $rc4_example->getChiperText();


// -----------------------
	// DECRYPT
// -----------------------

// ECHO PLAIN
echo $rc4_example->getChiper('bego loh');

// ALTERNATIVE
// echo $rc4_example->getPlainText();


// I LEARN THIS ENCRYPT (RC4) FROM THIS WEBSITE :
// https://matriasiyas.wordpress.com/2014/01/19/pengertian-algoritma-rc4/
// thanks you matriasiyas :D
