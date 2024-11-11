<?php

class NumberLetterService
{
    protected $unit = ['', 'un'];
    protected $units = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    protected $teens = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
    protected $tens = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    protected $tensy = ['', '', 'veinti', 'treinta y', 'cuarenta y', 'cincuenta y', 'sesenta y', 'setenta y', 'ochenta y', 'noventa y'];
    protected $hundreds = ['', 'cien', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];
    protected $hundred = ['', 'ciento'];


    public function convert($number)
    {
        if ($number == 0) {
            return 'cero pesos';
        }

        $millions = floor($number / 1000000);
        $thousands = floor(($number - $millions * 1000000) / 1000);
        $remainder = $number % 1000;

        $words = '';

        if ($millions > 0) {
            $words .= $this->convertBelowThousand($millions) . ' millón' . ($millions > 1 ? 'es' : '') . ' ';
        }

        if ($thousands > 0) {
            $words .= $this->convertBelowThousand($thousands) . ' mil ';
        }

        if ($remainder > 0) {
            $words .= $this->convertBelowThousand($remainder) . ' ';
        }

        return trim($words) . ' pesos';
    }

    protected function convertBelowThousand($number)
    {
        $hundreds = floor($number / 100);
        $remainder = $number % 100;
        $words = '';

        if ($hundreds > 0) {
            $units = $remainder % 100;
            if($hundreds == 1 && $units > 0){
                $words .= $this->hundred[$hundreds] . ' ';
            }else{                
                $words .= $this->hundreds[$hundreds] . ' ';
            }
        }

        if ($remainder < 10) {  
            $units = $remainder % 10;
            if (isset($units)) {
                if($units == 0){
                    $words .= $this->units[$remainder];
                }elseif($units == 1){
                    $words .= $this->unit[$remainder];
                }else{
                    $words .= $this->units[$remainder];
                }
            }else{
                $words .= $this->units[$remainder];
            }         
            
        } elseif ($remainder < 20) {
            $words .= $this->teens[$remainder - 10];
        } else {
            $tens = floor($remainder / 10);
            $units = $remainder % 10;
            if($units == 0){
                $words .= $this->tens[$tens] . ' ';
                $words .= $this->units[$units];
            }elseif($units == 1){
                $words .= $this->tensy[$tens] . ' ';
                $words .= $this->unit[$units];
            }else{
                $words .= $this->tensy[$tens] . ' ';
                $words .= $this->units[$units];
            }
        }

        return trim($words);
    }
}
?>