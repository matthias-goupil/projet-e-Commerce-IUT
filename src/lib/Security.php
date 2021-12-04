<?php
class Security {
    private static $seed = 'MAvMW6Gvm7r1xkrxquj2';

    public static function hacher($texte_en_clair) {
        $texte_hache = hash('sha256', $seed.$texte_en_clair);
        return $texte_hache;
    }
}

?>