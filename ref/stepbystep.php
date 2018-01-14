Refaktoryzacja:

1)Dodanie menu 




2)Wyodrebnienie metody do wypisywania na tablicy napisow

/// Ta było 

public function writeGameOver()
    {
        //$text = 'Koniec gry';
        $text = 'GAME OVER';
        $length = strlen($text);
        $col = ($this->width / 2) - ($length / 2);
        $row = $this->height / 2;

        for ($i = 0; $i < $length; ++$i) {
            $this->map[$row][$col] = $text[$i];
            ++$col;
        }
    }

/// Krok 1
/// Wydzielenie innej funkcji 

    /**Funcion writing a string on board 
    *
    */
    public function writeStringOnBoard($text)
    {
        $length = strlen($text);
        $col = ($this->width / 2) - ($length / 2);
        $row = $this->height / 2;

        for ($i = 0; $i < $length; ++$i) {
            $this->map[$row][$col] = $text[$i];
            ++$col;
        }
    }


