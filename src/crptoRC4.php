<?php 
namespace rc4;

class crptoRC4
{
	private $s, $k;
	private $panjang;
	private $plaintext;
	private $pseudoRandomByte;
	private $chipertext;
	private $key;

	public function __construct($key)
	{
		$this->key = $key;
	}

	/*
	 |------------------------------------------------------
	 | Set And Get
	 |------------------------------------------------------
	 */

	public function setKey($key)
	{
		$this->key = $key;
	}

	public function getKey()
	{
		return $this->key;
	}

	public function getPlainText()
	{
		return $this->plaintext;
	}

	public function getChiperText()
	{
		return $this->chipertext;
	}

	/*
	 |-------------------------------------------------------
	 */


	// generate S-Box (Array S)
	private function setSBoxS()
	{
		for ($i=0; $i < $this->panjang; $i++) { 
			$this->s[$i] = $i;
		}
	}

	// generate K-Box (Array K)
	private function setSBoxK()
	{
		for ($i=0; $i < count($this->s); $i++) { 
			$this->k[$i] = $this->key[($i % strlen($this->key))];
		}

	}

	// Random S-Box 
	private function processRandomSBox()
	{
		$j = 0;

		for ($i=0; $i < $this->panjang; $i++) {
			$j = ($j + $this->s[$i] + $this->k[$i]) % $this->panjang;
			$this->swap($i, $j);
		}
	}

	// Swap value in array (only property $this->s)
	private function swap($i, $j)
	{
		$nil_i = $this->s[$i];
		// print_r($nil_i);
		// die();
		$this->s[$i] = $this->s[$j];
		$this->s[$j] = $nil_i;
	}


	// get chiper
	public function getChiper($plaintext)
	{
		$this->plaintext = $plaintext;
		$this->panjang = strlen($plaintext);
		
		$this->setSBoxS();
		$this->setSBoxK();
		$this->processRandomSBox();

		if(is_null($this->pseudoRandomByte)) {
			$this->setPseudoRandomByte($this->plaintext);
		}
		
		$hasil = $this->proses($this->plaintext);
		$this->chipertext = $hasil;

		return $hasil;
	}

	// get plain
	public function getPlain($chipertext)
	{
		$this->chipertext = $chipertext;
		$this->panjang = strlen($chipertext);

		$this->setSBoxS();
		$this->setSBoxK();
		$this->processRandomSBox();

		if(is_null($this->pseudoRandomByte)) {
			$this->setPseudoRandomByte($this->chipertext);
		}

		$hasil = $this->proses($this->chipertext);
		$this->plaintext = $hasil;

		return $hasil;
	}

	// Processing, $jenis = property, $this->chipertext or $this->plaintext
	public function proses($jenis)
	{
		for ($i=0; $i < strlen($jenis); $i++) { 
			
			$bin_char = $this->charToBin($jenis[$i]);
			$bin_pseudo_char = $this->charToBin($this->pseudoRandomByte[$i]);
			
			$hasil_xor = $this->xor($bin_char, $bin_pseudo_char);
			
			$hasil_akhir[$i] = $hasil_xor;
		}

		return implode('', $hasil_akhir);
	}

	// Xor with char (in binner) and char pseudo (in binner)
	// return string
	private function xor($bin_char, $bin_pseudo_char)
	{
		for ($i=0; $i < strlen($bin_char) ; $i++) { 
			$hasil[$i] = intval($bin_char[$i]) ^ intval($bin_pseudo_char[$i]);
		}

		$ascii = bindec(implode('', $hasil));
		
		return chr($ascii);
	}

	// Make char to binner and add 0 in front (if char.length != 8)
	private function charToBin($char)
	{
		$bin_char = decbin(ord($char));
		
		while(strlen($bin_char) != 8) {
			$bin_char = '0' . $bin_char;
		}

		return $bin_char;
	}

	// generate pseudo random
	private function setPseudoRandomByte($jenis)
	{
		$i = 0;
		$j = 0;

		for ($p_data = 0; $p_data < strlen($jenis); $p_data++) { 


			$i = ($i + 1) % strlen($jenis);
			$j = ($j + $this->s[$i]) % strlen($jenis);
			$this->swap($i, $j);

			$t = ($this->s[$i] + $this->s[$j]) % strlen($jenis);
			$this->pseudoRandomByte[$p_data] = $this->s[$t];
		}
	}
}
?>