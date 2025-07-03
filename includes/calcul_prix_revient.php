function prixDeRevientVendeur($cout_achat, $transport = 0, $douane = 0, $stockage = 0, $autres_frais = 0) {
    return $cout_achat + $transport + $douane + $stockage + $autres_frais;
}

// Exemple d'utilisation
$prix_revient = prixDeRevientVendeur(1000, 100, 50, 30, 20); // 1000+100+50+30+20 = 1200
echo "Prix de revient vendeur : $prix_revient FCFA";
