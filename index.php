<?php
// tutaj wpisz swój klucz api z panel.2r2.pl
$apikey = "";

// Ustawianie szerokości i wysokości obrazka
$imageWidth = 700;
$imageHeight = 900;

// Tworzenie obrazka
$image = imagecreatetruecolor($imageWidth, $imageHeight);

// Ustawianie kolorów
$backgroundColor = imagecolorallocate($image, 34, 34, 34); // #222
$textColor = imagecolorallocate($image, 255, 255, 255); // #fff
$textColorS = imagecolorallocate($image, 255, 255, 0); // #fff

// Wypełnianie tła
imagefill($image, 0, 0, $backgroundColor);

// Pobieranie danych z API
$ch = curl_init('https://panel.2r2.pl/api');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$apikey&xxt=swiat");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
$json = curl_exec($ch);
curl_close($ch);

$data = json_decode($json, true);
$strumien_sloneczny = $data['Strumień słoneczny'];
$wskaźnik_a = $data['Wskaźnik A'];
$wskaźnik_k = $data['Wskaźnik K'];
$wskaźnik_k_bez_raportu = $data['Wskaźnik K (bez raportu)'];
$promieniowanie_x = $data['Promieniowanie rentgenowskie X'];
$plamy_sloneczne = $data['Plamy słoneczne'];
$linia_helu = $data['Linia helu'];
$strumien_protonow = $data['Strumień protonów'];
$strumien_elektronow = $data['Strumień elektronów'];
$aktywnosc_zorzy_polarnej = $data['Aktywność zorzy polarnej'];
$normalizacja = $data['Normalizacja'];
$stopien_szerokosci_geograficznej = $data['Stopień szerokości geograficznej'];
$wiatr_sloneczny = $data['Wiatr słoneczny'];
$pole_magnetyczne = $data['Pole magnetyczne'];
$pole_geomagnetyczne = $data['Pole geomagnetyczne'];
$szum_sygnalu = $data['Szum sygnału'];
$fof2 = $data['FOF2'];
$muf_factor = $data['MUF Factor'];
$muf = $data['MUF'];

$aktualizacja = $data['Aktualizacja'];

$propagacja = $data['PROPAGACJA'];

// Dodawanie tekstu
$fontSize = 20;
$textX = 20;
$textY = 40;

imagettftext($image, $fontSize, 0, $textX, $textY, $textColor, 'arial.ttf', 'Aktualizacja: ' . $aktualizacja);

// Dodawanie tabeli z informacjami o propagacji
$tableX = 20;
$tableY = 100;
$tableWidth = $imageWidth - 2 * $tableX;
$rowHeight = 30;
$columnWidth = $tableWidth / 3;

$tableHeaderY = $tableY;
imagettftext($image, $fontSize, 0, $tableX, 80, $textColorS, 'arial.ttf', 'Informacje o propagacji:');

$rowY = $tableHeaderY + $rowHeight;
foreach ($propagacja as $item) {
    $pasmo = $item['Pasmo'];
    $czas = $item['Czas'];
    $warunek = $item['Warunek'];

    imagettftext($image, $fontSize, 0, $tableX, $rowY, $textColor, 'arial.ttf', $pasmo);
    imagettftext($image, $fontSize, 0, $tableX + $columnWidth, $rowY, $textColor, 'arial.ttf', $czas);
    imagettftext($image, $fontSize, 0, $tableX + 2 * $columnWidth, $rowY, $textColor, 'arial.ttf', $warunek);

    $rowY += $rowHeight;
}

// Dodawanie pozostałych informacji
$infoX = $tableX;
$infoY = 430;
$spacing = 23;
$fontSize = 14;
imagettftext($image, 20, 0, $infoX, 389, $textColorS, 'arial.ttf', 'INNE: ');

imagettftext($image, $fontSize, 0, $infoX, $infoY, $textColor, 'arial.ttf', 'Strumień słoneczny: ' . $strumien_sloneczny);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing, $textColor, 'arial.ttf', 'Wskaźnik A: ' . $wskaźnik_a);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 2, $textColor, 'arial.ttf', 'Wskaźnik K: ' . $wskaźnik_k);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 3, $textColor, 'arial.ttf', 'Wskaźnik K (bez raportu): ' . $wskaźnik_k_bez_raportu);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 4, $textColor, 'arial.ttf', 'Promieniowanie rentgenowskie X: ' . $promieniowanie_x);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 5, $textColor, 'arial.ttf', 'Plamy słoneczne: ' . $plamy_sloneczne);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 6, $textColor, 'arial.ttf', 'Linia helu: ' . $linia_helu);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 7, $textColor, 'arial.ttf', 'Strumień protonów: ' . $strumien_protonow);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 8, $textColor, 'arial.ttf', 'Strumień elektronów: ' . $strumien_elektronow);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 9, $textColor, 'arial.ttf', 'Aktywność zorzy polarnej: ' . $aktywnosc_zorzy_polarnej);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 10, $textColor, 'arial.ttf', 'Normalizacja: ' . $normalizacja);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 11, $textColor, 'arial.ttf', 'Stopień szerokości geograficznej: ' . $stopien_szerokosci_geograficznej);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 12, $textColor, 'arial.ttf', 'Wiatr słoneczny: ' . $wiatr_sloneczny);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 13, $textColor, 'arial.ttf', 'Pole magnetyczne: ' . $pole_magnetyczne);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 14, $textColor, 'arial.ttf', 'Pole geomagnetyczne: ' . $pole_geomagnetyczne);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 15, $textColor, 'arial.ttf', 'Szum sygnału: ' . $szum_sygnalu);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 16, $textColor, 'arial.ttf', 'FOF2: ' . $fof2);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 17, $textColor, 'arial.ttf', 'MUF Factor: ' . $muf_factor);
imagettftext($image, $fontSize, 0, $infoX, $infoY + $spacing * 18, $textColor, 'arial.ttf', 'MUF: ' . $muf);


// Dodawanie źródła
$sourceX = $tableX + 160;
$sourceY = $imageHeight - 35;
imagettftext($image, $fontSize, 0, $sourceX, $sourceY, $textColorS, 'arial.ttf', 'Źródło: panel.2r2.pl by HF8FRN');

// Ustawianie nagłówków HTTP
header('Content-Type: image/png');

// Wyświetlanie obrazka
imagepng($image);

// Zwalnianie zasobów pamięci
imagedestroy($image);
?>
