<?php
include('../connexion/connexion.php');
include_once('../models/select/sel-vente.php');
if (isset($_GET['idclient'])) {
    // Votre code existant
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gestion des Ventes - <?=$page_title?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- link -->
  <?php include_once('../include/link.php'); ?>
  <!-- link -->
  
  <style>
    .card-custom {
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border: none;
      transition: transform 0.3s ease;
    }
    
    .card-custom:hover {
      transform: translateY(-5px);
    }
    
    .btn-custom {
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-custom:hover {
      transform: scale(1.05);
    }
    
    .table-custom th {
      background-color: #2c3e50;
      color: white;
      font-weight: 600;
    }
    
    .stock-info {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
    }
    
    .header-section {
      background: linear-gradient(135deg, #343a40 0%, #495057 100%);
      color: white;
      padding: 20px 0;
      border-radius: 0 0 15px 15px;
      margin-bottom: 30px;
    }
    
    .form-section {
      background-color: #f8f9fa;
      border-radius: 10px;
      padding: 20px;
    }
    
    .action-buttons .btn {
      margin: 2px;
    }
    
    .alert-custom {
      border-radius: 10px;
      border: none;
    }
    
    .filter-section {
      background-color: #e9ecef;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }
    
    .date-badge {
      background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      font-weight: 600;
    }
    
    @media print {
      .no-print {
        display: none !important;
      }
      .card-custom {
        box-shadow: none;
        border: 1px solid #dee2e6;
      }
      .table-custom th {
        background-color: #495057 !important;
        color: white !important;
      }
    }
  </style>
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- menu -->
  <?php include_once('../include/menu.php'); ?>

  <main id="main" class="main">
    <!-- Header Section -->
    <div class="header-section">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1 class="h2 mb-0"><i class="bi bi-cart-check me-2"></i>Gestion des Ventes</h1>
            <span class="date-badge mt-2 d-inline-block">
              <i class="bi bi-calendar-event me-1"></i><?=$page_title?>
            </span>
          </div>
          <div class="col-md-6 text-end">
            <?php if(!isset($_GET['idsup']) && !isset($_GET['new']) && !isset($_GET['com']) && !isset($_GET['idclient'])): ?>
              <a href="vente.php?new" class="btn btn-success btn-custom me-2 no-print">
                <i class="bi bi-plus-circle me-1"></i>Nouvelle Vente
              </a>
              <button onclick="window.print()" class="btn btn-info btn-custom no-print">
                <i class="bi bi-printer me-1"></i>Imprimer
              </button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <!-- Stock Information -->
      <?php if(isset($_GET['com']) || isset($_GET['id']) || (!isset($_GET['idsup']) && !isset($_GET['new']) && !isset($_GET['com']) && !isset($_GET['idclient']))): ?>
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="stock-info text-center">
            <h4><i class="bi bi-droplet me-2"></i>Stock Essence</h4>
            <h3><?=$_SESSION['stock_essence']?> L</h3>
          </div>
        </div>
        <div class="col-md-6">
          <div class="stock-info text-center" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h4><i class="bi bi-droplet-fill me-2"></i>Stock Mazout</h4>
            <h3><?=$_SESSION['stock_mazout']?> L</h3>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <!-- Filtres par Date -->
      <?php if(!isset($_GET['idsup']) && !isset($_GET['new']) && !isset($_GET['com']) && !isset($_GET['idclient'])): ?>
      <div class="filter-section no-print">
        <div class="row align-items-center">
          <div class="col-md-12">
            <h5 class="mb-3"><i class="bi bi-funnel me-2"></i>Filtrer les ventes</h5>
          </div>
          <div class="col-md-8">
            <form method="GET" action="" class="row g-3">
              <div class="col-md-3">
                <select name="date_filter" class="form-select" onchange="this.form.submit()">
                  <option value="today" <?= $date_filter == 'today' ? 'selected' : '' ?>>Aujourd'hui</option>
                  <option value="all" <?= $date_filter == 'all' ? 'selected' : '' ?>>Toutes les ventes</option>
                  <option value="custom" <?= $date_filter == 'custom' ? 'selected' : '' ?>>Période personnalisée</option>
                </select>
              </div>
              <?php if($date_filter == 'custom'): ?>
              <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="<?= $start_date ?>" placeholder="Date début">
              </div>
              <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" value="<?= $end_date ?>" placeholder="Date fin">
              </div>
              <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                  <i class="bi bi-search me-1"></i>Filtrer
                </button>
              </div>
              <?php endif; ?>
            </form>
          </div>
          <div class="col-md-4 text-end">
            <?php if($date_filter == 'custom' && !empty($start_date) && !empty($end_date)): ?>
              <a href="vente.php" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Effacer le filtre
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <!-- Main Content -->
      <section class="section">
        <div class="row">
          <div class="col-12">
            <div class="card card-custom">
              <div class="card-body">
                
                <!-- Suppression Modal -->
                <?php if(isset($_GET['idsup']) && !empty($_GET['idsup'])): ?>
                <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="card card-custom border-danger">
                      <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Confirmation de suppression</h5>
                        <a href="vente.php" class="btn btn-light btn-sm"><i class="bi bi-x-lg"></i></a>
                      </div>
                      <div class="card-body">
                        <p class="mb-3">Voulez-vous vraiment supprimer la vente de :</p>
                        <div class="alert alert-warning">
                          <strong><?=$supprimer['nom']." ".$supprimer['postnom']?></strong><br>
                          Quantité: <?=$supprimer['quantite']?> L<br>
                          Prix: <?=$supprimer['prix']?> $/L
                        </div>
                        <p class="text-danger"><small><i class="bi bi-info-circle me-1"></i>Cette action est irréversible</small></p>
                      </div>
                      <div class="card-footer bg-transparent">
                        <a href='../models/del/del-vente.php?iddel=<?=$_GET['idsup']?>' class="btn btn-danger me-2">
                          <i class="bi bi-trash me-1"></i>Supprimer
                        </a>
                        <a href="vente.php" class="btn btn-secondary">Annuler</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Nouvelle Vente - Saisie Client -->
                <?php elseif(isset($_GET['new']) && !isset($_GET['com'])): ?>
                <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-8">
                    <div class="card card-custom">
                      <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-plus me-2"></i>Nouvelle Vente - Information Client</h5>
                      </div>
                      <div class="card-body">
                        <form action="../models/add/add-vente.php" method="post">
                          <div class="mb-3">
                            <label class="form-label">Nom du Client <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" placeholder="Ex: KAMBALE KILIMA" name="client" required autocomplete="off">
                          </div>
                          <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-custom" name="valider_new">
                              <i class="bi bi-arrow-right me-1"></i>Suivant
                            </button>
                            <a href="vente.php?fin" class="btn btn-outline-secondary">Annuler l'opération</a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Formulaire de Vente -->
                <?php elseif(isset($_GET['com']) || isset($_GET['id'])): ?>
                <div class="row">
                  <!-- Formulaire -->
                  <div class="col-lg-6 mb-4">
                    <div class="card card-custom form-section">
                      <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-cart-plus me-2"></i>Détails de la Vente</h5>
                      </div>
                      <div class="card-body">
                        <form action="<?=$action?>" method="POST">
                          <div class="row g-3">
                            <div class="col-12">
                              <label class="form-label">Type de Carburant</label>
                              <select name="type" class="form-select" required>
                                <option value="essence">Essence</option>
                                <option value="mazout">Mazout</option>
                              </select>
                            </div>
                            <div class="col-12">
                              <label class="form-label">Type d'Achat</label>
                              <select name="type_achat" class="form-select" required>
                                <option value="litre">Litre</option>
                                <option value="fut">Fut</option>
                              </select>
                            </div>
                            <div class="col-12">
                              <label class="form-label">Quantité <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="Ex: 12.5" name="qte" 
                                     value="<?=isset($_GET['id']) ? $modData['quantite'] : ''?>" required autocomplete="off">
                            </div>
                            
                            <?php if(isset($_SESSION['notif'])): ?>
                            <div class="col-12">
                              <div class="alert alert-<?=$_SESSION['color']?> alert-custom">
                                <i class="bi bi-<?=$_SESSION['icon']?> me-2"></i>
                                <?=$_SESSION['notif']; unset($_SESSION['notif'])?>
                              </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-12">
                              <?php if(isset($_GET['id'])): ?>
                              <div class="row g-2">
                                <div class="col-8">
                                  <button type="submit" class="btn btn-success w-100 btn-custom" name="valider">
                                    <i class="bi bi-check-lg me-1"></i><?=$bouton?>
                                  </button>
                                </div>
                                <div class="col-4">
                                  <a href="vente.php" class="btn btn-secondary w-100">Annuler</a>
                                </div>
                              </div>
                              <?php else: ?>
                              <button type="submit" class="btn btn-success w-100 btn-custom" name="valider">
                                <i class="bi bi-check-lg me-1"></i>Valider
                              </button>
                              <?php endif; ?>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Panier -->
                  <div class="col-lg-6">
                    <div class="card card-custom">
                      <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Détails de la Commande</h5>
                      </div>
                      <div class="card-body">
                        <?php if(isset($_GET['com'])): ?>
                        <div class="receipt-header mb-4 p-3 bg-light rounded">
                          <h6 class="fw-bold mb-2">STATION ENERGIE MUYISA</h6>
                          <p class="mb-1"><strong>Client:</strong> <?=$detail['client']?></p>
                          <p class="mb-1"><strong>Date:</strong> <?=date('d/m/Y', strtotime($detail["dates"]))?></p>
                          <p class="mb-0"><strong>Paiement:</strong> <?=$detail['type']==1 ? "Cash" : "Crédit"?></p>
                        </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead class="table-dark">
                              <tr>
                                <th>Qte</th>
                                <th>Désignation</th>
                                <th>P.U ($)</th>
                                <th>P.T ($)</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $numero=0;
                              $total=0;
                              $totalo=0;
                              while($data=$Selpanier->fetch()):
                                $numero++;
                                $PT=$data['prixunitaire']*$data['quantite'];
                                $total+=$PT;
                                $totalo=$total;
                              ?>
                              <tr>
                                <td><?=$data['quantite']?></td>
                                <td><?=ucfirst($data['type_achat'])." ".$data['type']?></td>
                                <td><?=number_format($data['prixunitaire'], 2)?></td>
                                <td><?=number_format($PT, 2)?></td>
                                <td>
                                  <a href="../models/del/del-vente.php?iddelpanier=<?=$data['id']?>&com=<?=$_GET['com']?>" 
                                     class="btn btn-danger btn-sm" 
                                     onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">
                                    <i class="bi bi-trash"></i>
                                  </a>
                                </td>
                              </tr>
                              <?php endwhile; ?>
                              <tr class="table-active fw-bold">
                                <td colspan="3" class="text-end">TOTAL:</td>
                                <td colspan="2"><?=number_format($total, 2)?> $</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="row g-2 mt-3">
                          <div class="col-4">
                            <a href="../models/del/del-vente.php?cancel=<?=$_GET['com']?>" 
                               class="btn btn-outline-danger w-100 btn-sm">
                              Annuler
                            </a>
                          </div>
                          <div class="col-8" <?= $totalo==0 ? 'hidden' : '' ?>>
                            <a href="facture_cash.php?com=<?=$_GET['com']?>" 
                               class="btn btn-dark w-100 btn-custom">
                              <i class="bi bi-printer me-1"></i>Valider & Imprimer
                            </a>
                          </div>
                          <div class="col-12 mt-2">
                            <a href="vente.php?new" class="btn btn-outline-primary w-100">
                              <i class="bi bi-plus-circle me-1"></i>Nouvelle Commande
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Vente Crédit -->
                <?php elseif(isset($_GET['idclient'])): ?>
                <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-8">
                    <div class="card card-custom">
                      <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Vente à Crédit</h5>
                      </div>
                      <div class="card-body">
                        <form action="../models/add/add-vente.php?client=<?=$_GET['idclient']?>" method="POST">
                          <div class="mb-3">
                            <label class="form-label">Type de Vente</label>
                            <select name="type" class="form-select" required>
                              <option value="2">Crédit</option>
                            </select>
                          </div>

                          <?php if(isset($_SESSION['notif'])): ?>
                          <div class="alert alert-<?=$_SESSION['color']?> alert-custom">
                            <i class="bi bi-<?=$_SESSION['icon']?> me-2"></i>
                            <?=$_SESSION['notif']; unset($_SESSION['notif'])?>
                          </div>
                          <?php endif; ?>

                          <div class="row g-2">
                            <div class="col-8">
                              <button type="submit" class="btn btn-warning w-100 btn-custom" name="valider_new">
                                <i class="bi bi-arrow-right me-1"></i>Suivant
                              </button>
                            </div>
                            <div class="col-4">
                              <a href="vente.php" class="btn btn-secondary w-100">Annuler</a>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Liste des Ventes -->
                <?php else: ?>
                <div class="row">
                  <div class="col-12">
                    <?php if(isset($_SESSION['notif'])): ?>
                    <div class="alert alert-<?=$_SESSION['color']?> alert-custom mb-4">
                      <i class="bi bi-<?=$_SESSION['icon']?> me-2"></i>
                      <?=$_SESSION['notif']; unset($_SESSION['notif'])?>
                    </div>
                    <?php endif; ?>

                    <div class="card card-custom">
                      <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i><?=$page_title?></h5>
                        <div class="no-print">
                          <span class="badge bg-primary fs-6">
                            Total: <?=number_format($totalg, 2)?> $
                          </span>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-custom">
                            <thead>
                              <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Montant ($)</th>
                                <th>Résultat</th>
                                <th class="no-print">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $numero=0;
                              $totalg=0;
                              while($data=$SelData->fetch()):
                                $numero++;
                                $total=0;
                                $com=$data['id'];
                                
                                $Selpanier=$connexion->prepare("SELECT * from panier where commande=?");
                                $Selpanier->execute(array($com));
                                
                                $resultat = "";
                                while($panier=$Selpanier->fetch()):
                                  $tot=$panier['quantite']*$panier['prixunitaire'];
                                  $total+=$tot;
                                  $resultat=$panier['resultat'];
                                endwhile;
                                
                                $totalg+=$total;
                                
                                $numclient=$data['client'];
                                $sel_client=$connexion->prepare("SELECT * from client where numero=?");
                                $sel_client->execute([$numclient]);
                                $client_data = $sel_client->fetch();
                                $client = $client_data ? $client_data['nom']." ".$client_data['postnom']." ".$client_data['prenom'] : $numclient;
                              ?>
                              <tr>
                                <td><?=$numero?></td>
                                <td><?=htmlspecialchars($client)?></td>
                                <td><?=date('d/m/Y', strtotime($data["dates"]))?></td>
                                <td>
                                  <span class="badge bg-<?=$data['type']==1 ? 'success' : 'warning'?>">
                                    <?=$data['type']==1 ? "Cash" : "Crédit"?>
                                  </span>
                                </td>
                                <td><strong><?=number_format($total, 2)?></strong></td>
                                <td><?=htmlspecialchars($resultat)?></td>
                                <td class="action-buttons no-print">
                                  <a href="facture_cash.php?com=<?=$data['id']?>" class="btn btn-info btn-sm" title="Voir">
                                    <i class="bi bi-eye"></i>
                                  </a>
                                  <a href="?idsup=<?=$data['id']?>" class="btn btn-danger btn-sm" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                  </a>
                                </td>
                              </tr>
                              <?php endwhile; ?>
                              <?php if($numero > 0): ?>
                              <tr class="table-success fw-bold">
                                <td colspan="4" class="text-end">TOTAL GÉNÉRAL:</td>
                                <td colspan="3"><?=number_format($totalg, 2)?> $</td>
                              </tr>
                              <?php else: ?>
                              <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                  <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                  Aucune vente trouvée pour cette période
                                </td>
                              </tr>
                              <?php endif; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <footer id="footer" class="no-print">
      <?php include_once('../include/footer.php'); ?>
    </footer>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center no-print">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- JS Files -->
  <?php include_once('../include/script_tab.php'); ?>

</body>
</html>