<?php 
namespace agung96tm\rc4;

class crptoRC4 {
	private $key;
	private $ciphertext;
	private $plaintext;
	private $s;

	public function __construct($key)
	{
		$this->key = $key;
	}

	public function encrypt($plain)
	{
		$this->plaintext = $plain;
		$this->acakSBox();

		// 
		$this->chipertext = $this->pseudoRandomWithXor($plain);

		return $this->chipertext;
	}

	public function decrypt($chiper)
	{
		$this->ciphertext = $chiper;
		$this->acakSBox();

		$this->plaintext = $this->pseudoRandomWithXor($chiper);
		return $this->plaintext;
	}

	private function pseudoRandomWithXor($data)
	{
		$n = strlen($data);
		$i = $j = 0;

		$data = str_split($data, 1);

		for($m = 0 ; $m < $n ; $m++) {
			$i = ($i + 1) % 256;
			$j = ($j + $this->s[$i]) % 256;

			// swap
			$this->swap($i, $j);
			
			$char = ord($data[$m]);
			$t = ($this->s[$i] + $this->s[$j]) % 256;
			
			$char = $t ^ $char;
			$data[$m] = chr($char);
		}

		$data = implode('', $data);

		return $data;
	}

	private function acakSBox()
	{
		$this->s = range(0, 255);
		$j = 0;
		$n = strlen($this->key);

		for($i = 0 ; $i < 256 ; $i++) {
			$char = ord($this->key[$i % $n]);
			$j = ($j + $this->s[$i] + $char) % 256;

			$this->swap($i, $j);
		}
	}

	private function swap($i, $j)
	{
		$nil = $this->s[$i];
		$this->s[$i] = $this->s[$j];
		$this->s[$j] = $nil;
	}
} 
?>
