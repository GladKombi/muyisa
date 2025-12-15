<?php 
include('../connexion/connexion.php');
include('../models/select/sel-vente.php');

if(isset($_GET['com']))
{
    $com=$_GET['com'];
    $val=$connexion->prepare("UPDATE commande SET statut=1 where id=?");
    $val->execute(array($com));
}

// Stocker les résultats dans des tableaux pour pouvoir les réutiliser
$panierData = [];
$total = 0;
while($data = $Selpanier->fetch()){
    $PT = $data['prixunitaire'] * $data['quantite'];
    $total += $PT;
    $panierData[] = [
        'quantite' => $data['quantite'],
        'type_achat' => $data['type_achat'],
        'type' => $data['type'],
        'prixunitaire' => $data['prixunitaire'],
        'prix_total' => $PT
    ];
}

$panierDataE = [];
$totalE = 0;
while($data = $SelpanierE->fetch()){
    $PT = $data['prixunitaire'] * $data['quantite'];
    $totalE += $PT;
    $panierDataE[] = [
        'quantite' => $data['quantite'],
        'type_achat' => $data['type_achat'],
        'type' => $data['type'],
        'prixunitaire' => $data['prixunitaire'],
        'prix_total' => $PT
    ];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Facture - Station Muyisa Energie</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include('../include/link.php'); ?> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #3498db;
      --accent-color: #e74c3c;
      --light-bg: #f8f9fa;
      --border-color: #dee2e6;
      --text-color: #333;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--text-color);
      background-color: #fff;
      line-height: 1.6;
    }
    
    .invoice-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background: white;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
      border-radius: 8px;
    }
    
    .header-section {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border-color);
    }
    
    .company-info h1 {
      color: var(--primary-color);
      margin-bottom: 5px;
      font-size: 1.8rem;
    }
    
    .invoice-details {
      text-align: right;
    }
    
    .invoice-number {
      font-size: 1.5rem;
      font-weight: bold;
      color: var(--secondary-color);
      margin-bottom: 10px;
    }
    
    .client-info {
      background-color: var(--light-bg);
      padding: 15px;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    
    .payment-info {
      display: inline-block;
      padding: 5px 12px;
      background-color: var(--secondary-color);
      color: white;
      border-radius: 4px;
      font-weight: bold;
    }
    
    .payment-info.cash {
      background-color: #27ae60;
    }
    
    .payment-info.credit {
      background-color: var(--accent-color);
    }
    
    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    .invoice-table th {
      background-color: var(--primary-color);
      color: white;
      padding: 12px 15px;
      text-align: left;
      font-weight: 600;
    }
    
    .invoice-table td {
      padding: 12px 15px;
      border-bottom: 1px solid var(--border-color);
    }
    
    .invoice-table tr:last-child td {
      border-bottom: none;
    }
    
    .total-row {
      background-color: var(--light-bg);
      font-weight: bold;
    }
    
    .total-row td {
      padding-top: 15px;
      padding-bottom: 15px;
    }
    
    .disclaimer {
      text-align: center;
      font-style: italic;
      color: #6c757d;
      margin-top: 25px;
      padding: 15px;
      border-top: 1px dashed var(--border-color);
    }
    
    .action-buttons {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    
    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-primary {
      background-color: var(--secondary-color);
      color: white;
    }
    
    .btn-success {
      background-color: #27ae60;
      color: white;
    }
    
    .btn-dark {
      background-color: var(--primary-color);
      color: white;
    }
    
    .btn:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }
    
    @media print {
      .no-print {
        display: none;
      }
      
      .invoice-container {
        box-shadow: none;
        padding: 0;
      }
      
      body {
        background-color: white;
      }
      
      .page-break {
        page-break-before: always;
        margin-top: 50px;
      }
    }
    
    @media (max-width: 768px) {
      .header-section {
        flex-direction: column;
      }
      
      .invoice-details {
        text-align: left;
        margin-top: 15px;
      }
      
      .invoice-table {
        font-size: 0.9rem;
      }
      
      .invoice-table th, 
      .invoice-table td {
        padding: 8px 10px;
      }
    }
  </style>
</head>

<body>
  <div class="invoice-container">
    <div class="action-buttons no-print">
      <?php if($_SESSION['fonction']=="comptable"){?>
        <!-- Bouton pour impression si nécessaire -->
      <?php }else{?>
        <a href="vente.php?new" class="btn btn-primary">Nouvelle Facture</a>
        <button onclick="window.print()" class="btn btn-success">Imprimer</button>
        <button onclick="saveAsImage()" class="btn btn-dark">Enregistrer en image</button>
      <?php } ?>
    </div>
    
    <!-- Première copie de la facture -->
    <div id="invoice">
      <div class="header-section">
        <div class="company-info">
          <h1>STATION MUYISA ENERGIE</h1>
          <div>
            <strong>RCCM:</strong> CD/Bbo/RCCM/23-A-1446<br>
            <strong>IMPÔT:</strong> A 20271017P<br>
            <strong>ID.NAT:</strong> 19-G4701-N50027E<br>
            <strong>Adresse:</strong> Q.VUTESTE, Cell. LUSANDO, N° 1<br>
            <strong>Tél:</strong> +243 993580599, +243 997287934
          </div>
        </div>
        
        <div class="invoice-details">
          <div class="invoice-number">Facture n° <?php echo sprintf('%04d', $detail['numfacture']);?></div>
          <div>Bukavu, le <?php $dates=strtotime($detail["dates"]); echo date('d/m/Y ',$dates);?></div>
        </div>
      </div>
      
      <div class="client-info">
        <div><strong>Client:</strong> <?php echo strtoupper($detail['client']);?></div>
        <div class="payment-info <?php echo ($detail['type']==1) ? 'cash' : 'credit'; ?>">
          PAIEMENT: <?php echo ($detail['type']==1) ? "CASH" : "CREDIT"; ?>
        </div>
      </div>
      
      <table class="invoice-table">
        <thead>
          <tr>
            <th>Qté</th>
            <th>Désignation</th>
            <th>Prix Unitaire</th>
            <th>Prix Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($panierData as $data): ?>
          <tr>
            <td><?=$data['quantite']?></td>
            <td><?=$data['type_achat']?> <?=$data['type']?></td>
            <td><?=$data['prixunitaire']?> $</td>
            <td><?=$data['prix_total']?> $</td>
          </tr>
          <?php endforeach; ?>
          <tr class="total-row">
            <td colspan="3"><strong>TOTAL</strong></td>
            <td><strong><?=$total?> $</strong></td>
          </tr>
        </tbody>
      </table>
      
      <div class="disclaimer">
        Les marchandises vendues ne sont ni remises ni échangées
      </div>
    </div>
    
    <!-- Deuxième copie de la facture (pour la duplication) -->
    <div class="page-break" id="invoice-copy">
      <div class="header-section">
        <div class="company-info">
          <h1>STATION MUYISA ENERGIE</h1>
        </div>
        
        <div class="invoice-details">
          <div class="invoice-number">Facture n° <?php echo sprintf('%04d', $detail['numfacture']);?></div>
        </div>
      </div>
      
      <table class="invoice-table">
        <thead>
          <tr>
            <th>Qté</th>
            <th>Désignation</th>
            <th>Prix Unitaire</th>
            <th>Prix Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($panierDataE as $data): ?>
          <tr>
            <td><?=$data['quantite']?></td>
            <td><?=$data['type_achat']?> <?=$data['type']?></td>
            <td><?=$data['prixunitaire']?> $</td>
            <td><?=$data['prix_total']?> $</td>
          </tr>
          <?php endforeach; ?>
          <tr class="total-row">
            <td colspan="3"><strong>TOTAL</strong></td>
            <td><strong><?=$totalE?> $</strong></td>
          </tr>
        </tbody>
      </table>
      
      <div class="disclaimer">
        Les marchandises vendues ne sont ni remises ni échangées
      </div>
    </div>
  </div>

  <script>
    function saveAsImage() {
      const invoiceElement = document.getElementById('invoice');
      html2canvas(invoiceElement).then(canvas => {
        const link = document.createElement('a');
        link.download = 'facture-muyisa-<?php echo sprintf('%04d', $detail['numfacture']);?>.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
      });
    }
  </script>
</body>
</html>