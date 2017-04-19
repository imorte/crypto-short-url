<?php

namespace App\Lib;

/**
 * Class Hash
 */
class Hash
{
    /**
     * @var array
     */
    private $goldenPrimes = [
        '1'                  => '1',
        '41'                 => '59',
        '2377'               => '1677',
        '147299'             => '187507',
        '9132313'            => '5952585',
        '566201239'          => '643566407',
        '35104476161'        => '22071637057',
    ];

    /**
     * @var array
     */
    private $chars62 = [];

    /**
     * Hash constructor.
     */
    public function __construct()
    {
        $chars = array_merge(
            range(48,57),
            range(65,90),
            range(97,122)
        );

        $this->chars62 = $chars;
    }

    /**
     * @param $num
     * @return string
     */
    public function hash($num)
    {
        $len = random_int(4, 6);
        // Возведение в степень по длине хеша
        $ceil = pow(62, $len);
        // Получить ключ для нужной длины
        $primes = array_keys($this->goldenPrimes);
        $prime = $primes[$len];
        // Остаток от деления исходного числа и ключа от 62 в степени длины нужного хеша
        $dec = ($num * $prime) % $ceil;
        $hash = $this->base62($dec);

        return $hash;
    }

    /**
     * @param $int
     * @return string
     */
    private function base62($int)
    {
        $key = "";

        while($int > 0) {
            // Находим место в хеш таблице
            $mod = $int % 62;
            $key .= chr($this->chars62[$mod]);
            $x = (int)($int / 62);
            $int = $x;
        }

        return strrev($key);
    }

    /**
     * @param $hash
     * @return string
     */
    public function unhash($hash)
    {
        $len = strlen($hash);
        // Возведение в степень по длине хеша
        $ceil = pow(62, $len);
        $mmiprimes = array_values($this->goldenPrimes);
        $mmi = $mmiprimes[$len];
        $num = $this->unbase62($hash);
        $dec = bcmod(bcmul($num, $mmi), $ceil);

        return $dec;
    }

    /**
     * @param $key
     * @return int|string
     */
    private function unbase62($key)
    {
        $int = 0;

        foreach(str_split(strrev($key)) as $i => $char) {
            // Поиск кода символа
            $dec = array_search(ord($char), $this->chars62);
            // Код симвода умноженный на 62 в i степени
            $int = bcadd(bcmul($dec, bcpow(62, $i)), $int);
        }

        return $int;
    }

}
